<?php
	$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');
	if (!$conn) {
		echo "Database not connected !";
	}

	if($_GET['method']=="1"){
		$user_id = $_POST['user_id'];
		$session_data_db = $_POST['mobile_session_data'];
		$session_data =json_decode($session_data_db);


		$prod_id = $session_data[0]->session_data->product_id;
		$qty = $session_data[0]->session_data->quantity;
		if($session_data[0]->session_data->variation_id!=0){
			$clr = $session_data[1]->session_data->variation->attribute_pa_color;
			$size = $session_data[1]->session_data->variation->attribute_pa_size;
		}else{
			$clr = "";
			$size = "";
		}
		
		$is_custom = "1";

		$sql = "INSERT INTO `wp_iqonic_add_to_cart`(`user_id`, `pro_id`, `quantity`, `color`, `size`, `is_custom`, `session_data`)
							VALUES ('$user_id', '$prod_id', '$qty', '$clr', '$size', '$is_custom', '$session_data_db')";
		$result = $conn->query($sql);
		if($result){
			$status=true;
		}else{
			$status=false;
		}
		$user_arr=array(
			"inserted" => $status
		);
		echo json_encode($user_arr);
	}

	if($_GET['method']=="2"){
		$user_id = $_POST['user_id'];
		$sql = "SELECT * from `cus_mobile_cart_session` where user_id='$user_id'";
		$result = $conn->query($sql);
		if($row = mysqli_fetch_assoc($result)){
			$cartData=$row;
			$status = true;
		}else{
			$cartData=[];
			$status = false;
		}
		$user_arr=array(
			"state" => $status,
			"cartData" => $cartData,
		);
		echo json_encode($user_arr);
	}

	if($_GET['method']=="3"){
		$user_id = $_POST['user_id'];
		$sql = "Delete from `cus_mobile_cart_session` where user_id='$user_id'";
		$result = $conn->query($sql);
		if($result){
			$status=true;
		}else{
			$status=false;
		}
		$user_arr=array(
			"deleted" => $status
		);
		echo json_encode($user_arr);
	}

?>