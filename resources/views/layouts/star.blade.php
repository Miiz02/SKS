<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Sekas | Laman Utama')</title>
  
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="{{ asset('star/template/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('star/template/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('star/template/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('star/template/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('star/template/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('star/template/vendors/css/vendor.bundle.base.css') }}">
  
    <!-- DataTables CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('star/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('star/template/js/select.dataTables.min.css') }}">
  
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('star/template/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('star/template/css/vertical-layout-light/celestial-css.css') }}">
    <link rel="shortcut icon" href="{{ asset('star/template/images/favicon.png') }}">
  </head>
  

<body>
  <div class="container-scroller">
    <!-- Navbar -->
    @include('layouts.starnav')

    <div class="container-fluid page-body-wrapper">
      <!-- Sidebar -->
      @include('layouts.starside')

      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Dynamic Content Section -->
          @yield('content')
        </div>

        <!-- Footer -->
        @include('layouts.starfoot')
      </div>
    </div>
  </div>

   <!-- JS Dependencies -->
<script src="{{ asset('star/template/vendors/js/vendor.bundle.base.js') }}"></script>

<!-- Plugin JS for This Page -->
<script src="{{ asset('star/template/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('star/template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('star/template/vendors/progressbar.js/progressbar.min.js') }}"></script>

<!-- Injected JS -->
<script src="{{ asset('star/template/js/off-canvas.js') }}"></script>
<script src="{{ asset('star/template/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('star/template/js/template.js') }}"></script>
<script src="{{ asset('star/template/js/settings.js') }}"></script>
<script src="{{ asset('star/template/js/todolist.js') }}"></script>

<!-- Custom JS for This Page -->
<script src="{{ asset('star/template/js/dashboard.js') }}"></script>
<script src="{{ asset('star/template/js/Chart.roundedBarCharts.js') }}"></script>

<!-- Sort Table Logic -->
<script>
    function sortTable(field, direction = 'asc') {
        // Redirect to the same route with sorting parameters
        const url = new URL(window.location.href);
        url.searchParams.set('sort_by', field);
        url.searchParams.set('sort_direction', direction);

        // Navigate to the new URL
        window.location.href = url.toString();
    }
</script>


</body>

</html>
