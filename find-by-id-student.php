<?php 

	require_once("config/DBConnection.php");

	$db = new DBConnection();
	$conn = $db->connect();

	$student_id = $_GET['student_id'];

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
	ON c.section_id = f.section_id WHERE a.student_id = $student_id";

 	$result = $conn->query($sqlSelect);

 	if ($result->num_rows > 0) {
 		$row = $result->fetch_object();
 	}

 	$responce = array(
		'status'    => "Ok",
		'message'   => "",
		'param'     => $student_id,
		'student'   => $row
	);
	echo json_encode($responce);

	$conn->close();
die;