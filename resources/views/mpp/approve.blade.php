@extends('layouts.star')

@section('content')
<!-- Date Filter Form -->
<div class="mb-3">
    <form method="GET" action="{{ route('mpp.approve') }}">
        <div class="input-group">
            <input type="date" name="date" class="form-control" value="{{ request('date') }}" aria-label="Select Date">
            <button class="btn btn-primary" type="submit">Filter</button>
            @if(request('date')) <!-- Check if a date filter is applied -->
                <a href="{{ route('mpp.approve') }}" class="btn btn-secondary ms-2">Cancel Filter</a>
            @endif
        </div>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-hover w-100" id="userDetails">
        <thead>
            <tr>
                <th>#</th>
                <th>
                    <a href="{{ route('mpp.approve', ['sort_by' => 'name', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Name
                        @if (request('sort_by') === 'name')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('mpp.approve', ['sort_by' => 'ndp', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        NDP
                        @if (request('sort_by') === 'ndp')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('mpp.approve', ['sort_by' => 'course', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Kursus
                        @if (request('sort_by') === 'course')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('mpp.approve', ['sort_by' => 'reason', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Sebab
                        @if (request('sort_by') === 'reason')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('mpp.approve', ['sort_by' => 'timestamp', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Masa
                        @if (request('sort_by') === 'timestamp')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('mpp.approve', ['sort_by' => 'date', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Tarikh
                        @if (request('sort_by') === 'date')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>Lihat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $index => $attendance)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ $attendance->user->ndp }}</td>
                <td>{{ $attendance->user->course }}</td>
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
                    <form action="{{ route('mpp.confirm', $attendance->id) }}" method="POST">
                        @csrf
                        @if(is_null($attendance->confirmed))
                            <!-- Show both buttons if confirmed status is null -->
                            <button type="submit" name="confirmed_status" value="1" class="btn btn-success">Attend</button>
                            <button type="submit" name="confirmed_status" value="0" class="btn btn-danger">Not Attend</button>
                        @else
                            <!-- Show one button based on confirmed status -->
                            @if ($attendance->confirmed == 1)
                                <button type="button" class="btn btn-success" disabled>Attend</button>
                                <button type="submit" name="confirmed_status" value="0" class="btn btn-danger">Not Attend</button>
                            @elseif ($attendance->confirmed == 0)
                                <button type="submit" name="confirmed_status" value="1" class="btn btn-success">Attend</button>
                                <button type="button" class="btn btn-danger" disabled>Not Attend</button>
                            @endif
                        @endif
                    </form>
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

    // Add event listener to close the modal when clicking outside of the image
    window.onclick = function(event) {
        const modal = document.getElementById('imageModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

<style>
    /* Style for active buttons */
    .btn.active {
        font-weight: bold; /* Bold for active state */
        opacity: 1; /* Ensure active buttons are fully opaque */
    }
    
    /* Style for disabled buttons */
    .btn:disabled {
        background-color: #6c757d; /* Grey background */
        color: white; /* White text */
        opacity: 0.65; /* Slightly transparent */
        cursor: not-allowed; /* Not-allowed cursor */
        border: 1px solid #6c757d; /* Match border with background */
    }
</style>

@endsection
