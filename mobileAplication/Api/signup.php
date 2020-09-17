<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

$username=$_POST['user_login'];
$userpass=$_POST['user_pass'];
$useremail=$_POST['user_email'];
 
$ciphering = "AES-128-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$encryption_iv = '1234567891011121'; 
$encryption_key = "GeeksforGeeks"; 
$encryption = openssl_encrypt($userpass, $ciphering, $encryption_key, $options, $encryption_iv); 

$sql = "SELECT id, user_email,user_pass FROM wp_users WHERE user_email='$useremail' " ;
$result = $conn->query($sql);

$message = '';
if ($result->num_rows > 0) {
$user_arr=array(
"status" => false,
"message" => "User allready exits"
);
}
else{
$sql = "INSERT INTO wp_users(user_login, user_pass, user_email) VALUES ('$username','$encryption','$useremail')";
$result = $conn->query($sql);
$user_arr=array(
"status" => true,
"message" => "New record created successfully"
);
}

echo json_encode($user_arr);
?>