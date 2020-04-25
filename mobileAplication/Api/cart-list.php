<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}


$sql = "SELECT * FROM wp_woocommerce_sessions" ;

$result = $conn->query($sql);

$user_arr=array(
	"status" => true,
	"message" => "Show Cart List",
	"data" => mysqli_fetch_all($result, MYSQLI_ASSOC)
);

echo json_encode($user_arr);

?>