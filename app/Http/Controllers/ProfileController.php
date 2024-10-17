<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    // ProfileController.php
public function show(Request $request)
{
    // Fetch the authenticated user
    $student = $request->user();

    return view('student.profile', compact('student'));
}

    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = auth()->user(); // Get the authenticated user
        return view('profile.edit', compact('user')); // Pass user to view
    }
    
    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ndp' => 'required|string|max:10',
            'ic' => 'required|string|max:12',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'kursus' => 'required|string',
            'semester' => 'required|string',
        ]);
    
        $user = $request->user();
        $user->update($validatedData);
    
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Log out the user
        Auth::logout();

        // Delete the user account
        $user->delete();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
