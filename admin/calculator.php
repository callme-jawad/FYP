<?php
$pageName="Rental Calculator";
include("check.php");
authenticate("ignore");
 include("../db/opendb.php");
 $sqr_feet =0 ;
  $marla = 0;
  $bed_rooms= 0;
  $sqr_feet_rate = 0;
  $marla_rate = 0;
if(isset($_POST['btnsubmit'])){

  $sqr_feet = $_POST['sqr_feet'];
  $marla = $_POST['marla'];
  $bed_rooms=$_POST['bed_rooms'];

  $query = "select * from settings";
  $settings = $conn->query($query);

  foreach($settings as $row){

    $sqr_feet_rate= $row['sqr_feet'];
    $marla_rate = $row['marla'];

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
                <h3 class="card-title">Calculator </h3>
              </div> <br>
             
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">

                <div class="card-body">
                   <div class="row">
                   <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">sqr. feet</label>
                    <input required type="text" placeholder="Sqr. feet..." value="<?php echo $sqr_feet ?>" class="form-control" name="sqr_feet">
                     
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Marla</label>
                    <input required type="text" placeholder="Marla..." value="<?php echo $marla ?>" class="form-control" name="marla">
                     
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bedrooms</label>
                    <input required type="text" placeholder="Bedrooms..." value="<?php echo $bed_rooms ?>" class="form-control" name="bed_rooms">
                     
                  </div>
                </div>
              </div>
                   
                  
                <div class="row">
                   <div class="col-md-12">
                  
                </div>
                 
                  </div>
                 </div>
                <!-- /.card-body -->


                <div class="card-footer float-right ">
                  <button type="submit"  name="btnsubmit" class="btn btn-primary">Calculate</button>
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

    
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Result </h3>
              </div> <br>
             
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">

                <div class="card-body">
                   <div class="row">
                   <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Per Sqr/Feet (Rs.) : <?php echo $sqr_feet_rate ?>/-</label> <br>
                      <label for="exampleInputEmail1">Marla Rate (Rs.) : <?php echo $marla_rate ?>/-</label>
                   
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sqr Feet : <?php echo $sqr_feet ?></label> <br>
                    <label for="exampleInputEmail1">Marla : <?php echo $marla ?></label> <br>
                    <label for="exampleInputEmail1">Bedrooms : <?php echo $bed_rooms ?></label>
                     
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><h3>Calculated Amount:  </h3></label>
                    <label>Per sqr/Feet * sqr Feet= <?php echo $sqr_feet_rate*$sqr_feet ?></labe>
                     <label>Marla rate * Marla= <?php echo $marla_rate*$marla ?></labe>
                      <hr>
                      <label>Total Amount (Rs): <?php echo  (($sqr_feet_rate*$sqr_feet) + ($marla_rate*$marla))*$bed_rooms ?></label>
                  </div>
                </div>
              </div>
                   
                  
                <div class="row">
                   <div class="col-md-12">
                  
                </div>
                 
                  </div>
                 </div>
                <!-- /.card-body -->
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