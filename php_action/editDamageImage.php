<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {		

$damageId = $_POST['damageId'];
 
$type = explode('.', $_FILES['editDamageImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['editDamageImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['editDamageImage']['tmp_name'], $url)) {

				$sql = "UPDATE damage_product SET damage_image = '$url' WHERE damage_id = $Id";				

				if($connect->query($sql) === TRUE) {									
					$valid['success'] = true;
					$valid['messages'] = "Successfully Updated";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while updating product image";
				}
			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST