<?php 
// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'Admin Courses';
include ('includes/admin_header.html'); 

if ($_SESSION['user_level'] == 0) // If the user is not Admin, redirect to the Login page
    {
	ob_end_clean(); // This will delete the buffer
	header("Location: index.html");
	exit(); // This will exit the script
    }

// Welcome the user by name if they are logged in
echo '<h1>All Courses';
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

//This selects the relevant data from the database
require ('mysqli_connect.php');
        $query = "SELECT course_id, course_title FROM course";
		  		  
// execute the query
$results = mysqli_query($dbc, $query) or die(mysqli_error());       
$numrow = mysqli_num_rows($results);
?>
   
<!-- Start Course Info Section -->
    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header scheme2">Course</h2>
                    <p>Below is a list of all Courses. Please select any of the <?php echo $numrow;?> Courses to review all Units. </p>
                     <div class="table-responsive">
                         <table class="table table-hover">
                         <thead>
                             <tr class="btn-primary">
                              <th>Course ID</th>
                              <th>Course Title</th>
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
                                    extract($row);

                                    //This creates the table to pull through the relevant variables and data
                                    echo "<tr>";		

                                    echo "<td>";
                                    echo $course_id;
                                    echo "</td>";

                                    echo "<td>";
                                    echo "<a href='admin_unit.php'>".$course_title."</a>";
                                    echo "</td>";

                                    echo "</tr>";

                                    $count = $count +1;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include ('includes/footer.html'); ?>