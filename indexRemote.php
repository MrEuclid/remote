<!DOCTYPE html>
<html lang="en">
  <head>
 
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-2.27.0.min.js" charset="utf-8"></script>
  <link href = "remoteStyles.css"  rel = "stylesheet">

    <title>Remote</title>

<style type="text/css">
.c {width:auto; text-align: center;}
#counter {position:absolute; top:100px ; left:200px ; font-size:28pt ; color:red ;}

#two {font-weight: bolder;color: red ; font-size: 24pt ;}

   .c {
        margin:auto; 
        text-align: center;
        }
    
    button {
                margin:2em; 
             
                font-weight: bold; 
                color:orange; 
                background-color: black;
            }
input {margin-right:1em;}
  .site {color:green; background-color: skyblue;}

  h1 {display: inline-block;}
}
</style>


  </head>
  <body>
  
    <div class  = "container-fluid">
      <div class = "row justify-content-center">
        <h1 class = "c"> Remote data</h1> <a href = "../index.php">Home</a>
      </div></div>
 
      <div class = "row justify-content-center">
        <div class = "col-12 c">
  <!--
  <h2 class = "c">  Read data</h2>
-->
    <button id = "readData">Read data</button>
         <div id = "read">
    <button class = "site" id = "serial_LM35">LM35 - DHT11</button>
    <button class = "site" id = "serial_HR204">ultrasonic</button>
   <button class = "site" id = "LM35_1737">DWEET</button>
</div></div>
</div> <!-- read -->


 <div class = "row justify-content-center">
<div class = "col-12 c">
<!--
<h2 clas s= "c">View sensor data</h2>
-->
<button id =  "retrieveData" >View sensors</button>
</div></div>

 <div class = "row justify-content-center">
<div class = "col-12 c">

<div id = "webPage"></div>
</div></div>
</div>
</div>

</body>
</html>
<script>
    $(document).ready(function(){
    
        $('#readData').show();
        $('#retrieveData').show();
        $('.site').hide();
        $('#webPage').hide();
 })

  </script>

<script>
    $(document).ready(function(){
        $(".site").on('click', function(){
          let click = this.id;
          console.log(click + ".html");
          let url = click + ".html"
       //   alert(click);
          $('#webPage').load(url).show();
 })
})
  </script>

<script>
    $(document).ready(function(){
        $("#readData").on('click', function(){
      //    alert(this.id);
        $('#read').show();
        $('#view').hide();
        $('.site').show();
        $('#readData').hide();
        $('#retrieveData').show();
        $('#webPage').hide();
        

 })
})
  </script>

  <script>
    $(document).ready(function(){
        $("#retrieveData").on('click', function(){
           let click = this.id;
          console.log(click + ".html");
          let url = click + ".html"
       //   alert(click);
          $('#webPage').load(url).show();
      //     alert(this.id);
        $('#read').hide();
         $('#view').show();
        $('#readData').show();
        $('#retrieveData').hide();
        
 })
})
  </script>

