<?php 	

require_once 'core.php';

$sql = "SELECT damage_id, damage_name FROM damage_product WHERE status = 1";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);