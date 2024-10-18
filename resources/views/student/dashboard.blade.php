


@extends('layouts.star')

@section('title', 'Sekas | Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-rounded mb-4">
                <div class="card-body">
                    <h5 class="card-title">Attendance Records</h5>
                    <div class="table-responsive">
                        <button class="btn btn-success me-2 fw-bold"
                            style="display: flex; align-items: center; margin-right: 60px;"
                            onclick="window.location='{{ route('student.create') }}'">
                            <i class="mdi mdi-folder-plus menu-icon" style="margin-right: 5px;"></i> Tambah
                        </button>

                        <table class="table table-hover">
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
                                    <th>Status</th>
                                    <th>Attendance Status</th>
                                    <th>Picture</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $key => $attendance)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $attendance->user->name }}</td>
                                        <td>{{ $attendance->ndp }}</td>
                                        <td>{{ $attendance->course }}</td>
                                        <td>{{ $attendance->reason }}</td>
                                        <td>{{ $attendance->timestamp ? $attendance->timestamp->format('H:i A') : 'N/A' }}</td>
                                        <td>{{ $attendance->timestamp ? $attendance->timestamp->format('d/m/Y') : 'N/A' }}</td>
                                        <td>
                                            <label class="badge badge-{{ $attendance->attendance_status === 'Approve' ? 'success' : ($attendance->attendance_status === 'Rejected' ? 'danger' : 'outline-dark') }} fw-bold">
                                                {{ $attendance->attendance_status }}
                                            </label>
                                        </td>
                                        <td>
                                            @if (isset($attendance->confirmed))
                                                @if ($attendance->confirmed == 1)
                                                    <label class="badge badge-success fw-bold">Present</label>
                                                @elseif ($attendance->confirmed == 0)
                                                    <label class="badge badge-danger fw-bold">Absent</label>
                                                @else
                                                    <label class="badge badge-warning fw-bold">Pending</label>
                                                @endif
                                            @else
                                                <label class="badge badge-warning fw-bold">Pending</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($attendance->picture)
                                                <img src="{{ asset('storage/' . $attendance->picture) }}" alt="Attendance Picture" width="100" onclick="openModal('{{ asset('storage/' . $attendance->picture) }}')">
                                            @else
                                                No picture uploaded
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Viewing -->
    <div id="imageModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.8); z-index:1000; justify-content:center; align-items:center;">
        <span style="color:white; position:absolute; top:20px; right:30px; font-size:30px; cursor:pointer;"
            onclick="closeModal()">&times;</span>
        <img id="modalImage" src="" alt="Large Attendance Picture"
            style="max-width:80%; max-height:80%; margin:auto; display:block;">
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
@endsection
