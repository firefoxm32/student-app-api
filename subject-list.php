<?php 

	require_once("config/DBConnection.php");

	$db = new DBConnection();
	$conn = $db->connect();


	$yearLevelId = $_GET['year_level_id'];
	$courseCode = $_GET['course_code'];


	$sqlSelect = "SELECT * FROM subjects a 
		LEFT JOIN year_levels b 
	ON a.year_level_id = b.year_level_id
		LEFT JOIN course_subjects c
	ON a.subject_code = c.subject_code
		LEFT JOIN course d
	ON c.course_code = d.course_code WHERE a.year_level_id = $yearLevelId AND c.course_code = '".$courseCode."'";
	// echo $sqlSelect;
	$result = $conn->query($sqlSelect);

	$subjects = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_object()) {
			$subjects[] = $row;
		}
	}

	$response = array(
			'status'   => "Ok",
			'param'    => array(
					'yearLevelId' => $yearLevelId,
					'courseCode'  => $courseCode
			),
			'message'  => "",
			'subjects' => $subjects
	);
	echo json_encode($response);

	$conn->close();
die;