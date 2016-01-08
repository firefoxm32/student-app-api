<?php 

	require_once("config/DBConnection.php");

	$db = new DBConnection();
	$conn = $db->connect();
	$sql = "SELECT * FROM users";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$users = array();
		while ($row = $result->fetch_object()) {
			$users[] = $row;
		}
		$response = array(
			'status' => 'ok',
			'users' => $users,
		);
		echo json_encode($response);
	} else {
		echo json_encode(array(
				'status' => 'ok',
				'message' => 'No result!'
			)
		);
	}

	$conn->close();

 ?>