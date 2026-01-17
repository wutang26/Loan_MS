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
            $loans = Loan::where('status','pending')->get();

            return view('admin.loans.show_loans', compact('loans'));
        }
           
    //  Apply loans 
    public function create()
    {

        return view('admin.loans.apply_loan');
    }

    // Store loans
    public function store(Request $request)
    {
        //Pass and Validate first
        $request->validate([
            'first_name'     => 'required|string|max:255', //or "required"
            'middle_name'     => 'required|string|max:255', //or "required"
            'last_name'     => 'required|string|max:255', //or "required"
            'amount'     => 'required|string|max:255', //or "required"
            'total_repayment'     => 'required|string|max:255', //or "required"
            'outstanding_loan' => 'required|exists:regions,id',
            'status'     => 'required|string|max:255', //or "required"

            //'email'    => 'required|email|unique:users,email', //or  "required"
            //'password' => 'required|min:6', #Should not be empty |minimum length/value must be 6  or  "required"
        ]);

        Loan::create([
           
            'first_name'    => $request->first_name,
            'middle_name'    => $request->middle_name,
            'last_name'    => $request->last_name,
            'amount'    => $request->amount,
            'total_repayment'    => $request->total_repayment,
            'outstanding_loan'    => $request->region_id,
            'status'    => $request->status,

            //'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Loan created successfully');
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
