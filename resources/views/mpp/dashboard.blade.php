@extends('layouts.star')

@section('content')

<div class="mb-3">
    <a href="{{ route('mpp.approve') }}" class="btn btn-primary">Pergi ke Pengesahan</a>
</div>

<!-- Date Filter Form -->
<div class="mb-3">
    <form method="GET" action="{{ route('mpp.dashboard') }}">
        <div class="input-group">
            <input type="date" name="date" class="form-control" value="{{ request('date') }}" aria-label="Select Date">
            <button class="btn btn-primary" type="submit">Filter</button>
            @if(request('date')) <!-- Check if a date filter is applied -->
                <a href="{{ route('mpp.dashboard') }}" class="btn btn-secondary ms-2">Cancel Filter</a>
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
                <th>
                    <a href="{{ route('mpp.dashboard', ['sort_by' => 'course', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc', 'date' => request('date')]) }}"
                       style="text-decoration: none; color: inherit;">
                        Kursus
                        @if (request('sort_by') === 'course')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>Semester</th>
                <th>Sebab</th>
                <th>
                    <a href="{{ route('mpp.dashboard', ['sort_by' => 'timestamp', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc', 'date' => request('date')]) }}"
                       style="text-decoration: none; color: inherit;">
                        Masa
                        @if (request('sort_by') === 'timestamp')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>Tarikh</th>
                <th>Lihat</th>
                <th>Kehadiran</th>
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
                    <label class="badge badge-{{ $attendance->attendance_status === 'Approve' ? 'success' : ($attendance->attendance_status === 'Rejected' ? 'danger' : 'outline-dark') }} fw-bold">
                        {{ $attendance->attendance_status }}
                    </label>
                </td>
                <td>
                    <span>
                        @if(is_null($attendance->confirmed))
                        Pending
                        @elseif($attendance->confirmed)
                        Approved
                        @else
                        Not Approved
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
