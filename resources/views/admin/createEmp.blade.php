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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
  
  <meta name="csrf-token" content="{{ csrf_token() }}" >
  <style>
  .error{
      color:red;
      font-weight: normal !important;
  }
  </style>
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
                  <h3 class="card-title">Employees</h3>
                  
                        <button type="button" style="float:right" class="btn btn-primary" data-toggle="modal" data-target="#myModal">New</button>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(session()->has('succ'))
                    <div class="alert alert-success" role="alert">
                        {!! session()->get('succ') !!}
                    </div>
                    @endif
                    @if(session()->has('err'))
                    <div class="alert alert-danger" role="alert">
                        {!! session()->get('err') !!}
                    </div>
                    @endif
                    
                    
                        <table id="empTable" class="table">
                            <thead>
                                <th>Emp Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Designation</th>
                                <th>Salary</th>
                            </thead>
                            <tbody>
                                @if(!empty($data))
                                    @foreach($data as $emp)
                                    <tr>
                                        <td>{{$emp->empName}}</td>
                                        <td>{{$emp->empEmail}}</td>
                                        <td>{{$emp->empMobile}}</td>
                                        <td>{{$emp->empDesg}}</td>
                                        <td>{{$emp->empSalary}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    
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
      <strong>Copyright &copy; 2014-2020 <a href="#">Interview Task</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">New Employee</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" role="alert" id="errorDiv" style="display:none;">
            <p>Oops! Something went wrong. Please fill all details</p>
          </div>
        <div class="row">
          
                        <div class="col-md-10">
                            <form id="orderForm">
                                <div class="form-group row">
                                    <label for="fullName" class="col-sm-3 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="fullName" name="fullName">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mobile" name="mobile">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="designation" class="col-sm-3 col-form-label">Designation</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="designation" name="designation">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="salary" class="col-sm-3 col-form-label">salary</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="salary" name="salary">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="role" id="role" >
                                            <option value="1">Cash</option>
                                            <option value="2">Credit</option>
                                            <option value="3">Debit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                    <button type="button" id="butt" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                
                            </div>
                        </div>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
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
  <script src="{{asset('/public/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  
  <script>
  $(document).ready(function(){
      $("#empTable").DataTable({
        dom: 'Bfrtip',
        buttons:['csvHtml5']
      });
      $("#butt").click(function(){
            $name = $("#fullName").val();
            $email = $("#email").val();
            $mobile = $("#mobile").val();
            $designation = $("#designation").val();
            $salary = $("#salary").val();
            $role = $("#role").val();

            $.ajax({
                type:"POST",
                url:'createUserAjax',
                headers:{
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                data:{
                    'username':$name,
                    'emailId':$email,
                    'mobile':$mobile,
                    'designation':$designation,
                    'salary':$salary,
                    'role':$role
                },
                success:function(data){
                    // alert(data);
                    if(data == 'SUCCESS'){
                      location.reload(true);
                    }else if(data == 'ERROR1'){
                      $("#errorDiv").css('display', 'block');
                    }
                }
            });
        
      });
    
  });
  </script>