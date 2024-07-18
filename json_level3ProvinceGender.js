 function drawVisualizationLevel3ProvinceGender() {

        // Create the data table.
       
	  
	    data = $.ajax({
         url: "ajax/level3ProvinceGender.php",
         dataType: "json",
		 async: false
        }).responseText;
 
 
		
		 var data = new google.visualization.DataTable(data);
		  var view = new google.visualization.DataView(data);
		 
		 
		
    var formatter = new google.visualization.NumberFormat(
    {pattern: '####'});
formatter.format(data, 4); // Apply formatter to 3rd   column - year
		
	 
	 

        provincePicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'province',
          'options': {
            'filterColumnLabel': 'Province',
           
          }
        }); 
		
	 //Define a column chart to show aggegate data data
         chart = new google.visualization.ChartWrapper({
          'chartType': 'BarChart',
          'containerId': 'chart',
            'options': {
        title: "Level 3 - Province - Gender",
         colors: ['yellow','green'],
		 isStacked:true,
        width: 800,
        height: 600,
		// hAxis:{"Year":"Registrations"},
       
        legend: { position: "top" } },
		 'view': {'columns': [0,3 , 5 ,  { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }]
                      
    }
	    	 })
		
		     // Define a table to show aggregate treatment data
        table = new google.visualization.ChartWrapper({
     'chartType': 'Table',
          'containerId': 'table',
          'options': {
            'title': ['Table 9 - Level 3 Totals by Province and Gender'],
			'showRowNumber':'true',
     // 'width': 800,
     // 'height': 800 
   },
	  'view': {'columns': [0,1,2,3,4,5,6 ]}
        });
        
     

        // Instantiate and draw our chart, passing in some options.
      	
	  
        // Create the dashboard.
        new google.visualization.Dashboard(document.getElementById('dashboard')).
      
			 bind(provincePicker,[table]).
       bind(provincePicker,[chart]).
		   
          // Draw the dashboard
          draw(data);
		}
  