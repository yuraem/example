<?php
const CLIENT_TOKEN = 'OTI5Y2FMOTITYTA5YI00ZJBHLWI4MDCTOGY3OTG2OTI5YWFI';
if (isset($_POST['name']) && $_POST['phone'] != '' ) {
	$post = [
		"stream_code" => '8yqy7',
		"client" => [
			'name' => $_POST['name'],
			'phone' => $_POST['phone']
		],
		'sub1' => '?sub1='.$_POST['sub1'],
		'sub2' => '&sub2='.$_POST['sub2'],
		'sub3' => '&sub3='.$_POST['sub3'],
		'sub4' => '&sub4='.$_POST['sub4'],
		'sub5' => '&sub5='.$_POST['sub5'],
	];

	session_start();
	$_SESSION['fbid'] = $_POST['fbid'];

	// отправляем заявку
// 	$ch = curl_init('https://affiliate.drcash.sh/v1/order');
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

// 	curl_setopt( $ch, CURLOPT_HTTPHEADER,
// 	array(
// 		'Content-Type: application/json',
// 		'Authorization: Bearer '.CLIENT_TOKEN
// 		)
// 	);
// 	$response = json_decode(curl_exec($ch));
// 	curl_close($ch);
	header('location: ./thanks/'.$post['sub1'].$post['sub2'].$post['sub3'].$post['sub4'].$post['sub5']);
	exit;
}
