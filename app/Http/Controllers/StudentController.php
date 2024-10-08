<?php

namespace App\Http\Controllers;

use App\Models\Attendance; // Ensure you import the Attendance model
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('user_id', auth()->id())->get(); // Fetch attendance records for the authenticated user
        $userName = auth()->user()->name; // Get the authenticated user's name
    
        return view('student.dashboard', compact('attendances', 'userName'));
    }
    
    public function create()
    {
        $userName = auth()->user()->name; // Get the authenticated user's name
        $userEmail = auth()->user()->email; // Get the authenticated user's email
        return view('student.create', compact('userName', 'userEmail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attendance_status' => 'required|string',
            'timestamp' => 'required|date',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate picture upload
        ]);

        // Handle picture upload if exists
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('pictures', 'public'); // Store in public disk
        } else {
            $path = null;
        }

        // Create attendance record
        Attendance::create([
            'user_id' => auth()->id(),
            'attendance_status' => $request->attendance_status,
            'timestamp' => $request->timestamp,
            'picture' => $path,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Attendance recorded successfully!');
    }
}
