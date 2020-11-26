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
                  <h3 class="card-title">Post</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-md-8">
                        <div class="alert alert-danger" id="erralert" role="alert" style="display:none"></div>
                        @if(!empty($postData))
                        <!--<form id="orderForm">-->
                            <div class="form-group row">
                                <h3>{{$postData[0]->postTitle}}</h3>
                            </div>
                            <div class="form-group ">
                                <span style="font-size:20px">{{$postData[0]->postDesc}}</span><br />
                                <span style="font-size:12px">Posted By: {{$postData[0]->username}}</span>
                            </div>
                            <hr/>
                            <h4>Comments</h4>
                            @if(!empty($postComm))
                                @foreach($postComm as $comm)
                                    <p><span>{{$comm->commentDesc}}
                                    @if(($delete == '1') || (session('user')['role'] == 'admin'))
                                        <button id="deleteButt" data-deleteId="{{$comm->commentId}}" ><i class="fa fa-trash"></i></button>
                                    @endif
                                    </span style="font-size:20px"><br />
                                    <span style="font-size:12px">Commented By: {{$comm->username}} on {{$comm->createdDateTime}}</span></p>
                                @endforeach
                                @if(($comment == 1) && ($postData[0]->restrict_comments == 1))
                                    <form method="POST" action="{{asset('saveComment')}}" id="commentForm" >
                                    {{ csrf_field() }}
                                        <input type="hidden" name="postId" id="postId" value="{{request()->postId}}" />
                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="commentVal" name="commentVal"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary" id="submitsal">Save</button>
                                        </div>
                                    </form>
                                @endif

                            @endif
                        <!--</form>-->
                        @endif
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
  <script src="{{asset('/public/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      
        $("#commentForm").validate({
            rules:{
                commentVal:{
                    required:true
                }
            },
            messages:{
                commentVal:{
                    required:"Please enter comments"
                }
            },
            submitHandler:function(){
                $("#commentForm")[0].submit();
            }
        });

        $("#deleteButt").click(function(){
            $deleteId = $(this).attr('data-deleteId');
            // alert($deleteId);
            $.ajax({
                type:"POST",
                url:"{{asset('deleteComment')}}",
                headers:{
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                },
                data:{
                    'commentId': $deleteId
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
</body>