<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PIZZAS | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/public/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('/public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/public/assets/css/adminlte.min.css')}}">
  <meta name="csrf-token" content = "{{ csrf_token() }}">
  <style>
    .error{
      color:red;
      margin-right: 46%;
      font-weight: normal !important;
      border-right: 1;
      display: inline-block !important;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>LOGIN</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login to start your session</p>
        @if($errors->any())
          <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
          </div>
        @endif
      <form action="{{asset('/createUser')}}" method="post" id="loginForm">
        {{ csrf_field() }}
        <div class="mb-3">
          <input type="text" name="emailId" id="emailId" class="form-control" placeholder="Email">          
        </div>
        <div class="mb-3">
          <input type="text" name="uname" id="uname" class="form-control" placeholder="Name">          
        </div>
        <div class="mb-3">
          <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password">          
        </div>
        <div class="mb-3">
          <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile">          
        </div>
        <div class="mb-3">
          <select class="form-control" name="role" id="role" >
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>          
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
          </div>
          <div class="col-3">
            <a href="{{asset('/login')}}">Login</a>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('/public/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/public/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/public/assets/dist/js/adminlte.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $("#loginForm").validate({
      rules:{
        'email':{
          required:true,
          email:true
        }
      },
      messages:{
        'email':{
          required:"Please enter Email-Id",
          email:"Please enter valid Email-Id",
        }
      },
      submitHandler:function(){
        $("#loginForm")[0].submit();
      }
    });
  });
</script>
<script language="javascript" type="text/javascript">
	window.history.forward();
	</script>
</body>