<?php

namespace App\Http\Controllers;

use App\Models\Attendance; // Ensure you import the Attendance model
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
{
    $query = Attendance::where('user_id', auth()->id());

    // Initialize variables for sorting
    $validSortFields = ['timestamp', 'ndp', 'course', 'reason']; // List of valid columns
    $sortField = $request->get('sort_by', 'timestamp'); // Default sort field
    $sortDirection = $request->get('sort_direction', 'asc'); // Default sort direction

    // Check if the requested sort field is valid
    if (in_array($sortField, $validSortFields)) {
        $query->orderBy($sortField, $sortDirection);
    } else {
        // If not valid, default to sorting by 'timestamp'
        $query->orderBy('timestamp', $sortDirection);
    }

    // Fetch attendance records for the authenticated user
    $attendances = $query->get(); 
    $userName = auth()->user()->name; // Get the authenticated user's name

    return view('student.dashboard', compact('attendances', 'userName', 'sortField', 'sortDirection'));
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
