<?php
include("check.php"); 
authenticate("ignore"); //authenticate user
include("../db/opendb.php");  //open dbconnection
$pageName="Profile";
$status="";
$user_id = $_SESSION['Tracking_user']['user_id'];  //getting user id from SESSION variable
$query = "select * from users where user_id='".$user_id."'";  //get user from db
$result = $conn->query($query);
foreach($result as $row)
{
  $name = $row['name'];
  $email = $row['email'];
  $password = $row['password'];
}
$management_fee="";
$security="";
$times_rent="";
$renewal_percentage="";
$comission_percentage="";
$govt_tax="";
$sqr_feet = "";
$marla = "";
$query = "select * from settings";
$settings = $conn->query($query);
foreach($settings as $row){
    $management_fee = $row['management_fee'];
    $security = $row['security'];
    $times_rent = $row['times_rent'];
    $renewal_percentage = $row['renewal_percentage'];
    $comission_percentage = $row['comission_percentage'];
    $govt_tax = $row['govt_tax'];
    $sqr_feet= $row['sqr_feet'];
    $marla = $row['marla'];
}

if (isset($_POST['btnupdate'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "update users set name='".$name."',email = '".$email."',password='".$password."' where user_id='".$user_id."'";
    $result = $conn->query($query);
    $status="success";

}


if (isset($_POST['btnadd'])) {
    $management_fee = $_POST['management_fee'];
    $security = $_POST['security'];
    $times_rent = $_POST['times_rent'];
    $renewal_percentage = $_POST['renewal_percentage'];
    $comission_percentage = $_POST['comission_percentage'];
    $govt_tax = $_POST['govt_tax'];
    $sqr_feet = $_POST['dqr_feet'];
    $marla = $_POST['marla'];
    $q = "delete from settings";
    $conn->query($q);
    $query = "insert into settings(management_fee,security,times_rent,renewal_percentage,comission_percentage,govt_tax,sqr_feet,marla
              ) values ('".$management_fee."','".$security."','".$times_rent."','".$renewal_percentage."','".$comission_percentage."','".$govt_tax."','".$sqr_feet."','".$marla."')";
    $result = $conn->query($query);
    

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
     <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-3">
             
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../dist/img/avatar.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $name ?></h3>

                <p class="text-muted text-center"><?php echo $email ?></p>

               

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
          
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <?php
       if ($status != "" && $status != "success") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $status . '</div>';
            } 

     if ($status!="" && $status == "success") {
                echo '<div class="alert alert-success"><strong>User updated!: </strong> ' . $status . '</div>';
            }
             ?>
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                 
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Profile</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                 
                  <!-- /.tab-pane -->
                
                  <!-- /.tab-pane -->

                  <div class="" id="settings">
                    <form class="form-horizontal" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input name="name" type="text" value="<?php echo $name ?>" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" value="<?php echo $email ?>" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="text" name="password"  class="form-control" id="inputName2" placeholder="Password...">
                        </div>
                      </div>
                     
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success" name="btnupdate">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>


            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                 
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                 
                  <!-- /.tab-pane -->
                
                  <!-- /.tab-pane -->

                  <div class="" id="settings">
                    <form class="form-horizontal" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Management Fee</label>
                        <div class="col-sm-10">
                          <input value="<?php echo $management_fee ?>" name="management_fee" type="text" class="form-control" id="inputName" placeholder="Management fee...">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Security (Rs.)</label>
                        <div class="col-sm-10">
                          <input value="<?php echo $security ?>" type="text" name="security" class="form-control" id="inputEmail" placeholder="Security...">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Times rent</label>
                        <div class="col-sm-10">
                          <input value="<?php echo $times_rent ?>" type="number" name="times_rent"  class="form-control" id="inputName2" placeholder="Times Rent...">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Renewal %</label>
                        <div class="col-sm-10">
                          <input value="<?php echo $renewal_percentage ?>" type="number" name="renewal_percentage"  class="form-control" id="inputName2" placeholder="Renewal %...">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Comission %</label>
                        <div class="col-sm-10">
                          <input value="<?php echo $comission_percentage ?>" type="number" name="comission_percentage"  class="form-control" id="inputName2" placeholder="Comission %...">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Govt. tax</label>
                        <div class="col-sm-10">
                          <input value="<?php echo $govt_tax ?>" type="number" name="govt_tax"  class="form-control" id="inputName2" placeholder="Govt tax...">
                        </div>
                      </div>
                        <hr/>
                      <div class="card-header p-2">
                      <ul class="nav nav-pills">
                 
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Rates</a></li>
                      </ul>
                    </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">per sqr/feet (Rs)</label>
                        <div class="col-sm-10">
                          <input value="<?php echo $sqr_feet ?>" type="number" name="sqr_feet"  class="form-control" id="inputName2" placeholder="Sqr Feet...">
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">per Marla (Rs)</label>
                        <div class="col-sm-10">
                          <input value="<?php echo $marla ?>" type="number" name="marla"  class="form-control" id="inputName2" placeholder="Sqr Feet...">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success" name="btnadd">Set settings</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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
<?php $conn=NULL; ?>