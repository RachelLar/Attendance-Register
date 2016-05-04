<?php 
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'ACM Register Home';
include ('includes/header.html');


//This selects the relevant data from the database
require ('mysqli_connect.php');

//$attendance_id    = $_GET['attend_id']; // it will allow the database to generate the auto_increment.
$day   = $_GET['day'];
$time   = $_GET['time'];
$student_id   = $_GET['student_id'];
//$slot_id   = $_GET['slot_id'];

// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
$student_id    = substr($student_id,0,5);

// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
//$slot_id	   = substr($slot_id,0,8);

// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO addSessionView (day, time, student_id) VALUES ('".$day."','".$time."',".$student_id.")";
//echo $query;

// execute the query
       $results = mysqli_query($dbc, $query); 
	   
	    if ($day && $time && $student_id)  // Then, IF everything is set correctly
		 
		  {
                                            // This will finish the page
                                            //echo '<div class="alert alert-success" role="alert"><p>Record Successful.</p></div>';
											//sleep(5);
                                           // include ('includes/footer.html'); // This will include the HTML footer.
                                            //exit(); // This will stop the page.
											echo "<script>alert('record entered successful')</script>";
								         } 
										mysqli_close($dbc);

										
// jump to the next page

//$strval= 'Location:registerDB.php?slot_id='.$slot_id;
//echo $strval;
//header( $strval );

	include ('includes/footer.html'); ?>