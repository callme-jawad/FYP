<?php
//require("phpsqlajax_dbinfo.php");
require("../db/opendb.php");
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a MySQL server



// Select all the rows in the markers table


$id = $_GET['id'];
$query = "SELECT property.propert_id,property.street_address,property.city,property.state,property.lat,property.lng,rental_owner.first_name,rental_owner.last_name,rental_owner.email,rental_owner.phone_no FROM property
 JOIN rental_owner ON property.fk_rental_owner=rental_owner.id where property.propert_id='$id'";

 $result = $conn->query($query);


header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
foreach ($result as $value){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $value['propert_id'] . '" ';
  echo 'cordinates_street_address="' . parseToXML($value['street_address']) . '" ';
   echo 'city="' . parseToXML($value['city']) . '" ';
    echo 'state="' . parseToXML($value['state']) . '" ';
  echo 'lat="' . $value['lat'] . '" ';
  echo 'lng="' . $value['lng'] . '" ';
   echo 'owner_name="' . parseToXML($value['first_name']." ".$value['last_name']) . '" ';
    echo 'owner_email="' . parseToXML($value['email']) . '" ';
     echo 'owner_phone="' . parseToXML($value['phone_no']) . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';

?>