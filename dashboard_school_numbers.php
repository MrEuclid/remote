<?php 
session_start() ;
include "includes/set_session.php" ;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>
      School numbers dashboard
    </title> <link rel="stylesheet" type="text/css" href="css/andrew_pio-styles.css">
	<link href='http://fonts.googleapis.com/css?family=Khmer' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 
 
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
      google.load('visualization', '1.1', {packages: ['controls']});
    </script>
	 
	 <script type="text/javascript">
	//  google.charts.load('current', {packages: ['gauge']});
      google.load("visualization", "1.1", {packages:["gauge"]});
      google.setOnLoadCallback(drawGauge);
	  google.setOnLoadCallback(drawGauge2);
	  
      function drawGauge() {

   var jsonData =      $.ajax({
         url: "moeys_data_current.php",
         dataType: "json",
		 async: false
        }).responseText;
		
		 var dataall = new google.visualization.DataTable(jsonData);

        var options = {
          width: 300, height: 120,
          redFrom: 1300, redTo: 1500,
		  
		  max:1500,
        };

        var gauge = new google.visualization.Gauge(document.getElementById('gauge'));

        gauge.draw(dataall, options);
	 
	 }
	 
	 
	 function drawGauge2() {

   var jsonData =      $.ajax({
         url: "database_current.php",
         dataType: "json",
		 async: false
        }).responseText;
		
		 var dataall = new google.visualization.DataTable(jsonData);

        var options = {
          width: 300, height: 120,
          redFrom: 1300, redTo: 1500,
		  
		  max:1500,
        };

        var gauge = new google.visualization.Gauge(document.getElementById('gauge2'));

        gauge.draw(dataall, options);
	 
	 }
	 
	 </script>
	 
	 
	 
    <script type="text/javascript">
	
	
      function drawVisualization() {
        // Prepare the data
        
      
	  
	     var data = $.ajax({
         url: "moeys_data2.php",
         dataType: "json",
		 async: false
        }).responseText;
		
		
		var data2 = $.ajax({
         url: "moeys_data2.php",
         dataType: "json",
		 async: false
        }).responseText;
		
		
		
      
      
       yearPicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'controlyear',
          'options': {
            'filterColumnLabel': 'Month',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': true,
			  'sortValues':false
            }
          },
          'state': {'selectedValues': ['2015']}
        });
      
        schoolPicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'controlschool',
          'options': {
            'filterColumnLabel': 'School',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': true
            }
          },
		  'state': {'selectedValues': ['SMC']}
        }); 
		
		
		
		  gradePicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'controlgrade',
          'options': {
            'filterColumnLabel': 'Grade',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': true
            }
          },
		  'state': {'selectedValues': ['G5']}
        });
        
        // Define a column chart to show 'Population' data
         graph = new google.visualization.ChartWrapper({
          'chartType': 'ColumnChart',
          'containerId': 'chart1',
          'options': {
            'title': ['PIO Roll by gender - monthly return to MOEYS ']
         //   'width': 360,
         //   'height': 240,
          //  'chartArea': {top: 50, right: 50, bottom: 50}
          },
          // Configure the barchart to use columns 2 (City) and 3 (Population)
          'view': {'columns': [ 2,3,4,5]}
        });
      
	  
	   // Define a table to show 'Population' data
        table = new google.visualization.ChartWrapper({
          'chartType': 'Table',
          'containerId': 'table1',
          'options': {
            'title': ['PIO Roll by gender'],
          //  'width': 340,
         //   'height': 300,
         //   'chartArea': {top: 50, right: 50, bottom: 50}
          },
          // Configure the barchart to use columns 2 (City) and 3 (Population)
        //  'view': {'columns': [0,1, 2,3,4]}
        });
	  
	
	
	  
        // Create the dashboard.
        new google.visualization.Dashboard(document.getElementById('dashboard')).
          // Configure the controls so that:
          // - the 'Country' selection drives the 'Region' one,
          // - the 'Region' selection drives the 'City' one,
          // - and finally the 'City' output drives the chart
      
          bind(yearPicker, schoolPicker).
		  bind(schoolPicker, gradePicker).
          bind(gradePicker, graph).
		   bind(gradePicker, table).
		   
          // Draw the dashboard
          draw(data);
		  
		  
		  new google.visualization.Dashboard(document.getElementById('dashboardnames')).
          // Configure the controls so that:
          // - the 'Country' selection drives the 'Region' one,
          // - the 'Region' selection drives the 'City' one,
          // - and finally the 'City' output drives the chart
      
          bind(yearPicker, schoolPicker).
		  bind(schoolPicker, gradePicker).
          bind(gradePicker, graph).
		   bind(gradePicker, table).
		  
		   
          // Draw the dashboard
          draw(data);
		 
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
	
	 <script type="text/javascript">
	
	
	
      function drawVisualization2() {
        // Prepare the data
        // monthly totals by school
        
	  
	     var data2 = $.ajax({
         url: "moeys_data_totals.php",
         dataType: "json",
		 async: false
        }).responseText;
		
datePicker2 = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'controldate2',
          'options': {
            'filterColumnLabel': 'Date',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': true,
			  'sortValues': false
            }
          }
          
        });
	
	 schoolPicker2 = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'controlschool2',
          'options': {
            'filterColumnLabel': 'School',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': false
            }
          },
		  'state': {'selectedValues': ['SMC']}
        }); 
		
	
	
     
 
	
      
	  // Table shows monthly totals
        table2 = new google.visualization.ChartWrapper({
          'chartType': 'Table',
          'containerId': 'table2',
          'options': {
            'title': ['PIO numbers'],
			'showRowNumber' : true
          
          },
         
        });
	  
	// chart 
	
	  chart2 = new google.visualization.ChartWrapper({
          'chartType': 'LineChart',
          'containerId': 'chart2',
          'options': {
            'title': ['School numbers MoEYS data'],
			
		//	'height':600,
		// 	'width':600,
			
           vAxis: { 
              title: "Number", 
			
              viewWindowMode:'explicit',
              viewWindow:{
               
                min:0 }
              }
         
          //  'chartArea': {top: 50, right: 50, bottom: 50}
          },
          // F is at the bottom of the stack
		  
         'view': {'columns': [0,2,3,4]}
        });
	
	  
        // Create the dashboard.
        new google.visualization.Dashboard(document.getElementById('dashboard2')).
          // Configure the controls so that:
         
          
     // google.visualization.table exposes a 'page' event.
