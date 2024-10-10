<?php

namespace App\Http\Controllers;

use App\Models\Attendance; // Ensure you import the Attendance model
use Illuminate\Http\Request;

class MppController extends Controller
{
    public function index()
{
    // Fetch all attendance records for MPP role
    $attendances = Attendance::with('user')->get(); // Get all attendances

    return view('mpp.dashboard', compact('attendances'));
}

    public function confirm(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        
        // Update confirmation status based on radio button
        if ($request->input('confirmed_status') === 'attend') {
            $attendance->confirmed = 1; // Mark as attended
        } else {
            $attendance->confirmed = 0; // Mark as not attended
        }

        $attendance->save();

        return redirect()->route('mpp.dashboard')->with('success', 'Attendance confirmation updated successfully!');
    }
}
