<!-- resources/views/student/profile.blade.php -->
@extends('layouts.star')

@section('content')
<div class="container">
    <h2>Student Profile</h2>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="profile-image" style="margin-right: 20px;">
                    <img src="{{ asset('star/template/images/faces/face8.jpg') }}" alt="Profile Image" class="img-thumbnail" style="width: 100px; height: 100px;">
                </div>
                <div>
                    <h5>{{ $student->name }}</h5>
                    <p><strong>Email:</strong> {{ $student->email }}</p>
                    <p><strong>Nombor IC:</strong> {{ $student->ic ?? 'N/A' }}</p>
                    <p><strong>Nombor Telefon:</strong> {{ $student->telefon ?? 'N/A' }}</p>
                    <p><strong>NDP:</strong> {{ $student->ndp ?? 'N/A' }}</p>
                    <p><strong>Kursus:</strong> {{ $student->kursus ?? 'N/A' }}</p>
                    <p><strong>Semester:</strong> {{ $student->semester ?? 'N/A' }}</p>
                    <p><strong>Alamat:</strong> {{ $student->alamat ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- resources/views/student/profile.blade.php -->
@extends('layouts.star')

@section('content')
<div class="container">
    <h2>Student Profile</h2>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="profile-image" style="margin-right: 20px;">
                    <img src="{{ asset('star/template/images/faces/face8.jpg') }}" alt="Profile Image" class="img-thumbnail" style="width: 100px; height: 100px;">
                </div>
                <div>
                    <h5>{{ $student->name }}</h5>
                    <p><strong>Email:</strong> {{ $student->email }}</p>
                    <p><strong>NDP:</strong> {{ $student->ndp ?? 'N/A' }}</p>
                    <p><strong>Kursus:</strong> {{ $student->kursus ?? 'N/A' }}</p>
                    <p><strong>Semester:</strong> {{ $student->semester ?? 'N/A' }}</p>
                    <p><strong>Nombor IC:</strong> {{ $student->ic ?? 'N/A' }}</p>
                    <p><strong>Alamat:</strong> {{ $student->alamat ?? 'N/A' }}</p>
                    <p><strong>Semester:</strong> {{ $student->semester ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('profildeve.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
