<?php 

	require_once("config/DBConnection.php");

	$db = new DBConnection();
	$conn = $db->connect();

	$sqlSelect = "SELECT * FROM student a 
		LEFT JOIN student_course b 
	ON a.student_id = b.student_id 
		LEFT JOIN student_year c 
	ON a.student_id = c.student_id
		LEFT JOIN course d
	ON b.course_code = d.course_code
		LEFT JOIN year_levels e
	ON c.year_level_id = e.year_level_id
		LEFT JOIN sections f
	ON c.section_id = f.section_id";

	$result = $conn->query($sqlSelect);

	$itemList = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_object()) {
			$itemList[] = $row;
		}
	}
	$responce = array(
		'status'  => "Ok",
		'message' => "",
		'students'   => $itemList
	);
	echo json_encode($responce);

	$conn->close();
die;