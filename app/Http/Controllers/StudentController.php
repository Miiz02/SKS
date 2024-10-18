<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Attendance::where('user_id', auth()->id());
    
        $validSortFields = ['timestamp', 'ndp', 'course', 'reason'];
        $sortField = $request->get('sort_by', 'timestamp');
        $sortDirection = $request->get('sort_direction', 'asc') === 'desc' ? 'desc' : 'asc';
    
        $sortField = in_array($sortField, $validSortFields) ? $sortField : 'timestamp';
        $query->orderBy($sortField, $sortDirection);
    
        // Apply pagination and retain sorting parameters
        $attendances = $query->paginate(10)->appends([
            'sort_by' => $sortField,
            'sort_direction' => $sortDirection,
        ]);
    
        $userName = auth()->user()->name;
    
        return view('student.dashboard', compact('attendances', 'userName', 'sortField', 'sortDirection'));
    }
    
    public function create()
    {
        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;
        return view('student.create', compact('userName', 'userEmail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attendance_status' => 'required|in:present,absent', // Maintain existing logic for user input
            'timestamp' => 'required|date',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $path = $request->hasFile('picture')
            ? $request->file('picture')->storeAs('pictures', time() . '.' . $request->file('picture')->extension(), 'public')
            : null;
    
        // Error handling for picture upload
        if ($request->hasFile('picture') && !$path) {
            return back()->with('error', 'Failed to upload picture. Please try again.');
        }
    
        // Determine confirmed value based on user input
        $confirmedValue = null; // Default to null for Pending
        if ($request->attendance_status === 'present') {
            $confirmedValue = 1; // Present
        } elseif ($request->attendance_status === 'absent') {
            $confirmedValue = 0; // Absent
        }
    
        Attendance::create([
            'user_id' => auth()->id(),
            'attendance_status' => $confirmedValue, // Save the confirmed value
            'timestamp' => date('Y-m-d H:i:s', strtotime($request->timestamp)),
            'picture' => $path,
        ]);
    
        return redirect()->route('student.dashboard')->with('success', 'Attendance recorded successfully!');
    }
    
}
