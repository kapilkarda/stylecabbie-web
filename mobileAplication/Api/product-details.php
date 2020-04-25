<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

$pro_id = $_POST['product_id'];

$sql = "SELECT * FROM wp_wc_product_meta_lookup where product_id = '$pro_id' " ;

$result = $conn->query($sql);

$user_arr=array(
	"status" => true,
	"message" => "Show product details",
	"data" => mysqli_fetch_all($result, MYSQLI_ASSOC)
);

echo json_encode($user_arr);

?>