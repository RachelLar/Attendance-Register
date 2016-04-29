
<?php 
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'ACM Register Home';
include ('includes/header.html');


//This selects the relevant data from the database
require ('mysqli_connect.php');

		// set up the SQL query to retrive slot details
$query1 = "SELECT *
		 FROM slot
		ORDER BY day, time ";

       // execute the query
       $results1 = mysqli_query($dbc, $query1); 
       
					
					// count the number of rows that will be selected from the table 
$numrow1 = $results1->num_rows;	


		// set up the SQL query to retrive slot details
$query2 = "SELECT *
		 FROM student
		ORDER BY fname ";

       // execute the query
       $results2 = mysqli_query($dbc, $query2); 
       
					
					// count the number of rows that will be selected from the table 
$numrow2 = $results2->num_rows;	

?>
<form name ="takeAttendance"  action="addAttendanceDB.php" method="get">
					<select method="get" name="slot_id" required>
							<optgroup label="Select Slot" value="0" ><option>  <!-- =====blanked first option ====== -->	
					

<!--------------------------------------------------------------------------- -->

			<div>
			 <?php
			 
			 
			 
								// Volunteer display loop for each row of data, put the values into an array called $row1
								$count1 = 0;
								while ($count1 < $numrow1) 
									{
									   // pull one record of data out of the $results1 array and copy it to $row1
										$row1 = $results1->fetch_assoc();
											
										// extract the values from the $row1 array, and copy them into variables that
										// have the same names as the field names in the table
										extract ($row1);
									
										echo "<option>"; 
										echo $slot_id." >> ".$day." ".$time;
										echo "</option>";
										echo  "<br />";	
												
										// Volunteer display loop for each row of data, put the values into an array called $row1
										$count1 = $count1 + 1;
									}	
							?>
							</optgroup>
							</select>

</div>

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

</div>


											
									<input type="hidden" name="student_id" value=<?php echo $student_id; ?> >
		
		<!--  ### do same hidden input fields for session and date fields to put into attend table  -->

		
									<input type="radio" name="attendance" value="P"> Present 	
									<input type="radio" name="attendance" value="A"> Absent 
									<input type="radio" name="attendance" value="L"> Late 
								<!--	</form> -->
								
								<form name="option" action ="action=<?php echo $_SERVER['PHP_SELF']; ?>" method = "GET"> 
									<select name="reason" id="reason">
									<option value="">Select One</option>
									<option value="SIK">SCK</option>
									<option value="HOL">HOL</option>
									<option value="OTH">OTH</option>
									</select>
									
								
							<input type="submit" value="Submit" name="button">		
									
			</form>						































	<?php include ('includes/footer.html'); ?>