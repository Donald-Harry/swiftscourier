<?php 
error_reporting(E_ALL);



include 'functions.php';
if (get('type') != 1) {
	echo "<script> alert('Access denied. please check again as admin'); window.location.href='../admin.php' </script>";
	exit();
}
if (isset($_POST['update'])) {
	$reciever_name = sanitize($_POST['reciever_name']);
	$package = sanitize($_POST['package']);
	$description = sanitize($_POST['description']);
	$tracking_id = sanitize($_POST['tracking_id']);
	$package_type = sanitize($_POST['package_type']);
	$qty = sanitize($_POST['qty']);
	$weight = sanitize($_POST['weight']);
	$service_type = sanitize($_POST['service_type']);
	$package_status = sanitize($_POST['package_status']);
	$booking_date = sanitize($_POST['booking_date']);
	$arrival_date = sanitize($_POST['arrival_date']);
	$disperse_address = sanitize($_POST['disperse_address']);
	$disperse_country = sanitize($_POST['disperse_country']);
	$delivering_to = sanitize($_POST['delivering_to']);
	$delivering_country = sanitize($_POST['delivering_country']);
	$current_destination = sanitize($_POST['current_destination']);
	$perc = sanitize($_POST['perc']);
	$status = sanitize($_POST['status']);
	$sta_arr = array('DELETED'=>'0','UNDO'=>'1','PENDING'=>'1','SHIP'=>'2','DELIVERED'=>'3');
	$status = $sta_arr[$status];


	
	$up = "UPDATE `info` SET `reciever_name`='$reciever_name',`package`='$package',`description`='$description',`package_type`='$package_type',`qty`='$qty',`weight`='$weight',`service_type`='$service_type',`package_status`='$package_status',`booking_date`='$booking_date',`arrival_date`='$arrival_date',`disperse_address`='$disperse_address',`disperse_country`='$disperse_country',`delivering_to`='$delivering_to',`delivering_country`='$delivering_country',`current_destination`='$current_destination', `perc`='$perc', `status`='$status' WHERE `tracking_id`='$tracking_id'";
	$qr = $db->query($up);
	if ($qr) {
		echo "<script> alert('Successful.'); window.location.href='../admin.php' </script>";
		exit();
	}else{
		echo "<script> alert('An error occoured.'); window.location.href='../admin.php' </script>";
		exit();
	}
}else{
	echo "<script> alert('Unauthorised access.'); window.location.href='../admin.php' </script>";
	exit();
}


 ?> 