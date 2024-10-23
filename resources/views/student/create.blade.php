@extends('layouts.star')

@section('content')
<style>
    .form-control {
        border: 1px solid #ccc; 
        border-radius: 4px; 
    }
    .form-control:focus {
        border-color: #6c757d; 
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25); 
    }
    .custom-label {
        padding-left: 5px; 
    }
    .form-check-input {
        margin-right: 5px; 
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <h1 style="font-weight: bold; padding-left: 30px;">Rekod Kehadiran</h1>
                    </div>

                    <div class="card card-rounded mt-4">
                        <div class="card-body">
                            <h3>Create Attendance Record</h3>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $userName }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $userEmail }}" readonly>
                                </div>
                                
                                <h5>Kehadiran</h5>
                                <div class="form-row">
                                    <div class="form-check col">
                                        <input type="radio" class="form-check-input" id="attend" name="attendance_status" value="Hadir" required>
                                        <label class="form-check-label custom-label" for="attend">Hadir</label>
                                    </div>
                                    <div class="form-check col">
                                        <input type="radio" class="form-check-input" id="not_attend" name="attendance_status" value="Tidak Hadir" required>
                                        <label class="form-check-label custom-label" for="not_attend">Tidak Hadir</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="sebab">Sebab</label>
                                    <textarea class="form-control" id="reason" name="sebab" rows="5"></textarea>
                                </div>
                                
                                <div class="form-group mt-3">
                                    <label for="timestamp">Timestamp</label>
                                    <input type="datetime-local" class="form-control" id="timestamp" name="timestamp" 
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" readonly required>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="picture">Upload Picture</label>
                                    <input type="file" class="form-control" id="picture" name="picture" accept="image/*">
                                </div>

                                <button type="submit" class="btn btn-success mt-4 me-2">
                                    <i class="mdi mdi-folder-plus menu-icon"></i> Submit
                                </button>
                                <a href="{{ route('student.dashboard') }}" class="btn btn-light mt-4">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
