<?php

$_POST['temperature'] = '';
$_POST['pulse_rate'] = '';
$_POST['vibrations'] = '';
$_POST['timestamp'] = '';

//extract data from the post
//set POST variables
$url = 'https://mdm-hackathon.herokuapp.com/api';

$fields = array(
	'temperature' => urlencode($_POST['temperature']),
	'pulse_rate' => urlencode($_POST['pulse_rate']),
	'vibrations' => urlencode($_POST['vibrations']),
	'timestamp' => urlencode($_POST['timestamp'])
);

$fields_string = '';

//url-ify the data for the POST
foreach ($fields as $key => $value) {
	$fields_string .= $key .'=' . $value . '&';
}
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);
