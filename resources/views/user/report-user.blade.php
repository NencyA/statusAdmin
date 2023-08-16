@extends('layout.master')

@section('content')
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class=" header-sticky mb-4">
       <div class="header-divider"></div>
       <div class="container-fluid ">
          <nav aria-label="breadcrumb">
             <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                   <span>Home</span>
                </li>
                <li class="breadcrumb-item active"><span>Report-User</span></li>
             </ol>
          </nav>
       </div>
    </header>
    <div class="body flex-grow-1 px-3 card-body">
       <div class="">
          <h2>Reported-User List</h2>
          <div class="row">
             {!! $dataTable->table() !!}
          </div>
       </div>
    </div>
    <footer class="footer">
       <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
       <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
    </footer>
</div>
@endsection
@section('js')
{!! $dataTable->scripts() !!}
<script>
     $(document).ready(function() {
        $('#reporteduser-table thead').addClass('table-light');
        $('#reporteduser-table').addClass('table border mb-0');
    });
</script>
@endsection
