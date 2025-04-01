<?php  

namespace App\Http\Controllers\Companies\Project;

use App\Models\ProjectRepayment;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; // Add this for DB transactions

class ProjectRepaymentController extends Controller
{
    public function store(Request $request)
    {
        // Start a transaction
        DB::beginTransaction();
    
        try {
            // Validate the request
            $validated = $request->validate([
                'project_id' => 'required|exists:projects,id', // Ensure the project exists
                'payment_date' => 'required|date', // Payment date should be valid
                'payment_amount' => 'required|numeric|min:1', // Payment amount should be positive
                'payment_method' => 'required|string', // Payment method is required
            ]);
    
            // Retrieve the project
            $project = Project::find($validated['project_id']);
    
            // Calculate the new total paid amount (including the new payment)
            $newAmountPaid = $project->payments->amount_paid + $validated['payment_amount'];
    
            // Calculate the remaining balance (total price - total paid amount)
            $remainingBalance = $this->calculateRemainingBalance($project, $newAmountPaid);
    
            // Store the repayment record
            $repayment = ProjectRepayment::create([
                'project_id' => $validated['project_id'],
                'payment_date' => $validated['payment_date'],
                'payment_amount' => $validated['payment_amount'],
                'payment_method' => $validated['payment_method'],
                'remaining_balance' => $remainingBalance, // Store the updated remaining balance
            ]);
    
            // Update the project's amount_paid and payment_status
            $project->payments->update(['amount_paid' => $newAmountPaid]);
    
            // Determine the payment status based on the new amount_paid
            $paymentStatus = $this->getPaymentStatus($project->payments->total_price, $newAmountPaid);
    
            // Update the payment status
            $project->payments->update(['payment_status' => $paymentStatus]);
    
            // Commit the transaction
            DB::commit();
    
            return response()->json(['message' => 'Repayment successfully recorded!'], 200);
    
        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollBack();
    
            // Return an error message
            return response()->json(['error' => 'Failed to record repayment. Please try again.'], 500);
        }
    }
    
    private function calculateRemainingBalance($project, $newAmountPaid)
    {
        // Calculate the remaining balance dynamically
        return $project->payments->total_price - $newAmountPaid;
    }
    
    private function getPaymentStatus($totalPrice, $amountPaid)
    {
        // Determine the payment status based on the new amount paid
        if ($amountPaid >= $totalPrice) {
            return 'completed';  // Fully Paid
        } elseif ($amountPaid > 0) {
            return 'ongoing';  // Partial Payment Made
        } else {
            return 'pending';  // No Payment Made Yet
        }
    }
    
}    