<!DOCTYPE html >
<!DOCTYPE html>
<html>
	<head>
		<title>Profile</title>
	</head>

	<body>
	<?php

	//required configuration files to connect to RabbitMQ

	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');

	//retrieve the username and password from the login.html
	$username = $_POST["username"];
	$password = $_POST["password"];
	//$password = sha1($password);

	//print the username and password
	//print("this is $username <br>and this is $password");

	//assign $client
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$request = array();
	$request['type'] = "login";
	$request['username'] = $username;
	$request['password'] = $password;
	//$request['message'] = $msg;
	$response = $client->send_request($request);
	//$response = $client->publish($request);

	//assign a payload variable to have the response from the server
	$payload = $response;

	echo $payload["first_name"];
	echo "<br>";
	echo $payload["last_name"];
	echo "<ul>";
	foreach ($payload ["cars"] as $x => $x_value) {
		echo "<br>";
		foreach ($x_value as $y => $y_value) {
			echo "<li> ".$y_value."</li>";

		}

	}
	echo "</ul>";


	/*echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";
	*/

	?>

	</body>
</html>

