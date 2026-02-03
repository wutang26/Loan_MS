<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Repayment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Member;
 use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class LoanApprovalController extends Controller
{
    //User will be able to see loans infomations Submitted(Pending) or Rejected or approved
            public function index()
        {

         if (auth()->user()->hasRole(['admin', 'super-admin'])) {
            
                // Admins see all loans
                $loans = Loan::with('user')->latest()->get();

            } else {
                // Normal users see ONLY their loans
            $loans = Loan::with('user') ->where('user_id', auth()->id())->latest()->get();
            }

            return view('admin.loans.show_loans', compact('loans'))->with('i', 0);
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

            // Handle Loan Statuses
            public function loansByStatus($application_status)
            {
                // Validate status
                $validStatuses = ['pending', 'approved', 'rejected', 'disbursed'];
                if (!in_array($application_status, $validStatuses)) {
                    abort(404, 'Invalid loan status');
                }

                // Fetch loans with user relation (assuming 'user' not 'user_id')
                $loans = Loan::with('user') // <- use relation name, not user_id
                            ->where('application_status', $application_status)
                            ->get();

                return view('admin.loans.loans_by_status', compact('loans', 'application_status'));
            }

            //Show Rejected or Approved Loans Or Disbused Based on admin Approval
         public function approvedLoans()
            {
                $user = auth()->user();

                if (!$user) {
                    abort(403, 'Unauthorized');
                }

                // Optional: remind normal users if they have active loan
                if ($user->hasActiveLoan() && !$user->hasAnyRole(['super-admin', 'admin'])) {
                    return back()->with('error', 'You must finish repaying your current loan first.');
                }

                // Query approved loans
                $query = Loan::where('application_status', 'approved');

                // Restrict to own loans if not admin
                if (! $user->hasAnyRole(['super-admin', 'admin'])) {
                    $query->where('user_id', $user->id);
                }

                $loans = $query->get();

                return view('admin.loans.approved_loan', compact('loans'));
            }

                //Updating Status Controller
                    public function updateStatus(Request $request, Loan $loan)
                        {
                            $request->validate([
                                'status' => 'required|in:pending,approved,rejected,disbursed'
                            ]);

                            $loan->application_status = $request->status;
                            $loan->save();

                            return back()->with('success', 'Loan status updated successfully.');
                        }


            // Loan Disbursement
          public function disburseLoan(Loan $loan)
            {
                $user = auth()->user();

                if (!$user->hasAnyRole(['super-admin', 'admin'])) {
                    abort(403, 'Unauthorized');
                }

                if ($loan->application_status !== 'approved') {
                    return back()->with('error', 'Loan must be approved before disbursement.');
                }

                // Prevent double disbursement
                if ($loan->application_status === 'disbursed') {
                    return back()->with('error', 'Loan already disbursed.');
                }

                DB::transaction(function () use ($loan) {

                    //  Update loan status
                    $loan->update([
                        'application_status' => 'disbursed',
                        'disbursed_at' => now(),
                        'outstanding_loan' => $loan->total_repayment,
                    ]);

                    //  Create repayment schedule
                    $months = $loan->loan_period_months ?? 1;
                    $monthlyAmount = floor(($loan->total_repayment / $months) * 100) / 100;

                    $remaining = $loan->total_repayment;

                    for ($i = 1; $i <= $months; $i++) {

                        // Fix rounding on last installment
                        $amount = ($i == $months) ? $remaining : $monthlyAmount;

                        $loan->repayments()->create([
                            'installment_no' => $i,
                            'due_date' => Carbon::now()->addMonths($i)->format('d-m-y'),
                            'amount' => $amount,
                            'status' => 'pending',
                        ]);

                        $remaining -= $amount;
                    }
                });

                return back()->with('success', 'Loan disbursed and repayment schedule created.');
            }
  
                    /**
     * Show repayment schedule for a single loan
     */
            public function repayments($loanId){
                    $user = auth()->user();

                    $loan = Loan::with('repayments')->findOrFail($loanId);

                    if (!$user->hasAnyRole(['super-admin', 'admin']) && $loan->user_id !== $user->id) {
                        abort(403, 'Unauthorized');
                    }

            return view('loans.repayments', compact('loan'));
        }


        //Pay By Installment
        public function payInstallment($repaymentId)
            {
            $user = auth()->user();

            $repayment = LoanRepayment::with('loan')->findOrFail($repaymentId);
            $loan = $repayment->loan;

            // Security: user can only pay their own loan
            if (! $user->hasAnyRole(['super-admin', 'admin']) && $loan->user_id !== $user->id) {
                abort(403, 'Unauthorized');
            }

            // Only pending payments allowed
            if ($repayment->status !== 'pending') {
                return back()->with('error', 'This installment is already paid.');
            }

            // Mark installment paid
            $repayment->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            // Update loan totals
            $loan->increment('total_paid', $repayment->amount);
            $loan->decrement('outstanding_loan', $repayment->amount);

            // If fully paid → close loan
            if ($loan->outstanding_loan <= 0) {
                $loan->update([
                    'application_status' => 'completed'
                ]);
            }

            return back()->with('success', 'Installment paid successfully.');
        }

}
