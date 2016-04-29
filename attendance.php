<?php 
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'ACM Register Home';
include ('includes/header.html');


//This selects the relevant data from the database
require ('mysqli_connect.php');
        
		$query = "SELECT student_id, fname, lname 
                    FROM  student"; 
					
        // execute the query
        $results = mysqli_query($dbc, $query) or die(mysqli_error(x)); 
        $numrow = mysqli_num_rows($results);
		
			

// set up the SQL query to retrive slot details
$query2 = "SELECT *
		  FROM slot
		  ORDER BY day, time ";

       // execute the query
        $results2 = mysqli_query($dbc, $query2); 
       
// count the number of rows that will be selected from the table 
$numrow2 = $results2->num_rows;



?>

<!-- Start Home Page Section -->
    <div>
        <div class="container">
		
                  <div class="row">
                <div class="col-lg-12">     

			<strong>Please select Slot to take Attendance</strong>
					<select name="_idslot" required>
							<optgroup label="Select Slot" value="0" ><option>  <!-- =====blanked first option ====== -->	
					

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
										echo $slot_id." >> ".$day." ".$time;
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
<!--------------------------------------------------------------------------- -->
<br>
 <div class="table-responsive">
                         <table class="table table-hover">
                         <thead>
                             <tr class="btn-primary">
                              <th>Student ID</th>
                              <th>Forename</th>
							  <th>Surname</th>
							  <th>Attendance</th>
							  <th>Reason</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php                
                            //This will count each row of data, put the values into an array called $row
                            $count = 0;
                            while ($count < $numrow)
                                {	
                                    // Pull one record of data out of the $results array
                                    $row = $results->fetch_assoc();
                                    extract ($row);

                                    //This creates the table to pull through the relevant variables and data
                                    echo "<tr>";		

                                    echo "<td>";
                                    echo $student_id;
                                    echo "</td>";

									echo "<td>";
                                    echo $fname;
                                    echo "</td>";
									
									echo "<td>";
                                    echo $lname;
                                    echo "</td>";
									
									//echo "<td style='text-align:center'>";
                                   // Hide checkbox before at value 0 
									//echo "<input type='hidden' name='checkbox_attendance' value='0'>";
									//Then if user clicks present a 1 will be logged in the database
									//echo "<input type='checkbox' class='form' value='1' name='checkbox_attendance'
									//align='center'</input>";
									//echo "</td>";
									//<input type="submit" value="Submit" name="button"> 
									
                                  echo "<td>";
								  
							
								  $count = $count +1;
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  ?>
								  
								  
								  
								  
		
								
								
								
							
									<form name="radio" action="attendance.php" method="POST"> 
											
									<input type="hidden" name="student_id" value=<?php echo $student_id; ?> >
		
		<!--  ### do same hidden input fields for session and date fields to put into attend table  -->

		
									<input type="radio" name="attendance" value="P"> Present 	
									<input type="radio" name="attendance" value="A"> Absent 
									<input type="radio" name="attendance" value="L"> Late 
								<!--	</form> -->
								<?php
								
								
								
								
										
		
									echo "</td>";
									
									
                                    echo "<td>";
									?>
							
								<!--	<form name="option" action ="action=<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">  -->
									<select name="reason" id="reason">
									<option value="">Select One</option>
									<option value="SIK">SCK</option>
									<option value="HOL">HOL</option>
									<option value="OTH">OTH</option>
									</select>
									
									<input type="submit" value="Submit" name="button">
									
									</form>
									
									
									<?php
									echo "</td>";                                    
									
                                    echo "</tr>";

                                    
                            
								
}
?>
                          
                            </tbody>
                        </table>
					</body>
					<?php
					//$student_id   = $_GET['student_id'];
					$slot_id      = $_GET['slot_id'];
					$arrival      = $_GET['arrival'];
					$attendance   = $_GET['attendance'];
					$reason		   = $_GET['reason'];
					
					
					
					$slot_id    = substr($slot_id,0,8);
					
					
					    // This will add the user to the database
                        $q = "INSERT INTO attend VALUES ('$student_id' , '$slot_id', '$arrival', '$attendance', '$reason')";
						//echo $q. "<br>";
                        $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

                      //  if (mysqli_affected_rows($dbc) == 1)
                          //  { // Then IF it ran correctly
							//WHERE student_id = . $results2 .;

                            // echo'<div class="alert alert-success" role="alert"><p>Record Updated Successfully.</p></div>';
                           //  }
                                

            
            
        //mysqli_close($dbc);
    // This will end of the main Submit conditional.
?>	
					
								
									
                </div>   
            </div>
        </div>
    </div>

<?php include ('includes/footer.html'); ?>