<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WelfareSupport;
use App\Models\Group;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WelfareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::all();
        $users = User::all();
        $event_types = EventType::all();
        $supports = WelfareSupport::with(['group', 'eventType', 'approvedBy'])
                    ->latest()
                    ->paginate(10);

        return view('welfareSupports.index', compact('supports', 'groups', 'users', 'event_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all();
        $eventTypes = EventType::all();
        $users = User::all();

        return view('welfareSupports.create', compact('groups', 'eventTypes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
            'event_type_id' => 'required|exists:event_types,id',
            'mode' => 'required|in:support,loan',
            'amount' => 'required|numeric|min:0',
            'repayment_amount' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->mode === 'loan' && ($value === null || $value === '')) {
                        $fail('The repayment amount field is required for loans.');
                    }
                }
            ],
            'description' => 'nullable|string|max:1000',
        ]);

        WelfareSupport::create([
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
            'event_type_id' => $request->event_type_id,
            'mode' => $request->mode,
            'amount' => $request->amount,
            'repayment_amount' => $request->mode === 'loan' ? $request->repayment_amount : null,
            'approved_by' => Auth::id(),
            'description' => $request->description,
        ]);

        return redirect()->route('welfareSupports.index')
                         ->with('success', 'Welfare support created successfully.');
    }

    /**
     * Show the individual welfare support.
     */
    public function show(WelfareSupport $welfareSupport)
    {
        return view('welfareSupports.show', compact('welfareSupport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WelfareSupport $welfareSupport)
    {
        $groups = Group::all();
        $eventTypes = EventType::all();
        $users = User::all();

        return view('welfareSupports.edit', compact('welfareSupport', 'groups', 'eventTypes', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WelfareSupport $welfareSupport)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
            'event_type_id' => 'required|exists:event_types,id',
            'mode' => 'required|in:support,loan',
            'amount' => 'required|numeric|min:0',
            'repayment_amount' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->mode === 'loan' && ($value === null || $value === '')) {
                        $fail('The repayment amount field is required for loans.');
                    }
                }
            ],
            'description' => 'nullable|string|max:1000',
        ]);

        $welfareSupport->update([
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
            'event_type_id' => $request->event_type_id,
            'mode' => $request->mode,
            'amount' => $request->amount,
            'repayment_amount' => $request->mode === 'loan' ? $request->repayment_amount : null,
            'description' => $request->description,
        ]);

        return redirect()->route('welfareSupports.index')
                         ->with('success', 'Welfare support updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WelfareSupport $welfareSupport)
    {
        $welfareSupport->delete();

        return redirect()->route('welfareSupports.index')
                         ->with('success', 'Welfare support deleted successfully.');
    }
}