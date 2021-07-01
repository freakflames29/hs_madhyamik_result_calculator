<?php 
include 'header.php';
?>
<?php 

  $show=false;
  $mad=false;
  $elv=false;
  $hs_prac=false;
  $comp=false;
  $math=false;

  if(isset($_POST['submit']))
  {
      $username=mysqli_real_escape_string($con,$_POST['username']);
      $phone=mysqli_real_escape_string($con,$_POST['phone']);
    //madhyamik marks
      $m1=$_POST['m1'];
      $m2=$_POST['m2'];
      $m3=$_POST['m3'];
      $m4=$_POST['m4'];
      //class 11 marks
      $elv_acc=$_POST['elv_acc'];
      $elv_business=$_POST['elv_business'];
      $elv_cost_tax=$_POST['elv_cost_tax'];
      $elv_eco_math=$_POST['elv_eco_math'];
      $elv_comp_appli=$_POST['elv_comp_appli'];
      $elv_beng=$_POST['elv_beng'];
      $elv_eng=$_POST['elv_eng'];
      // class 12 marks 30
      $twe_prac_compApp=$_POST['twe_prac_compApp'];
      // class 12 marks 20
      $twe_prac_twe_acc=$_POST['twe_prac_twe_acc'];
      $twe_prac_twe_business=$_POST['twe_prac_twe_business'];
      $twe_prac_twe_candt=$_POST['twe_prac_twe_candt'];
      $twe_prac_twe_ben=$_POST['twe_prac_twe_ben'];
      $twe_prac_twe_eng=$_POST['twe_prac_twe_eng'];

      $twe_prac_twe_eco_math=$_POST['twe_prac_twe_eco_math'];

    

       if(($m1>=101||$m1<0)||($m2>=101||$m2<0)||($m3>=101||$m3<0)||($m4>=101||$m4<0))
      {
        $mad=true;
     
      }
      if(!empty($elv_comp_appli))
      {
         if(($elv_acc>=81||$elv_acc<0)||($elv_business>=81||$elv_business<0)||($elv_cost_tax>=81||$elv_cost_tax<0)||($elv_comp_appli>=71||$elv_comp_appli<0)||($elv_beng>=81||$elv_beng<0)||($elv_eng>=81||$elv_eng<0))
            {
              $elv=true;
          
           }
      }
      else if(!empty($elv_eco_math))
      {
        if(($elv_acc>=81||$elv_acc<0)||($elv_business>=81||$elv_business<0)||($elv_cost_tax>=81||$elv_cost_tax<0)||($elv_eco_math>=81||$elv_eco_math<0)||($elv_beng>=81||$elv_beng<0)||($elv_eng>=81||$elv_eng<0))
            {
              $elv=true;
              echo "dhuke6";
          
           }
      }
      else if(!empty($elv_eco_math)&&!empty($elv_comp_appli))
      {
        $elv=true;
      }
     
     if(($twe_prac_compApp>=31||$twe_prac_compApp<0)||($twe_prac_twe_acc>=21 || $twe_prac_twe_acc<0)||($twe_prac_twe_business>=21 || $twe_prac_twe_business<0) || ($twe_prac_twe_candt>=21 || $twe_prac_twe_candt<0)||($twe_prac_twe_ben>=21 || $twe_prac_twe_ben<0) ||($twe_prac_twe_eng>=21 || $twe_prac_twe_eng<0) )
     {
       $hs_prac=true;
     }
     if(!$hs_prac&&!$elv&&!$mad)
     {


       //madh 28 marks-70-30
        $madh_twe=ceil((($m1+$m2+$m3+$m4)*28)/400);
        //madh 32 marks-80-20
        $madh_thir=ceil((($m1+$m2+$m3+$m4)*32)/400);

        $new_acc=$madh_thir+ceil(($elv_acc*48)/80)+$twe_prac_twe_acc;
        $new_business=$madh_thir+ceil(($elv_business*48)/80)+$twe_prac_twe_business;
        $new_costtax=$madh_thir+ceil(($elv_cost_tax*48)/80)+$twe_prac_twe_candt;
        $new_ben=$madh_thir+ceil(($elv_beng*48)/80)+$twe_prac_twe_ben;
        $new_eng=$madh_thir+ceil(($elv_eng*48)/80)+$twe_prac_twe_eng;
        //70-30
        if(!empty($twe_prac_compApp)&&!empty($elv_comp_appli))
        {
          $new_compApp=$madh_twe+ceil(($elv_comp_appli*42)/70)+$twe_prac_compApp;
          $min=min($new_acc, $new_business,$new_costtax, $new_ben,$new_eng,$new_compApp);
          $total=($new_acc+ $new_business+$new_costtax+ $new_ben+$new_eng+$new_compApp)-$min;
          // echo "The vali is fod".$elv_eco_math;
          $comp=true;
        }
        if(!empty($twe_prac_twe_eco_math)&&!empty($elv_eco_math))
        {
          $new_ecomath=$madh_thir+ceil(($elv_eco_math*48)/80)+$twe_prac_twe_eco_math;
          $min=min($new_acc, $new_business,$new_costtax, $new_ben,$new_eng,$new_ecomath);
          $total=($new_acc+ $new_business+$new_costtax+ $new_ben+$new_eng+$new_ecomath)-$min;
          // echo "ki bal h66".$elv_eco_math;
          $math=true;
        }
        
        // // min find
        // if($new_compApp)
        // {

        // }
        // else if($new_ecomath)
        // {
        // }
        // percent
        $percent=round((($total*100)/500),2);
        $show=true;
         $sql="insert into hs values(NULL,'$username','$phone','$total','$percent','Commerece')";
        $sql_run=mysqli_query($con,$sql);
        
     }





  }


 ?>
