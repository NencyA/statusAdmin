<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{URL::asset('vendors/simplebar/css/simplebar.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/vendors/simplebar.css')}}">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="{{URL::asset('/css/bootstrap.min.css')}}">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('/css/toastr.min.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/buttons.bootstrap.min.css') }}">

</head>
<body>
    <header class="header header-sticky mb-4">

    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
           <svg class="icon icon-lg">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
           </svg>
        </button>
        <a class="header-brand d-md-none" href="#">
           <svg width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="assets/brand/coreui.svg#full"></use>
           </svg>
        </a>
        <ul class="header-nav ms-auto">
           <li class="nav-item">
              <a class="nav-link" href="#">
                 <svg class="icon icon-lg">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                 </svg>
              </a>
           </li>
           <li class="nav-item">
              <a class="nav-link" href="#">
                 <svg class="icon icon-lg">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                 </svg>
              </a>
           </li>
           <li class="nav-item">
              <a class="nav-link" href="#">
                 <svg class="icon icon-lg">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                 </svg>
              </a>
           </li>
        </ul>
        <ul class="header-nav ms-3">
           <li class="nav-item dropdown">
              <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                 <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/8.jpg" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                 <a class="dropdown-item" href="{{ route('logout') }}">
                    logout
                 </a>
              </div>
           </li>
        </ul>
     </div>
    </header>

</body>
</html>
