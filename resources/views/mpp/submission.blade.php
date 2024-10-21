@extends('layouts.star')

@section('content')
<div class="table-responsive">
    <table class="table table-hover w-100" id="userDetails">
        <thead>
            <tr>
                <th>#</th>
                <th>
                    <a href="{{ route('student.dashboard', ['sort_by' => 'name', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Name
                        @if (request('sort_by') === 'name')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('student.dashboard', ['sort_by' => 'ndp', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        NDP
                        @if (request('sort_by') === 'ndp')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('student.dashboard', ['sort_by' => 'course', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Kursus
                        @if (request('sort_by') === 'course')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('student.dashboard', ['sort_by' => 'reason', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Sebab
                        @if (request('sort_by') === 'reason')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('student.dashboard', ['sort_by' => 'timestamp', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
                        style="text-decoration: none; color: inherit;">
                        Masa
                        @if (request('sort_by') === 'timestamp')
                            <span>{{ request('sort_direction') === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('student.dashboard', ['sort_by' => 'date', 'sort_direction' => request('sort_direction', 'asc') === 'asc' ? 'desc' : 'asc']) }}"
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
                    <form action="{{ route('mpp.confirm', $attendance->id) }}" method="POST">
                        @csrf
                        <button type="submit" name="confirmed_status" value="attend" class="btn btn-success {{ $attendance->confirmed == 1 ? 'active' : 'inactive' }}">Attend</button>
                        <button type="submit" name="confirmed_status" value="not_attend" class="btn btn-danger {{ $attendance->confirmed == 0 ? 'active' : 'inactive' }}">Not Attend</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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

    // Function to handle filtering options
    function filterAll() {
        setActiveOption('All');
    }

    function filterPassed() {
        setActiveOption('Passed');
    }

    function filterFailed() {
        setActiveOption('Failed');
    }

    function setActiveOption(option) {
        const items = document.querySelectorAll('.dropdown-item');
        items.forEach(item => {
            item.classList.remove('active'); // Remove active class from all
            if (item.textContent.trim() === option) {
                item.classList.add('active'); // Add active class to selected option
            }
        });
    }
</script>

<style>
    /* Style for inactive buttons */
    .btn.inactive {
        opacity: 0.5; /* Reduced opacity for inactive state */
        font-size: 0.85rem; /* Smaller font size */
        color: #fff; /* White text */
        background-color: #6c757d; /* Gray background */
    }
    
    .btn.active {
        font-size: 1rem; /* Normal font size for active */
    }
    
    /* Adjusting hover effect for active buttons */
    .btn-success:hover.active {
        background-color: #218838; /* Darker green on hover */
    }

    .btn-danger:hover.active {
        background-color: #c82333; /* Darker red on hover */
    }

    /* Ensure hover effect is applied even for inactive buttons */
    .btn.inactive:hover {
        opacity: 0.75; /* Slightly increase opacity on hover */
        cursor: pointer; /* Change cursor to pointer */
    }
</style>

@endsection
