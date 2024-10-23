@extends('layouts.star')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <h1 style="font-weight: bold; padding-left: 30px;">Edit Profile</h1>
                    </div>

                    <div class="card card-rounded mt-4">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('profile.update') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH') <!-- Spoofing the PATCH method -->
                                
                                <div class="form-group">
                                    <label for="profile_photo" style="font-weight: bold; color: #007bff;">Profile Photo</label>
                                    <small class="form-text text-muted">Upload a clear image of your face (max 2MB, formats: jpeg, png).</small>
                                    <input type="file" class="form-control mt-2" name="profile_photo" accept="image/*">
                                </div>
                                
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" name="name" 
                                           value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="ndp">NDP</label>
                                    <input type="text" class="form-control" name="ndp" 
                                           value="{{ old('ndp', $user->ndp) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="ic">IC</label>
                                    <input type="text" class="form-control" name="ic" 
                                           value="{{ old('ic', $user->ic) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="telefon">Phone Number</label>
                                    <input type="text" class="form-control" name="telefon" 
                                           value="{{ old('telefon', $user->telefon) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Address</label>
                                    <input type="text" class="form-control" name="alamat" 
                                           value="{{ old('alamat', $user->alamat) }}">
                                </div>

                                <div class="form-group">
                                    <label for="kursus">Kursus</label>
                                    <select class="form-control" name="kursus" required>
                                        <option value="" disabled>Select Kursus</option>
                                        <option value="Sistem" {{ old('kursus', $user->kursus) == 'Sistem' ? 'selected' : '' }}>Sistem</option>
                                        <option value="Perisian" {{ old('kursus', $user->kursus) == 'Perisian' ? 'selected' : '' }}>Perisian</option>
                                        <option value="Cadd" {{ old('kursus', $user->kursus) == 'Cadd' ? 'selected' : '' }}>Cadd</option>
                                        <option value="IPD" {{ old('kursus', $user->kursus) == 'IPD' ? 'selected' : '' }}>IPD</option>
                                        <option value="Rangkaian" {{ old('kursus', $user->kursus) == 'Rangkaian' ? 'selected' : '' }}>Rangkaian</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select class="form-control" name="semester" required>
                                        <option value="" disabled>Select Semester</option>
                                        <option value="Semester 1" {{ old('semester', $user->semester) == 'Semester 1' ? 'selected' : '' }}>Semester 1</option>
                                        <option value="Semester 2" {{ old('semester', $user->semester) == 'Semester 2' ? 'selected' : '' }}>Semester 2</option>
                                        <option value="Semester 3" {{ old('semester', $user->semester) == 'Semester 3' ? 'selected' : '' }}>Semester 3</option>
                                        <option value="Semester 4" {{ old('semester', $user->semester) == 'Semester 4' ? 'selected' : '' }}>Semester 4</option>
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                <a href="{{ url('/student') }}" class="btn btn-light">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
