<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PWL Laravel Starter Code') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Untuk mengirimkan token Laravel CSRF pada setiap request ajax -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    @stack('css') <!-- Digunakan untuk memanggil custom css dari perintah push('css') pada masing-masing view -->

    <!-- Custom CSS for sidebar, search bar, main content, header, and footer -->
    <style>
        /* Apply pink gradient to the sidebar */
        .main-sidebar.sidebar-dark-primary {
            background: linear-gradient(135deg, #ff99cc 0%, #ff99cc 100%);
        }

        /* Change text color to black for sidebar elements */
        .main-sidebar .brand-link,
        .main-sidebar .nav-link,
        .main-sidebar .nav-header,
        .main-sidebar .user-panel .info,
        .main-sidebar .user-panel .info a {
            color: #000000 !important;
        }

        /* Ensure icons in the sidebar are black, but exclude the brand image */
        .main-sidebar .nav-icon {
            filter: brightness(0); /* Adjust icon color to black */
        }

        /* Remove brightness filter for the brand image to make the logo visible */
        .main-sidebar .brand-link .brand-image {
            filter: none !important; /* Remove brightness filter to show original logo colors */
            width: 30px; /* Ensure the logo is properly sized */
            height: 30px;
            margin-right: 10px; /* Add spacing between logo and text */
        }

        /* Set default background color of menu items to white */
        .main-sidebar .nav-item .nav-link {
            color: #000000 !important;
            margin: 2px 5px; /* Add small margin for spacing between menu items */
            border-radius: 5px; /* Optional: Add slight rounding for better appearance */
        }

        /* Hover effect for sidebar links - slightly darker white */
        .main-sidebar .nav-link:hover {
            background-color: #f5f5f5 !important; /* Slightly off-white on hover */
            color: #000000 !important;
        }

        /* Active link styling */
        .main-sidebar .nav-item .nav-link.active {
            background-color: #e0e0e0 !important; /* Slightly grayish white for active state */
            color: #000000 !important;
        }

        /* Style the search bar in the navbar with white background */
        .navbar .form-control.navbar-search {
            border-color: #cccccc; /* Light gray border for contrast */
            color: #000000; /* Black text for readability */
        }

        /* Placeholder text color for the search bar */
        .navbar .form-control.navbar-search::placeholder {
            color: #666666; /* Slightly lighter text for placeholder */
            opacity: 1; /* Ensure placeholder is fully visible */
        }

        /* Focus state for the search bar */
        .navbar .form-control.navbar-search:focus {
            border-color: #999999; /* Slightly darker gray border on focus */
            box-shadow: 0 0 0 0.2rem rgba(200, 200, 200, 0.25); /* Subtle gray focus shadow */
            color: #000000;
        }

        /* Set light pink background for the brand logo section */
        .main-sidebar .brand-link {
            background-color: #ffccdd !important; /* Light pink background */
        }

        /* Set very light pink background for the main content */
        .content-wrapper {
            background-color: #ffe6f0 !important; /* Very light pink for main content */
        }

        /* Set deeper pink background for the header (navbar) */
        .navbar {
            background-color: #ffcfe7 !important; /* Deeper pink for header */
        }

        /* Set deeper pink background for the footer */
        .main-footer {
            background-color: #ffcfe7 !important; /* Deeper pink for footer */
            color: #000000 !important; /* Ensure footer text is black for readability */
        }

        /* Ensure footer links are readable */
        .main-footer a {
            color: #000000 !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.header')
  <!-- /.navbar -->
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/NitipdongNa.png') }}" alt="Nitipdong.na Logo" class="brand-image img">
        <span class="brand-text font-weight-bold">NITIPDONG.NA</span>
      </a>

      <!-- Sidebar -->
      @include('layouts.sidebar')
      <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.breadcrumb')

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Datatables & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- jQuery Validation -->
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script>
    // Untuk mengirimkan token Laravel CSRF pada setiap request AJAX
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
@stack('js') <!-- Digunakan untuk memanggil custom js dari perintah push('js') pada masing-masing view -->
</body>
</html>