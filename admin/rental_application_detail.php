<?php
$pageName="Rental Application Detail";
include("../admin/check.php");
authenticate("ignore");
 include("../db/opendb.php");
 $property_id = $_GET['id'];
$q = "SELECT * from property JOIN applicant on 
property.propert_id=applicant.property
WHERE property.propert_id='".$property_id."'";
$result = $conn->query($q);

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
<?php foreach($result as $row){ ?>
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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Application</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
                <div class="col-12 col-sm-12">
                  <?php if($row['status']==0){ ?>
                  <div class="info-box bg-warning">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"></span>
                      <span class="info-box-number text-center text-muted mb-0"><font size="+2">Pending </font></span>
                    </div>
                  
                  </div>
                <?php }elseif($row['status']==1){?>
                  <div class="info-box bg-success">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"></span>
                      <span class="info-box-number text-center text-muted mb-0"><font size="+2">On Lease </font></span>
                    </div>
                  
                  </div>
                <?php }else{?>
                  <div class="info-box bg-danger">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted"></span>
                      <span class="info-box-number text-center text-muted mb-0"><font size="+2">Rejected </font></span>
                    </div>
                  
                  </div>
                <?php }?>
                </div>
               
                
              </div>
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">City</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $row['city'] ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">State</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $row['state'] ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Zip Code</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php  echo $row['zip_code']?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4>Property Address</h4>
                    <div class="post">
                      
                      <!-- /.user-block -->
                      <p>
                        <?php echo $row['street_address']?>
                      </p>

                    </div>

                    <div class="post clearfix">
                      <h4>Applicant Details</h4>
                      <hr>
                       
                       
                       
                      
                      <!-- /.user-block -->
                      <p>
                        <b>Applicant's Name: </b> <?php echo $row['first_name']." ".$row['last_name'] ?>  <br>
                        <b>Email:</b> <?php echo $row['email'] ?><br>
                        <b>Phone#:</b> <?php echo $row['phone'] ?><br>
                        <b>Dob</b>: <?php echo $row['dob'] ?> <br>
                        <b>Country:</b><?php echo $row['applicant_country'] ?> <br>
                        <b>Street Address:</b><?php echo $row['street_address'] ?> <br>
                        <b>City:</b><?php echo $row['city'] ?> <br>
                        <b>State:</b><?php echo $row['state'] ?> <br>
                        <b>Zip Code:</b><?php echo $row['zip_code'] ?> <br>
                        <b>Home Contact:</b><?php echo $row['applicant_home_contact'] ?> <br>
                        <b>Emergency Contact Name:</b><?php echo $row['emergency_contact_first_name']." ".$row['emergency_contact_last_name'] ?> <br>
                        <b>Emergency Contact Relation:</b><?php echo $row['emergency_contact_relationship'] ?> <br>
                        <b>Emergency Email:</b><?php echo $row['emergency_email'] ?> <br>
                        <b>Emergency Phone:</b><?php echo $row['emergency_phone'] ?> <br>
                      </p>
                      <p>
                       
                      </p>
                    </div>

                    <div class="post">
                       <h4>Rental Details</h4>
                       <hr>
                      <!-- /.user-block -->
                      <p>
                        <b> Country:</b><?php echo $row['rental_country'] ?><br>
                         <b> Street Address:</b><?php echo $row['rental_street_address'] ?> <br>
                          <b> City:</b><?php echo $row['rental_city'] ?> <br>
                           <b> Zip Code:</b><?php echo $row['rental_zip_code'] ?> <br>
                            <b>Rental Date From:</b><?php echo $row['rental_date_from'] ?> <br>
                             <b>Rental Date to:</b><?php echo $row['rental_date_to'] ?> <br>
                              <b>Reason for leaving:</b><?php echo $row['rental_reason_for_leaving'] ?> <br>
                               <b>Landlord Name:</b><?php echo $row['rental_landlorn_first_name']." ".$row['rental_landlord_last_name'] ?> <br>
                                <b>Landlord Phone:</b><?php echo $row['rental_landlord_phonr'] ?> <br>
                                 <b>Landlord Email:</b><?php echo $row['rental_landlord_email'] ?> <br>

                      </p>

                      <p>
                        
                      </p>
                    </div>


                     <div class="post clearfix">
                      <h4>Employment</h4>
                      <hr>
                       
                       
                       
                      
                      <!-- /.user-block -->
                      <p>
                        <b>Employment Name: </b> <?php echo $row['emp_first_name']." ".$row['emp_last_name'] ?>  <br>
                        <b>Country:</b> <?php echo $row['emp_country'] ?><br>
                        <b>Address:</b> <?php echo $row['emp_address'] ?><br>
                        <b>city</b>: <?php echo $row['emp_city'] ?> <br>
                        <b>state</b><?php echo $row['emp_state'] ?> <br>
                        <b>zipcode </b><?php echo $row['emp_zip_code'] ?> <br>
                        <b>phone</b><?php echo $row['emp_phone'] ?> <br>
                        <b>Email</b><?php echo $row['emp_email'] ?> <br>
                        <b>Position Held</b><?php echo $row['emp_position_held'] ?> <br>
                        
                      </p>
                      <p>
                       
                      </p>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              
                <img width="400px" src="../assets/property_images/<?php echo $row['image'] ?>">
              

             
             
              <div class="text-center mt-5 mb-3">
                <?php if($row['status']!=-1 && $row['status']!=1){?>
                <a href="#" class="btn btn-sm btn-primary">Reject</a> <?php }?>
                
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
<?php } ?>
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