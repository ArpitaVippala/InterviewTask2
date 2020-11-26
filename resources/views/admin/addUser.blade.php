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
                  <h3 class="card-title">Users</h3>
                  
                        <button type="button" style="float:right" class="btn btn-primary" data-toggle="modal" data-target="#myModal">New</button>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {!! session()->get('success') !!}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {!! session()->get('error') !!}
                    </div>
                    @endif
                    
                    
                        <table id="empTable" class="table">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if(!empty($users))
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->emailId}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td><a onclick="thisUser({{$user->userId}})" data-target="#myModal2" href="javascript:void(0)">Edit</a></td>
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
      <h4 class="modal-title">New User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" role="alert" id="errorDiv" style="display:none;">
            <p>Oops! Something went wrong. Please fill all details</p>
          </div>
        <div class="row">
          
                        <div class="col-md-10">
                          <form id="userForm" method="POST" action="{{asset('saveUser')}}">
                            {{ csrf_field() }}
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
                                <label for="email" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="pwd" name="pwd">
                                </div>
                            </div>
                            <!--<div class="form-group row">
                                <label for="salary" class="col-sm-3 col-form-label">salary</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="salary" name="salary">
                                </div>
                            </div>-->
                            <div class="form-group row">
                                <div class="col-sm-10">
                                <button type="submit" id="submitButt" class="btn btn-primary">Submit</button>
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

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Employee Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" role="alert" id="errorDiv" style="display:none;">
            <p>Oops! Something went wrong. Please fill all details</p>
          </div>
        <div class="row">
          
                        <div class="col-md-10">
                          <form id="userForm1" method="POST" action="{{asset('updateUser')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="userid" id="userid" />
                            <div class="form-group row">
                                <label for="fullName" class="col-sm-3 col-form-label">Full Name</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="editfullName" name="editfullName">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="editemail" name="editemail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="editPwd" name="editPwd">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="editmobile" name="editmobile">
                                </div>
                            </div>
                            <!--<div class="form-group row">
                                <label for="designation" class="col-sm-3 col-form-label">Designation</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="designation" name="designation">
                                </div>
                            </div>-->
                            <div class="form-group row">
                                <label for="salary" style="margin-right:10px">Comment</label>
                                <div class="col-sm-10">
                                  <input type="radio" style="margin:8px" id="commentYes" name="commentCond" value="1" checked>Yes
                                  <input type="radio" style="margin:8px" id="commentNo" name="commentCond" value="0">No
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="salary" style="margin-right:10px">Delete Post</label>
                                <div class="col-sm-10">
                                  <input type="radio" style="margin:8px" id="delPostYes" name="postRemove" value="1" checked>Yes
                                  <input type="radio" style="margin:8px" id="delPostNo" name="postRemove" value="0">No
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                <button type="submit" id="submitButt1" class="btn btn-primary">Submit</button>
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
      $("#userForm").validate({
        rules:{
            fullName:{
                required:true
            },
            email:{
                required:true
            },
            mobile:{
                required:true
            },
        },
        messages:{
            fullName:{
                required:"Please enter full name"
            },
            email:{
                required:"Please enter email"
            },
            mobile:{
                required:"Please enter mobile"
            },
        },
        submitHandler:function(){
            $("#userForm")[0].submit();
        }
      });

      $("#userForm1").validate({
        rules:{
            fullName:{
                required:true
            },
            email:{
                required:true
            },
            mobile:{
                required:true
            },
            pwd:{
                required:true
            },
        },
        messages:{
            fullName:{
                required:"Please enter full name"
            },
            email:{
                required:"Please enter email"
            },
            mobile:{
                required:"Please enter mobile"
            },
            pwd:{
                required:"Please enter password"
            },
        },
        submitHandler:function(){
            $("#userForm1")[0].submit();
        }
      });
  });
  </script>
  <script>
  function thisUser(userId){
    $("#myModal2").modal('show');
    $.ajax({
      type:"POST",
      url:"getUser",
      headers:{
        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
      },
      data:{
        'userId': userId
      },
      success:function(data){
        // alert(data);
        if(data == 'ERROR'){
          $("#errorDiv").css('display', 'block');
        }else{
          data = JSON.parse(data);
          data = data[0];
          $("#editfullName").val(data.username);
          $("#editemail").val(data.emailId);
          $("#editmobile").val(data.mobile);
          $("#editPwd").val(data.pwd);
          $("#userid").val(data.userId);
          if(data.restrict_comments == '1'){
            $("#commentYes").prop('checked', true);
          }else{
            $("#commentNo").prop('checked', true);
          }
          if(data.restrict_post_del == '1'){
            $("#delPostYes").prop('checked', true);
          }else{
            $("#delPostNo").prop('checked', true);
          }
        }
      }
    });
  }
  </script>