<div class="container">
	<br>
    <h1>Check Your Commerce HS result </h1>
   <!-- <hr> -->
  <?php 
   if($mad)
    {
      echo "<hr><div class='alert alert-danger' role='alert'>
                     Class 10 data is invalid ! check and submit again
                    </div>";
    }
   if($elv)
    {
      echo "<hr><div class='alert alert-danger' role='alert'>
                     Class 11 data is invalid ! check and submit again
                    </div>";
    }
   if($hs_prac)
    {
      echo "<hr><div class='alert alert-danger' role='alert'>
                     Class 12 pracitcal  data is invalid ! check and submit again
                    </div>";
    }
    if($show)
    {
       echo "<hr><h1>Your result will be </h1>";
       if($comp)
       {

          echo " <ul class='list-group'>
            <li class='list-group-item'>Bengali/Hindi:- $new_ben</li>
            <li class='list-group-item'>English:-$new_eng </li>
            <li class='list-group-item'>Accountancy:-$new_acc</li>
            <li class='list-group-item'>Business Studies:-$new_business</li>
            <li class='list-group-item'>Cost and Tax:-$new_costtax</li>
            <li class='list-group-item'>Computer Application :-$new_compApp</li>
            <li class='list-group-item list-group-item-success'>Best Of 5 marks :- $total</li>
            <li class='list-group-item list-group-item-info'>Percent:- $percent %</li>
          </ul>
          
          ";
       }
       else if($math)
       {
        echo " <ul class='list-group'>
            <li class='list-group-item'>Bengali/Hindi:- $new_ben</li>
            <li class='list-group-item'>English:-$new_eng </li>
            <li class='list-group-item'>Accountancy:-$new_acc</li>
            <li class='list-group-item'>Business Studies:-$new_business</li>
            <li class='list-group-item'>Cost and Tax:-$new_costtax</li>
            <li class='list-group-item'>Economics/Math:-$new_ecomath</li>
            <li class='list-group-item list-group-item-success'>Best Of 5 marks :- $total</li>
            <li class='list-group-item list-group-item-info'>Percent:- $percent %</li>
          </ul>
          
          ";
       }
    }




   ?>
 

	<form action="hs_commerce.php" method="post">
    <hr>
    <div class="mb-3 ">
      <label for="username" class="form-label">Name</label>
      <input type="text" class="form-control" id="username" name="username"placeholder="Name" required>
    </div>
    <div class="mb-3 ">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="number" class="form-control" id="phone" name="phone"placeholder="Phone Number" required>
    </div>
	<h2>Enter top 4 highest number of madhyamik outof 100</h2>
	  <div class="mb-3 ">
      <label for="m1" class="form-label">First Highest</label>
      <input type="text" class="form-control" id="m1" name="m1"placeholder="First Highest" required>
    </div>
     <div class="mb-3 ">
      <label for="m2" class="form-label">Second Highest</label>
      <input type="text" class="form-control" id="m2" name="m2"placeholder="Second Highest" required>
    </div> 
    <div class="mb-3 ">
      <label for="m3" class="form-label">Third Highest</label>
      <input type="text" class="form-control" id="m3" name="m3"placeholder="Third Highest" required>
    </div> 
    <div class="mb-3 ">
      <label for="m4" class="form-label">Fourth Highest</label>
      <input type="text" class="form-control" id="m4" name="m4"placeholder="Fourth Highest" required>
    </div>
    <hr>
    <h2>Enter your class 11 theory marks</h2>
      <div class="mb-3 ">
      <label for="elv_acc" class="form-label">Accountancy</label>
     	 <input type="text" class="form-control" id="elv_acc" name="elv_acc"placeholder="Accountancy Marks" 			required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_business" class="form-label">Business Studies</label>
     	 <input type="text" class="form-control" id="elv_business" name="elv_business"placeholder="Business Studies Marks" 			required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_cost_tax" class="form-label">Cost And Tax</label>
     	 <input type="text" class="form-control" id="elv_cost_tax" name="elv_cost_tax"placeholder="Cost And Tax Marks" 	required>
      </div>
      <div class="mb-3 ">
      <label for="elv_eco_math" class="form-label">Economics/Math</label>
     	 <input type="text" class="form-control" id="elv_eco_math" name="elv_eco_math"placeholder="Economics/Math Marks">
      </div>  
      <div class="mb-3 ">
      <label for="elv_comp_appli" class="form-label">Computer Application</label>
       <input type="text" class="form-control" id="elv_comp_appli" name="elv_comp_appli"placeholder="Computer Application Marks">
      </div> 
      <div class="mb-3 ">
      <label for="elv_beng" class="form-label">Bengali/Hindi</label>
     	 <input type="text" class="form-control" id="elv_beng" name="elv_beng"placeholder="Bengali/Hindi Marks" required>
      </div>
       <div class="mb-3 ">
      <label for="elv_eng" class="form-label">English</label>
     	 <input type="text" class="form-control" id="elv_eng" name="elv_eng"placeholder="English Marks" required>
      </div>
      <hr>
      <h2>Enter your class 12 practical marks outof 30</h2>
      <small>If you don't have any subject where practical marks is not 30 then leave this fields</small>
        <div class="mb-3 ">
     	 <label for="twe_prac_compApp" class="form-label">Computer Application</label>
     	 <input type="text" class="form-control" id="twe_prac_compApp" name="twe_prac_compApp"placeholder="Computer Application Marks">
      </div> 
      <hr>
      <h2>Enter your class 12 practical marks outof 20</h2>
      <small>If you don't have any subject where practical marks is not 20 then leave this field</small>

       <div class="mb-3 ">
     	 <label for="twe_prac_twe_acc" class="form-label">Accountancy</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_acc" name="twe_prac_twe_acc"placeholder="Accountancy Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_business" class="form-label">Business Studies</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_business" name="twe_prac_twe_business"placeholder="Business Studies Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_candt" class="form-label">Cost And Tax</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_candt" name="twe_prac_twe_candt"placeholder="Cost And Tax Marks" required>
      </div>
      <div class="mb-3 ">
       <label for="twe_prac_twe_ben" class="form-label">Bengali/Hindi</label>
       <input type="text" class="form-control" id="twe_prac_twe_ben" name="twe_prac_twe_ben"placeholder="Bengali/Hindi Marks" required>
      </div>
      <div class="mb-3 ">
       <label for="twe_prac_twe_eng" class="form-label">English</label>
       <input type="text" class="form-control" id="twe_prac_twe_eng" name="twe_prac_twe_eng"placeholder="English Marks" required>
      </div> 
      <div class="mb-3 ">
       <label for="twe_prac_twe_eco_math" class="form-label">Economics/Math</label>
       <input type="text" class="form-control" id="twe_prac_twe_eco_math" name="twe_prac_twe_eco_math"placeholder="Economics/Math Marks">
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>


     
	</form>	
  <br>

</div>





 <?php 
 		include 'footer.php';
  ?>