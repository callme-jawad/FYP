<?php
$pageName="Assign Maintenance";
include("check.php");
authenticate("ignore");
 include("../db/opendb.php");

 $q = "select * from employees";
 $result = $conn->query($q);

 $m_id = $_GET['maintenance_id'];

 $m_for = '';
 $q = "select * from maintenance where id = '$m_id'";
 $m_data = $conn->query($q);
 foreach($m_data as $row){
  $m_for = $row['m_for'];
 }

 if(isset($_POST['btnsubmit'])){
  $employee = $_POST['employee'];

  $q = "update  maintenance set status = 'Assigned',assigned_to = '$employee' where id = '$m_id'";
  echo $q;
  $return =$conn->query($q);
  if($return){
    echo "<script>window.location.href='maintenance.php'</script>";
  }

   
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
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Assign Maintenance to Employee </h3>
              </div> <br>
             
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">

                <div class="card-body">
                  
                   <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Maintenance For</label>
                    <input readonly placeholder="" value="<?php echo $m_for ?>" class="form-control" type="text" name="first_name">
                    
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Employee</label>
                    <select required name="employee" class="form-control">
                      <?php foreach($result as $row){ ?>  
                          <option><?php echo $row['name']; ?></option>
                      <?php } ?>
                      
                    </select>
                    
                  </div>
                </div>
                 
                  </div>
                 
               
                 </div>
                <!-- /.card-body -->


                <div class="card-footer float-right ">
                  <button type="submit" name="btnsubmit" class="btn btn-primary">Assign to Employee</button>
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