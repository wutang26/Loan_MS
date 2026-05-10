<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Contribution;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Models\Penalty;
use App\Models\WalletTransaction;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Group::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    $groups = $query->latest()->get();

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        $users = User::all();
        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $group = Group::create($request->only(
            
        'name', 'description','penalty_amount','monthly_contribution'
        
        ));

        if ($request->users) {
            foreach ($request->users as $userId => $share) {
                $group->users()->attach($userId, [
                    'share_percentage' => $share
                ]);
            }
        }

        return redirect()->route('groups.index');
    }

   
    /**
     * Display the specified resource.
     */
   public function show(Group $group)
{
    // Only contributions for THIS group
    $contributions = Contribution::where('group_id', $group->id)->get();

    // Total paid contributions
    $totalContributions = $contributions->where('status', 'paid')->sum('amount');

    // Total expenses/transactions (outflow)
    $totalTransactions = WalletTransaction::where('group_id', $group->id)
                        ->where('type', 'debit')
                        ->sum('amount');

    // Available balance
    $balance = $totalContributions - $totalTransactions;

    $wallets = WalletTransaction::all();

    return view('groups.show', compact('group', 'contributions', 'balance','wallets','totalContributions'));

    
}




//Contributions Section
 public function addContribution(Group $group)
    {
      
     
        $members = $group->members;

        $user = Auth::user();

       

        $user = Auth::user(); // logged in user

        return view('contributions.add_contribution', compact(
            'group',
            'members',
            'user',
          
        ));
    }

    /**
     * Store contribution
     */
    public function storeContribution(Request $request, Group $group)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount'    => 'required|numeric|min:0',
            'month'     => 'required|string',
            'year'      => 'required|numeric',
            'status'    => 'required'
        ]);

        Contribution::create([

            'group_id' => $group->id,

            'member_id' => $request->member_id,

            'amount' => $request->amount,

            'month' => $request->month,

            'year' => $request->year,

            'status' => $request->status,

            'paid_at' => $request->status == 'paid'
                ? now()
                : null,
        ]);

       return redirect()->route('groups.show', $group->id)
    ->with('success', 'Contribution added successfully');
    }


    //Register A member to Group
    public function registerMembers(Group $group)
{
    // $members = Member::whereNull('group_id')->get(); // only unassigned members

   $members = Member::all();

    return view('groups.register_member', compact('group', 'members'));
}

    //Attach Group Members
    public function attachMembers(Request $request, Group $group)
{
    $request->validate([
        'member_ids' => 'required|array'
    ]);

    Member::whereIn('id', $request->member_ids)
        ->update(['group_id' => $group->id]);

    return redirect()
        ->route('groups.show', $group->id)
        ->with('success', 'Members added successfully');
}

//Show Members Exit in a group
public function showMembers(Group $group)
{
    $members = $group->members()->latest()->get();

    return view('groups.available_members', compact('group', 'members'));
}


//Handle Penalties logic

public function createPenalties(Group $group)
{

    $members = $group->members;

    $user = Auth::user();

    

    $user = Auth::user(); // logged in user

    return view('penalties.create_penalties', compact('group', 'members','user'));
}


  public function storePenalties(Request $request, Group $group)
    {
        $request->validate([

            'member_id' => 'required|exists:members,id',

            'amount' => 'required|numeric|min:0',

            'reason' => 'required|string',

            'status' => 'required'
        ]);

        Penalty::create([

            'group_id' => $group->id,

            'member_id' => $request->member_id,

            'contribution_id' => $request->contribution_id,

            'amount' => $request->amount,

            'reason' => $request->reason,

            'status' => $request->status,
        ]);

        return redirect()
            ->route('groups.show', $group->id)
            ->with('success', 'Penalty added successfully');
    }


//Show Penalties
public function showPenalties(Group $group)
{
    $penalties = Penalty::where('group_id', $group->id)
        ->latest()
        ->get();

    return view(
        'penalties.show_penalties',
        compact('group', 'penalties')
    );

}


//Group Controller 
public function payPenalty(Penalty $penalty)
{
    $penalty->update([
        'status' => 'paid'
    ]);

    return back()->with(
        'success',
        'Penalty paid successfully'
    );
}


//Create A wallet for 
public function showWallet(Group $group)
{
    // Total contributions (inflow)
    $totalContributions = Contribution::where('group_id', $group->id)
                            ->where('status', 'paid') // only paid contributions
                            ->sum('amount');

    // Total expenses/transactions (outflow)
    $totalTransactions = WalletTransaction::where('group_id', $group->id)
                            ->where('type', 'debit') // money spent
                            ->sum('amount');

    // Available Balance
    $balance = $totalContributions - $totalTransactions;

    // Optionally, show all transactions
    $transactions = WalletTransaction::where('group_id', $group->id)
                        ->latest()
                        ->get();

    return view('groups.wallet', compact('group', 'balance', 'transactions'));
}

    /**
     * Show the form for editing the specified resource.
     */
   // Show edit form
public function edit($id)
{
    $group = Group::findOrFail($id);
    return view('groups.edit', compact('group'));
}

// Handle update
public function update(Request $request, $id)
{
    $group = Group::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'monthly_contribution' => 'required|numeric|min:0',
        'penalty_amount' => 'required|numeric|min:0',
    ]);

    $group->update($request->only('name', 'description', 'monthly_contribution', 'penalty_amount'));

    return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $group = Group::findOrFail($id);

    // Optional: detach members first if needed
    // $group->users()->detach();
    // $group->members()->update(['group_id' => null]);

    $group->delete();

    return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
}
}
