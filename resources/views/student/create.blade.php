{{-- resources/views/student/create.blade.php --}}
@extends('layouts.default')

@section('content')
    <h1>Create Attendance Record</h1>

    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $userName }}" readonly>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $userEmail }}" readonly>
        </div>

        <div>
            <label>Attendance:</label>
            <div>
                <input type="radio" id="attend" name="attendance_status" value="attend" required>
                <label for="attend">Attend</label>
            </div>
            <div>
                <input type="radio" id="not_attend" name="attendance_status" value="not_attend">
                <label for="not_attend">Not Attend</label>
            </div>
        </div>

        <div>
            <label for="timestamp">Timestamp:</label>
            <input type="datetime-local" id="timestamp" name="timestamp" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" required>
        </div>

        <div>
            <label for="picture">Upload Picture:</label>
            <input type="file" id="picture" name="picture" accept="image/*">
        </div>

        <button type="submit">Create Attendance</button>
    </form>
@endsection
