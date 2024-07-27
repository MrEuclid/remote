<!DOCTYPE html>
<html lang="en">
  <head>
 
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.plot.ly/plotly-2.27.0.min.js" charset="utf-8"></script>
  <<link href = "remoteStyles.css"  rel = "stylesheet">

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
}
</style>


  </head>
  <body>
  
    <div class  = "container-fluid">
      <div class = "row justify-content-center">
        <h1 class = "c"> <a href = "../index.php">Home</a> Remote data</h1>
      </div></div>
      <div class = "row justify-content-center">
        <div class = "col-12 c">
  <h2 class = "c">  Read data</h2>

  <button class = "site" id = "serial_LM35">LM35</button>
    <button id = "serial_HR204">HR 2024</button>
   <button id = "serial_counting">Counting</button>
   <button id = "LM35_1737">DWEET</button></a>
</div></div>


 <div class = "row justify-content-center">
<div class = "col-12 c">

<h2 clas s= "c">View sensor data</h2>
<button id =  "retrieveData" >View sensors</button></a>
</div></div>
 <div class = "row justify-content-center">
<div class = "col-12 c">
  <h3>Site</h3>
<div id = "webPage"></div>
</div></div>
</div>

</body>
</html>


<script>
    $(document).ready(function(){
        $(".site").on('click', function(){
          let click = this.id;
          console.log(click + ".html");
          let url = click + ".html"
         // alert(click);
$('#webPage').load(url);
 })
})
  </script>}
