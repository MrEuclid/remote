
<html>
<head>
<title>Carpark totals</title>
<head>
    <link rel="stylesheet" href="css/dentalStyles.css">
  <link href='http://fonts.googleapis.com/css?family=Khmer' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
  
      google.load('visualization', '1.1', {packages: ['controls']});
 
  //  google.charts.load('current', {packages: ['gauge']});
      google.load("visualization", "1.1", {packages:["gauge"]});
    </script>
    </script>
	<!--
   <script type="text/javascript" src = "http://admin.teacherjohn.org/ajax/volunteers/volunteer_totals.js"></script>
	<script type="text/javascript" src = "http://admin.teacherjohn.org/ajax/dashboard_volunteers.js"></script>
	<script type="text/javascript" src = "http://admin.teacherjohn.org/ajax/volunteer_charts.js"></script>
	-->
	
	<!-- load volunteer dashboard  -->
		
	
	 <script src ="carParkTotals.js"></script>
	 <script type="text/javascript">
     
	   google.setOnLoadCallback(drawVisualizationCarParkTotals);
	    
    </script>     

  
	
</head>
  <body>
  


<div class = "container">
	<div class = "row">
<div class = "col-sm-12">
<h1>Welcome to the PIO Carpark App</h1>
<h3>Find the carpark which still has a space for your car.</h3>
	</div>

 
  <div id="dashboard_carpark_totals">

 <div class="col-sm-6">
  
	<h4>Table for Carparks</a> </h4>
	
	
	<div id = "table_carpark_totals"></div>
	</div> <!-- col -->
	<div class="col-sm-6">
	<h4>Chart for Carparks </a> </h4>
	 <div id = "chart_carpark_totals"></div>
	
	</div>
 
   </div> <!-- dashboard -->
   </div> <!-- container -->

  </body>
</html>