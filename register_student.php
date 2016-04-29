<?php 
/*This register.php script is based on Chapter 18 of
PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition).
This page will display the html registration page and process the php request.*/

// This states a requirement to include the config file 
// and the page header, then set the page title.

require ('includes/config.inc.php');
$page_title = 'Register a Student';
include ('includes/admin_header.html');

if ($_SESSION['user_level'] == 1) // If the user is Admin, redirect to the Login page
    {
	ob_end_clean(); // This will delete the buffer
	header("Location: index.html");
	exit(); // This will exit the script
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') // This handles the form
    { 
        // This states a requirement for a database connection
        require (MYSQL);

        // This will Trim away the white-space of all the incoming data
        $trimmed = array_map('trim', $_POST);

        // This will assume invalid values 
        $fn = $ln = $DD =$MM = $YY = $hn = $ad1 = $ad2 = $tw = $pc = $al = FALSE;

		
        // This will check for a student ID number
       // if (preg_match ('/^[1-9][0-9]*$/', $trimmed['student_id']))
           // {
             //   $idn = mysqli_real_escape_string ($dbc, $trimmed['student_id']);
           // }
        //else 
           // {
              //  echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your ID Number!</p></div>';
           // }

        // This will check for a first name
        if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['fname'])) 
            {
                $fn = mysqli_real_escape_string ($dbc, $trimmed['fname']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your first name!</p></div>';
            }

        // This will check for a last name
        if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['lname']))
            {
                $ln = mysqli_real_escape_string ($dbc, $trimmed['lname']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your last name!</p></div>';
            }
		
		// This will check for a DOB /([012]?[1-9]|[12]0|3[01])\/(0?[1-9]|1[012])\/([0-9]{4})/
		
        if (preg_match ('/^[1-9][0-9]*$/', $trimmed['DD']))
            {
                $DD = mysqli_real_escape_string ($dbc, $trimmed['DD']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your Day of Birth!</p></div>';
            }
			
			
			 if (preg_match ('/^[1-9][0-9]*$/', $trimmed['MM']))
            {
                $MM = mysqli_real_escape_string ($dbc, $trimmed['MM']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your Month of Birth!</p></div>';
            }
			
			
			 if (preg_match ('/^[1-9][0-9]*$/', $trimmed['YY']))
            {
                $YY = mysqli_real_escape_string ($dbc, $trimmed['YY']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your Year of Birth!</p></div>';
            }
			
		// This will check for a House Number
		//'/^[A-Z \'.-]{2,40}$/i'('/^[0-9a-z,]+$/i', $cst_value)
        if (preg_match ('/[A-Za-z0-9]+/', $trimmed['house_no']))
            {
                $hn = mysqli_real_escape_string ($dbc, $trimmed['house_no']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your House Number!</p></div>';
            }
		
		// This will check for a Address line 1
        if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['address1']))
            {
                $ad1 = mysqli_real_escape_string ($dbc, $trimmed['address1']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter first line of Address!</p></div>';
            }
		
		// This will check for a Address line 2
        if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['address2']))
            {
                $ad2 = mysqli_real_escape_string ($dbc, $trimmed['address2']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter second line of Address!</p></div>';
            }
			
		// This will check for a Town
        if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['town']))
            {
                $tw = mysqli_real_escape_string ($dbc, $trimmed['town']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter Town!</p></div>';
            }
		
		// This will check for a post code   /^[A-Z \'.-]{2,40}$/i
        if(preg_match("/^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/",$trimmed['postcode']) || preg_match("/^[A-Z]{1,2}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2}$/",$trimmed['postcode']) || preg_match("/^GIR0[A-Z]{2}$/",$trimmed['postcode']))
            	
			{
                $pc = mysqli_real_escape_string ($dbc, $trimmed['postcode']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Postcode!</p></div>';
            }
		
			
		// This will check for any Allergies
        if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['allergies']))
            {
                $al = mysqli_real_escape_string ($dbc, $trimmed['allergies']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter allergies or write None!</p></div>';
            }
				

						$query = "INSERT INTO student (fname, lname, DD, MM, YY, house_no, address1, address2, town, postcode, allergies) VALUES ('".$fn."', '".$ln."', '".$DD."', '".$MM."', '".$YY."', '".$hn."', '".$ad1."', '".$ad2."','".$tw."','".$pc."','".$al."')";
                                 	  
        // execute the query
        $results = mysqli_query($dbc, $query); 
		
      //$numrow = mysqli_num_rows($results);
					
						 if ($fn && $ln && $DD & $MM && $YY && $hn && $ad1 && $ad2 && $tw && $pc && $al)  // Then, IF everything is set correctly
		 
		  {
                                            // This will finish the page
                                            echo '<div class="alert alert-success" role="alert"><p>Record Successful.</p></div>';
											//sleep(5);
                                           // include ('includes/footer.html'); // This will include the HTML footer.
                                            //exit(); // This will stop the page.
											//echo "<script>alert('record entered successful')</script>";
								         } 
										mysqli_close($dbc);

	
										}
	//header("Location: register_student2.php");
//exit; // Location header is set, pointless to send HTML, stop the script
?>

<div class="card2 signin-card clearfix text-left">
<!--This will display the html registration form-->
<div class="textwhite" id="Header"><h3>ACM Register</h3></div>
    <h1 class="textwhite">Registration</h1> 
    <p class="textwhite">Complete all fields for registration.</p>
        <form class="form-group" role="form" action="register_student.php" method="post">
         <!--    <div class="form-group form-group-sm">
               <input type="text" name="student_id" placeholder="Student ID" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['student_id'])) echo $trimmed['student_id']; ?>" />
            </div>--> 
            <div class="form-group form-group-sm">
               <input type="text" name="fname" placeholder="First Name" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['fname'])) echo $trimmed['fname']; ?>" />
            </div>
             <div class="form-group form-group-sm">
               <input type="text" name="lname" placeholder="Last Name" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['lname'])) echo $trimmed['lname']; ?>" />
            </div>
			<div class="form-group form-group-sm">
               <input type="text" name="DD" placeholder="DD" class="form-control input-md text-center" id="inputDD" size="10" maxlength="2" value="<?php if (isset($trimmed['DD'])) echo $trimmed['DD']; ?>" />
			    <input type="text" name="MM" placeholder="MM" class="form-control input-md text-center" id="inputMM" size="10" maxlength="2" value="<?php if (isset($trimmed['MM'])) echo $trimmed['MM']; ?>" />
				 <input type="text" name="YY" placeholder="YYYY" class="form-control input-md text-center" id="inputYY" size="10" maxlength="4" value="<?php if (isset($trimmed['YY'])) echo $trimmed['YY']; ?>" />
            </div>
            
			<div class="form-group form-group-sm">
               <input type="text" name="house_no" placeholder="House_No" class="form-control input-md text-center" id="inputhouse_no" size="30" maxlength="30" value="<?php if (isset($trimmed['house_no'])) echo $trimmed['house_no']; ?>" />
            </div>
			<div class="form-group form-group-sm">
               <input type="text" name="address1" placeholder="Address1" class="form-control input-md text-center" id="inputaddress1" size="30" maxlength="30" value="<?php if (isset($trimmed['address1'])) echo $trimmed['address1']; ?>" />
            </div>
			<div class="form-group form-group-sm">
               <input type="text" name="address2" placeholder="Address2" class="form-control input-md text-center" id="inputaddress2" size="30" maxlength="30" value="<?php if (isset($trimmed['address2'])) echo $trimmed['address2']; ?>" />
            </div>
			 <div class="form-group form-group-sm">
               <input type="text" name="town" placeholder="Town" class="form-control input-md text-center" id="inputtown" size="30" maxlength="60" value="<?php if (isset($trimmed['town'])) echo $trimmed['town']; ?>" />
            </div>
			<div class="form-group form-group-sm">
               <input type="text" name="postcode" placeholder="Postcode ie NR203RE" class="form-control input-md text-center" id="inputpostcode" size="30" maxlength="30" value="<?php if (isset($trimmed['postcode'])) echo $trimmed['postcode']; ?>" />
            </div>	
				<div class="form-group form-group-sm">
               <input type="text" name="allergies" placeholder="Allergies" class="form-control input-md text-center" id="inputallergies" size="30" maxlength="30" value="<?php if (isset($trimmed['allergies'])) echo $trimmed['allergies']; ?>" />
            </div>
                  
               <div class="form-group form-group-sm">
			   <button type="save" name="save" value="save" class="btn btn-primary btn-lg btn-block" >Save</button>
			    
            </div> 
			
			
				
        </form>             
</div>
<?php include ('includes/footer.html'); ?>