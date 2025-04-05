<?php
namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Models\Project;

use App\Models\CustomerRepayment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        // Get all projects for customer to choose from
        $projects = Project::all();
        return view('company.customer.register', compact('projects'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate customer information and payment
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:customers,email',
                'phone' => 'required|string',
                'address' => 'required|string',
                'project_id' => 'required|exists:projects,id',
                'payment_method' => 'required|string', // Cash or Installment
                'amount_paid' => 'required|numeric',
                'installment_period' => 'nullable|numeric',
                'installment_amount' => 'nullable|numeric',
            ]);

            // Create customer
            $customer = Customer::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);

            // Get the selected project
            $project = Project::find($validated['project_id']);
            
            // Check if payment is installment and store accordingly
            $repayment = ProjectRepayment::create([
                'project_id' => $validated['project_id'],
                'customer_id' => $customer->id,
                'payment_method' => $validated['payment_method'],
                'amount_paid' => $validated['amount_paid'],
                'remaining_balance' => $project->price - $validated['amount_paid'],
            ]);

            // If it's installment, save the installment info
            if ($validated['payment_method'] == 'installment') {
                $repayment->installment_period = $validated['installment_period'];
                $repayment->installment_amount = $validated['installment_amount'];
                $repayment->save();
            }

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Mteja amesajiliwa kwa mafanikio!'], 200);

        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();
            return response()->json(['error' => 'Kusajili mteja kumeshindikana, tafadhali jaribu tena.'], 500);
        }
    }
}
