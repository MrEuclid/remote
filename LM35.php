<?php $studentID  = $_GET["studentID"]; ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="//dweet.io/client/dweet.io.min.js"></script>
  
  <script src="https://cdn.plot.ly/plotly-2.27.0.min.js" charset="utf-8"></script>

    <style>

    .c {
        margin:auto; 
        text-align: center;
        }
    
    button {
                margin:2em; 
                width:6em;
                height:4em; 
                font-weight: bold; 
                color:orange; 
                background-color: black;
            }

    #redLED {background-color: red;}
    #yellowLED {background-color: yellow;}
    #greenLED {background-color: green;}

    </style>
</head>
<body>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
     <h1 class = "c">Remote Monitoring LM35</h1>
            </div></div>
  <div class="row">
  <div class="col-sm-12">
    <label>Time</label>
  <button id = "time">0</button>
  <label>Temp</label>
  <button id = "temp">0</button>
  <label>Max</label>
  <button id = "max">0</button>
  <label>Min</label>
  <button id = "min">0</button> 
  <label>Mean</label>
  <button id = "avg">0</button>
  <label>Count</label>
  <button id = "cnt">0</button>
   <label>Download</label>
   <a href = "downloadLM35.php?thing=<?echo $studentID; ?>">
  <button id = "download">Download</button>
    </a>
  </div></div>

        <div class="row">
          <div class="col-sm-12">
            <p id = "message"></p>
      </div></div>
      <div id = "myChart"></div>

<script type="text/javascript">

function lineGraph(xData,yData)
{
       TESTER2 = document.getElementById('myGraph');
       var layout = {
    title: 'Room temperature',
    xaxis: {type: "string",title:'Time'},
    yaxis:{title:"Temperature",range: [20, 40]},
    showlegend: false
};
    var trace1 = {
        x: xData,
        y: yData,
        type: 'scatter'
};

var dataGraph = [trace1];

Plotly.newPlot('myChart', dataGraph,layout);
}
</script>

<script type="text/javascript">

    function stats(arrayX,arrayY) 
// receive dataX and dataY
    {
       let  l = dataY.length;
       sum = 0;
        for (i = 0;  i < l ; i++)
            {
                y = dataY[i];
                sum = Number(y + sum);
            }
        cnt = parseInt(Math.max(...arrayX));
        maxY = parseInt(Math.max(...arrayY));
        minY = parseInt(Math.min(...arrayY));
        avg = Math.round(sum/cnt,1);
        console.log(cnt,maxY,minY,avg);
        $('#cnt').text(cnt);
        $('#avg').text(avg);
        $('#max').text(maxY);
        $('#min').text(minY);
        $('#time').text(l);
        $('#temp').text(arrayY[l-1]); // last reading 
}
</script>

<script type="text/javascript">
    function pushData(x,y)
    {
        let readingID = dataX.length;
        dataX.push(readingID);
        dataY.push(y);
        if (dataX.length > 1)
        {stats(dataX,dataY);}
        console.log("X",dataX);
        console.log("Y",dataY);
        lineGraph(dataX,dataY);
    }
</script>

<script type="text/javascript">
    function initial(thing)
    {
       
// not needed
    }
</script>


<script>
     $(document).ready(function(){
        dataX = []; // x values;
        dataY = []; // y values
        sum = 0 ; // for average
        n = 0; // counter
        studentID = "<?php echo $studentID; ?>" ;
        myThing = "LM35_" + studentID;  // will get this through GET for different IDs
        let message = "Shows the temperature at the location of " + myThing + ". It does this by analysing the dweets associated with the " + myThing + "."; 
    $('#message').text(message);
       // alert(myThing);
      //  dweetData = initial(myThing);

        // makes a new dweet
        dweetio.dweet_for("my-thing", 
            { "temp": 0.51,
        "time": "00-01"}, 

            function(err, dweet){

    console.log(dweet.thing); // "my-thing"
    console.log(dweet.content); // The content of the dweet
    console.log(dweet.created); // The create date of the dweet

});
       

        
        let d = [];
// get the time of the ;atest tweet for reference
        dweetio.get_latest_dweet_for(myThing, function(err, dweet){
        dweet = dweet[0]; // Dweet is always an array of 1
        dweetName = dweet.thing;
        dweetTime = dweet.created;
        dweetContent = dweet.content;
        console.log(dweet.content);
        latestTemperature = parseInt(dweet.content["temp"]);
        latestTime = dweet.content["time"];
        //console.log(dweet.content); // The content of the dweet
        console.log(latestTemperature,latestTime); // The content of the dweet


        d[0] = latestTime;
        d[1] = latestTemperature;
        pushData(d[0],d[1]);
        $.post("writeRoom.php", {"thing":myThing, "hourMinute":d[0],"temperature":d[1]});
        console.log("first one",dweet);

        })
    })

