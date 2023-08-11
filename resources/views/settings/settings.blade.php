@extends('layout.master')

@section('content')
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
       <div class="header-divider"></div>
       <div class="container-fluid">
          <nav aria-label="breadcrumb">
             <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                   <span>Home</span>
                </li>
                <li class="breadcrumb-item active"><span>Dashboard</span></li>
                <a href="#" class="btn btn-dark position-absolute mb-auto"  data-toggle="modal" data-target="#adminForm" style="right: 30px; bottom: 5px ">Change Password</a>
             </ol>
          </nav>
       </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="card mb-4">
            <div class="card-header">Admin</div>
            <div class="card-body">
              <div class="bd-example">
                <dl class="row">
                  <dt class="col-sm-3">Name:</dt>
                  <dd class="col-sm-9">{{ $adminData->name }}</dd>
                  <dt class="col-sm-3">Email:</dt>
                  <dd class="col-sm-9">{{ $adminData->email }}
                  </dd>
                  <dt class="col-sm-3">Mobile No:</dt>
                  <dd class="col-sm-9">{{ $adminData->phoneNo }}</dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
    </div>



    <footer class="footer">
       <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
       <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
    </footer>
</div>
<div class="modal fade" id="adminForm" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <form id=adminData method="POST">
             @csrf
             <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body">
                <div class="form-group">
                   <label for="name" class="col-form-label">Old Password:</label>
                   <input type="password" class="form-control" id="oldpwd" name="oldpwd" >
                </div>
                <div class="form-group">
                   <label for="emailId" class="col-form-label">New Password:</label>
                   <input type="password" class="form-control" id="newpwd" name="newpwd">
                </div>
                <div class="form-group">
                   <label for="password" class="col-form-label">Confirm Password:</label>
                   <input type="password" class="form-control" id="conpwd" name="conpwd">
                </div>
             </div>
             <div class="modal-footer">
                <div class="col-6 text-end">
                    <a href="forgot-password" class="btn btn-link px-0" type="button">Forgot password?</a>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-dark">Submit</button>
             </div>
          </form>
       </div>
    </div>
</div>
@endsection

@section('js')
<script>
        $(document).on("submit", "#adminData", function (e) {
            e.preventDefault();
            let formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{route('change-password')}}",
                type:"POST" ,
                processData: false,
                contentType: false,
                data: formData,
                success:function(response)
                {
                    if(response.status == 1){
                        toastr.success(response.message);
                        $('.modal-backdrop').hide();
                        $('#adminForm').hide();
                        $('#oldpwd').val('');
                        $('#newpwd').val('');
                        $('#conpwd').val('');
                    }else{
                        toastr.error(response.message);
                    }
                }
            });
        });
</script>
@endsection
