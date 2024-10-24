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
            'telefon' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'kursus' => 'required|string',
            'semester' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        $user = $request->user();
        
        // Handle file upload
        if ($request->hasFile('profile_photo')) {
            // Store the new profile photo
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validatedData['profile_photo'] = $path; // Add the photo path to the validated data
        }

        $user->update($validatedData); // Update user information with validated data

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