function listen() {
dweetio.listen_for("LM35_1737", function(dweet){

    // This will be called anytime there is a new dweet for my-thing

  //  alert("New dweet",dweet);
console.log("new",dweet);
 let yt = Number(dweet.content["temp"]);
 let y = parseFloat(yt.toFixed(2));
 let x = dweet.content["time"];
pushData(x,y);
// send it to the database 
  $.post("writeRoom.php", { "hourMinute":x,"temperature":y});

});

}

listen();

// wait for a new tweet 
</script>
<!--
<script>



// read what is already there
// read the last dweet only 
$.get("readRoom.php", function(dataRead){
  dataRead = JSON.parse(dataRead);
  alert(dataRead);
  l = dataRead.length;
  console.log("l",l);
 
  for (i = 0;  i < l ; i++)
  {
  x = dataRead[i][0];
  y = parseInt(dataRead[i][1]);
  dataX.push(x);
  dataY.push(y);
  sum = parseInt(sum) + parseInt(y);
  }
  cnt = parseInt(Math.max(...dataX));
  maxY = parseInt(Math.max(...dataY));
  minY = parseInt(Math.min(...dataY));
  avg = Math.round(sum/cnt,1);
  console.log(cnt,maxY,minY,avg);
  $('#cnt').text(cnt);
  $('#avg').text(avg);
  $('#max').text(maxY);
  $('#min').text(minY);
  lineGraph(dataX,dataY);

});
//lineGraph();
fiveMinutes = 1*60*1000
setInterval(displayData, fiveMinutes);


function displayData() {
 // console.log("");
/*
dweetio.get_all_dweets_for("my-thing", function(err, dweets){


    // Dweets is an array of dweets
    for(theDweet in dweets)
    {
        var dweet = dweets[theDweet];


        console.log(dweet.thing); // The generated name
        console.log(dweet.content); // The content of the dweet
        console.log(dweet.created); // The create date of the dweet
    }


*/


 dweetio.get_latest_dweet_for("LM35_1737", function(err, dweet){
dweet = dweet[0]; // Dweet is always an array of 1
dweetName = dweet.thing;
console.log(dweet.thing); // The generated name
//console.log(dweet.content); // The content of the dweet
console.log(dweet.content); // The content of the dweet
latestTemperature = parseInt(dweet.content["temp"]);
yearMonthDay = dweet.content["ymd"];
hourMinute = dweet.content["hm"];

// alert(dweet.content + dweet.content["temp"]);
latestTime = yearMonthDay +"-" +hourMinute;
$('#time').text(latestTime);
$('#temp').text(latestTemperature);
t += parseInt(latestTemperature);
cnt++;

//push new values
// read what is already there
$.get("readRoom.php", function(dataRead){
  dataRead = JSON.parse(dataRead);
 // alert(dataRead);
  l = dataRead.length;
  console.log("l",l);
  sum = 0 ;
  for (i = 0;  i < l ; i++)
  {
  x = dataRead[i][0];  // id
  y = parseInt(dataRead[i][1]);
  dataX.push(x);
  dataY.push(y);
  sum = parseInt(sum) + parseInt(y);
  }
  cnt = parseInt(Math.max(...dataX));
  maxY = parseInt(Math.max(...dataY));
  minY = parseInt(Math.min(...dataY));
  avg = Math.round(sum/cnt,1);
  console.log(cnt,maxY,minY,avg);
  $('#cnt').text(cnt);
  $('#avg').text(avg);
  $('#max').text(maxY);
  $('#min').text(minY);

})
  
lineGraph(dataX,dataY);


// get what is in the data base for plotting


  $.post("writeRoom.php", { "yearMonthDay": yearMonthDay, 
                            "hourMinute":hourMinute,
                            "latestTemperature":latestTemperature});
        function (data, status, jqXHR) {
                        console.log("statuspost: ", status);
                        console.log("datapost: " + data);
                         datapost = JSON.parse(data);
                        console.log("Data");
                        console.log(datapost); 
                        n = datapost[0][3];
                        avg = Math.round(datapost[0][2],1);
                        max = datapost[0][1];
                        min = datapost[0][0];
                        $('#cnt').text(n);
                        $('#avg').text(avg);
                        $('#max').text(max);
                        $('#min').text(min);


                        //min,max,avg,n
                 });
                });

  
     
}







 
</script>



</body>
</html>




<script>


      $(document).ready(function(){
     $('#stop').on('click', function(){
    
console.log("stop");
        alert("stopping");
        clearInterval();
       window.stop(); 




     })
    })
    
</script>


<script type="text/javascript">

function lineGraph(xData,yData)
{
       TESTER2 = document.getElementById('myGraph');
       var layout = {
    title: 'Room temperature',
    xaxis: {type: "string",title:'Time'},
    yaxis:{title:"Temperature",range: [20, 40]},
    showlegend: false
};
    var trace1 = {
        x: xData,
        y: yData,
        type: 'scatter'
};

var dataGraph = [trace1];

Plotly.newPlot('myChart', dataGraph,layout);
}
</script>

<script>
    

</script>

-->