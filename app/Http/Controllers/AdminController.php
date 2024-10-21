<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class WardenController extends SortingController
{
    public function index(Request $request)
    {
        $query = Attendance::query(); // Adjust the query based on your requirements

        // Apply sorting using the base method
        $query = $this->applySorting($request, $query);
        
        $attendances = $query->paginate(10)->appends($request->except('page')); // Retain other query parameters

        return view('warden.dashboard', compact('attendances'));
    }

    // Other methods...
}
