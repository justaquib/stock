<?php 	

require_once 'core.php';

$damageId = $_POST['damageId'];

$sql = "SELECT damage_id, damage_name, damage_image, brand_id, categories_id, quantity, rate, active, status,units_damaged FROM damage_product WHERE damage_id = $damageId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);