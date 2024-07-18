 <?php 

include "includes/mySession.php" ;
include "connectDatabase.php" ;
?>

<!DOCTYPE html>

<html>

  <head>
  <meta charset="utf-8">

    <title>Level 2 - Summary treatments Province </title>
  
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

<script type="text/javascript" src = "ajax/json_level2SummaryTreatmentsProvince.js"></script>

 
 <script type="text/javascript">
      // Load the Visualization API and the piechart package.
     

      // Set a callback to run when the Google Visualization API is loaded.
	 
      google.setOnLoadCallback(drawVisualizationLevel2SummaryTreatmentsProvince);
   
	  
     </script>
	 
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	 <link rel="stylesheet" type="text/css" href="css/dentalStyles.css">
	<style>
	#centred-text { text-align: center ;
    position:absolute;
top:50px;
left:auto ;
right:auto;
width:60%;}
	</style>
  </head>
  <body>

<div id = "header">
 


</div>  <!-- header -->   

<div id = "dashboard">
 <div class = "container-fluid">

   <div class = "row">

<div class="col-md-12 c">
  <h2><a href = "dashboardDental.php">Home</a></h2>
<h1 class = "c">Dental reports</h1>
<h2>Level 2 - Summary Treatments Province  - <?php echo $message ; ?>
<a href = "export_level_2_data.php">
<img src = "images/excel.jpg" alt = "Click to download data for analysis in Excel"/>
</a>

<a href = "view_level_2_SummaryTreatmentProvince_data.php" title = "Summary - Province Gender", target = "_blank">
View output on screen
</a>
</h2> 
</div></div>
 
 <div class = "row">

<div class="col-md-12 c">
<h3>Level 2 - Province and Gender</h3>

<div id = "province"></div>

<div id = "table">
  
</div></div>


<div class = "row">
<div class="col-md-12 c">

<div id = "chart"></div>



</div> <!-- column -->
</div>  <!--row -->




</div> <!-- container -->
</div> <!-- dashboard -->


  </body>



</html>
