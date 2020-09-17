<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

$user_id = $_POST['user_id'];

$sql = "SELECT * FROM wp_woo_wallet_transactions WHERE user_id = '$user_id'" ;

$result = $conn->query($sql);

$user_arr=array(
	"status" => true,
	"message" => "Show wallet amount",
	"data" => mysqli_fetch_all($result, MYSQLI_ASSOC)
);

echo json_encode($user_arr);

?>