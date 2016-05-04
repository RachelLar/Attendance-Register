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
$p1   = $_GET['parent_fname'];
$p2   = $_GET['parent_lname'];
$pt   = $_GET['parent_tel'];
$pe   = $_GET['email'];
$rel   = $_GET['relationship'];
$student_id   = $_GET['student_id'];



// to extract only the volunteerID (five characters), and not considering the name of the volunteer in order to store it into the database
$student_id	   = substr($student_id,0,5);

// set up the query using the values that were passed via the URL from the form
$query = "INSERT INTO parent (student_id, parent_fname, parent_lname, parent_tel, email, relationship) VALUES (".$student_id.",'".$p1."','".$p2."',".$pt.",'".$pe."','".$rel."')";
echo $query;

// execute the query
       $results = mysqli_query($dbc, $query); 
	   echo $query;
	   
	    if ($p1 && $p2 && $pt && $pe && $rel)  // Then, IF everything is set correctly
		 
		  {
                                            // This will finish the page
                                            //echo '<div class="alert alert-success" role="alert"><p>Record Successful.</p></div>';
											//sleep(5);
                                           // include ('includes/footer.html'); // This will include the HTML footer.
                                            //exit(); // This will stop the page.
											echo "<script>alert('record entered successful')</script>";
								         } 
										mysqli_close($dbc);

										


	include ('includes/footer.html'); ?>