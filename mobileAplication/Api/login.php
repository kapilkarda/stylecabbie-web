<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

$useremail = $_POST['user_email'];
$userpass = $_POST['user_pass'];

$ciphering = "AES-128-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$encryption_iv = '1234567891011121'; 
$encryption_key = "GeeksforGeeks"; 
$encryption = openssl_encrypt($userpass, $ciphering, $encryption_key, $options, $encryption_iv); 

$sql = "SELECT * FROM wp_users WHERE user_email='$useremail' AND user_pass='$encryption'" ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
$user_arr=array(
"token" => base64_encode($useremail),
"status" => true,
"message" => "Login successfully!",
"Data" => mysqli_fetch_assoc($result)
);
} else {
$user_arr=array(
"status" => false,
"message" => "Login failed"
);
}

echo json_encode($user_arr);

?>