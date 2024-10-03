<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers; // Use the trait for default authentication methods

    public function __construct()
    {
        // Apply guest middleware for different user types
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:student')->except('logout');
    }

    // Show admin login form
    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    // Handle admin login
    public function adminLogin(Request $request)
    {
        // Validate login credentials
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in as admin
        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/admin'); // Redirect to admin dashboard
        }

        // If authentication fails, redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Show student login form
    public function showStudentLoginForm()
    {
        return view('auth.login', ['url' => 'student']);
    }

    // Handle student login
    public function studentLogin(Request $request)
    {
        // Validate login credentials
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in as student
        if (Auth::guard('student')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/student'); // Redirect to student dashboard
        }

        // If authentication fails, redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Optional: Handle logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Log out admin user
        Auth::guard('student')->logout(); // Log out student user

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to the homepage
    }
}
