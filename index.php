<?php # Script 18.5 - index.php
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'Home';
include ('includes/header.html');

// Welcome the user (by name if they are logged in):

echo  "<img src='img/logo.png' width='150' height='150' title='motto' alt='company motto' align='middle'/> <h1>Ashley Cross Montessori Register";


//if (isset($_SESSION['first_name'])) {
	//echo ", {$_SESSION['first_name']}";
//}
echo '</h1>';
?>
<!--<p><img src="img/logo.png" width="150" height="150" title="motto" alt="company motto" /></p>-->
        <!-- Start Club Info Section -->
    <div style="padding:20px;">
	
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
				
                    <h2 class="page-header scheme2">Welcome</h2>
					
                
                    <div class="col-lg-6 scheme2">
                        <p><strong>Our Mission Statement</strong></p>
						<p>	To provide every child with a highly stimulating, caring Montessori environment, within which each child is safe, happy and able to develop at their own pace, to his and her full potential. </p>
                        
                            <strong>Our Core Values</strong>
                         <ul>
                            <li>Love</li>
                            <li>Dedication</li>
                            <li>Understanding</li>
                            <li>Community</li>
                            <li>Authentic Montessori Practice</li>
                        </ul>
                        <p>We are committed to providing every child with a highly stimulating, caring educational environment: an environment within which each child is safe, happy and able to develop at their own pace, to his and her full potential.</p>
							
							<p>Nursery education for most children is their first step outside the family.  Within Shepherd Montessori Schools Ltd, we recognise the importance of this transition.  Together, in partnership with parents, we can lay the foundations for learning, and nurture the development of the child.  Shepherd Montessori Schools Ltd holds dear is its position within the communities we serve, and sees it as a privilege to be there.</p>
							
							<p>The lasting relationships we build with each child, parent and grandparent is the cornerstone to our vision. </p>
                    </div>
                                    <div class="col-lg-6 scheme2">
                        <p><img src="img/school.gif" width="250" height="100" title="motto" alt="company motto" />
							</p>
							<strong>2016 Shepherd Montessori Schools Ltd</strong>
                        <ul>
                                                       
                            <li>Ashley Cross Montessori: 01202 735521</li>
                            <li>Bay Tree Montessori: 01202 525674</li>
                            <li>Townsend Montessori: 01202 391258</li>
                        </ul>
                        <p> Please call us now at Ashley Cross Montessori to have a chat about what we can offer to your child and we can arrange a visit to the setting.   
							<br />
							We look forward to hearing from you..</p>
						
						
						<p><a href="http://www.montessorieducation.co.uk/">Visit our Website</a></p>
						
                            <a href="https://www.facebook.com/solent.subaqua" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
                       
						
                    </div>
                </div>
            </div>
        </div>
    </div>
	

<?php include ('includes/footer.html'); ?>