<?php
$payment_id = $_GET['payment_id'];
$pageName="Edit Renter Payment";
include("check.php");
authenticate("ignore");
 include("../db/opendb.php");
  $q = "select * from applicant";
  $renter = $conn->query($q);

 $q = "select * from payments where id = '".$payment_id."'";
 $payment = $conn->query($q);

 if(isset($_POST['btnsubmit'])){
   $payment_for = validateData($_POST['payment_for']);
  $payment_method = validateData($_POST['payment_method']);
  $bank = validateData(isset($_POST['bank'])?$_POST['bank']:'');
  $branch = validateData(isset($_POST['branch'])?$_POST['branch']:'');
  $amount = validateData($_POST['amount']);
  $description = validateData($_POST['description']);
  $applicant = validateData($_POST['applicant']);
  $q = "update  payments set payment_for='".$payment_for."',payment_method='".$payment_method."',bank='".$bank."',branch='".$branch."',amount='".$amount."',description='".$description."',fk_applicant_id='".$applicant."' where id='".$payment_id."'";
  $conn->query($q);

  echo "<script>window.location.href='renter_payments.php'</script>";
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
                <h3 class="card-title">Edit Payments </h3>
              </div> <br>
             
              <!-- /.card-header -->
              <!-- form start -->
              <?php foreach($payment as $row){ ?>
              <form method="post" enctype="multipart/form-data">

                <div class="card-body">
                   <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Payment for</label>
                     <select defaultvalue="<?php echo $row['payment_for'] ?>" class="form-control" name="payment_for">
                       <option value="Rent">Rent</option>
                       <option value="Maintenance">Maintenance</option>
                       <option value="Charges">Charges</option>
                       <option value="Any other">Any other</option>
                     </select>
                  </div>
                </div>

                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Payment Method</label>
                     <select class="form-control" name="payment_method">
                       <option>Cash</option>
                       <option>Bank</option>
                     </select>
                  </div>
                </div>
              </div>
                   <div class="row">
                   <div class="col-md-8">
                  <div class="form-group">
                  <b>Bank details if any? </b>

                    
                  </div>
                </div>
               
                  </div>
                  <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bank</label>
                      <input value="<?php echo $row['bank'] ?>" type="text" class="form-control" name="bank" placeholder="Bank...">
                    
                  </div>
                </div>

                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Branch</label>
                     <input value="<?php echo $row['branch'] ?>" type="text" class="form-control" name="branch" placeholder="Branch...">

                  </div>
                </div>
              </div>
              <div class="row">   
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                     <input value="<?php echo $row['amount'] ?>" type="text" class="form-control" name="amount" placeholder="Amount...">

                  </div>
              </div>             
              </div>
                  <div class="row">
                   <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea placeholder="Description..." class="form-control" name="description">
                      <?php echo $row['description'] ?>
                    </textarea>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Renter</label>
                    <select value="<?php echo $row['id'] ?>" required class="form-control" name="applicant">
                      <option value="">Select</option>
                      <?php foreach($renter as $row2){ ?>
                      <option value="<?php echo $row2['id'] ?>"><?php echo $row2['first_name'] ?>(<?php echo $row2['email'] ?>)</option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> &nbsp;</label> <br>
                     <button type="submit" name="btnsubmit" class="btn btn-primary">Update Payment</button>
                  </div>
                </div>
                </div>
                

                 </div>
                <!-- /.card-body -->


                <div class="card-footer float-right ">
                 
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