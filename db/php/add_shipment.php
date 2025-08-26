<?php 
include 'functions.php';
if (get('type') != 1) {
	echo "<script> alert('Access denied. please check again as admin'); window.location.href='../admin.php' </script>";
	exit();
}
if (isset($_POST['add'])) {
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
	$sl ="SELECT id FROM info ORDER BY id DESC LIMIT 1";
	$qr = $db->query($sl);
	$row = $qr->fetch_assoc();
	$generated1 = $row['id']+1239; $generated2 = $row['id']+2112; 
	$generated = $generated1.''.$generated2;
	$tracking_id = "SG".$generated;
	 // Uploading the image
    $filename = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $fileSize = $_FILES['photo']['size'];

    // Get the image extension
    $img_explode = explode('.', $filename);
    $img_ent = end($img_explode);
    $valid_extensions = ['jpg', 'png', 'jpeg', 'gif', 'webp', 'JPG', 'PNG', 'JPEG', 'GIF', 'WEBP'];

    if (in_array($img_ent, $valid_extensions)) {
        if ($fileSize < 50000000) {
            $img = time() . $filename;
            if (move_uploaded_file($tmp_name, "../uploads/" . $img)) {
                // Insert details into database
	$in ="INSERT INTO `info`(`reciever_name`, `package`, `description`, `tracking_id`, `package_type`, `qty`, `weight`, `service_type`, `package_status`, `booking_date`, `arrival_date`, `disperse_address`, `disperse_country`, `delivering_to`, `delivering_country`, `current_destination`, `perc`, `photo`, `status`) VALUES ('$reciever_name', '$package', '$description', '$tracking_id', '$package_type', '$qty', '$weight', '$service_type', '$package_status', '$booking_date', '$arrival_date', '$disperse_address', '$disperse_country', '$delivering_to', '$delivering_country', '$current_destination', '$perc', '$img', '$status')";
	$qr = $db->query($in);
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

}}}
 ?>