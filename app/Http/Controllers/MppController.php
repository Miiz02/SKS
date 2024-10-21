<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MppController extends SortingController
{
    /**
     * Display the dashboard with attendance records, including sorting and pagination.
     */
    public function index(Request $request)
    {
        // Start the query, eager-loading the 'user' relationship
        $query = Attendance::with('user');

        // Filter by date if provided
        if ($request->has('date') && !empty($request->input('date'))) {
            $date = Carbon::createFromFormat('Y-m-d', $request->input('date'));
            $query->whereDate('created_at', $date); // Assuming 'created_at' is the date field in your attendance table
        }

        // Apply sorting (from SortingController)
        $query = $this->applySorting($request, $query);

        // Paginate the results
        $attendances = $query->paginate(10); // Adjust items per page as needed

        // Retain sorting and date parameters in pagination links
        $attendances->appends($request->only('sort_by', 'sort_direction', 'date'));

        return view('mpp.dashboard', compact('attendances'));
    }

    /**
     * Display the MPP submission page.
     */
    public function approve(Request $request)
    {
        // Start the query, eager-loading the 'user' relationship
        $query = Attendance::with('user');
        
        // Filter by date if provided
        if ($request->has('date') && !empty($request->input('date'))) {
            $date = Carbon::createFromFormat('Y-m-d', $request->input('date'));
            $query->whereDate('created_at', $date); // Adjust this to your date column
        }
        
        // Apply sorting (from SortingController)
        $query = $this->applySorting($request, $query);
        
        // Paginate the results
        $attendances = $query->paginate(10); // Adjust items per page as needed
        
        // Retain sorting and date parameters in pagination links
        $attendances->appends($request->only('sort_by', 'sort_direction', 'date'));
        
        return view('mpp.approve', compact('attendances'));
    }
    
    // ... rest of your controller methods
    public function confirm(Request $request, $id)
    {
        // Validate the request to ensure the confirmed_status is provided
        $request->validate([
            'confirmed_status' => 'required|boolean', // Ensure this is a boolean value
        ]);
    
        // Find the attendance record by ID
        $attendance = Attendance::findOrFail($id);
    
        // Update the confirmed column based on the submitted value
        $attendance->confirmed = $request->input('confirmed_status');
        $attendance->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Attendance confirmation updated successfully.');
    }
    

}
