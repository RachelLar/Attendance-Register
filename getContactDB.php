
<?php 
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'ACM Register Home';
include ('includes/header.html');
echo '<h1>Student Contacts</h1>';


//This selects the relevant data from the database
require ('mysqli_connect.php');

$chosenStudent      = $_GET['student_id'];

$chosenStudent    = substr($chosenStudent ,0,5);


$query = "SELECT parent_fname, parent_lname, parent_tel, parent_email, relationship
				FROM parent
				WHERE student_id =  '".$chosenStudent ."'
				";
		
		
		
		// execute the query
       $results = mysqli_query($dbc, $query);
	   
	  $numrow = $results->num_rows;	
	   
	   ?>
<!--------------------------------------------------------------------------- -->
<br>
<form name ="viewContact"  action="getContactDB.php" method="get">
 <div class="table-responsive">
                         <table class="table table-hover">
                         <thead>
                             <tr class="btn-primary">
                              <th>Forename</th>
                              <th>Surname</th>
							  <th>Telephone</th>
							  <th>Email</th>
							  <th>Relationship</th>
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
                                    echo $parent_fname;
                                    echo "</td>";

									echo "<td>";
                                    echo $parent_lname;
                                    echo "</td>";
									
									echo "<td>";
                                    echo $parent_tel;
                                    echo "</td>";
									
									echo "<td>";
                                    echo $parent_email;
                                    echo "</td>";
									
									echo "<td>";
                                    echo $relationship;
                                    echo "</td>";
                                 
								  
							
								  $count = $count +1;
								  
								  
		
					                                  
									
                                    echo "</tr>";

}
                            
								

?>
                          
                            </tbody>
                        </table>
							
					</body>
		
					<?php include ('includes/footer.html'); ?>