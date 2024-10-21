<nav class="sidebar sidebar-offcanvas" id="sidebar" style="padding: 20px 10px;">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile" style="align-items: center; padding: 10px; margin-bottom: 15px;">
                <div class="sidebar-profile-image" style="margin-right: 10px;">
                    <img src="{{ asset('star/template/images/faces/face8.jpg') }}" alt="Profile Image">
                </div>
                <div class="sidebar-profile-name">
                    <p class="sidebar-name" style="margin-bottom: 5px;">{{ auth()->user()->name }}</p>
                    @if ($userRole === 'warden')
                        <p class="sidebar-designation fw-bold">Warden</p>
                    @elseif ($userRole === 'mpp')
                        <p class="sidebar-designation fw-bold">Majlis Perwakilan Pelajar</p>
                    @else
                        <p class="sidebar-designation fw-bold">Pelajar</p>
                    @endif

                    <p class="sidebar-designation fw-bold">F04 (Software Development)</p>
                    <p class="sidebar-designation fw-bold">22123003</p>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">Main Pages</li>
        @if($userRole === 'student')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile/view') ? 'active' : '' }}" href="{{ url('/profile/view') }}">
                    <i class="mdi mdi-account-circle-outline"></i>
                    <span>Profil</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ auth()->user()->hasRole('warden') ? route('admin.dashboard') : (auth()->user()->hasRole('mpp') ? route('mpp.dashboard') : route('student.dashboard')) }}">
                <i class="mdi mdi-home"></i>
                <span>Laman Utama</span>
            </a>
        </li>

        <li class="nav-item nav-category">Rekod Kehadiran</li>

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
                <a class="nav-link {{ request()->is('mpp/approve') ? 'active' : '' }}" href="{{ url('/mpp/approve') }}">
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
