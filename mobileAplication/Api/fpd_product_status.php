<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

$pro_id = $_POST['product_id'];

$sql = "SELECT * FROM wp_postmeta where post_id = '$pro_id' and meta_key='fpd_products' and meta_value!=''" ;

$result = $conn->query($sql);
if(mysqli_fetch_array($result)){
	$status=true;
}else{
	$status=false;
}

$user_arr=array(
	"fpd_product_status" => $status
);

echo json_encode($user_arr);

?>