function drawVisualizationVolunteerTotalsAll() {
        // Prepare the data
        
      
	  
	     var data = $.ajax({
         url: "http://admin.teacherjohn.org/data/volunteers/json_volunteer_totals_all.php",
         dataType: "json",
		 async: false
        }).responseText;
		
	
	 
      
	
		
		
		 var dt = new google.visualization.DataTable(data);
 		 var view = new google.visualization.DataView(dt);
		 
		     var formatter = new google.visualization.NumberFormat(
    {pattern: '####'});
	
	
 // formatter.format(view,0);

	formatter.format(dt,0);	 
		
		 view.setColumns([0,1,2,3,4 ,5
                       ]);
					   
			  // Define a column chart to show 'Population' data
         graph_volunteer_totals = new google.visualization.ChartWrapper({
          'chartType': 'ColumnChart',
          'containerId': 'chart_volunteer_totals',
          'options': {
            'title': ['Volunteer numbers'],
			'annotations.alwaysOutside':'true',
			'isStacked':true ,
			colors: ['red','blue'],
      //     'width': 360,
      //  'height': 480,
          //  'chartArea': {top: 50, right: 50, bottom: 50}
          },
          // Configure the barchart to use columns year, organisation, nationalityorganisation, nationality, nationalitytotal
		  //  organisation, orgtotal, 
       'view': {'columns': [1,2,3, { calc: "stringify",
                         sourceColumn: 0,
                         type: "string",
                         role: "annotation" }
                            ]}
        });		   
		
		
		  var organisationPicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'organisationall',
          'options': {
            'filterColumnLabel': 'Organisation',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': true
            }
          }
        });
    
		  var yearPicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'yearall',
          'options': {
            'filterColumnLabel': 'Year',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': true
            }
          }
        });
    
		 // Define a table to show 'Population' data
        table_volunteer_totals_all = new google.visualization.ChartWrapper({
     'chartType': 'Table',
          'containerId': 'table_volunteer_totals_all',
          'options': {
            'title': ['Volunteer Numbers'],
			'annotations.alwaysOutside':'true'
         //  'width': 240,
         //   'height': 300,
         //   'chartArea': {top: 50, right: 50, bottom: 50}
          },
          // Configure the table to use all columns, year, organisation, total
        'view': {'columns': [0,1,2,3,4,5]}
        });
        
      
	
	
	  
        // Create the dashboard.
        new google.visualization.Dashboard(document.getElementById('dashboard_volunteer_totals_all')).
		 
		  bind(organisationPicker,table_volunteer_totals_all).
		  bind([organisationPicker,yearPicker],table_volunteer_totals_all).
		  bind([organisationPicker,yearPicker],graph_volunteer_totals).
		
		   
          // Draw the dashboard
          draw(dt);
		  
		  
		  // now do the line graph
		  
		   var data2 = $.ajax({
         url: "http://admin.teacherjohn.org/data/volunteers/json_volunteer_monthly.php",
         dataType: "json",
		 async: false
        }).responseText;
		
		
		 var dt2 = new google.visualization.DataTable(data2);
 		 var view2 = new google.visualization.DataView(dt2);
		 view.setColumns([0,2]);
		 
		    var options = {
       
          title: 'Volunteers per month',
		  hAxis:{title:'Date'},
		  vAxis :{title: 'Number of volunteers'},
		//  trendlines :{0:{color:'red'} },
          
      
        width: 900,
        height: 500
      };

      var chart2 = new google.visualization.ColumnChart(document.getElementById('linechart'));
	  
	   chart2.draw(view2, options);
	   
	   
		
		
	
	}