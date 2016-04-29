<?php

require ('mysqli_connect.php');

$host = "localhost";
$user = "root";
$password = "";
$database = "theVLE";

// Copy the variables that the form placed in the URL
// into these eight variables
$aID    = $_GET['availID']; // it will allow the database to generate the auto_increment.
$aday   = $_GET['Relationship'];
$idn    = $_GET['student_id'];



// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
$idn    = substr($vno,0,5);


//Connect to MYSQL
$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_errno)
	{;
		echo "Failed to connect to MYSQL" . $connect->connect_error;
	}
	
// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO parent VALUES	('".$aID."','".$aday."','".$atime."','".$afreq."','".$anote."','".$vno."','".$jno."','".$lno."')";

//execute the query
$results = $connect->query($query);

// jump to the next page
header( 'Location:mgmt_home.php');
?>