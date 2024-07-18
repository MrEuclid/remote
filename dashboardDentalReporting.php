<?php 
session_start() ; 

//phpinfo() ;

// print_r($_SESSION) ;


if (isset($_SESSION['start']) AND isset($_SESSION['finish']) AND ISSET($_SESSION['pword']))
        {$start = $_SESSION['start'] ;
         $finish = $_SESSION['finish'] ;
          $pword = $_SESSION['pword'] ;}

if (isset($_POST['start']) AND isset($_POST['finish']) AND ISSET($_POST['pword']))
{$start = $_POST['start'] ;
         $finish = $_POST['finish'] ;
          $pword = $_POST['pword'] ;

  $_SESSION['start'] = $start;
      $_SESSION['finish'] = $finish;
      $_SESSION['pword'] = $pword;
        }





 if ($pword <> 1950) { header("Location: http://dental.teacherjohn.org/index.php" ); exit() ;}


?>

<!DOCTYPE html>
<html>


<title>Dental Dashboard</title>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
 

  <link href='http://fonts.googleapis.com/css?family=Khmer' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 
 
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  
 
<link href='css/dentalStyles.css' rel='stylesheet' type='text/css'>

 <script type="text/javascript">
  
    $(document).ready(function(){
    
    
   $('#wrapper').show() ;

   
   })
</script>

<style>
.accordionHeading1 {background-color:Tomato ; color:black ; font-size: 18pt  ;}
.accordionHeading2 {background-color:DodgerBlue ; color:black ; font-size: 18pt ;}
.accordionHeading3 {background-color:yellow ; color:black ; font-size: 18pt ;}
.accordionHeading4 {background-color: green ; color:black ; font-size: 18pt ;}
.accordionHeading5 {background-color:violet ; color:black ; font-size: 18pt ;}
.accordionHeading6 {background-color:lightgrey ; color:black ; font-size: 18pt ;}
.accordionHeading7 {background-color: pink; color:black ; font-size: 18pt ;}

.btn {
    width: 250px;
    height: 50px; !important;
}

</style>
</head>
  <body>
  
<?php include "connectDatabase.php" ; ?> 

<div class = "container">


<div class = "row">
  <div class = "col-sm-12 c">
    <h1 class = "c">Dental Dashboard</a></h1>
    <a href = "index.php"><button>Exit</button></a>
   <form id = "getDates" action = "" method = "POST" >

    <input type = "text" hidden = "true" name = "pword" value="<?php echo $pword; ?>">
    <h2>Set start and end dates</h2>

    

    Start<input type = "date" id = "start" name = "start" value="<?php echo $start;?>">
    
    &nbsp; &nbsp; --- &nbsp; &nbsp;
    End<input type = "date" id = "finish" name = "finish" value="<?php echo $finish;?>">
    
    
  <input type = "submit" name = "Select" id = "getReport">


    </h2>

  </form>


    <div id = "showDates">
 <?php     


    //   print_r($_SESSION) ;
       $s = date('d-m-Y',strtotime($start)) ;
$f = date('d-m-Y',strtotime($finish)) ;
$message = $s . '
 to ' . $f . " for the dashboard "; 
 echo $message ;
     
         
 echo "Start = " . $start ;
 echo "Finish = " . $finish ;

// print_r($_POST);


?>

     <br>
     <label>The reporting period is from </label>
   <strong><?php echo $message ?></strong> 

     </br>
    </div>


 

 </div></div>   

<div class = "row">
  <div class = "col-sm-12 c">


</div></div>

<?php
$q = "select count(id) FROM patients 
WHERE 
registration_date >= '$start'
AND 
registration_date <= '$finish'" ;
$r = mysqli_query($dbServer,$q) ;
$d = mysqli_fetch_row($r) ;
$registered = $d[0] ;

?>


<?php
$q = "SELECT 

count(patients.id) AS N, 

