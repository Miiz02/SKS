@extends('layouts.default')

@section('content')
    <h1>Admin Attendance Confirmation</h1>
    
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Time</th>
                <th>Date</th>
                <th>Confirmed Attendance</th>
                <th>Uploaded File</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->user->course }}</td>
                    <td>{{ $attendance->user->semester }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->timestamp)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->timestamp)->format('Y-m-d') }}</td>
                    <td>{{ $attendance->confirmed ? 'Attended' : 'Not Attended' }}</td>
                    <td>
                        @if($attendance->picture)
                            <a href="{{ asset('storage/' . $attendance->picture) }}" target="_blank">View File</a>
                        @else
                            No file uploaded
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
