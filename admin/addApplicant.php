<?php
$pageName="Add Applicant";
include("check.php");
authenticate("ignore");
 include("../db/opendb.php");
  require '../phpMailer/PHPMAILERAutoload.php';
  require '../phpMailer/credentials.php';

  $q = "select * from property";
  $result = $conn->query($q);
  $status = "";

 if(isset($_POST['btnsubmit'])){
  $first_name = validateData($_POST['first_name']);
  $last_name = validateData($_POST['last_name']);
  $email = validateData($_POST['email']);
  $phone = validateData($_POST['phone']);
  $property = validateData($_POST['property']);
    $q = "select * from applicant where property='".$property."'";
    $result = $conn->query($q);
    if($result->rowCount()>0){
      $status="error";
    }else{
  $q = "insert into applicant(first_name,last_name,email,phone,property) values(:first_name,:last_name,:email,:phone,:property)";
  $stmt = $conn->prepare($q);
  $stmt->bindParam(':first_name',$first_name);
  $stmt->bindParam(':last_name',$last_name);
  $stmt->bindParam(':email',$email);
  $stmt->bindParam(':phone',$phone);
  $stmt->bindParam(':property',$property);
  $stmt->execute();
  $id = $conn->lastInsertId();
   $status="success";
  if(isset($_POST['isEmail'])){
              $mail = new PHPMailer;

            //$mail->SMTPDebug = 4;                               // Enable verbose debug output

          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = EMAIL;                             // SMTP username
          $mail->Password = PASS;                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                                    // TCP port to connect to

          $mail->setFrom(EMAIL,'Registeration Success | Start Application');
          $mail->addAddress($email);     // Add a recipient

          $mail->addReplyTo(Sender);



          //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
          $mail->isHTML(true);                                  // Set email format to HTML

          $mail->Subject = "Registration Success | Start Application";
          $mail->Body= "<h1>You're invited to apply</h1> <br>
                          Hi $first_name <br>
                          <p>Thanks for your interest in one of our rentals! Click below to get started.
                     </p> 
                      <a href=\"localhost/lms/startApplication.php?id={$id}\" class='button'>Start Application</a> 


                      ";
          //$mail->AltBody = "Thi is muzamil";

          if(!$mail->send()) {
              $msg = 'Message could not be sent.';
             // echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
              $msg="success";
             
          }
      }

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
 <script>

   function validateform(){  
    var fname   = frm.first_name.value;
    var lname  = frm.last_name.value;
    var phone  = frm.phone.value;

    var letters = /^[A-Za-z]+$/;
    var numbers = /^[0-9]+$/;
    if(!fname.match(letters))
     {
      alert("First name is invalid");
      return false;

     }else if(!lname.match(letters)){
      alert("Last name is invalid");
      return false;
     }else if(!phone.match(numbers)){
          alert("Phone is invalid");
          return false;
     }else if(phone.length>11){
        alert("Phone number length be valid");
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
  <p>Applicant Added Sucess</p>
  </div>

     <?php } ?>

      <?php 
        if($status!="" && $status=="error"){
         ?>
        <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Failed!</h4>
  <p>Please try another Property</p>
  </div>

     <?php } ?>
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
              <form id="frm" method="post" enctype="multipart/form-data" onsubmit="return validateform()" >

                <div class="card-body">
                   <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    <input required type="text" placeholder="First Name" name="first_name" class="form-control">
                     
                    </select>
                  </div>
                </div>

                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input required type="text" placeholder="Last Name" name="last_name" class="form-control">
                     
                    </select>
                  </div>
                </div>
              </div>
                   <div class="row">
                   <div class="col-md-8">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Email</label>
                    <input required type="email" placeholder="Email" name="email" class="form-control"><br>
                    <input type="checkbox" name="isEmail"> Send Application link on Email
                    
                  </div>
                </div>
                <div class="col-md-4">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input required   type="text" name="phone"  class="form-control" id="Name" placeholder="Phone#">
                  </div>
                </div>
                 
                  </div>
                  <div class="row">
                   <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Property</label>
                    <select required class="form-control" name="property">
                      <?php foreach($result as $row){ ?>
                      <option value="<?php echo $row['propert_id'] ?>"><?php echo $row['street_address'] ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> &nbsp;</label> <br>
                     <button type="submit" name="btnsubmit" class="btn btn-primary">Add Applicant</button>
                  </div>
                </div>
                </div>
                

                 </div>
                <!-- /.card-body -->


                <div class="card-footer float-right ">
                 
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