<?php 

	require_once("config/DBConnection.php");

	$db = new DBConnection();
	$conn = $db->connect();

	$studId = $_POST['student_id'];
	$firstName = $_POST['first_name'];
	$middleName = $_POST['middle_name'];
	$lastName = $_POST['last_name'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$course = $_POST['course_code'];
	$schoolYear = $_POST['school_year'];
	$semester = $_POST['semester'];
	$yearLevel = $_POST['year_level'];
	$section = $_POST['section'];

	$sqlInsert = "INSERT INTO student(
		student_id, first_name, middle_name, 
		last_name, gender, address)
	VALUES(
		'$studId', '$firstName', '$middleName', '$lastName', '$gender', '$address')";

	if (!$conn->query($sqlInsert)) {
		echo json_encode(
			array(
				'status'  => 'error',
				'message' => 'Error in saving record Student',
				'error'   => mysqli_error($conn)
			)
		);
		die;
	}
	$sqlInsert = "INSERT INTO student_course(
		date_created, student_id, course_code)
	VALUES(
		NOW(), '$studId', '$course')";
	
	if (!$conn->query($sqlInsert)) {
		echo json_encode(
			array(
				'status' => 'error',
				'message' => 'Error in saving record Student Course',
				'error'   => mysqli_error($conn)
			)
		);
		die;
	}
	$sqlInsert = "INSERT INTO student_year(
		student_id, year_level_id, section_id, 
		school_year, semester)
	VALUES(
		'$studId', $yearLevel, $section, $schoolYear, $semester)";

	if (!$conn->query($sqlInsert)) {
		echo json_encode(
			array(
				'status' => 'error',
				'message' => 'Error in saving record Student Year',
				'error'   => mysqli_error($conn),
				'query'   => $sqlInsert
			)
		);
		die;
	}

	echo json_encode(
		array(
			'status' => 'Ok',
			'message' => 'Save Successfull'
		)
	);

	$conn->close();
die;