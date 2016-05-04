<?php 
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'ACM Register Home';
include ('includes/header.html');


//This selects the relevant data from the database
require ('mysqli_connect.php');

        $query = "SELECT arrival, departure 
                    FROM  attend
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
				<head>
				 <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>

					</body>
                </div>   
            </div>
        </div>
    </div>

<?php include ('includes/footer.html'); ?>