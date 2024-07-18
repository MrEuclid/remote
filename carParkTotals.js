function drawVisualizationCarParkTotals() {
        // Prepare the data
        
      
	  
	     var data = $.ajax({
         url: "myDataCarpark.php",
         dataType: "json",
		 async: false
        }).responseText;
		
	
	 
      
	
		
	//	alert(data) ;
		 var dt = new google.visualization.DataTable(data);
 		 var view = new google.visualization.DataView(dt);
		 
		 // alert(dt);

     var table = new google.visualization.ChartWrapper({
    'chartType': 'Table',
    'containerId': 'table_carpark_totals',
    dataTable: data,
    'options': {
        'width': '300px'
    }
});
table.draw();

	
 // formatter.format(view,0);

	


		
	//	 view.setColumns([0,1,2]);
					   
			  // Define a column chart to show 'Population' data
        var graph_carpark_totals = new google.visualization.ChartWrapper({
          'chartType': 'ColumnChart',
          'containerId': 'chart_carpark_totals',
           dataTable: data,
          'options': {
            'title': ['Carpark numbers'],
			'annotations.alwaysOutside':'true',
			'isStacked':false ,
			colors: ['red','blue','green','yellow','pink','brown'],
      //     'width': 360,
      //  'height': 480,
          //  'chartArea': {top: 50, right: 50, bottom: 50}
          },
          // Configure the barchart to use columns year, organisation, nationalityorganisation, nationality, nationalitytotal
		  //  organisation, orgtotal, 
       'view': {'columns': [2,3, { calc: "stringify",
                         sourceColumn: 2,
                         type: "string",
                         role: "annotation" }
                            ]}
        });		   
		
		
		// chart_carpark_totals.draw();
    

    var bar = new google.visualization.ChartWrapper({
          'chartType': 'ColumnChart',
          'containerId': 'chart_carpark_totals',
           dataTable: data,
          'options': {
            'title': ['Carpark numbers'],
      'annotations.alwaysOutside':'true',
      'isStacked':false ,
      colors: ['red','blue','green','yellow','pink','brown'],
      //     'width': 360,
      //  'height': 480,
          //  'chartArea': {top: 50, right: 50, bottom: 50}
          },
          // Configure the barchart to use columns year, organisation, nationalityorganisation, nationality, nationalitytotal
      //  organisation, orgtotal, 
       'view': {'columns': [2,1, { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }
                            ]}
        });      
bar.draw();
	   
		
		
	
	}