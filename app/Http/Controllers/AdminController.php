<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\User;
use App\Models\Member;
use App\Models\Region;
use App\Models\Group;
use App\Models\Loan;
use Illuminate\Http\Request;
use App\Models\GroupLoan;
use App\Models\GroupLoanMember;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //Welcome index page
    public function index()
    {

        return view('admin.index');
    }


    //Loan Members
    public function members()
    {

        //$members = Member::all();
       
         //Egar load a relation ship controller for member and districts and region
        $members = Member::with(['region', 'district'])->get();

        return view('admin.members.index', compact('members'));
    }

    //Create members function
    public function create()
    {

        $regions = Region::all();

        $districts = District::all();

        return view('admin.members.create', compact('regions', 'districts'));
    }

    // Store members
    public function store(Request $request)
    {
        //Pass and Validate first
        $request->validate([
            'member_number'     => 'required|string|max:255', //or "required"
            'first_name'     => 'required|string|max:255', //or "required"
            'middle_name'     => 'required|string|max:255', //or "required"
            'last_name'     => 'required|string|max:255', //or "required"
            'phone'     => 'required|string|max:255', //or "required"
            'address'     => 'required|string|max:255', //or "required"
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
            'date_joined' => 'required|date',
            'status'     => 'required|string|max:255', //or "required"

            //'email'    => 'required|email|unique:users,email', //or  "required"
            //'password' => 'required|min:6', #Should not be empty |minimum length/value must be 6  or  "required"
        ]);

        Member::create([
            'member_number'     => $request->member_number,
            'first_name'    => $request->first_name,
            'middle_name'    => $request->middle_name,
            'last_name'    => $request->last_name,
            'phone'    => $request->phone,
            'address'    => $request->address,
            'region_id'    => $request->region_id,
            'district_id'    => $request->district_id,
            'date_joined'    => $request->date_joined,
            'status'    => $request->status,

            //'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member created successfully');
    }


    //Edit Function
    public function edit(string $id)
    {

        $member = Member::find($id);

        $regions = Region::all();

        $districts = District::all();

        return view('admin.members.edit', compact('member','regions','districts'));
    }

    public function update(Request $request, string $id)
    {

        //Validate
        $request->validate([
              'member_number'     => 'required|string|max:255', //or "required"
            'first_name'     => 'required|string|max:255', //or "required"
            'middle_name'     => 'required|string|max:255', //or "required"
            'last_name'     => 'required|string|max:255', //or "required"
            'phone'     => 'required|string|max:255', //or "required"
            'address'     => 'required|string|max:255', //or "required"
            'region_id' => 'required|exists:regions,id',
            'district_id' => 'required|exists:districts,id',
            'date_joined' => 'required|date',
            'status'     => 'required|string|max:255', //or "required"

            // 'email'    => 'required|email|unique:users,email', //or  "required"
            // 'password' => 'required|min:6', #Should not be empty |minimum length/value must be 6  or  "required"
        ]);

        $member = Member::find($id);
        $member->member_number = $request->member_number;
        $member->first_name = $request->first_name;
        $member->middle_name = $request->middle_name;
        $member->last_name = $request->last_name;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->region_id = $request->region_id;
        $member->district_id = $request->district_id;
        $member->date_joined = $request->date_joined;
        $member->status = $request->status;
        //$member->password = Hash::make($request->password);
        $member->save();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member updated successfully');
    }

    //Delete a member 
    public function deleteMember($id)
        {
            $member = Member::findOrFail($id);
            $member->delete();

    return redirect()
        ->route('admin.members.index')
        ->with('success', 'Member deleted successfully');
    }


    //Statics Dashboard And Estimations
      
    public function dashboard()
    {
        //Render All Groups
        $groups = Group::all();

        //Loans active
    $loans = Loan::with('group.members')
    ->where('application_status', 'disbursed')
    ->get();

        //Active Loans
        
       $active_loans = Loan::where('application_status', 'disbursed')->get();

        //Outstanding Loans
         if (auth()->user()->hasRole(['admin', 'super-admin'])) {

        // Admin sees all loans with remaining balance
        $out_standing_loans = Loan::where('outstanding_loan', '>', 0)
                    ->with('user')
                    ->get();

    } else {

        // Normal user sees only own outstanding loans
        $out_standing_loans = Loan::where('user_id', auth()->id())
                    ->where('outstanding_loan', '>', 0)
                    ->with('user')
                    ->get();
    }

    //Ongoing Loans
    $ongoing_loans = Loan::where('application_status', 'disbursed')
    ->where('outstanding_loan', '>', 0)
    ->count();

    //Paid Loans
    $paid_loans = Loan::where('outstanding_loan', '<=', 0)
        ->where('application_status', 'disbursed')
        ->count();

    //overdue loans
    $overdue_loans = Loan::whereHas('repayments', function ($query) {
            $query->where('status', 'pending')
                ->where('due_date', '<', now());
        })
        ->count();
   
    //Loop through Group Loan Table
    $group_loans = GroupLoan::get();

    //Member
    $members = Member::get();

  $loans = Loan::with('group.members')->get();

  return view('statics.estimated_joined', compact('groups','loans','active_loans','out_standing_loans',
  'ongoing_loans','paid_loans','overdue_loans','group_loans','members'
));

}
}