// google.visualization.events.addListener(table, 'select', selectHandler);



		   bind([schoolPicker2,datePicker2],[table2,chart2]).
		 
		
  
          // Draw the dashboard
          draw(data2);
		  
		   
		   
          // Draw the dashboard
        
		  
      }
      

      google.setOnLoadCallback(drawVisualization2);
	  



	  
	  /*
	  function selectHandler() {
    var selection = chart.getSelection();
    if (selection.length) {
        var pieSliceLabel = data.getValue(selection[0].row, 0);
        window.location.href = 'http://www.google.com?search=' + pieSliceLabel;
    }
}*/
	
	  
    </script>
	
	
	
  </head>
 <body>
 
   <?php

include "includes/connect_db_euclid_pio.php" ;
include "includes/date_data.php" ;
?>
<div id="header">
<div id="pio-title">PIO - Statistics</div> 
	
<?php include "includes/headerlinks.php" ; ?></div>

<br><br>
<div class = "container">
 <div class="col-md-4">
<h3>Current Student Numbers MOEYS - K - G6</h3>

    <div id = "gauge"></div>
    <div id="dashboard">
	
	
	<h3>Current Student Numbers Teacher John - K - G6</h3>

    <div id = "gauge2"></div>
   
	
 <p>Dashboard for school numbers - MOEYS data - Monthly</p>
      <table>
        
            <div id="controlyear"></div>
            <div id="controlschool"></div>
            <div id="controlgrade"></div>
			
          </td>
          
            <div  id="chart1"></div>
            
			 <div  id="table1"></div>
			
			 
          </td>
        </tr>
      </table>
    </div>
	</div> <!-- column -->
	 <div class="col-md-8">
	 <div id="dashboard2">
	 Student search
	 
	 
	 
	 
	 
	 
	<table border = '0'>
	<tr>
	
	<td><a href="http://admin.teacherjohn.org/export_students.php" >Export to Excel</a></td>
	</tr>
	<tr>
	
	
	<td><div id="controldate2"></div></td>
	<td><div id="controlschool2"></div></td>
	<td><div id="controlgrade2"></div></td>
	</tr>	
	</table>		
	 <div  id="chart2"></div>
	 <br><br>
	 <div  id="table2"></div>
	</div> <!-- column -->
	</div> <!-- container -->
  </body>
</html>
