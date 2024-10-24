<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // Your registration form view
    }

    public function createStudent(Request $request)
    {
        // Log the incoming request data
        \Log::info('Registration attempt:', $request->all());
    
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // If validation fails, redirect back to the registration form with errors and old input
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Pass the validation errors
                ->withInput(); // Retain old input
        }
    
        // If validation passes, create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
    

}
