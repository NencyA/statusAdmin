<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui.svg#signet"></use>
            </svg>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fa fa-home" style="margin-right: 20px;
                margin-left: 10px;" aria-hidden="true"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('category') }}">
                    <i class="fa fa-hashtag" style="margin-right: 20px;
                margin-left: 10px;" aria-hidden="true"></i>
                    Hashtag / Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user-list') }}">
                    <i class="fa fa-user" style="margin-right: 20px;
                margin-left: 10px;" aria-hidden="true"></i>
                    User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('uservideo') }}">
                    <i class="fa fa-user" style="margin-right: 20px;
                margin-left: 10px;" aria-hidden="true"></i>
                    Video
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('settings') }}">
                    <i class="fa fa-cog" style="margin-right: 20px;
                margin-left: 10px;" aria-hidden="true"></i>
                    Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reported-video') }}"><i class="fa fa-video-camera" style="margin-right: 20px;
                margin-left: 10px;" aria-hidden="true"></i>
                    Reported Video
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reported-user') }}"><i class="fa fa-user-times" style="margin-right: 20px;
                margin-left: 10px;" aria-hidden="true"></i>
                    Reported User
                </a>
            </li>
        </ul>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    @yield('content')
</body>

</html>