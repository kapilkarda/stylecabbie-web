<?php
$conn = mysqli_connect('localhost','stylecabbie','Style@123#','staging');

if (!$conn) {
echo "Database not connected !";
}

$sql = "SELECT wp_terms.*,wp_term_taxonomy.* FROM wp_terms LEFT JOIN wp_term_taxonomy ON wp_terms.term_id = wp_term_taxonomy.term_id WHERE wp_term_taxonomy.taxonomy = 'product_cat' AND wp_term_taxonomy.parent = 0 AND wp_terms.slug != 'uncategorized'";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

	$term_id=(int)$row['term_id'];

     $sql2 = "SELECT * FROM wp_termmeta WHERE term_id = $term_id and meta_key='thumbnail_id'" ;
     $result2 = $conn->query($sql2);
     $f_res=mysqli_fetch_array($result2);
     $f_meta_value = $f_res['meta_value'];

     $sql3 = "SELECT * FROM wp_posts WHERE ID = $f_meta_value" ;
     $result3 = $conn->query($sql3);
     $f_res3=mysqli_fetch_array($result3);
     $image_url = $f_res3['guid'];

     $data[]= array('category_id' => $term_id,'cat_name' => $row['name'],'cat_image' => $image_url );

}

$user_arr=array(
	"status" => true,
	"message" => "Show category list",
	"data" => $data
	
);

echo json_encode($user_arr);

?>