<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

$cust_id = $_POST['customer_id'];

$sql = "SELECT * FROM wp_wc_order_stats where customer_id = '$cust_id' " ;

$result = $conn->query($sql);

$user_arr=array(
	"status" => true,
	"message" => "Show order history",
	"data" => mysqli_fetch_all($result, MYSQLI_ASSOC)
);

echo json_encode($user_arr);

?>