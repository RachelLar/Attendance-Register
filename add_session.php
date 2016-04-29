<?php 
/*This register.php script is based on Chapter 18 of
PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (4th Edition).
This page will display the html registration page and process the php request.*/

// This states a requirement to include the config file.
require ('includes/config.inc.php');
$page_title = 'Add a Session';
include ('includes/admin_header.html');
 
if ($_SESSION['user_level'] != 2) // If the user is not Management, redirect to the Login page
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
	//$ct && $ut1 && $tt1u1 && $td1u1 && $tt2u1 && $td2u1 && $tt3u1 && $td3u1 && $ut2 && $tt1u2 && $td1u2 && $tt2u2 && $td2u2 && $tt3u2 && $td3u2 && $ut3 && $tt1u3 && $td1u3 && $tt2u3 && $td2u3 && $tt3u3 && $td3u3 = FALSE;
	
    // This will check for a session 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['session_code'])) 
            {
		$ct = mysqli_real_escape_string ($dbc, $trimmed['session_code']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Course Title!</p></div>';
            }    
 
    // This will check for the first unit title 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['unit_title_1'])) 
            {
		$ut1 = mysqli_real_escape_string ($dbc, $trimmed['unit_title_1']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the First Unit Title!</p></div>';
            }    
  
    // This will check for the topic 1 title of unit 1
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_1u1'])) 
            {
		$tt1u1 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_1u1']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 1 title of Unit 1!</p></div>';
            } 

    // This will check for the topic 1 description of unit 1 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_1u1'])) 
            {
		$td1u1 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_1u1']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 1 description of Unit 1!</p></div>';
            } 

    // This will check for the topic 2 title of unit 1 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_2u1'])) 
            {
		$tt2u1 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_2u1']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 2 title of Unit 1!</p></div>';
            } 

    // This will check for the topic 2 description of unit 1 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_2u1'])) 
            {
		$td2u1 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_2u1']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 2 description of Unit 1!</p></div>';
            } 

    // This will check for the topic 3 title of unit 1 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_3u1'])) 
            {
		$tt3u1 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_3u1']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 3 title of Unit 1!</p></div>';
            } 

    // This will check for the topic 3 description of unit 1 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_3u1'])) 
            {
		$td3u1 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_3u1']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 3 description of Unit 1!</p></div>';
            } 
			 
 
 
 //------------------
     // This will check for the second unit title 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['unit_title_2'])) 
            {
		$ut2 = mysqli_real_escape_string ($dbc, $trimmed['unit_title_2']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Second Unit Title!</p></div>';
            }  
			
    // This will check for the topic 1 title of unit 2
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_1u2'])) 
            {
		$tt1u2 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_1u2']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 1 title of Unit 2!</p></div>';
            } 

    // This will check for the topic 1 description of unit 2
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_1u2'])) 
            {
		$td1u2 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_1u2']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 1 description of Unit 2!</p></div>';
            } 

    // This will check for the topic 2 title of unit 2 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_2u2'])) 
            {
		$tt2u2 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_2u2']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 2 title of Unit 2!</p></div>';
            } 

    // This will check for the topic 2 description of unit 2 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_2u2'])) 
            {
		$td2u2 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_2u2']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 2 description of Unit 2!</p></div>';
            } 

    // This will check for the topic 3 title of unit 2 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_3u2'])) 
            {
		$tt3u2 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_3u2']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 3 title of Unit 2!</p></div>';
            } 

    // This will check for the topic 3 description of unit 1 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_3u2'])) 
            {
		$td3u2 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_3u2']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 3 description of Unit 2!</p></div>';
            } 
			  						
//-----------------			
    // This will check for the third unit title 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['unit_title_3'])) 
            {
		$ut3 = mysqli_real_escape_string ($dbc, $trimmed['unit_title_3']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Third Unit Title!</p></div>';
            }  	

    // This will check for the topic 1 title of unit 3
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_1u3'])) 
            {
		$tt1u3 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_1u3']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 1 title of Unit 3!</p></div>';
            } 

    // This will check for the topic 1 description of unit 3 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_1u3'])) 
            {
		$td1u3 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_1u3']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 1 description of Unit 3!</p></div>';
            } 

    // This will check for the topic 2 title of unit 3
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_2u3'])) 
            {
		$tt2u3 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_2u3']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 2 title of Unit 3!</p></div>';
            } 

    // This will check for the topic 2 description of unit 3 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_2u3'])) 
            {
		$td2u3 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_2u3']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 2 description of Unit 3!</p></div>';
            } 

    // This will check for the topic 3 title of unit 3 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_title_3u3'])) 
            {
		$tt3u3 = mysqli_real_escape_string ($dbc, $trimmed['topic_title_3u3']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 3 title of Unit 3!</p></div>';
            } 

    // This will check for the topic 3 description of unit 3 
	if (preg_match ('/^[a-zA-Z0-9-_. ]+$/', $trimmed['topic_description_3u3'])) 
            {
		$td3u3 = mysqli_real_escape_string ($dbc, $trimmed['topic_description_3u3']);
            } 
        else 
            {
                echo '<div class="alert alert-danger" role="alert"><p class="error">Please enter the Topic 3 description of Unit 3!</p></div>';
            } 
			 
 //---------------------------------------------           
	
	if ($ct && $ut1 && $tt1u1 && $td1u1 && $tt2u1 && $td2u1 && $tt3u1 && $td3u1 && $ut2 && $tt1u2 && $td1u2 && $tt2u2 && $td2u2 && $tt3u2 && $td3u2 && $ut3 && $tt1u3 && $td1u3 && $tt2u3 && $td2u3 && $tt3u3 && $td3u3) 
            { // Then, IF everything is set correctly

		// This will make sure the email address is available
		$q = "SELECT course_id FROM course WHERE course_title='$ct'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) 
                    { // IF available.
                        // This will set up the query using the values that were passed via the URL from the form
                        // This uses prepared statements to improve security			
                        $query1 = $dbc->prepare("INSERT INTO course (course_title) VALUES ( ? )");
                        // This will bind the variables to the statement
                        $query1->bind_param('s', $ct);
                        // This will execute the statement
                        $query1->execute( );
//--------------------------------------------------------------------------------
                        // This will store the last value of LAST_INSERT_ID() for the Course ID here
                        $queryLCID = $dbc->prepare( "SELECT LAST_INSERT_ID()" );
                        $queryLCID->execute();
                        $result = $queryLCID->get_result();
                        $resultarray = $result->fetch_assoc();
                        $lastcid = $resultarray['LAST_INSERT_ID()'];
                        //echo( '<p>Last CID</p>');
                        //echo ($lastcid);
                        //print_r( $lastcid);                                            
//--------------------------------------------------------------------------------
                        // This will Prepare Query Two - Inserting into the unit row, the first unit_title, and the course_course_id)
                        $query2 = $dbc->prepare("INSERT INTO unit (unit_title, course_course_id) VALUES ( ?, ? )" );
                        // This will bind the variables to the statement
                        $query2->bind_param('si', $ut1, $lastcid);
                        // This will execute the statement
                        $query2->execute( ); 
//----------------------------------------------------------------------------------
                        // This will store the last value of LAST_INSERT_ID() for the Unit ID here
                        $queryLUID1 = $dbc->prepare( "SELECT LAST_INSERT_ID()" );
                        $queryLUID1->execute();
                        $result = $queryLUID1->get_result();
                        $resultarray = $result->fetch_assoc();
                        $lastuid1 = $resultarray['LAST_INSERT_ID()'];
			//echo( '<p>Last UID1</p>');
                        //echo( $lastuid1 );
                        //print_r( $lastuid1);
//----------------------------------------------------------------------------------
                        // This will Prepare Query Three - Inserting into the first topic row, the topic_title, the topic_description, and the unit_unit_id
                        $query3 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query3->bind_param('ssi', $tt1u1, $td1u1, $lastuid1);
                        // This will execute the statement
                        $query3->execute( ); 			
 //---------------------------------------------------------------------
                        // This will Prepare Query Four - Inserting into the second topic table for the unit, the topic_title, the topic_description, and the unit_unit_id
                        $query4 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query4->bind_param('ssi', $tt2u1, $td2u1, $lastuid1);
                        // This will execute the statement
                        $query4->execute( ); 
//---------------------------------------------------------------------                     
                        // This will Prepare Query Three - Inserting into the third topic table for the unit, the topic_title, the topic_description, and the unit_unit_id
                        $query5 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query5->bind_param('ssi', $tt3u1, $td3u1, $lastuid1);
                        // This will execute the statement
                        $query5->execute( );						
//----------Add Second Unit/Topic info--------------------------------------------				
                        // This will Prepare Query Two - Inserting into the second unit table, the unit_title, and the course_course_id)
                        $query6 = $dbc->prepare("INSERT INTO unit (unit_title, course_course_id) VALUES ( ?, ? )" );
                        // This will bind the variables to the statement
                        $query6->bind_param('si', $ut2, $lastcid);
                        // This will execute the statement
                        $query6->execute( ); 
//--------------------------------------------------------------------------------
                         // This will store the last value of LAST_INSERT_ID() for the Unit ID here
                        $queryLUID2 = $dbc->prepare( "SELECT LAST_INSERT_ID()" );
                        $queryLUID2->execute();
                        $result = $queryLUID2->get_result();
                        $resultarray = $result->fetch_assoc();
                        $lastuid2 = $resultarray['LAST_INSERT_ID()'];  
                	//echo( '<p>Last UID2</p>');
                        //echo( $lastuid2 );
                        //print_r( $lastuid2);                                                                                              
//--------------------------------------------------------------------------------
                        // This will Prepare Query Three - Inserting into the first topic table, the topic_title, the topic_description, and the unit_unit_id
                        $query7 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query7->bind_param('ssi', $tt1u2, $td1u2, $lastuid2);
                        // This will execute the statement
                        $query7->execute( ); 
//--------------------------------------------------------------------------------                        
                        // This will Prepare Query Four - Inserting into the second topic table for the unit, the topic_title, the topic_description, and the unit_unit_id
                        $query8 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query8->bind_param('ssi', $tt2u2, $td2u2, $lastuid2);
                        // This will execute the statement
                        $query8->execute( );
//--------------------------------------------------------------------------------                    
                        // This will Prepare Query Nine - Inserting into the third topic table for the unit, the topic_title, the topic_description, and the unit_unit_id
                        $query9 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query9->bind_param('ssi', $tt3u2, $td3u2, $lastuid2);
                        // This will execute the statement
                        $query9->execute( );				
//----------Add Third Unit/Topic info---------------------------------------------				
                        // This will Prepare Query Two - Inserting into the third unit table, the unit_title, and the course_course_id)
                        $query10 = $dbc->prepare("INSERT INTO unit (unit_title, course_course_id) VALUES ( ?, ? )" );
                        // This will bind the variables to the statement
                        $query10->bind_param('si', $ut3, $lastcid);
                        // This will execute the statement
                        $query10->execute( ); 
//--------------------------------------------------------------------------------                      
                        // This will store the last value of LAST_INSERT_ID() for the Unit ID here
                        $queryLUID3 = $dbc->prepare( "SELECT LAST_INSERT_ID()" );
                        $queryLUID3->execute();
                        $result = $queryLUID3->get_result();
                        $resultarray = $result->fetch_assoc();
                        $lastuid3 = $resultarray['LAST_INSERT_ID()'];                        
                        //echo( '<p>Last UID3</p>');
                        //echo( $lastuid3 );
                        //print_r( $lastuid3);	                                                
//--------------------------------------------------------------------------------
                        // This will Prepare Query Three - Inserting into the first topic table, the topic_title, the topic_description, and the unit_unit_id
                        $query11 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query11->bind_param('ssi', $tt1u3, $td1u3, $lastuid3);
                        // This will execute the statement
                        $query11->execute( ); 
//--------------------------------------------------------------------------------                                                                
                        // This will Prepare Query Four - Inserting into the second topic table for the unit, the topic_title, the topic_description, and the unit_unit_id
                        $query12 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query12->bind_param('ssi', $tt2u3, $td2u3, $lastuid3);
                        // This will execute the statement
                        $query12->execute( ); 
//--------------------------------------------------------------------------------                    
                        // This will Prepare Query Three - Inserting into the third topic table for the unit, the topic_title, the topic_description, and the unit_unit_id
                        $query13 = $dbc->prepare("INSERT INTO topic (topic_title, topic_description, unit_unit_id) VALUES ( ?, ?, ? )");
                        // This will bind the variables to the statement
                        $query13->bind_param('ssi', $tt3u3, $td3u3, $lastuid3);
                        // This will execute the statement
                        $query13->execute( );						
//----------End Add Unit/Topic info-----------------------------------------------
                        
			if (mysqli_affected_rows($dbc) >= 1)  // If it ran OK.
                            {
                                // This will finish the page
                                echo '<div class="alert alert-success" role="alert"><h3>The Course and its Units and Topics have been added.</h3></div>';
                                include ('includes/footer.html'); // Include the HTML footer.
                                exit(); // Stop the page.
                            } 
                        else 
                            { // ELSE, if it did not run correctly
				echo '<div class="alert alert-danger" role="alert"><p class="error">The Course and its Units and Topics could not be added due to a system error. We apologize for any inconvenience.</p></div>';
                            }			
                    } 
                    else 
                        { //  ELSE, it will advise the email address is not available
                            echo '<div class="alert alert-danger" role="alert"><p class="error">That Course name has already been used.</p></div>';
                        }		
	} 
        else 
            { // ELSE, if one of the data tests failed it will advise to try again
		echo '<div class="alert alert-danger" role="alert"><p class="error">Please try again.</p></div>';
            }

	mysqli_close($dbc);

    } // End
?>

<div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 scheme2"> 
                    <div class="formbox_register clearfix text-center">
                    <h1>Add a Course</h1> 
                    <p>All fields must be completed to add the course.</p>
                    <p>Please Note: Resources for each Topic can be added once the Topic has been created.</p>
                    <hr>
                        <form class="form-group" role="form" action="add_course.php" method="post">
                            <div class ="col-lg-12">
                                <h3>The Course</h3>
                                <div class="form-group form-group-md">
                                   <input type="text" name="course_title" placeholder="Course Title" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['course_title'])) echo $trimmed['course_title']; ?>" />
                                </div>							
                            </div>

                            <div class="col-lg-4">
                                <h3>First Unit</h3>
                                    <div class="form-group form-group-sm">
                                       <input type="text" name="unit_title_1" placeholder="Unit Title 1" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['unit_title_1'])) echo $trimmed['unit_title_1']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_1u1" placeholder="Topic Title 1 - 1" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_1u1'])) echo $trimmed['topic_title_1u1']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_1u1" placeholder="Topic Description 1 - 1" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_2u1" placeholder="Topic Title 2 - 1" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_2u1'])) echo $trimmed['topic_title_2u1']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_2u1" placeholder="Topic Description 2 - 1" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div>
                                    <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_3u1" placeholder="Topic Title 3 - 1" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_3u1'])) echo $trimmed['topic_title_3u1']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_3u1" placeholder="Topic Description 3 - 1" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div><hr>
                                    </div>

                                    <div class="col-lg-4">
                                        <h3>Second Unit</h3>
                                    <div class="form-group form-group-sm">
                                       <input type="text" name="unit_title_2" placeholder="Unit Title 2" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['unit_title_2'])) echo $trimmed['unit_title_2']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_1u2" placeholder="Topic Title 1 - 2" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_1u2'])) echo $trimmed['topic_title_1u2']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_1u2" placeholder="Topic Description 1 - 2" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_2u2" placeholder="Topic Title 2 - 2" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_2u2'])) echo $trimmed['topic_title_2u2']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_2u2" placeholder="Topic Description 2 - 2" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div>
                                    <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_3u2" placeholder="Topic Title 3 - 2" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_3u2'])) echo $trimmed['topic_title_3u2']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_3u2" placeholder="Topic Description 3 - 2" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div><hr>                                
                                    </div>

                                    <div class="col-lg-4">
                                        <h3>Third Unit</h3>
                                    <div class="form-group form-group-sm">
                                       <input type="text" name="unit_title_3" placeholder="Unit Title 3" class="form-control input-md  text-center" id="inputName" size="30" maxlength="30" value="<?php if (isset($trimmed['unit_title_3'])) echo $trimmed['unit_title_3']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_1u3" placeholder="Topic Title 1 - 3" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_1u3'])) echo $trimmed['topic_title_1u3']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_1u3" placeholder="Topic Description 1 - 3" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_2u3" placeholder="Topic Title 2 - 3" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_2u3'])) echo $trimmed['topic_title_2u3']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_2u3" placeholder="Topic Description 2 - 3" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div>
                                    <div class="form-group form-group-sm">
                                       <input type="text" name="topic_title_3u3" placeholder="Topic Title 3 - 3" class="form-control input-md text-center" id="inputName" size="30" maxlength="40" value="<?php if (isset($trimmed['topic_title_3u3'])) echo $trimmed['topic_title_3u3']; ?>" />
                                    </div>
                                     <div class="form-group form-group-sm">
                                       <textarea rows="2" cols="30" name="topic_description_3u3" placeholder="Topic Description 3 - 3" class="form-control input-md text-center" id="inputName" size="30" maxlength="60"></textarea>
                                    </div><hr>
                                    </div>
                                <div class="col-lg-12">
                                    <h3>Please check all information carefully before submitting</h3>
                                    <br />     
                                    <div class="form-group form-group-lg" align="center">                 
                                       <button type="submit" name="submit" value="Register" class="btn btn-primary btn-lg btn-block">Add Course</button>
                                    </div>                                
                                </div>                 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include ('includes/footer.html'); ?>
