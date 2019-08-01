<?php 

require_once 'core.php';

if($_POST) {

	$startDate1 = $_POST['startDate1'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate1);
	$start_date1 = $date->format("Y-m-d");


	$endDate1 = $_POST['endDate1'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate1);
	$end_date1 = $format->format("Y-m-d");

	$sql = "SELECT * FROM product WHERE exp >= '$start_date1' AND exp <= '$end_date1' and order_status = 1";
	$query = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Expiry Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		$totalAmount = "0";
		while ($result = $query) {
			$table .= '<tr>
				<td><center>'.$result['exp'].'</center></td>
				<td><center>'.$result['brand_id'].'</center></td>
				<td><center>'.$result['quantity'].'</center></td>
				<td><center>'.$result['rate'].'</center></td>
			</tr>';	
			$totalAmount += $result['grand_total'];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Total Amount</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	

	echo $table;

}

?>