sum(case when gender = 'F' then 1 else 0 end) AS Female,
round(sum(case when gender = 'F' then 1 else 0 end) / count(patients.id)*100,2) AS femalePercent,
sum(case when gender = 'M' then 1 else 0 end) AS Male,
round(sum(case when gender = 'M' then 1 else 0 end) / count(patients.id)*100,2) AS malePercent
from patients


join consultations on patients.id = consultations.patient_id 
AND consultations.date >= '$start'
AND consultations.date <= '$finish' " ;
$r = mysqli_query($dbServer,$q) ;
$d = mysqli_fetch_row($r) ;
$level1 = $d[0] ;

?>

<?php
$q = "select count(id) FROM finished_level_2
WHERE 
date_finished >= '$start'
AND 
date_finished <= '$finish' " ;
$r = mysqli_query($dbServer,$q) ;
$d = mysqli_fetch_row($r) ;
$level2 = $d[0] ;

?>

<?php
$q = "select count(id) FROM level_2_treatments
WHERE 
treatment_date >= '$start'
AND 
treatment_date <= '$finish' " ;
$r = mysqli_query($dbServer,$q) ;
$d = mysqli_fetch_row($r) ;
$level2Treatments = $d[0] ;

?>


<?php



$q = "select count(code) AS N,  sum(t) AS Teeth, 
sum(FILLING) AS FILL, sum(RCT) AS RCT, sum(X) AS Extraction ,
sum(case when X > 0 then 1 else 0 end) AS XPatients,
round(100*sum(case when X > 0 then 1 else 0 end)/count(code),2) AS XPercent,
sum(X)/sum(case when X > 0 then 1 else 0 end) AS MeanX


FROM (select  code,


sum(case when treatment <> '' then 1 else 0 end) AS t,
sum(case when treatment = 'X' then 1 else 0 end) AS X,
sum(case when treatment = 'AMAL_FILLING' OR treatment = 'COM_FILLING' then 1 else 0 end) AS FILLING,
sum(case when treatment = 'ROOT' then 1 else 0 end) AS RCT
FROM patients
join level_3_treatments 
ON patients.id = level_3_treatments.patient_id
join sites ON patients.school_id = code
AND treatment_date >= '$start'
AND treatment_date <= '$finish'
GROUP BY patient_id
) as t 


" ;

/*
$q = "select count(id) FROM finished_level_3
WHERE 
date_finished >= '$start'
AND 
date_finished <= '$finish' " ;

*/
$r = mysqli_query($dbServer,$q) ;
$d = mysqli_fetch_row($r) ;
$level3 = $d[0] ;

?>




 <div id = "wrapper">
 <div class = "row">
<div class="col-md-6 col-sm-offset-3">

 <h2>Choose the report you need</h2>
  <p class = "c"><strong>Note:</strong> The reports use the <strong>start</strong> and <strong>end</strong> dates you have selected.</p>
<div class = "c">
  
<a href = "export_all_tables.php"> <button  class="btn btn-danger btn-lg ">Export all tables to Excel</button></a>
&nbsp  &nbsp  &nbsp  &nbsp 
<a href = "export_all_tables_screen.php" target = "+blank"> <button  class="btn btn-info btn-lg ">View all tables on screen</button></a>
</div>
<br>

  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading c">
        <h4 class="panel-title c accordionHeading1">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" >All One-2-One registrations</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">

      <!-- registration options -->
<h2>All One2one Registrations



<a href = "http://rpubs.com/MrEuclid/524200"
 title = "View charts and tables for registrations in an RPub document">
<img src = "images\Rlogo.png" width = "25" height = "25" alt = "View in RPub"></a>
<br>
Total registrations = <?php echo $registered ; ?> 
</h2>

   <div class = "row">
<div class="col-md-12 c">

<a href = "registrationReport.php" 
title = "Registrations for all patients." >
<button  class="btn btn-danger btn-lg ">Registrations (total)</button>
</a>
<br><br>

<a href = "registrationProvinceGenderReport.php" 
title = "Registrations by Province and Gender for all patients." >
<button  class="btn btn-warning btn-lg ">Province / Gender</button>
</a>
<br><br>

