@extends('layouts.default')

@section('content')
    <h1>{{ $userName }}'s Attendance Records</h1>

    @if($attendances->isEmpty())
        <p>No attendance records found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Attendance Status</th>
                    <th>Timestamp</th>
                    <th>Picture</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->attendance_status }}</td>
                        <td>{{ $attendance->timestamp }}</td>
                        <td>
                            @if($attendance->picture)
                                <img src="{{ asset('storage/' . $attendance->picture) }}" alt="Attendance Picture" width="100" onclick="openModal('{{ asset('storage/' . $attendance->picture) }}')">
                            @else
                                No picture uploaded
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Modal -->
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
    </script>
@stop
