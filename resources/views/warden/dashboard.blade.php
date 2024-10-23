@extends('layouts.star')

@section('content')

<div class="mb-3">
    <h2>Dashboard Admin</h2>
    <p>Welcome to the Admin Dashboard. Here you can view the attendance records submitted by MPP.</p>
</div>

<!-- Date Filter Form -->
<div class="mb-3">
    <form method="GET" action="{{ route('admin.dashboard') }}">
        <div class="input-group">
            <input type="date" name="date" class="form-control" value="{{ request('date') }}" aria-label="Select Date">
            <button class="btn btn-primary" type="submit">Filter</button>
            @if(request('date')) <!-- Check if a date filter is applied -->
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ms-2">Cancel Filter</a>
            @endif
        </div>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-hover w-100" id="userDetails">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>NDP</th>
                <th>Kursus</th>
                <th>Semester</th>
                <th>Sebab</th>
                <th>Masa</th>
                <th>Tarikh</th>
                <th>Pictures</th>
                <th>Pengesahan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $index => $attendance)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ $attendance->user->ndp }}</td>
                <td>{{ $attendance->user->course }}</td>
                <td>{{ $attendance->user->semester }}</td>
                <td>{{ $attendance->sebab ?? 'No reason provided' }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->timestamp)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->timestamp)->format('Y-m-d') }}</td>
                <td>
                    @if ($attendance->picture)
                    <img src="{{ asset('storage/' . $attendance->picture) }}" alt="Attendance Picture" width="100" onclick="openModal('{{ asset('storage/' . $attendance->picture) }}')">
                    @else
                    No picture uploaded
                    @endif
                </td>
                <td>
                    <span>
                        @if(is_null($attendance->confirmed))
                        <label class="badge badge-warning fw-bold">Belum Ditanda</label>
                        @elseif($attendance->confirmed)
                        <label class="badge badge-success fw-bold">Hadir</label>
                        @else
                        <label class="badge badge-danger fw-bold">Tidak Hadir</label>
                        @endif
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $attendances->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- Modal for Image Viewing -->
<div id="imageModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.8); z-index:1000; justify-content:center; align-items:center;">
    <span style="color:white; position:absolute; top:20px; right:30px; font-size:30px; cursor:pointer;" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" alt="Large Attendance Picture" style="max-width:80%; max-height:80%; margin:auto; display:block;">
</div>

<script>
    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('imageModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

@endsection