<a href = "registrationOrganisationGenderReport.php" 
title = "Registrations by Organisation and Gender for all patients." >
<button  class="btn btn-success btn-lg ">Organisation / Gender</button>
</a>
<br><br>

<a href = "registrationSchoolGenderReport.php" 
title = "Registrations by School and Gender for all patients." >
<button  class="btn btn-info btn-lg ">School / Gender</button>
</a>
<br><br>

<a href = "registrationGradeGenderReport.php" 
title = "Registrations by Grade and Gender for all patients." >
<button  class="btn btn-primary btn-lg ">Grade / Gender</button>
</a>
<br><br>


</div></div>


      </div>
      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title c accordionHeading2">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Level 1 Summary</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">

<h2>Level 1 Summary

<a href = "http://rpubs.com/MrEuclid/524244"
target = "_blank" title = "View charts and tables for registrations in an RPub document">
<img src = "images\Rlogo.png" width = "25" height = "25"alt = "View in RPub"></a>
<br>
Total Level 1 = <?php echo $level1 ; ?>

</h2>
 
  <div class = "row">
<div class="col-md-12 c">

<a href = "level_1_ProvinceGenderReport.php" 
title = "Level 1 contacts by province and gender." >
<button  class="btn btn-primary btn-lg ">Province / Gender</button>
</a>

<br><br>

<a href = "level_1_OrganisationGenderReport.php" 
title = "Level 1 contacts by Organisation and Gender." >
<button  class="btn btn-danger btn-lg ">Organisation / Gender</button>
</a>

<br><br>

<a href = "level_1_SchoolGenderReport.php" 
title = "Level 1 contacts by School and Gender." >
<button  class="btn btn-warning btn-lg ">School / Gender</button>
</a>

<br><br>

<a href = "level_1_GradeGenderReport.php" 
title = "Level 1 contacts by Grade and Gender." >
<button  class="btn btn-info btn-lg ">Grade / Gender</button>
</a>

<br><br>

<a href = "level_1_SchoolCavitiesInfectionReport.php" 
title = "Level 1 contacts with acute infection and/or cavities in permanent teeth." >
<button  class="btn btn-primary btn-lg ">School / Infection & Cavities</button>
</a>

<br><br>

<a href = "level_1_SchoolReferralsReport.php" 
title = "Level 1 contacts with acute infection and/or cavities in permanent teeth." >
<button  class="btn btn-success btn-slg">School / Referrals to L2 or L3</button>
</a>

</div></div>
<br><br>

      </div>
      </div>
    </div>


    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title c accordionHeading3">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Level 2 Contact Summary</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">

        <h2>Level 2 Contact Summary
<a href = ""
target = "_blank" title = "View charts and tables for Level 1 in an RPub document">
<img src = "images\Rlogo.png" width = "25" height = "25" alt = "View in RPub"></a>
<br>
Completed level 2 = <?php echo $level2 ; ?>
</h2>


 <div class = "row">
<div class="col-md-12 c">
<a href = "level_2_ProvinceGenderReport.php" 
title = "Level 2 contacts finished by province and gender." >
<button  class="btn btn-warning btn-lg ">Province / Gender</button>
</a>

<br><br>

<a href = "level_2_OrganisationGenderReport.php" 
title = "Level 2 contacts by Organisation and Gender." >
<button  class="btn btn-danger btn-lg ">Organisation / Gender</button>
</a>

<br><br>

<a href = "level_2_SchoolGenderReport.php" 
title = "Level 2 contacts by School and Gender." >
<button  class="btn btn-success btn-lg ">School / Gender</button>
</a>

<br><br>

<a href = "level_2_GradeGenderReport.php" 
title = "Level 2 contacts by Grade and Gender." >
<button  class="btn btn-info btn-lg">Grade / Gender</button>
</a>

<br><br>


      </div>
      </div>
    </div>
  </div> 


    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title c accordionHeading4">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Level 2 Treatments (detailed) </a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">

      <h2>Level 2 Treatments (detailed)
