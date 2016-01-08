<?php 

	require_once("config/DBConnection.php");

	$db = new DBConnection();
	$conn = $db->connect();

	$userId = $_GET['user_id'];
	$pass = $_GET['password'];	

	//check connection first before doing query
	$sql = "SELECT * FROM users WHERE user_id = '$userId' AND password = '$pass'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$user = $result->fetch_object();
		$response = array(
			'status' => 'ok',
			'message' => 'Successfully Login!',
			'user' => $user
		);
		echo json_encode($response);
		die;
	}

	echo json_encode(array(
			'status' => 'error',
			'message' => 'Login Failed!'
		)
	);
	$conn->close();	
 ?>