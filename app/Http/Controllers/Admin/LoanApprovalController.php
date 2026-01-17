<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Repayment;

class LoanApprovalController extends Controller
{
    //User will be able to see loans infomations Submitted(Pending) or Rejected or approved
            public function index()
        {
            //$loans = Loan::where('status','pending')->get();
            
            $loans = Loan::all();
            $users = Loan::with('user')->latest()->get();


            return view('admin.loans.show_loans', compact('loans','users'));
        }
           
    //  Apply loans 
    public function create()
    {

        return view('admin.loans.apply_loan');
    }

            // Store loans
        public function store(Request $request)
        {
            $request->validate([
                'loan_amount'        => 'required|numeric|min:1000',
                'loan_period_months' => 'required|integer|min:1|max:60',
                'purpose'            => 'nullable|string|max:255',
            ]);
            
            
            $applicationDate = now()->toDateString(); // today

            $interestRate = 0.10; // 10%
            $totalRepayment = $request->loan_amount * (1 + $interestRate);

            $startDate = now();
            $endDate = now()->addMonths($request->loan_period_months);

            Loan::create([
                'user_id'              => auth()->id(),
                'loan_amount'          => $request->loan_amount,
                'loan_period_months'   => $request->loan_period_months,
                'interest_rate'      => $interestRate,   // ⚠ Corrected use defined above variable
                'total_repayment'      => $totalRepayment,
                'outstanding_loan'     => $totalRepayment,
                'start_date'           => $startDate,
                'end_date'             => $endDate,
                'application_date'   => $applicationDate,  // ⚠ Added
                'application_status'   => 'pending', // User should not submit status
                'purpose'              => $request->purpose,
            ]);

            return redirect()->route('loans.show_loans')
                ->with('success', 'Loan application submitted successfully');
        }




        //Loan approval
            public function approve(Loan $loan)
            {
                $loan->update([
                    'status' => 'approved',
                    'approved_at' => now(),
                ]);

                return back()->with('success','Loan approved');
            }
            
            
        //Loan reject
            public function reject(Loan $loan)
            {
                $loan->update(['status' => 'rejected']);
                return back()->with('error','Loan rejected');
            }


                //Loan Disbusement
                public function disburse(Loan $loan)
                {
                    if ($loan->status !== 'approved') {
                        return back()->with('error','Loan not approved');
                    }

                    $loan->update([
                        'status' => 'disbursed',
                        'disbursed_at' => now(),
                    ]);

                    // Later: integrate Mobile Money API here

                    return back()->with('success','Loan disbursed successfully');
                }


                    //Repayment 
                    public function repay(Request $request, Loan $loan)
                    {
                        Repayment::create([
                            'loan_id' => $loan->id,
                            'amount' => $request->amount,
                            'payment_date' => now(),
                            'payment_method' => 'cash'
                        ]);

                        if ($loan->totalPaid() >= $loan->amount) {
                            $loan->update(['status' => 'completed']);
                        }

                        return back()->with('success','Payment recorded');
                    }


//Additional concepts
//$loan->update(['status' => 'active']);

//Active loans only
//Loan::where('status','active')->get();



}
