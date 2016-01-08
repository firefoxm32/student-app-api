<?php 


echo json_encode(
  array(
  	'status' => 'ok',
  	'message' => 'POST Request',
	'param' => array(
		'name' => $_POST['name'],
		'address' => $_POST['address']
	)

  )
);

die;