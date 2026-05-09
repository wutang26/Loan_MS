<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\WalletTransaction;
use App\Models\Contribution;


class WalletController extends Controller
{ // Show wallet balance and transactions
  public function showWallet(Group $group)
{
    $balance = $group->walletTransactions()->sum('amount'); // or your logic

    $transactions = $group->walletTransactions()->latest()->get();

    return view('wallets.show_wallet', compact('group', 'balance', 'transactions'));
}

    // Show form to add a new wallet transaction
    public function createTransaction(Group $group)
    {
        $members = $group->users; // Assuming a 'users' relation
        return view('wallets.create_transaction', compact('group', 'members'));
    }

    // Store a new wallet transaction
    public function storeTransaction(Request $request, Group $group)
    {
        $request->validate([
            'member_id' => 'nullable|exists:users,id', // Adjust if your member table differs
            'type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        WalletTransaction::create([
            'group_id' => $group->id,
            'member_id' => $request->member_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('groups.show', $group->id)
                         ->with('success', 'Transaction added successfully.');
    }
}
