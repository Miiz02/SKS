<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
    /**
 * Handle an incoming authentication request.
 */
public function store(LoginRequest $request): RedirectResponse
{
    // Attempt to authenticate the user
    $request->authenticate();

    // Regenerate the session
    $request->session()->regenerate();

    // Debugging: Log the authenticated user details
    \Log::info('User logged in:', [
        'id' => $request->user()->id,
        'email' => $request->user()->email,
        'role' => $request->user()->role, // Check the role after login
    ]);

    // Redirect based on the user role
    switch ($request->user()->role) {
        case 'warden':
            return redirect()->route('admin.dashboard');
        case 'mpp':
            return redirect()->route('mpp.dashboard');
        default:
            return redirect()->intended(route('student.dashboard'));
    }
}



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
