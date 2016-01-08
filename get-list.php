<?php 

	require_once("config/DBConnection.php");

	$db = new DBConnection();
	$conn = $db->connect();

	
	$tblName = $_GET['tableName'];

	$sqlSelect = "SELECT * FROM $tblName";

	$result = $conn->query($sqlSelect);

	$itemList = array();

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_object()) {
			$itemList[] = $row;
		}
	}
	$response = array(
		'status'  => "Ok",
		'param'   => array(
			'tableName' => $tblName,
			),
		'items' => $itemList
	);
	echo json_encode($response);
	$conn->close();
die;