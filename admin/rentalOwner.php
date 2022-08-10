<?php
$pageName="Rental Owner";
include("check.php");
authenticate("ignore");
 include("../db/opendb.php");
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

  <button class=" btn btn-warning" onclick="location.href='addRentalOwner.php'">Add Rental Owner</button> 
   


   <hr>
         <div class="card">
    <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-secondary">
              <tr style="color:white">
               
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                 <th>Phone</th>
              
              <!--   <th>UnitFMN</th> -->
                <th>Address</th>
                <th>Date </th>

               
                <th>Action</th>
                <!-- <th width="15%">Action</th> -->

                </tr>
            </thead>
            <tbody>
              <?php
            
              
              $query = "select * from rental_owner ";
            
              $result = $conn->query($query) or die("Query error");

              foreach ($result as $row) {
              ?>

              
                 <tr>
                 
                  <td><?php echo $row['first_name']; ?></td>
                  <td><?php echo $row['last_name']; ?></td>
                  <td><?php echo $row['email'];?></td>
                   <td><?php echo $row['phone_no']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                   
                
                 
                  
                
                 
                  <td><?php echo date( 'M d Y g:i A ', strtotime($row['created_at'])) ?></td>
                <td> <div class="input-group-prepend">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                      Action
                    </button>
                    <div class="dropdown-menu">
                     
                     <a class="dropdown-item" href="#">Details</a>
                    </div>
                  </div></td>
                    </tr>
              <?php
              }
              ?>
            </tbody>
            <tfoot class="bg-secondary">
                  <tr style="color:white">
               
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                 <th>Phone</th>
              
              <!--   <th>UnitFMN</th> -->
                <th>Address</th>
                <th>Date </th>

               
                <th>Action</th>
                <!-- <th width="15%">Action</th> -->

                </tr>

            </tfoot>
          </table>


        </div>
      </div>
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