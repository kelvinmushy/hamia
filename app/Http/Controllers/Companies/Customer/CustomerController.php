<?php

namespace App\Http\Controllers\Companies\Customer;

use App\Models\Customer;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;

class CustomerController extends Controller
{
    public function index()
    {
        // Get all customers and regions
        $customers = Customer::with('district')->get();
        $regions = Region::all();

        return view('company.customer.index', compact('customers', 'regions'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate customer input
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'nullable|email|unique:customers,email',
                'phone_number' => 'required|string',
                'address' => 'required|string',
                'district_id' => 'required|exists:districts,id',
            ]);

            // Create customer
            Customer::create([
                'name' => $validated['name'],
                'company_id' => Auth::user()->company->id,
                'email' => $validated['email'] ?? null,
                'phone_number' => $validated['phone_number'],
                'district_id' => $validated['district_id'],
                'address' => $validated['address'],
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Customer added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2',
            'phone_number' => 'required|string|regex:/^255[0-9]{9}$/|size:12',
            'email' => 'nullable|email',
            'district_id' => 'required|exists:districts,id',
            'address' => 'required|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validated);

        return response()->json(['message' => 'Customer updated successfully.']);
    }

}
