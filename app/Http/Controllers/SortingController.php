<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class SortingController extends Controller
{
    protected function applySorting(Request $request, $query)
    {
        $validSortFields = ['timestamp', 'ndp', 'course', 'sebab'];
        $sortField = $request->get('sort_by', 'timestamp');
        $sortDirection = $request->get('sort_direction', 'asc') === 'desc' ? 'desc' : 'asc';

        $sortField = in_array($sortField, $validSortFields) ? $sortField : 'timestamp';
        return $query->orderBy($sortField, $sortDirection);
    }
}


// TODO:fix the sorting stuff