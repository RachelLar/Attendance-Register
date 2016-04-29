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
$query2 = "SELECT *
		 FROM student
		ORDER BY lname ";

       // execute the query
       $results2 = mysqli_query($dbc, $query2); 
       
					
					// count the number of rows that will be selected from the table 
$numrow2 = $results2->num_rows;	



?>

<!-- Start Home Page Section -->
    <div>
        <div class="container">
		<form name ="chosenStudent"  action="getContactDB.php" method="get">
		
                  <div class="row">
                <div class="col-lg-12">     

			<strong>Please Select Student to View Contact</strong>
					<select method="get" name="student_id" required>
							<optgroup label="Select Student" value="0" ><option>  <!-- =====blanked first option ====== -->	
					

<!--------------------------------------------------------------------------- -->

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
							<button = id="sendform"> <!-- ===== sending form ============-->					
								<input type="Submit" Value="SUBMIT"></input>
							</button>
			</form>
<br />
<br />


								
									
                </div>   
            </div>
        </div>
    </div>

<?php include ('includes/footer.html'); ?>