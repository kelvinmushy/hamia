<?php
namespace App\Http\Controllers\Companies\Project;

use App\Models\CustomerPayment;
use App\Models\ProjectDivision;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerPaymentController extends Controller
{
    // Show the payment form (Uza modal)
    public function create($projectId, $divisionId)
    {
        $division = ProjectDivision::findOrFail($divisionId);
        $customers = Customer::all(); // You can also filter Customers based on the project or division

        return response()->json([
            'customers' => $customers,
            'division' => $division
        ]);
    }

    // Store the payment details (cash or installment)
    public function store(Request $request, $projectId, $divisionId)
    {
        // Validate the payment data
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'payment_method' => 'required|in:bank_transfer,cash,tigo_pesa,voda_m_pesa,halopesa', // More descriptive payment methods
            'payment' => 'required|numeric', // The payment amount
            'payment_frequency' => 'nullable|in:weekly,monthly', // Frequency options
            'installment_count' => 'nullable|integer|min:1', // Optional, only if installment is applicable
        ]);

        // Find the division
        $division = ProjectDivision::findOrFail($divisionId);
        $sellPrice = $division->sell_price;  // Get the sell price of the division

        // Create the payment record
        $payment = new CustomerPayment();
        $payment->customer_id = $validatedData['customer_id'];
        $payment->payment_method = $validatedData['payment_method'];  // Descriptive payment method
        $payment->payment = $validatedData['payment']; // The amount paid
        $payment->division_id = $divisionId; // Reference the project division
         $payment->save();

        // Track the total money collected for this division (sum of all payments)
        $totalPaid = CustomerPayment::where('division_id', $divisionId)
            ->sum('payment');  // Sum of all payments

        // Update the ProjectDivision table's payment status and attributes based on total paid
        if ($totalPaid >= $sellPrice) {
            // If the total paid equals or exceeds the sell price, mark as 'completed'
            $division->payment_status = 'completed';
        } else {
            // Otherwise, mark as 'ongoing'
            $division->payment_status = 'ongoing';
        }

        // Update the ProjectDivision table with the payment details from the payment record
        $division->payment_type = $request->payment_type;  // Set the payment type
        $division->payment_frequency = $validatedData['payment_frequency'];  // Set the payment frequency
        $division->installment_count = $validatedData['installment_count'];  // Set the number of installments
        
        $division->save();

        // Return a success message or response
        return response()->json([
            'message' => 'Payment successfully processed!',
            'payment_status' => $division->payment_status,  // Return the updated payment status
            'total_paid' => $totalPaid // Include the total paid amount
        ]);
    }
}
