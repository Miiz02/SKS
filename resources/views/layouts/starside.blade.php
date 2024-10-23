<nav class="sidebar sidebar-offcanvas" id="sidebar" style="padding: 20px 10px;">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile" style="align-items: center; padding: 10px; margin-bottom: 15px;">
                <div class="sidebar-profile-image" style="margin-right: 10px;">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ Storage::url(auth()->user()->profile_photo) }}" alt="Profile Image" >
                    @else
                        <img src="{{ asset('star/template/images/faces/face8.jpg') }}" alt="Default Profile Image" style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;">
                    @endif
                </div>
                <div class="sidebar-profile-name">
                    <p class="sidebar-name" style="margin-bottom: 5px;">{{ auth()->user()->name }}</p>
                    <p class="sidebar-designation fw-bold">
                        @switch($userRole)
                            @case('warden')
                                Warden
                                @break
                            @case('mpp')
                                Majlis Perwakilan Pelajar
                                @break
                            @default
                                Pelajar
                        @endswitch
                    </p>
                    <p class="sidebar-designation fw-bold">F04 (Software Development)</p>
                    <p class="sidebar-designation fw-bold">22123003</p>
                </div>
            </div>
        </li>
        

        <li class="nav-item nav-category">Main Pages</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" 
               href="{{ $userRole === 'warden' ? route('admin.dashboard') : ($userRole === 'mpp' ? route('mpp.dashboard') : route('student.dashboard')) }}">
                <i class="mdi mdi-home"></i>
                <span>Laman Utama</span>
            </a>
        </li>

        @if($userRole === 'student')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile/view') ? 'active' : '' }}" href="{{ route('student.profile') }}">
                    <i class="mdi mdi-account-circle-outline"></i>
                    <span>Profil</span>
                </a>
            </li>
        @endif

        @if($userRole === 'student' || $userRole === 'mpp')
            <li class="nav-item nav-category">Rekod Kehadiran</li>
        @endif

        @if($userRole === 'student')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('student/create') ? 'active' : '' }}" href="{{ route('student.create') }}">
                    <i class="mdi mdi-library-plus"></i>
                    <span>Tambah Rekod</span>
                </a>
            </li>
        @endif

        @if($userRole === 'mpp')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('mpp/approve') ? 'active' : '' }}" href="{{ route('mpp.approve') }}">
                    <i class="mdi mdi-code-not-equal"></i>
                    <span>Pengesahan</span>
                </a>
            </li>
        @endif

        <li class="nav-item nav-category">Pilihan</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('tetapan') ? 'active' : '' }}" href="{{ url('tetapan') }}">
                <i class="mdi mdi-brightness-7"></i>
                <span>Tetapan</span>
            </a>
        </li>
        
        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout-variant"></i>
                <span>Log - Keluar</span>
            </a>
        </li>
    </ul>
</nav>