<a href = ""
target = "_blank" title = "View charts and tables for Level 2 treatments in an RPub document">
<img src = "images\Rlogo.png" width = "25" height = "25" alt = "View in RPub"></a>
<br>
Level 2 treatments = <?php echo $level2Treatments ; ?>
</h2>


 <div class = "row">
<div class="col-md-12 c">
<a href = "level_2_SummaryTreatmentsProvinceReport.php" 
title = "Level 2 treatments by province." >
<button  class="btn btn-primary btn-lg ">Province</button>
</a>

<br><br>

<a href = "level_2_SummaryTreatmentsOrganisationReport.php" 
title = "Level 2 treatments by Organisation." >
<button  class="btn btn-danger btn-lg ">Organisation</button>
</a>

<br><br>

<a href = "level_2_SummaryTreatmentsSchoolReport.php" 
title = "Level 2 treatments by School." >
<button  class="btn btn-warning btn-lg ">School</button>
</a>

<br><br>

<a href = "level_2_SummaryTreatmentsGradeReport.php" 
title = "Level 2 treatments by Grade." >
<button  class="btn btn-success btn-lg ">Grade</button>
</a>

<br><br>

      </div>
      </div>
    </div>
  </div>



    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title c accordionHeading5">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Level 3 Contacts</a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">

         <h2>Level 3 Contacts

<a href = "http://rpubs.com/MrEuclid/524244"
target = "_blank" title = "View charts and tables for registrations in an RPub document">
<img src = "images\Rlogo.png" width = "25" height = "25"alt = "View in RPub"></a>
<br>
Total Level 3 = <?php echo $level3 ; ?>

</h2>
 <div class = "row">
<div class="col-md-12 c">
<a href = "level_3_ProvinceGenderReport.php" 
title = "Level 3 contacts by province and gender." >
<button  class="btn btn-primary btn-lg ">Province / Gender</button>
</a>

<br><br>

<a href = "level_3_OrganisationGenderReport.php" 
title = "Level 3 contacts by Organisation and Gender." >
<button  class="btn btn-danger btn-lg ">Organisation / Gender</button>
</a>

<br><br>

<a href = "level_3_SchoolGenderReport.php" 
title = "Level 3 contacts by School and Gender." >
<button  class="btn btn-warning btn-lg ">School / Gender</button>
</a>

<br><br>

<a href = "level_3_GradeGenderReport.php" 
title = "Level 3 contacts by Grade and Gender." >
<button  class="btn btn-info btn-lg ">Grade / Gender</button>
</a>

<br><br>




      </div>
      </div>
    </div>
  </div>


  




    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title c accordionHeading6">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Level 3 Treatments (detailed)</a>
        </h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body">

         <h2>Level 3 Treatments Summary

<a href = "http://rpubs.com/MrEuclid/524244"
target = "_blank" title = "View charts and tables for registrations in an RPub document">
<img src = "images\Rlogo.png" width = "25" height = "25"alt = "View in RPub"></a>
<br>
Total Level 3 = <?php echo $level3 ; ?>

</h2>
 <div class = "row">
<div class="col-md-12 c">
<a href = "level_3_SummaryTreatmentsProvinceReport.php" 
title = "Level 3 treatments by province and ." >
<button  class="btn btn-primary btn-lg ">Province</button>
</a>

<br><br>

<a href = "level_3_SummaryTreatmentsOrganisationReport.php" 
title = "Level 3 treatments by Organisation." >
<button  class="btn btn-danger btn-lg ">Organisation</button>
</a>

<br><br>

<a href = "level_3_SummaryTreatmentsSchoolReport.php" 
title = "Level 3 treatments by School and Gender." >
<button  class="btn btn-warning btn-lg ">School</button>
</a>

<br><br>

<a href = "level_3_SummaryTreatmentsGradeReport.php" 
title = "Level 3 treatments by Grade." >
<button  class="btn btn-info btn-lg ">Grade</button>
</a>

<br><br>




      </div>
      </div>
    </div>
  </div>


  </div>



</div> <!-- accordion -->


</div> <!-- wrapper -->
</div>  <!-- container -->
</body>
</html>
