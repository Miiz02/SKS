<?php

namespace App\Http\Controllers;

use App\Models\Attendance; // Ensure you import the Attendance model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all attendance records
        $attendances = Attendance::with('user')->get(); // Assuming 'user' relationship exists to fetch user details

        return view('admin.dashboard', compact('attendances')); // Pass the data to the view
    }
}
