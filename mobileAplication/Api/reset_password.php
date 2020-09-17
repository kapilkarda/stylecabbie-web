<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

$userid = $_POST['user_id'];
$oldpass = $_POST['old_pass'];
$new_pass = $_POST['new_pass'];

$ciphering = "AES-128-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$encryption_iv = '1234567891011121'; 
$encryption_key = "GeeksforGeeks"; 
$encryption_old = openssl_encrypt($oldpass, $ciphering, $encryption_key, $options, $encryption_iv);
$encryption_new = openssl_encrypt($new_pass, $ciphering, $encryption_key, $options, $encryption_iv); 

$sql = "SELECT * FROM wp_users WHERE ID='$userid' AND user_pass='$encryption_old'" ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$sql = "UPDATE wp_users SET user_pass='$encryption_new' WHERE ID=$userid";
	if ($conn->query($sql) === TRUE) {
    	$user_arr=array(
			"status" => true,
			"message" => "Password Reset Successfully"
		);
	} else {
	    $user_arr=array(
			"status" => true,
			"message" => "Password Not Reset Successfully"
		);
	}
	
} else {
$user_arr=array(
"status" => false,
"message" => "Old Password Not matched"
);
}

echo json_encode($user_arr);

?>