<?php

require_once 'core.php';

$sql = "SELECT  damage_product.damage_id, damage_product.damage_name, damage_product.brand_id, damage_product.categories_id, damage_product.quantity, damage_product.rate, damage_product.active, damage_product.status, brands.brand_name,categories.categories_name,damage_product.units_damaged from damage_product
		INNER JOIN brands ON damage_product.brand_id= brands.brand_id
		INNER JOIN categories ON damage_product.categories_id = categories.categories_id
		WHERE damage_product.status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {

 // $row = $result->fetch_array();
 $active = "";

 while($row = $result->fetch_array()) {
 	$damageId = $row[0];
 	// active
 	if($row[7] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Available</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editDamageModal" onclick="editDamage('.$damageId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeDamageModalBtn" onclick="removeDamage('.$damageId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

	$brand = $row[9];
	$category = $row[10];
    $unitsdamage= $row[11];
    $imageUrl = substr($row[2], 3);
	$damageImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array(
 		// image
 		$damageImage,
 		// product name
 		$row[1],
 		// rate
 		$row[6],
 		// quantity
 		$row[5],
 		// brand
 		$brand,
 		// category
 		$category,
 		// active
 		$active,
    //exp
    
 		// button
 		$button
 		);
 } // /while

}// if num_rows

$connect->close();

echo json_encode($output);
