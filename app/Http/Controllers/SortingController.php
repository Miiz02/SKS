<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class SortingController extends Controller
{
    protected function applySorting(Request $request, $query)
    {
        // Define valid sort fields
        $validSortFields = ['timestamp', 'kursus', 'sebab'];
    
        // Retrieve the sort field and direction from the request, with defaults
        $sortField = $request->get('sort_by', 'timestamp');
        $sortDirection = $request->get('sort_direction', 'desc'); // Default to 'desc' for latest first
    
        // Validate and sanitize sort field
        if (!in_array($sortField, $validSortFields)) {
            $sortField = 'timestamp'; // Default to 'timestamp' if invalid
        }
    
        // Validate sort direction
        $sortDirection = strtolower($sortDirection) === 'desc' ? 'desc' : 'asc';
    
        // Apply sorting to the query
        return $query->orderBy($sortField, $sortDirection);
    }
    
}
