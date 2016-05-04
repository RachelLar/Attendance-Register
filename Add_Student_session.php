
<?php 
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'ACM Register Home';
include ('includes/header.html');

if ($_SESSION['user_level'] != 2) // If the user is not Management, redirect to the Login page
    {
	ob_end_clean(); // This will delete the buffer
	header("Location: index.html");
	exit(); // This will exit the script
    }

//This selects the relevant data from the database
require ('mysqli_connect.php');


		// set up the SQL query to retrive slot details
$query2 = "SELECT *
		 FROM student
		ORDER BY fname ";

       // execute the query
       $results2 = mysqli_query($dbc, $query2); 
       
					
					// count the number of rows that will be selected from the table 
$numrow2 = $results2->num_rows;	

?>
 <div class="container">
            <div class="row">
                <div class="col-lg-12 scheme2"> 
                    <div class="formbox_register clearfix text-center">

<div class="textwhite" id="Header"><h3>ACM Register</h3></div>
    <h1 class="textwhite">Add Sessions</h1> 
    <p class="textwhite">Complete all fields for booking of Sessions.</p>
<form name ="takeAttendance"  action="addSessionDB.php" method="get">
					
				

		<select method="get" name="student_id" required>
							<optgroup label="Select student" value="0" ><option>  <!-- =====blanked first option ====== -->	
					

<!--------------------------------------------------------------------------- -->

			<div>
			 <?php
			 
			 
			 
								// Volunteer display loop for each row of data, put the values into an array called $row1
								$count2 = 0;
								while ($count2 < $numrow2) 
									{
									   // pull one record of data out of the $results1 array and copy it to $row1
										$row2 = $results2->fetch_assoc();
											
										// extract the values from the $row1 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row2);
									
										echo "<option>"; 
										echo $student_id." >> ".$fname." ".$lname;
										echo "</option>";
										echo  "<br />";	
												
										// Volunteer display loop for each row of data, put the values into an array called $row1
										$count2 = $count2 + 1;
									}	
							?>
							</optgroup>
						</select>

				<br />
				<br />


											
									<input type="hidden" name="student_id" value=<?php echo $student_id; ?> >
		
		<!--  ### do same hidden input fields for session and date fields to put into attend table  -->

		
									<input type="radio" name="day" value="1MO"> Monday 	
									<input type="radio" name="day" value="2TU"> Tuesday 
									<input type="radio" name="day" value="3WE"> Wednesday 
									<input type="radio" name="day" value="4TH"> Thursday 
									<input type="radio" name="day" value="5FR"> Friday 
								<!--	</form> -->
								<br />
								<br />
								<form name="option" action ="action=<?php echo $_SERVER['PHP_SELF']; ?>" method = "GET"> 
									<select name="time" id="time">
									<option value="">Select One</option>
									<option value="0800">0800</option>
									<option value="1200">1200</option>
									<option value="1300">1300</option>
									</select>
									
									<br />
									<br />
								
							<input type="submit" value="Submit" name="button">		
									
			</form>						
</div>
	</div>





























	<?php include ('includes/footer.html'); ?>