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
  <style>
    <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    /* Float four columns side by side */
    .column {
      float: left;
      width: 33%;
      padding: 0 10px;
    }


    /* Remove extra left and right margins, due to padding */
    .row {margin: 0 -5px;}

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive columns */
    @media screen and (max-width: 600px) {
      .column {
        width: 100%;
        display: block;
        margin-bottom: 20px;
      }
    }

    /* Style the counter cards */
    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      padding: 16px;
      text-align: center;
      background-color: #ffffff;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
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
                  <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <span>Total Users:{{$users}}</span>
                  </div>
                <div class="row">
                    <span>Total Posts:{{$posts}}</span>
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
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
      }
    });
    $(".orderNow").click(function(){
      $productId = $(this).data('prodid');
      $productPrice = $(".productPrice_"+$productId).text();
      $prodPRice = $("#prodPrice_"+$productId).text(); 
      $.ajax({
        type:"POST",
        url: "addToCart",
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
          'prodId':$productId,
          'price':$prodPRice
        },
        success:function(data){
          if(data != 'no'){
            $("#cartButt_"+$productId).css('display', 'block');
            $("#orderNow_"+$productId).css('display', 'none');
            $("#cartItems").text(data);
          }
        }
      });
    });
    $currentCurr = 1;
    $("#currency").change(function(){
       $currVal = $("#currency").val();
       $.ajax({
        type:'POST',
        url:'changeCurrency',
        headers:{
          'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        data:{
          'currencyVal':$currVal
        },
        success:function(data){
          if(data == 'YES'){
            location.reload(true);
          }
        }
       });
      // $(".prodPrice").each(function(){
      //   $price = $(this).text();
      //   $productId = $(this).attr('data-productIdVal');
      //   // console.log("prodId "+$productId);
      //   if($currVal == '1'){
      //     $price = parseFloat(parseFloat($price)/1).toFixed(2);   
      //     $sym = "₹";    
      //   }else if($currVal == '2'){
      //     $price = parseFloat(parseFloat($price)/74.75).toFixed(2);
      //     $sym = "$";
      //   }else if($currVal == '3'){
      //     $price = parseFloat(parseFloat($price)/88.22).toFixed(2);
      //     $sym = "€";
      //   }
      //   $("#price_"+$productId).text($sym+' '+$price);
      // });
    });
  });
</script>
</body>
