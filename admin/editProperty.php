<?php
$property = base64_decode($_GET['property']);
$owner = base64_decode($_GET['owner']);
$pageName="Edit Property";
include("check.php");
authenticate("ignore");
 include("../db/opendb.php");
  $q = "select * from rental_owner";
 $rentalOwner = $conn->query($q);
 $q = "select * from property_type";
 $propertyType = $conn->query($q);

 $q = "select * from property where propert_id = '".$property."'";
 $result = $conn->query($q);

 if(isset($_POST['btnsubmit'])){
  $propertyType = validateData($_POST['property_type']);
  $address = validateData($_POST['address']);
  $city = validateData($_POST['city']);
  $state = validateData($_POST['state']);
  $zip_code =validateData($_POST['zip_code']);
  $property_owner = validateData($_POST['property_owner']);
  $country = validateData($_POST['country']);

  $query = "update  property set fk_property_type='$propertyType',street_address='$address',city='$city',state='$state',zip_code='$zip_code',country='$country',fk_rental_owner='$property_owner' WHERE  propert_id = $property";
  //echo $query;
  $conn->query($query);

  echo "<script>window.location.href='property.php'</script>";
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
                <h3 class="card-title">Add New Property </h3>
              </div> <br>
             
              <!-- /.card-header -->
              <!-- form start -->
              <?php foreach($result as $data){ ?>
              <form method="post" enctype="multipart/form-data">

                <div class="card-body">
                   <div class="row">
                   <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Property Type</label>
                    <select name="property_type" class="form-control">
                     <?php
                      foreach($propertyType as $row){
                     ?>
                     <option <?php echo ($data['fk_property_type']==$row['id'])?'selected': '' ?> value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?></option>
                   <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
                   <div class="row">
                   <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Street Address</label>
                    <textarea name="address" class="form-control">
                      <?php echo $data['street_address']; ?>
                    </textarea>
                    
                  </div>
                </div>
                 
                  </div>
                  <div class="row">
                   <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input value="<?php echo $data['city'] ?>"  type="text" name="city"  class="form-control" id="Name" placeholder="City...">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> State</label>
                    <input value="<?php echo $data['state']; ?>"  type="text" name="state" class="form-control" id="Name" placeholder="State...">
                  </div>
                </div>
                </div>
                <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label >Zip Code</label>
                    <input value="<?php echo $data['zip_code']; ?>" type="text" name="zip_code" class="form-control" id="Address" placeholder="Zipcode...">
                  </div>
                </div>
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Country</label>
                    <input value="<?php echo $data['country'] ?>"  type="text" name="country" class="form-control" id="province" placeholder="Country...">
                  </div>
                </div>
                  </div>

                  <div class="row">
                   <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Property Owner</label>
                    <select name="property_owner" class="form-control">
                     <?php
                      foreach($rentalOwner as $row){
                     ?>
                      <option <?php echo ($data['fk_rental_owner']==$row['id'])?'selected':'' ?> value="<?php echo $row['id'] ?>"><?php echo $row['first_name']." ".$row['last_name']."-".$row['email'] ?></option>
                   <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
                 </div>
                <!-- /.card-body -->


                <div class="card-footer float-right ">
                  <button type="submit" name="btnsubmit" class="btn btn-primary">Add Property</button>
                </div>
              </form>
            <?php } ?>
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