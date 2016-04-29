<?php 
/*This register.php script is based on Chapter 18 of
PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition).
This page will display the html registration page and process the php request.*/

// This states a requirement to include the config file 
// and the page header, then set the page title.

require ('includes/config.inc.php');
$page_title = 'Register a User';
include ('includes/admin_header.html');

if ($_SESSION['user_level'] == 0) // If the user is not Admin, redirect to the Login page
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
        $idn = $fn = $ln = $e = $p = FALSE;

        // This will check for a ID number
        if (preg_match ('/^[1-9][0-9]*$/', $trimmed['id_number']))
            {
                $idn = mysqli_real_escape_string ($dbc, $trimmed['id_number']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your ID Number!</p></div>';
            }

        // This will check for a first name
        if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) 
            {
                $fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your first name!</p></div>';
            }

        // This will check for a last name
        if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name']))
            {
                $ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
            }
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter your last name!</p></div>';
            }

        // This will check for an email address
        if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL))
            {
                $e = mysqli_real_escape_string ($dbc, $trimmed['email']);
            } 
        else    
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter a valid email address!</p></div>';
            }

        // This will check for a password and match against the confirmed password
        if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) 
            {
                if ($trimmed['password1'] == $trimmed['password2']) 
                    {
                        $p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
                    } 
                else
                    {
                        echo '<div class="alert alert-danger" role="alert"><p class="error">Your password did not match the confirmed password!</p></div>';
                    }
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter a valid password!</p></div>';
            }

        if ($idn && $fn && $ln && $e && $p)  // Then, IF everything is set correctly
            {
                // This will make sure the email address is available
                $q = "SELECT id_number FROM user WHERE email='$e'";
                $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

                if (mysqli_num_rows($r) == 0)  // IF available
                    {
                        // This will create the activation code
                        $a = md5(uniqid(rand(), true));

                        // This will add the user to the database
                        $q = "INSERT INTO user (id_number, first_name, last_name, email, password, active, registration_date) VALUES ('$idn', '$fn', '$ln', '$e', SHA1('$p'), '$a', NOW() )";
                        $r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

                        if (mysqli_affected_rows($dbc) == 1)
                            { // Then IF it ran correctly

                                // This will send the registration email 
                                /*$body = "Your VLE account has been registered. To activate your account, please click on this link ";
                                $body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
                                mail($trimmed['email'], 'Registration Confirmation', $body, 'From: demo@localhost.com');
                                   */
                                // This will send the registration email 
                                $to = $e;
                                $subject = "Registration Confirmation";
                                $body ="Your VLE account has been registered. To activate your account, please click on this link:\n\n".PHP_EOL;
                                $body .= "http://localhost/All/DWD2/TheVLE/public_html/activate.php?x=" . urlencode($e) . "&y=$a".PHP_EOL;
                                $headers = "From: postmaster@localhost.com"; 

                                    if (mail($to, $subject, $body, $headers)) 
                                        {
                                            // This will finish the page
                                            echo '<div class="alert alert-success" role="alert"><p>A confirmation email has been sent to the address of the user.</p></div>';
                                            include ('includes/footer.html'); // This will include the HTML footer.
                                            exit(); // This will stop the page.
                                        } 
                                   else 
                                       {
                                            echo'<div class="alert alert-danger" role="alert"><p>A confirmation email could not be sent to the address of the user.</p></div>';
                                        }
                                

                            } 
                        else  // ELSE, if it did not run correctly
                            {
                                echo '<div class="alert alert-danger" role="alert"><p class="error">You could not register this user due to a system error. We apologize for any inconvenience.</p></div>';
                            }
                    } 
                else  // ELSE, it will advise the email address is not available
                    {    
                        echo '<div class="alert alert-danger" role="alert"><p class="error">That email address has already been registered. If you have forgotten the password, use the link at right to have the password sent to you.</p></div>';
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
<div class="textwhite" id="Header"><h3>ACM Register</h3></div>
    <h1 class="textwhite">Registration</h1> 
    <p class="textwhite">Complete all fields for registration.</p>
        <form class="form-group" role="form" action="register.php" method="post">
            <div class="form-group form-group-sm">
               <input type="text" name="id_number" placeholder="ID Number" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['id_number'])) echo $trimmed['id_number']; ?>" />
            </div>
            <div class="form-group form-group-sm">
               <input type="text" name="first_name" placeholder="First Name" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" />
            </div>
             <div class="form-group form-group-sm">
               <input type="text" name="last_name" placeholder="Last Name" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" />
            </div>
             <div class="form-group form-group-sm">
               <input type="email" name="email" placeholder="Email" class="form-control input-md text-center" id="inputEmail3" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" />
            </div>
             <div class="form-group form-group-sm">
               <input type="password" name="password1" placeholder="Password" class="form-control input-md text-center" id="inputPassword3" size="30" maxlength="30" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" />
            </div>
             <div class="form-group form-group-sm">
               <input type="password" name="password2" placeholder="Verify Password" class="form-control input-md text-center" id="inputPassword3" size="30" maxlength="30" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" />
           
            </div>
            <div class="form-group form-group-lg" align="center">                 
               <button type="submit" name="submit" value="Register" class="btn btn-primary btn-lg btn-block">Register</button>
            </div>
        </form>             
</div>
<?php include ('includes/footer.html'); ?>