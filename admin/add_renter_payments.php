<?php
$pageName="Add Renter Payments";
include("check.php");
authenticate("ignore");
 include("../db/opendb.php");

  $q = "select * from applicant";
  $result = $conn->query($q);


 if(isset($_POST['btnsubmit'])){

  $date = date('Y-m-d H:i:s');
              $image_item = "";
              $arr = explode(":",$date);
              $d1=$arr[0];
              $d2=$arr[1];
              $d3=$arr[2];
              $finalDate=$d1."-".$d2."-".$d3;

              if(!empty($_FILES['reciept']['name'])){
              $dir="../assets/reciepts/";
              $image_item=$_FILES['reciept']['name'];
              $temp_name=$_FILES['reciept']['tmp_name'];
              $image_item= $finalDate.'_'.$image_item;
              $fdir= $dir.$image_item;
              move_uploaded_file($temp_name,$fdir);
            }

  $payment_for = validateData($_POST['payment_for']);
  $payment_method = validateData($_POST['payment_method']);
  $bank = validateData(isset($_POST['bank'])?$_POST['bank']:'');
  $branch = validateData(isset($_POST['branch'])?$_POST['branch']:'');
  $branchCode = validateData(isset($_POST['branchCode'])?$_POST['branchCode']:'');
  $accountNumber = validateData(isset($_POST['accountNumber'])?$_POST['accountNumber']:'');
  $amount = validateData($_POST['amount']);
  $description = validateData($_POST['description']);
  $applicant = validateData($_POST['applicant']);
  $image = $image_item?$image_item:"";
  $q = "insert into payments(payment_for,payment_method,bank,branch,branch_code,account_number,amount,description,fk_applicant_id,image) values('".$payment_for."','".$payment_method."','".$bank."','".$branch."','".$branchCode."','".$accountNumber."','".$amount."','".$description."','".$applicant."','".$image."')";
  $conn->query($q);



  


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
 <script type="text/javascript">
   function getPaymentMethod(method){
      // var input = document.createElement("input");
      // input.type = "text";
      // input.className = "form-control";
      // var insideRow = document.getElementById("bankdiv");
      // insideRow.appendChild(input);
      if(method=="Bank"){
      var label="";
      var inputName="";
      var placeholder="";
      for(var i=0;i<=3;i++){
        

        if(i==0){
          label="Bank Name";
          inputName="bank";
          placeholder="Bank..."

        }else if(i==1){
          label="Branch";
          inputName="branch";
          placeholder="Branch...";
        } else if(i==2){
          label="Branch Code";
          inputName="branchCode";
          placeholder="Branch Code...";
        }else if(i==3){
          label="Account #";
          inputName="accountNumber";
          placeholder="Account#...";
        }

      var colDiv = document.createElement("div");
      colDiv.className="col-md-12";
      colDiv.id="banknamecol";
      var insideRow = document.getElementById("bankdiv");
      insideRow.appendChild(colDiv);

      var formGroup = document.createElement("div");
      formGroup.className="form-group";
      formGroup.id="banknameFormGroup";
      var insideCol = document.getElementById("banknamecol");
      insideCol.appendChild(formGroup);

      var banknameLable = document.createElement("label");
      banknameLable.innerHTML=label;
      var insideformGroup = document.getElementById("banknameFormGroup");
      insideformGroup.appendChild(banknameLable);

      var banknameInput = document.createElement("input");
      banknameInput.className="form-control";
      banknameInput.name=inputName;
      banknameInput.type="text";
      banknameInput.placeholder=placeholder
      insideformGroup = document.getElementById("banknameFormGroup");
      insideformGroup.appendChild(banknameInput);
    }
  }else{
    const list = document.getElementById("bankdiv");
   list.removeChild(list.firstElementChild);

  }



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
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Payments </h3>
              </div> <br>
             
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">

                <div class="card-body">
                   <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Payment for</label>
                     <select class="form-control" name="payment_for">
                       <option>Rent</option>
                       <option>Maintenance</option>
                       <option>Charges</option>
                       <option>Any other</option>
                     </select>
                  </div>
                </div>

                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Payment Method</label>
                     <select onchange="getPaymentMethod(this.value)" class="form-control" name="payment_method">
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
                  <div class="row" id="bankdiv">
                  

              </div>
              <div class="row">   
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                     <input type="text" class="form-control" name="amount" placeholder="Amount...">

                  </div>
              </div>             
              </div>
                  <div class="row">
                   <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea placeholder="Description..." class="form-control" name="description">
                      
                    </textarea>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Renter</label>
                    <select  required class="form-control" name="applicant">
                      <option value="">Select</option>
                      <?php foreach($result as $row){ ?>
                      <option value="<?php echo $row['id'] ?>"><?php echo $row['first_name'] ?>(<?php echo $row['email'] ?>)</option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Reciept</label>
                    <input type="file" name="reciept" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> &nbsp;</label> <br>
                     <button type="submit" name="btnsubmit" class="btn btn-primary">Add Payment</button>
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