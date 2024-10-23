@extends('layouts.star')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Student Profile</h2>
    <div class="card card-rounded">
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="{{ auth()->user()->profile_photo ? Storage::url(auth()->user()->profile_photo) : asset('star/template/images/faces/face8.jpg') }}" alt="Profile Image">
                <span class="font-weight-bold">{{ $student->name }}</span>
                <span class="text-black-50">{{ $student->email }}</span>
            </div>

            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Maklumat Peribadi</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="labels">Nama</label>
                        <input type="text" class="form-control" placeholder="" value="{{ $student->name }}" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Kad Pengenalan</label>
                        <input type="text" class="form-control" value="{{ $student->ic ?? 'N/A' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">No. Matrix/NDP</label>
                        <input type="text" class="form-control" value="{{ $student->ndp ?? 'N/A' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Semester</label>
                        <input type="text" class="form-control" value="{{ $student->semester ?? 'N/A' }}" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Kursus</label>
                        <input type="text" class="form-control" value="{{ $student->kursus ?? 'N/A' }}" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">No. Telefon</label>
                        <input type="text" class="form-control" value="{{ $student->telefon ?? 'N/A' }}" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Alamat</label>
                        <textarea class="form-control" style="resize: none; height: 100px;" readonly>{{ $student->alamat ?? 'N/A' }}</textarea>
                    </div>
                </div>
                
                <div class="mt-5 text-center">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary profile-button">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
