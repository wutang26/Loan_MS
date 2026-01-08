<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        //AUTH FOR usertype handle and Separate Dashboard for isAdmin, isStaff, loanOffice, user.
        $user = auth()->user(); //  get logged-in user

    // Role-based redirection
    if ($user->usertype === 'admin') {
        return redirect()->route('admin.index');
    }

    if ($user->usertype === 'staff') {
        return redirect()->route('admin.staff');
    }

    if ($user->usertype === 'loan_officer') {
        return redirect()->route('admin.loan_officer');
    }

    // Default user
    return redirect()->route('dashboard');

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



    //Nimeongeza hii usisahau accountant
    protected function authenticated($request, $user)
{
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('loan-officer')) {
        return redirect()->route('loans.applications');
    }

    if ($user->hasRole('accountant')) {
        return redirect()->route('reports.index');
    }

    return redirect()->route('login');
}

}
