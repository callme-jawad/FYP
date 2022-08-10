<?php
	$payment_id = $_GET['payment_id'];
	 include("../db/opendb.php");
	 $q = "delete from payments where id = '".$payment_id."'";
	 $result = $conn->query($q);
	 if($result){
	 	  echo "<script>window.location.href='renter_payments.php'</script>";

	 }
?>