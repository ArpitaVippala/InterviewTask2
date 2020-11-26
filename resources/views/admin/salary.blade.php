<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Interview Task</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/public/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/public/assets/css/adminlte.min.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" >
</head>
<body>
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <span>{!! session('admin')['role'] !!}</span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{asset('logout/user')}}" role="button">
          Logout  
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    @include('includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Salary</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-10">
                      <form id="orderForm">
                        <div class="form-group row">
                          <label for="fullName" class="col-sm-3 col-form-label">Working Days</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="workingDays" name="workingDays">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="fullName" class="col-sm-3 col-form-label">Absent Days</label>
                          <div class="col-sm-3">
                          <input type="text" class="form-control" id="absentDays" name="absentDays">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="fullName" class="col-sm-3 col-form-label">Total late Days</label>
                          <div class="col-sm-3">
                          <input type="text" class="form-control" id="lateDays" name="lateDays">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="fullName" class="col-sm-3 col-form-label">Total Early Days</label>
                          <div class="col-sm-3">
                          <input type="text" class="form-control" id="earlyDays" name="earlyDays">
                          </div>
                        </div>
                        <div class="form-group row">
                          <button type="button" class="btn btn-primary" name="submitsal" id="submitsal">Save</button>
                        </div>
                      </form>
                      <div>
                        <span id="calSalary"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0-pre
      </div>
      <strong>Copyright &copy; 2014-2020 </strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <script src="{{asset('/public/assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- bs-custom-file-input -->
  <script src="{{asset('/public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('/public/assets/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('/public/assets/js/demo.js')}}"></script>
  <script>
    $(document).ready(function(){
      /*$.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN': $("meta[name='token']").attr('value')
        }
      });*/
      $("#submitsal").click(function(){
        $workingDays = $("#workingDays").val();
        $absentDays = $("#absentDays").val();
        $lateDays = $("#lateDays").val();
        $earlyDays = $("#earlyDays").val();
        
        $.ajax({
          type:"POST",
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:'salaryCal',
          data:{
            'workingDays':$workingDays,
            'absentDays':$absentDays,
            'lateDays':$lateDays,
            'earlyDays':$earlyDays,
          },
          success:function(data){
            if(data != ''){
              data = JSON.parse(data);
            }
            $("#calSalary").html("Total calculated salary <b>"+data.calculatedSalary+"</b>");
          }
        });
      });
    });
  </script>
</body>