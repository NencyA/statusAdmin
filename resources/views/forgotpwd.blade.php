<!DOCTYPE html>
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link href="{{URL::asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/toastr.min.css')}}">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="css/examples.css" rel="stylesheet">
</head>

<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h1>Forgot Password</h1>
                                <form id="forgotpassword" method="POST">
                                    @csrf
                                    <p class="text-medium-emphasis">Please Enter Your Email Id</p>
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                            </svg></span>
                                        <input class="form-control" type="email" placeholder="Username" name="email"
                                            id="email">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $("#forgotpassword").submit(function(e){
            e.preventDefault();
            let email = $("#email").val();
            let password = $("#password").val();
            let formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{route('forget.password.post')}}",
                type:"POST" ,
                processData: false,
                contentType: false,
                data: formData,
                success:function(response)
                {
                    if(response.status == 1){
                        alert(response.message);
                        toastr.success(response.message);
                    }else{
                        alert(response.message);
                        toastr.error(response.message);
                    }
                }
            });

        });

    </script>
</body>

</html>
