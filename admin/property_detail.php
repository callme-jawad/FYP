<?php
$pageName="Property Detail";
include("../admin/check.php");
authenticate("ignore");
 include("../db/opendb.php");

 $property_id = $_GET['id'];

 $q = "SELECT * from property JOIN rental_owner
on property.fk_rental_owner=rental_owner.id
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
 <style type="text/css">
    #map {
        height: 100%;
        width: 100%;
    }
 </style>
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
          <h3 class="card-title">Property Detail</h3>

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
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $row['zip_code'] ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4>Street Address</h4>
                    <div class="post">
                      <div class="user-block">
                        
                        
                       
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <?php echo $row['street_address'] ?>
                      </p>

                      
                    </div>

                    

                    
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              
                <img src="../assets/property_images/<?php echo $row['image'] ?>">
              <br>
             

             
              
            </div>
           
          </div>

        </div>
        <!-- /.card-body --><hr>
         <div class="row" style="height:650px">
          <div class="col-lg-12">

            
              <div  id="map"></div>
                

          </div><!-- /.col -->

        </div><!-- /.row -->
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

<script>
                  var customLabel = {
                      restaurant: {
                          label: 'R'
                      },
                      bar: {
                          label: 'B'
                      }
                  };
                    //Render google map
                  function initMap(){  
                        var point=null;
                      var map = new google.maps.Map(document.getElementById('map'), {
                          center: new google.maps.LatLng(34.1688, 73.2215),
                          zoom: 12
                      });


                      // Change this depending on the name of your PHP or XML file
                      downloadUrl('property_detail_location.php?id=<?php echo $property_id ?>', function(data) {

                          var xml = data.responseXML;
                          var markers = xml.documentElement.getElementsByTagName('marker');
                          Array.prototype.forEach.call(markers, function(markerElem) {
                              var id = markerElem.getAttribute('id');
                              var cordinates_street_address = markerElem.getAttribute('cordinates_street_address');
                               var cordinates_country = markerElem.getAttribute('cordinates_country');
                               var city = markerElem.getAttribute('city');
                               var state = markerElem.getAttribute('state');
                               var owner_name = markerElem.getAttribute('owner_name');
                               var owner_email = markerElem.getAttribute('owner_email');
                               var owner_phone = markerElem.getAttribute('owner_phone');
                                var updated_at = markerElem.getAttribute('updated_at');
                              var latitude = markerElem.getAttribute('lat');
                              var longitude = markerElem.getAttribute('lng');
                                var tittleText="Lease Management System";

                               point = new google.maps.LatLng(
                                  parseFloat(markerElem.getAttribute('lat')),
                                  parseFloat(markerElem.getAttribute('lng')));

                              var infowincontent = document.createElement('div');
                              var strong = document.createElement('strong');
                              strong.textContent = "Name="+name
                              infowincontent.appendChild(strong);
                              infowincontent.appendChild(document.createElement('br'));

                              var text = document.createElement('text');
                              text.textContent = "Address="+cordinates_street_address
                              infowincontent.appendChild(text);
                             
                              var marker = new google.maps.Marker({
                                  map: map,
                                  position: point,
                                  

                              });


                             

                      var contentString =
                    '<div id="content">' +
                    '<div id="siteNotice">' +
                    "</div>" +
                    '<h4 id="firstHeading" class="firstHeading">Lease Management System</h4>' +
                    '<div id="bodyContent">' +
                    '<h6>Address:'+'&nbsp<b>'+cordinates_street_address+'</b></h6>' +
                    '<h6>City:'+'&nbsp<b>'+city+'</b></h6>' +
                     '<h6>State:'+'&nbsp<b>'+state+'</b></h6>' +

                    '<h6>Latitude:'+'&nbsp<b> '+latitude+'</b></h6>' +
                   '<h6>Longitude:'+'&nbsp<b> '+longitude+'</b></h6>' +
                      '<h6>Property Owner:'+'&nbsp<b>'+owner_name+'</b></h6>' +
                      '<h6>Owner Email:'+'&nbsp<b>'+owner_email+'</b></h6>' +
                      '<h6>Owner Phone:'+'&nbsp<b>'+owner_phone+'</b></h6>' +



                       
                    "</div>" +
                  "</div>";
                   
                      var infowindow = new google.maps.InfoWindow({
                        content: contentString
                      });
                                         
                              marker.addListener('mouseover',function()
                              {
                                  infowindow.open(map, marker);
                              });
                               marker.addListener('mouseout',function()
                              {
                                  infowindow.close(map, marker);
                              });


                              


                          });
                      });
                  }





                  function downloadUrl(url, callback) {
                      var request = window.ActiveXObject ?
                          new ActiveXObject('Microsoft.XMLHTTP') :
                          new XMLHttpRequest;

                      request.onreadystatechange = function() {
                          if (request.readyState == 4) {
                              request.onreadystatechange = doNothing;
                              callback(request, request.status);
                          }
                      };

                      request.open('GET', url, true);
                      request.send(null);
                  }

                  function doNothing() {}
              </script>
              <script async defer
                      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGdcSfLwqmDVg_HLbYAJo0qkbElSM5_fc&callback=initMap">
              </script>