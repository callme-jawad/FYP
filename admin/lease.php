<?php
$pageName="Rental Applications";
include("../admin/check.php");
authenticate("ignore");
 include("../db/opendb.php");
$query = "SELECT  applicant.first_name,applicant.last_name,applicant.lease_start,applicant.lease_end,applicant.lease_status,
rental_owner.first_name as rental_owner_first_name, rental_owner.last_name as rental_owner_last_name
from applicant
JOIN property on applicant.property = property.propert_id
JOIN rental_owner on property.fk_rental_owner=rental_owner.id
WHERE applicant.lease_status!=''";
$result = $conn->query($query) or die("Query error");
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

  <!-- <button class=" btn btn-warning" onclick="location.href='addProperty.php'">Add Property</button> 
   <button class=" btn btn-success" onclick="location.href='addPropertyType.php'">Add Property Type</button>  -->


   <hr>
         <div class="card">
    <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead class="bg-secondary">
              <tr style="color:white">
               
                <th>Applicant Name</th>
                <th>Lease Start</th>
                <th>Lease End</th>
                 <th>Rental Owner Name</th>
              
              <!--   <th>UnitFMN</th> -->
               
              <!--   <th>Furniture</th>
                <th>Water</th> -->
                <th>Status</th>
                <th>Action</th>
                <!-- <th width="15%">Action</th> -->

                </tr>
            </thead>
            <tbody>
              <?php
            
              
              

              foreach ($result as $row) {
              ?>

              
                 <tr>
                    <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                 <td><?php echo date( 'M d Y  ', strtotime($row['lease_start'])) ?></td>
                  <td><?php echo date( 'M d Y  ', strtotime($row['lease_end']))?></td>
                  <td><?php echo $row['rental_owner_first_name']." ".$row['rental_owner_last_name'];?></td>
                 
                   <?php if($row['lease_status']==1){ ?>
                  <td class="bg-success">Active</td>
                <?php }else{ ?>
                  <td class="bg-warning">Expired</td>
                <?php } ?>
                <td>
                  <button class="btn btn-primary">Details</button>
                  </td>
                    </tr>
              <?php
              }
              ?>
            </tbody>
            <tfoot class="bg-secondary">
                  <tr style="color:white">
               
                <th>Applicant Name</th>
                <th>Lease Start</th>
                <th>Lease End</th>
                 <th>Rental Owner Name</th>
              
              <!--   <th>UnitFMN</th> -->
               
              <!--   <th>Furniture</th>
                <th>Water</th> -->
                <th>Status</th>
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