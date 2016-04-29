<?php 
/*This upload_resource.php script is based on Chapter 11 of
PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition).
This page will display the html registration page and process the php request.*/

// This states a requirement to include the config file 
// and the page header, then set the page title.

require ('includes/config.inc.php');
$page_title = 'Upload a Resource';
include ('includes/admin_header.html');

if ($_SESSION['user_level'] != 2) // If the user is not Managemnt, redirect to the Login page
    {
	ob_end_clean(); // This will delete the buffer
	header("Location: index.html");
	exit(); // This will exit the script
    }

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
	// Check for an uploaded file:
	if (isset($_FILES['upload'])) 
            {		
		// Validate the type. This example allows for
                //JPEG, PNG, GIF, Plain and RTF Text formats, PDF and most Microsoft type applications
		$allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png', 'image/gif', 'text/rtf', 'text/plain', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/x-excel', 'application/x-msexcel', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/pdf'); 
		if (in_array($_FILES['upload']['type'], $allowed)) 
                    {		
			// Move the file over.
			if (move_uploaded_file ($_FILES['upload']['tmp_name'], "resources/{$_FILES['upload']['name']}")) 
                            {
                                echo '<div class="alert alert-danger" role="alert"><p>The file has been uploaded!</p></div>';
                                $thefile = $_FILES['upload']['name'];  
                                $reslink = $thefile;
                            } // End of move... IF.		
                    } 
                else 
                    { // Invalid type.
			echo '<div class="alert alert-danger" role="alert"><p class="error">Please upload a JPEG or PNG image.</p></div>';
                    }

	} // End of isset($_FILES['upload']) IF.
	
	// Check for an error
	if ($_FILES['upload']['error'] > 0) {
		echo '<div class="alert alert-danger" role="alert"><p class="error">The file could not be uploaded because: <strong>';
	
		// Print a message based upon the error.
		switch ($_FILES['upload']['error']) {
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini.';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
				break;
			case 3:
				print 'The file was only partially uploaded.';
				break;
			case 4:
				print 'No file was uploaded.';
				break;
			case 6:
				print 'No temporary folder was available.';
				break;
			case 7:
				print 'Unable to write to the disk.';
				break;
			case 8:
				print 'File upload stopped.';
				break;
			default:
				print 'A system error occurred.';
				break;
		} // End of switch.
		
		print '</strong></p></div>';
	
	} // End of error IF.
	
	// Delete the file if it still exists:
	if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) 
            {
		unlink ($_FILES['upload']['tmp_name']);
            }			
} // End of the submitted conditional.


if ($_SERVER['REQUEST_METHOD'] == 'POST') // This handles the form
    { 
        // This states a requirement for a database connection
        require (MYSQL);

        // This will Trim away the white-space of all the incoming data
        $trimmed = array_map('trim', $_POST);

        // This will assume invalid values
        $sid = $resti = $resinf = FALSE;

        // This will check for a Topic ID number
        if (preg_match ('/^[1-9][0-9]*$/', $trimmed['student_student_id']))
            {
                $sid = mysqli_real_escape_string  ($dbc, $trimmed['student_student_id']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic ID Number!</p></div>';
            }

        // This will check for a Resource Title
        if (preg_match ('/^[a-zA-Z0-9-._ ]+$/', $trimmed['resource_title'])) 
            {
                $resti = mysqli_real_escape_string ($dbc, $trimmed['resource_title']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Resource Title!</p></div>';
            }

        // This will check for any Resource Info
	if (preg_match ('/^[a-zA-Z0-9-._ ]+$/', $trimmed['resource_info'])) 
            {
		$resinf = mysqli_real_escape_string ($dbc, $trimmed['resource_info']);
        $resinf= strip_tags($resinf);
		     } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Resource Information!</p></div>';
             }  
        
        // Then, IF everything is set correctly            
        if ($resti && $resinf && $sid)  
            {
                // This will make sure the resource title is available
                $q = "SELECT resource_id FROM resource WHERE resource_title='$resti'";
                $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

                if (mysqli_num_rows($r) == 0)  // IF available
                    {                      
                        // This will add the resource to the database
                        $q = "INSERT INTO resource (resource_title, resource_info, student_student_id, resource_link) VALUES ('$resti', '$resinf', '$sid', '$reslink' )";  // '<a href=".../resources/'.$reslink.'" target= "blank">.$reslink.</a>' )";
                        $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

                        if (mysqli_affected_rows($dbc) == 1)
                            { // Then IF it ran correctly

                                // This will finish the page
                                echo '<div class="alert alert-success" role="alert"><p>Your resource was added to the database.</p></div>';
                                include ('includes/footer.html'); // This will include the HTML footer.
                                exit(); // This will stop the page.
                            } 
                        else  // ELSE, if it did not run correctly
                            {
                                echo '<div class="alert alert-danger" role="alert"><p class="error">You could not save the link to the database due to a system error. We apologize for any inconvenience.</p></div>';
                            }
                    } 
                else  // ELSE, it will advise the email address is not available
                    {    
                        echo '<div class="alert alert-success" role="alert"><p class="error">That title is already in use. Please select another</p></div>';
                    }
             }
        else  // ELSE, if one of the data tests failed it will advise to try again
            {   
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please try again.</p></div>';
            }

        mysqli_close($dbc);

    } // This will end of the main Submit conditional.
?>

<div class="card signin-card clearfix text-center">
<!--This will display the html registration form-->
    <div class="textwhite" id="Header">ACM Register</div>
    <h1 class="textwhite">Upload Resource</h1> 
    <p class="textwhite">Select a file of 1MB or smaller.</p>
        <form class="form-group" role="form" enctype="multipart/form-data" action="upload_resource.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <div class="form-group form-group-sm">
               <input type="text" name="student_student_id" placeholder="Exact student ID Number" class="form-control input-md  text-center" id="inputTopicId" size="30" maxlength="30" value="<?php if (isset($trimmed['student_student_id'])) echo $trimmed['student_student_id']; ?>" />
            </div>
            <div class="form-group form-group-sm">
               <input type="text" name="resource_title" placeholder="Resource Title" class="form-control input-md  text-center" id="inputResTitle" size="30" maxlength="30" value="<?php if (isset($trimmed['resource_title'])) echo $trimmed['resource_title']; ?>" />
            </div>        
            <div class="form-group form-group-sm">
                <textarea rows="2" cols="30" name="resource_info" placeholder="Resource Information" class="form-control input-md  text-center" id="inputResInfo"></textarea>
            </div>
            <div class="form-group form-group-lg" align="center">                 
               <input type="file" name="upload" value="Upload" class="form-control input-md btn btn-danger text-center">
               <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block">Submit</button>
            </div>
        </form>             
</div>
<?php include ('includes/footer.html'); ?>