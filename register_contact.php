
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
		 FROM student
		ORDER BY lname ";

       // execute the query
       $results1 = mysqli_query($dbc, $query1); 
       
					
					// count the number of rows that will be selected from the table 
$numrow1 = $results1->num_rows;	

if ($_SERVER['REQUEST_METHOD'] == 'POST') // This handles the form
    { 
        // This states a requirement for a database connection
        //require (MYSQL);

        // This will Trim away the white-space of all the incoming data
        $trimmed = array_map('trim', $_POST);

        // This will assume invalid values
        $p1 = $p2 = $pt = $pe = $rel = $student_id = FALSE;

        
        // This will check for a first name
        if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['parent_fname'])) 
            {
                $p1 = mysqli_real_escape_string ($dbc, $trimmed['parent_fname']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter parent first name!</p></div>';
            }

        // This will check for a last name
        if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['parent_lname']))
            {
                $p2 = mysqli_real_escape_string ($dbc, $trimmed['parent_lname']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter parent last name!</p></div>';
            }

        // This will check for a ID number
        if (preg_match ('/^[\+0-9\-\(\)\s]*$/', $trimmed['parent_tel']))
            {
                $pt = mysqli_real_escape_string ($dbc, $trimmed['parent_tel']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter Telephone Number!</p></div>';
            }
			
			 // This will check for an email address
        if (filter_var($trimmed['email']))
            {
                $pe = mysqli_real_escape_string ($dbc, $trimmed['email']);
            } 
        else    
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter a valid email address!</p></div>';
            }
			
			}

?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 scheme2"> 
                    <div class="formbox_register clearfix text-center">
                    <h1>Add Contact Info</h1> 
                    <p>All fields must be completed to add the course.</p>
                    <p>Please Note: Resources for each Student can be added once the contact has been created.</p>
						<form name ="student_id"  action="addcontacttoDB.php" method="get">
					<select method="get" name="student_id" required>
							<optgroup label="Select Student" value="0" ><option>  <!-- =====blanked first option ====== -->	
					

<!--------------------------------------------------------------------------- -->

		
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
										echo $student_id." >> ".$fname." ".$lname;
										echo "</option>";
										echo  "<br />";	
												
										// Volunteer display loop for each row of data, put the values into an array called $row1
										$count1 = $count1 + 1;
									}	
							?>
							</optgroup>
							</select>
									<br />
									<br />
									<input type="hidden" name="student_id" value=<?php echo $student_id; 
									?> >
		
		<!--  ### do same hidden input fields for session and date fields to put into attend table  -->

		
									<input type="radio" name="relationship" value="1P"> Parent 	
									<input type="radio" name="relationship" value="2G"> Guardian 
									
								<!--	</form> 
								
								<input type="submit" value="Submit" name="button">	-->
								<br />	
								<br />
							
			<div class="form-group form-group-sm">
               <input type="text" name="parent_fname" placeholder="First Name" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['parent_fname'])) echo $trimmed['parent_fname']; ?>" />
            </div>
             <div class="form-group form-group-sm">
               <input type="text" name="parent_lname" placeholder="Last Name" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['parent_lname'])) echo $trimmed['parent_lname']; ?>" />
            </div>
			<div class="form-group form-group-sm">
              <input type="text" name="parent_tel" placeholder="parent_tel" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['parent_tel'])) echo $trimmed['parent_tel']; ?>" />
            </div>
			  <div class="form-group form-group-sm">
               <input type="email" name="email" placeholder="Email" class="form-control input-md text-center" id="inputEmail3" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" />
            </div>
            <div class="form-group form-group-lg" align="center">                 
               <button type="submit" name="submit" value="Register" class="btn btn-primary btn-lg btn-block">Register</button>
            </div>
         


				</form>
				</div>
            </div>
        </div>
    </div>


























	<?php include ('includes/footer.html'); ?>