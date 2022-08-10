<?php
$m_id = $_GET['maintenance_id'];
include("../db/opendb.php");
if($_GET['status']==1){
	$q = "update maintenance set status='Completed' where id = '$m_id'";
	$result = $conn->query($q);
	echo "<script>window.location.href='maintenance.php'</script>";

}else{
	$q = "update maintenance set status='Rejected' where id = '$m_id'";
	$result = $conn->query($q);
	echo "<script>window.location.href='maintenance.php'</script>";
}
?>