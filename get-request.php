<?php 

//query
$student_list = array(
	array(
		'ID' => 1001,
		'name' => 'Student #1001'
	),
	array(
		'ID' => 1002,
		'name' => 'Student #1002'
	),
	array(
		'ID' => 1003,
		'name' => 'Student #1003'
	),
	array(
		'ID' => 1004,
		'name' => 'Student #1004'
	),
);

$students = array();

foreach ($student_list as $key => $student) {
	$students[] = array(
		'ID' => $student['ID'],
		'student' => $student['name']
	);
}

$response = array(
  	'status' => 'ok',
  	'message' => 'GET Request',
	'param' => array(
		'name' => $_GET['name'],
		'address' => $_GET['address']
	),
	'students' => $students
 );

echo json_encode(
  $response
);
die;

