<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupLoanRepayment; // <- Import your model!

class GroupRepaymentController extends Controller
{
    //
     

      public function store(Request $request)
    {
        // You might want to validate inputs first
        $validated = $request->validate([
            'loan_id' => 'required|exists:group_loans,id',
            'amount' => 'required|numeric|min:0',
            'paid_at' => 'nullable|date',
        ]);

        GroupLoanRepayment::create($validated);

        return back()->with('success', 'Repayment recorded successfully.');
    }
}
