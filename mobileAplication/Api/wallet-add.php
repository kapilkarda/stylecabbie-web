<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

// $blog_id = $_POST['blog_id'];
$user_id = $_POST['user_id'];
$type = $_POST['type'];
$balance = $_POST['balance'];
$currency = $_POST['currency'];

$sql = "INSERT INTO wp_woo_wallet_transactions(blog_id,user_id,type,balance,currency) VALUES ('1','$user_id','$type','$balance',$currency)";
$result = $conn->query($sql);

$user_arr=array(
	"status" => true,
	"message" => "Balance add successfully",
	"data" => mysqli_fetch_all($result, MYSQLI_ASSOC)
);

echo json_encode($user_arr);

?>