<?php
	session_start();
	include "new-connection.php";

	if(!isset($_POST['secure'])){
		header('location: logoff.php');
	    die();
	}

	$user = $_POST['user_id'];
	$incident = escape_this_string($_POST['name']);
	$date = date("Y-m-d",strtotime($_POST['date']));
	$query = "INSERT INTO incidents (creator_id, name, created_on, updated_on) VALUES ('" . $user . "', '" . $incident . "', '" . $date . "', '". date('Y-m-d H:i:s', time()) . "')";
	run_mysql_query($query);
	header('location: crime_dashboard.php');
	die();
?>