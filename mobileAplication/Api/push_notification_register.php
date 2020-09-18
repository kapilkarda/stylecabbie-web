<?php
$conn = mysqli_connect('localhost','root','Stylecabbie@123#','stylecabbie');
if(!$conn){
	echo'Not connect';
}

if (!$conn) {
echo "Database not connected !";
}

// $id = $_POST['id'];
$user_id = $_POST['user_id'];
$device_token = $_POST['device_token'];
$device_type = $_POST['device_type'];
if(isset($user_id) && isset($device_token) && isset($device_type)){



$sql = "SELECT id, user_id, device_token FROM push_notification_register WHERE device_token='$device_token' " ;
$result = $conn->query($sql);

$message = '';
if ($result->num_rows > 0) {
$user_arr=array(
"status" => false,
"message" => "Device token allready exits"
);
}
else{
$sql = "INSERT INTO push_notification_register (user_id,device_token,device_type) VALUES ('$user_id','$device_token','$device_type')";
$result = $conn->query($sql);

$user_arr=array(
	"status" => true,
	"message" => "Device Token add successfully",
	// "data" => mysqli_fetch_all($result, MYSQLI_ASSOC)
);
}

}else{
	$user_arr=array(
	"status" => false,
	"message" => "Required filed missing.",
	// "data" => mysqli_fetch_all($result, MYSQLI_ASSOC)
);

}

echo json_encode($user_arr);

?>