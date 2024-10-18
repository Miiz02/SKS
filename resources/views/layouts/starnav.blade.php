<nav class="navbar fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('star/template/images/logo.svg') }}" alt="logo">
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
            <img src="{{ asset('star/template/images/logo-mini.svg') }}" alt="logo mini">
        </a>
      
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item">
                <a class="nav-link active" href="#">LAMAN UTAMA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">PENYERAHAN</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-message-typing"></i>
                    <span class="count bg-success">2</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                    <!-- Repeat the message items as needed -->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-bell"></i>
                    <span class="count bg-danger">2</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <!-- Repeat the notification items as needed -->
                </div>
            </li>
            <li class="nav-item dropdown user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{ asset('star/template/images/faces/face8.jpg') }}" alt="Profile image">
                </a>
                <span class="nav-profile-name" style="margin-left: 8px;">{{ auth()->user()->name }}</span> <!-- Added margin-left -->
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item" href="#"><i class="typcn typcn-cog text-primary"></i> Tetapan</a>
                    <a class="dropdown-item" href="#"><i class="typcn typcn-power text-primary"></i> Log-Keluar</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>
