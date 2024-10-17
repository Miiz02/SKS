<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile" style="align-items: center; padding: 10px; margin-bottom: 15px;"> <!-- Added margin-bottom -->
                <div class="sidebar-profile-image" style="margin-right: 10px;">
                    <img src="{{ asset('star/template/images/faces/face8.jpg') }}" alt="Profile Image">
                </div>
                <div class="sidebar-profile-name">
                    <p class="sidebar-name">{{ auth()->user()->name }}</p>
                    <p class="sidebar-designation fw-bold">Pelajar</p>
                    <p class="sidebar-designation fw-bold">F04 (Software Development)</p>
                    <p class="sidebar-designation fw-bold">22123003</p>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">Main Pages</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/profile/view') }}">
                <i class="mdi mdi-account-circle-outline"></i>
                <span>Profil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/student') }}">
                <i class="mdi mdi-home"></i>
                <span>Laman Utama</span>
            </a>
        </li>
        <li class="nav-item nav-category">Rekod Kehadiran</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('kehadiran') }}">
                <i class="mdi mdi-library-plus"></i>
                <span>Tambah Rekod</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('penyerahan') }}">
                <i class="mdi mdi-code-not-equal"></i>
                <span>Penyerahan</span>
            </a>
        </li>
        <li class="nav-item nav-category">Pilihan</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('tetapan') }}">
                <i class="mdi mdi-brightness-7"></i>
                <span>Tetapan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('logout') }}">
                <i class="mdi mdi-logout-variant"></i>
                <span>Log - Keluar</span>
            </a>
        </li>
    </ul>
</nav>
