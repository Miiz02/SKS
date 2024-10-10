@extends('layouts.default')

@section('content')
    <h1>MPP Home Page</h1>

    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Time</th>
                <th>Date</th>
                <th>Attendance Status</th>
                <th>Uploaded File</th>
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
                    <td>{{ $attendance->attendance_status }}</td>
                    <td>
                        @if($attendance->picture)
                            <a href="{{ asset('storage/' . $attendance->picture) }}" target="_blank">View File</a>
                        @else
                            No file uploaded
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('mpp.confirm', $attendance->id) }}" method="POST">
                            @csrf
                            <label>
                                <input type="radio" name="confirmed_status" value="attend" {{ $attendance->confirmed == 1 ? 'checked' : '' }}>
                                Attend
                            </label>
                            <label>
                                <input type="radio" name="confirmed_status" value="not_attend" {{ $attendance->confirmed == 0 ? 'checked' : '' }}>
                                Not Attend
                            </label>
                            <button type="submit">Submit</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
