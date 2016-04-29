<?php 
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'ACM Register Home';
include ('includes/header.html');


//This selects the relevant data from the database
require ('mysqli_connect.php');
        $query = "SELECT student.fname, student.lname, parents.student_id, parents.forename, parents.surname, parents.contact_no, ice_contact.ice_forename, ice_contact.ice_surname, ice_contact.ice_tel
                    FROM  parents
					INNER JOIN ice_contact, student
                    ";              	  
 					
        // execute the query
        $results = mysqli_query($dbc, $query) or die(mysqli_error()); 
        $numrow = mysqli_num_rows($results);
?>

<!-- Start Home Page Section -->
    <div>
        <div class="container">
		
            <div class="row">
                <div class="col-lg-12">           
<body>
<br>
<br>
<h2 class="page-header scheme2">Student Contact Details</h2>

 <div class="table-responsive">
                         <table class="table table-hover">
                         <thead>
                             <tr class="btn-primary">
                              <th>Student ID</th>
							  <th>Student Name</th>
                              <th>Forename</th>
							  <th>Surname</th>
							  <th>Contact Tel</th>
							  <th>Emergency Contact Name</th>
							  <th>Emergency Contact Tel</th>
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
                                    echo $student_id;
                                    echo "</td>";
									
									echo "<td>";
                                    echo $fname;
									echo "   ";
									echo $lname;
                                    echo "</td>";

									echo "<td>";
                                    echo $forename;
                                    echo "</td>";
									
									echo "<td>";
                                    echo $surname;
                                    echo "</td>";
									
									echo "<td>";
                                    echo $contact_no;
                                    echo "</td>";
									
									echo "<td>";
                                    echo $ice_forename;
									echo "   ";
									echo $ice_surname;
                                    echo "</td>";
                                    
									echo "<td>";
                                    echo $ice_tel;
                                    echo "</td>";
									
                                    echo "</tr>";

                                    $count = $count +1;
                                }
								
								
								if(isset($_POST['checkbox_attendance']) && $_POST['checkbox_attendance'] == 'Yes') {
								//Store the value of checkbox_attendance (Yes) into the database
								} else {
								//Store 'No' into the database
								}//

?>
                           
                            </tbody>
                        </table>
					</body>
                </div>   
            </div>
        </div>
    </div>

<?php include ('includes/footer.html'); ?>