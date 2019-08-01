<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

  $damageName 		= $_POST['damageName'];
  // $damageImage 	= $_POST['damageImage'];
  $rate 					= $_POST['rate'];
  $quantity 			= $_POST['quantity'];    
  $brandName			= $_POST['brandName'];
  $categoryName 	= $_POST['categoryName'];
  $unitsdamaged 	= $_POST['unitsDamaged'];
  $damageStatus		  =	$_POST['damageStatus'];

	$type = explode('.', $_FILES['damageImage']['name']);
	$type = $type[count($type)-1];
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['damageImage']['tmp_name'])) {
			if(move_uploaded_file($_FILES['damageImage']['tmp_name'], $url)) {

				$sql = "INSERT INTO `damage_product` (`damage_name`, `damage_image`, `brand_id`, `categories_id`, `quantity`, `rate`,`units_damaged`,'active','status')
				VALUES ('$damageName', '$url', '$brandName', '$categoryName', '$quantity', '$rate','$unitsdamaged','$damageStatus', 1,)";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

			}	else {
				return false;
			}	// /else
		} // if
	} // if in_array

	$connect->close();

	echo json_encode($valid);

} // /if $_POST
