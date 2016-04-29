<?php 
// This page activates the user's account.
/*This activate.php script is based on Chapter 18 of
PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition),
and is used to carry-out the activate the user account process 
 */

// This states a requirement to include the config file 
// an optional alternative page header, then set the page title.
require ('includes/config.inc.php'); 
$page_title = 'Activate Your Account';
include ('includes/headerlogin.html');

// If $x and $y do not exist or aren't of the proper format, redirect the user
if (isset($_GET['x'], $_GET['y']) 
	&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
	&& (strlen($_GET['y']) == 32 )
	) 
    {
	// This will update the database
	require (MYSQL);
	$q = "UPDATE user SET active=NULL WHERE (email='" . mysqli_real_escape_string($dbc, $_GET['x']) . "' AND active='" . mysqli_real_escape_string($dbc, $_GET['y']) . "') LIMIT 1";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	// This will print a customized message and provide a basic Login Button
	if (mysqli_affected_rows($dbc) == 1) 
            {
		echo '<div class="alert alert-success" role="alert"><h3>Your account is now active. You may now log in.</h3></div>';
                echo '<div class="col-lg-12 text-center" style="padding:5px;"><a href="index.html" title="Login" class="btn btn-primary btn-lg" role="button">Login</a></div>';
            } 
        else 
            {
		echo '<div class="alert alert-danger" role="alert"><p class="error">Your account could not be activated. Please re-check the link or contact the system administrator.</p></div>'; 
            }
	mysqli_close($dbc);
} 
else 
    { // Redirect

	//$url = BASE_URL . 'index.php'; // This will define the URL
	ob_end_clean(); // This will delete the buffer
	header("Location: index.html");
	exit(); // This will exit the script

    } // End of main IF-ELSE.

//include ('includes/footer.html');
?>