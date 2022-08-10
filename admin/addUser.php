<?php
$pageName="Add Another Admin";
include("check.php");
authenticate("ignore");
$status = "";

 include("../db/opendb.php");
if(isset($_POST['btnsubmit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address=$_POST['address'];
  $pass=md5($_POST['password']);

  $q = "insert into users (name,email,password,address,fk_role_id) values('".$name."','".$email."','".$pass."','".$address."','1')";
  $conn->query($q);
  $status="success";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pageName ?></title>

  <!-- Google Font: Source Sans Pro -->
 <!-- Google Font: Source Sans Pro -->
 <?php include("../includes/head.php"); ?>
   <script>

   function validateform(){  
    var name   = frm.name.value;


    var letters = /^[A-Za-z]+$/;
    var numbers = /^[0-9]+$/;
    if(!name.match(letters))
     {
      alert(" Name is invalid");
      return false;

     }


    return true;
   }

 </script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"><?php  echo $pageName ?></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("../includes/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> <br>
   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $pageName ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php  echo $pageName ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
<section class="content">
      <div class="container-fluid">
         <?php 
        if($status!="" && $status=="success"){
         ?>
        <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Success!</h4>
  <p>User addedd success</p>
  </div>

     <?php } ?>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Admin </h3>
              </div> <br>
             
              <!-- /.card-header -->
              <!-- form start -->
              <form id="frm" method="post" enctype="multipart/form-data">

                <div class="card-body">
                   <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input required type="text" placeholder="Ful Name" class="form-control" name="name">
                     
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input required type="email" placeholder="Email" class="form-control" name="email">
                     
                    </select>
                  </div>
                </div>
              </div>
                   <div class="row">
                   <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea required placeholder="address" name="address" class="form-control">
                      
                    </textarea>
                    
                  </div>
                </div>
                 
                  </div>
                  
                <div class="row">
                   <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input placeholder="password" type="text" class="form-control" name="password">
                      
                    </textarea>
                    
                  </div>
                </div>
                 
                  </div>
                 </div>
                <!-- /.card-body -->


                <div class="card-footer float-right ">
                  <button type="submit"  name="btnsubmit" class="btn btn-primary">Add Admin</button>
                </div>
              </form>
            </div>
           

    

          </div>
          <!--/.col (left) -->
          <!-- right column -->
     
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("../includes/footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php include("../includes/scripts.php"); ?>
</body>
</html>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>