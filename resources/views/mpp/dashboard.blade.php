@extends('layouts.star')

@section('content')
<div class="table-responsive">
    <table class="table table-hover w-100" id="userDetails">
      <thead>
        <tr>
          <th>#</th>
          <th>
            <div style="display: flex; align-items: center;">
              <span style="margin-right: 5px;">Name</span>
              <div class="dropdown">
                <button class="btn rounded-3 wrapper" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-arrow-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" onclick="filterAll()">All</a></li>
                  <li><a class="dropdown-item" onclick="filterPassed()">Passed</a></li>
                  <li><a class="dropdown-item" onclick="filterFailed()">Failed</a></li>
                </ul>
              </div>
            </div>
          </th>
          <th>NDP</th>
          <th>Kursus</th>
          <th>Semester</th>
          <th>Sebab</th>
          <th>Masa</th>
          <th>Tarikh</th>
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
            <td>{{ $attendance->reason ?? 'No reason provided' }}</td>
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
                <button type="submit" name="confirmed_status" value="attend" class="btn btn-success {{ $attendance->confirmed == 1 ? 'active' : '' }}">Attend</button>
                <button type="submit" name="confirmed_status" value="not_attend" class="btn btn-danger {{ $attendance->confirmed == 0 ? 'active' : '' }}">Not Attend</button>
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
  </script>
  
@endsection


{{-- TODO:add attendance confirmation system  --}}