<?php
	session_start();
	include "new-connection.php";

	$incident = $_GET["incident_id"];
	$query = "DELETE FROM incidents WHERE id=" . $incident;

	run_mysql_query($query);
	header('location: crime_dashboard.php');
	die();
?>