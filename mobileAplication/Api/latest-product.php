<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}


//$sql = "SELECT * FROM wp_wc_product_meta_lookup ORDER BY product_id DESC LIMIT 5" ;

$sql = `SELECT p.*, pm2.meta_value as product_image FROM wp_posts p LEFT JOIN
wp_postmeta pm ON (
pm.post_id = p.id
AND pm.meta_value IS NOT NULL
AND pm.meta_key = '_thumbnail_id'
)
LEFT JOIN wp_postmeta pm2 ON (pm.meta_value = pm2.post_id AND pm2.meta_key = '_wp_attached_file'
AND pm2.meta_value IS NOT NULL) WHERE p.post_status='publish' AND p.post_type='product'
ORDER BY p.ID DESC`;

$result = $conn->query($sql);

$user_arr=array(
	"status" => true,
	"message" => "Show latest products",
	"data" => mysqli_fetch_all($result, MYSQLI_ASSOC)
);

echo json_encode($user_arr);

?>