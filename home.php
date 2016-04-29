<?php 
// This is the main page for the Admin User.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'ACM Home';
include ('includes/header.html');

// Welcome the user by name if they are logged in
echo '<h1>Welcome';
if (!isset($_SESSION['first_name'])) 
    {//If the Session isn't set and therefore not logged in
	ob_end_clean(); // This will delete the buffer
	header("Location: index.html");// This returns the user to the Login page
	exit(); // This will exit the script
    }
else 
    {
        echo ", {$_SESSION['first_name']}";
    }
echo '!</h1>';
?>
 
<div>
    <?php
	// Display links based upon the login status:
	if (isset($_SESSION['first_name'])) 
            {
                    {
                        echo '<h1>Staff Dashboard</h1><br />';
                        echo '<div class="col-md-12 text-center">';
                        //echo '<div class="btn-group" role="group">';
                        echo '<div class="col-lg-3" style="padding:5px;"><a href="attendancetest.php" title="Take Attendance" class="btn btn-primary btn-lg" role="button">Take Attendance</a></div>';
                        echo '<div class="col-lg-3" style="padding:5px;"><a href="absent.php" title="Absence" class="btn btn-primary btn-lg" role="button">Absence Tracking</a></div>';
						echo '<div class="col-lg-3" style="padding:5px;"><a href="view_contacts.php" title="Contact" class="btn btn-primary btn-lg" role="button">Contact Details</a></div>';
                        echo '<div class="col-lg-3" style="padding:5px;"><a href="index.php" title="Home" class="btn btn-primary btn-lg" role="button">Home</a></div>';
						echo '<div class="col-lg-3" style="padding:5px;"><a href="calendar.php" title="calendar" class="btn btn-primary btn-lg" role="button">Calendar</a></div>';
						echo '<div class="col-lg-3" style="padding:5px;"><a href="upload_rtf.php" title="upload" class="btn btn-primary btn-lg" role="button">Upload</a></div>';
                    }	
            } 
        else 
    ?>
</div>
<?php include ('includes/footer.html'); ?>