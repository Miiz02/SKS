<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class StudentController extends SortingController
{
   
    public function index(Request $request)
    {
        $query = Attendance::where('user_id', auth()->id());

        // Apply sorting using the base method
        $query = $this->applySorting($request, $query);
        
        $attendances = $query->paginate(10)->appends($request->except('page')); // Retain other query parameters

        $userName = auth()->user()->name;

        return view('student.dashboard', compact('attendances', 'userName'));
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
        'attendance_status' => 'required|in:Hadir,Tidak Hadir',
        'timestamp' => 'required|date',
        'sebab' => 'nullable|string|max:1000',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $path = $request->hasFile('picture')
        ? $request->file('picture')->storeAs('pictures', time() . '.' . $request->file('picture')->extension(), 'public')
        : null;

    if ($request->hasFile('picture') && !$path) {
        return back()->with('error', 'Failed to upload picture. Please try again.');
    }

    // Directly use the attendance status from the form
    $confirmedValue = $request->attendance_status;

    Attendance::create([
        'user_id' => auth()->id(),
        'attendance_status' => $confirmedValue,
        'timestamp' => date('Y-m-d H:i:s', strtotime($request->timestamp)),
        'picture' => $path,
        'sebab' => $request->input('sebab'),
    ]);

    return redirect()->route('student.dashboard')->with('success', 'Attendance recorded successfully!');
}


    
}
