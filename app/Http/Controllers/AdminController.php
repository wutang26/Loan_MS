<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\User;
use App\Models\Member;
use App\Models\Region;
use Illuminate\Http\Request;
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

}
