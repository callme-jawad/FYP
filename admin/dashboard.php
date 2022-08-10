<?php
include("check.php"); 
authenticate("ignore");  //authenticating user
$pageName="Dashboard";
include("../db/opendb.php"); //open database connection
$total=0;
$cleared=0;
$pending=0;
$total=0;
$rejected=0;
$query = "SELECT COUNT(*) as total_lease,(SELECT count(*) from applicant where lease_status=1) as current_lease,(SELECT count(*) from applicant where status=0) as pending_lease,(SELECT count(*) from applicant where status=-1) as rejected_lease from applicant";
$result = $conn->query($query);
foreach($result as $row){
  $total_lease = $row['total_lease'];
  $current_lease = $row['current_lease'];
  $pending_lease = $row['pending_lease'];
  $rejected_lease = $row['rejected_lease'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pageName ?></title>
 <!--  <script src="assets/js/fusioncharts.js"></script> -->
  <!-- Google Font: Source Sans Pro -->
 <!-- Google Font: Source Sans Pro -->
 <?php include("../includes/head.php"); ?>
 <style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
        height: 100%;
        width: 100%;
    }
    /* Optional: Makes the sample page fill the window. */

</style>
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
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"><?php  echo $pageName ?></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
 

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
   
   <!--  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $pageName ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $pageName ?></li>
            </ol>
          </div>
        </div>
      </div>
    </section> -->

    <!-- Main content -->
    <section class="content">
     <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?php echo $total_lease ?></h3>

              <p>Total Lease</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $current_lease ?><sup style="font-size: 20px"></sup></h3>

              <p>Current Lease</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $pending_lease ?></h3>

              <p>Pending Lease</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="list_emp.php?emp=-1" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $rejected_lease ?></h3>

              <p>Rejected Lease</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
        <div class="row mb-2" style="height:650px">
          <div class="col-lg-12">

            
              <div  id="map"></div>
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
                      downloadUrl('property_location_marker.php', function(data) {

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

          </div><!-- /.col -->

        </div><!-- /.row -->
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