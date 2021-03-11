<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VIMFile | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

  <style>
    .disp-0{
      display: none;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>vim</b>File</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

     @if (session('success'))
        <div class="alert alert-success">
            <span style="font-size: 14px; text-align: center">{{ session('success') }}</span>
        </div>

    @elseif(session('warning'))

        <div class="alert alert-danger">
            <span style="font-size: 14px; text-align: center">{{ session('warning') }}</span>
        </div>

    @endif

    <p class="login-box-msg">Sign in to start your session</p>

    <form action="#" method="post">
      <div class="form-group has-feedback">
        <input type="email" id="email" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" onclick="adminLogin('Login')" class="btn btn-primary btn-block btn-flat">Sign In <img class="spinner disp-0" src="{{ asset('img/loader/spin.gif') }}" style="width: 30px; height: 30px;"></button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <a href="{{ route('adminpasswordreset') }}" style="font-weight: bold; color: red;">Click to reset password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });


  // Admin Login

  function adminLogin(val){
    var route = "";
    var thisdata = "";
  if(val == "Login"){
    route = "{{ URL('Ajax/AdminLogin') }}";
    thisdata = {
      purpose:val,
      password: $("#password").val(),
      username: $("#email").val(),
    }
  }


  setHeaders();
        jQuery.ajax({
        url: route,
        method: 'post',
        data: thisdata,
        dataType: 'JSON',
        beforeSend:function(){
          $(".spinner").removeClass('disp-0');
        },
        success: function(result){
          $(".spinner").addClass('disp-0');
            if (result.message == "success") {
              $(".spinner").addClass('disp-0');
              swal("Good Job!", result.res, result.message);
                setTimeout(function(){ location.href = location.origin+'/'+result.link; }, 3000);
            }
            else
            {
               swal("Oops!", result.res, result.message);
            }

        }

      });

}

    //Set CSRF HEADERS
 function setHeaders(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    });
 }

</script>
</body>
</html>
