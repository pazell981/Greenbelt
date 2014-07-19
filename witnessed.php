<?php
	session_start();
	include "new-connection.php";

	$user = $_GET["user_id"];
	$incident = $_GET["incident_id"];
	$verify = "SELECT * FROM user_seen_incident WHERE incidents_id=" . $incident;
	$results = fetch_all($verify);
	$error = 0;
	foreach ($results as $result) {
		if($result["users_id"]==$user){
			$error++;
		}
	}
	if($error==0){
		$query = "INSERT INTO user_seen_incident (users_id, incidents_id) VALUES ('" . $user . "', '" . $incident . "')";
		run_mysql_query($query);
	}
	header('location: crime_dashboard.php');
	die();
?>