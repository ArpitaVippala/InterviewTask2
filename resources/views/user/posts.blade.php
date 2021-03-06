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
                    <h3 class="card-title">Employees</h3>
                    <button type="button" style="float:right" class="btn btn-primary" data-toggle="modal" data-target="#myModal">New Post</button>
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
                            <th>Post</th>
                            <th>Title</th>
                            <th>Comments</th>
                            <th>Posted By</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if(!empty($posts))
                                <?php $i=1 ;?>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a href="post/{{$post->postId}}" style="text-decoration:underline">{{$post->postTitle}}</a></td>
                                    <td>{{$post->commentcount}}</td>
                                    <td>{{$post->postedBy}}</td>
                                    <td>{{$post->date}}</td>
                                    <td>@if(($post->userId == session('user')['userId']) && ($post->restrict_post_del == 1))
                                        <button id="deleteButt" data-deleteId="{{$post->postId}}" ><i class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
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
                    <h4 class="modal-title">New Post</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>                
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert" id="errorDiv" style="display:none;">
                        <p>Oops! Something went wrong. Please fill all details</p>
                    </div>
                    <div class="row">                    
                        <div class="col-md-10">
                            <form id="postForm" method="POST" action="{{asset('savePost')}}">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="postTitle" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="postTitle" name="postTitle">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="postDesc" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="postDesc" name="postDesc">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                    <button type="submit" id="submitButt" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
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
      $("#postForm").validate({
        rules:{
            postTitle:{
                required:true
            },
            postDesc:{
                required:true
            },
        },
        messages:{
            postTitle:{
                required:"Please enter title"
            },
            postDesc:{
                required:"Please enter description"
            },
        },
        submitHandler:function(){
            $("#postForm")[0].submit();
        }
      });

      $("#deleteButt").click(function(){
            $deleteId = $(this).attr('data-deleteId');
            // alert($deleteId);
            $.ajax({
                type:"POST",
                url:"{{asset('deletePost')}}",
                headers:{
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                data:{
                    'postId': $deleteId
                },
                success:function(data){
                    // alert(data);
                    if(data == "SUCCESS"){
                        location.reload(true);
                    }else{
                        $("#erralert").html('OOPS! Something went wrong');
                        $("#erralert").css('display', 'block');
                    }
                }
            });
        });
  });
  </script>