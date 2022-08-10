<?php 
	session_start();
	date_default_timezone_set("Europe/London");
	function authenticate($page){
		if (!isset($_SESSION['Tracking_user'])) {
			echo "<script>window.location.href = 'login.php';</script>";
		}

		if ($page != "ignore"){
			if($_SESSION['Tracking_user'][$page] == 0){
			echo "<script>window.location.href = 'unauthorized.php';</script>";
			}
		}
	}

	function validateData($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	
	
	

?>