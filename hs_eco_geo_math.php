<?php 
include 'header.php';
?>
<?php 

  $mad=false;
  $hs=false;
  $hs_prac=false;
  $show=false;
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
          $elv_eco=$_POST['elv_eco'];
          $elv_geo=$_POST['elv_geo'];
          $elv_math=$_POST['elv_math'];
          $elv_bio_cs=$_POST['elv_bio_cs'];
          $elv_beng=$_POST['elv_beng'];
          $elv_eng=$_POST['elv_eng'];
          //class 12 practical marks outof 30
          $twe_prac_geo=$_POST['twe_prac_geo'];
          $twe_prac_bio_cs=$_POST['twe_prac_bio_cs'];
          //class 12 practical marks outof 20
          $twe_prac_twe_eco=$_POST['twe_prac_twe_eco'];
          $twe_prac_twe_math=$_POST['twe_prac_twe_math'];
          $twe_prac_twe_beng=$_POST['twe_prac_twe_beng'];
          $twe_prac_twe_eng=$_POST['twe_prac_twe_eng'];

          if(($m1>=101||$m1<0)||($m2>=101||$m2<0)||($m3>=101||$m3<0)||($m4>=101||$m4<0))
          {
            $mad=true;
         
          }
          if(($elv_beng>=81||$elv_beng<0)||($elv_eng>=81||$elv_eng<0)||($elv_eco>=81||$elv_eco<0)||($elv_math>=81||$elv_math<0)||($elv_geo>=71||$elv_geo<0)||($elv_bio_cs>=71||$elv_bio_cs<0))

          {
            $hs=true;
          }
           if(( $twe_prac_twe_beng>=21 || $twe_prac_twe_beng<0)||( $twe_prac_twe_eng>=21 || $twe_prac_twe_eng<0)||( $twe_prac_twe_eco>=21 || $twe_prac_twe_eco<0)||( $twe_prac_twe_math>=21 || $twe_prac_twe_math<0)||( $twe_prac_geo>=31 || $twe_prac_geo<0)||( $twe_prac_bio_cs>=31 || $twe_prac_bio_cs<0))
          {
            $hs_prac=true;
          }
           if(!$hs_prac&&!$hs&&!$mad)
           {
                //madh 28 marks-70-30
              $madh_twe=ceil((($m1+$m2+$m3+$m4)*28)/400);
              //madh 32 marks-80-20
              $madh_thir=ceil((($m1+$m2+$m3+$m4)*32)/400);

              $new_beng=$madh_thir+ceil(($elv_beng*48)/80)+$twe_prac_twe_beng;
              $new_eng=$madh_thir+ceil(($elv_eng*48)/80)+$twe_prac_twe_eng;
              $new_eco=$madh_thir+ceil(($elv_eco*48)/80)+$twe_prac_twe_eco;
              $new_math=$madh_thir+ceil(($elv_math*48)/80)+$twe_prac_twe_math;

              $new_geo=$madh_twe+ceil(($elv_geo*42)/70)+$twe_prac_geo;
              $new_cs=$madh_twe+ceil(($elv_bio_cs*42)/70)+$twe_prac_bio_cs;

              $min=min($new_beng,$new_eng,$new_eco, $new_math,$new_geo,$new_cs);
              $total=($new_beng+$new_eng+$new_eco+ $new_math+$new_geo+$new_cs)-$min;
              $percent=round((($total*100)/500),2);
              $show=true;
              $sql="insert into hs values(NULL,'$username','$phone','$total','$percent','EGM')";
              $sql_run=mysqli_query($con,$sql);
           }


  }


 ?>
<div class="container">
	<br>
 
	<h1>Check Your Eco-Geo-Math HS result </h1>
   <?php 

    if($mad)
    {
      echo "<hr><div class='alert alert-danger' role='alert'>
                     Class 10 data is invalid ! check and submit again
                    </div>";
    }
   if($hs)
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
      echo " <ul class='list-group'>
        <li class='list-group-item'>Bengali/Hindi:- $new_beng</li>
        <li class='list-group-item'>English:-$new_eng </li>
        <li class='list-group-item'>Math:-$new_math</li>
        <li class='list-group-item'>Computer Application:-$new_cs</li>
        <li class='list-group-item'>Economics:-$new_eco</li>
        <li class='list-group-item'>Geography :-$new_geo</li>
        <li class='list-group-item list-group-item-success'>Best Of 5 marks :- $total</li>
        <li class='list-group-item list-group-item-info'>Percent:- $percent %</li>
      </ul>
      
      ";
    }



   ?>
	<hr>
	<form action="hs_eco_geo_math.php" method="post">
    <!-- <hr> -->
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
      <label for="elv_eco" class="form-label">Economics</label>
     	 <input type="text" class="form-control" id="elv_eco" name="elv_eco"placeholder="Economics Marks" 			required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_geo" class="form-label">Geography</label>
     	 <input type="text" class="form-control" id="elv_geo" name="elv_geo"placeholder="Geography Marks" 			required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_math" class="form-label">Math</label>
     	 <input type="text" class="form-control" id="elv_math" name="elv_math"placeholder="Math Marks" 			required>
      </div>
      <div class="mb-3 ">
      <label for="elv_bio_cs" class="form-label">Computer Application</label>
     	 <input type="text" class="form-control" id="elv_bio_cs" name="elv_bio_cs"placeholder="Computer Application Marks" required>
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
        <div class="mb-3 ">
     	 <label for="twe_prac_geo" class="form-label">Geography</label>
     	 <input type="text" class="form-control" id="twe_prac_geo" name="twe_prac_geo"placeholder="Geography Marks" required>
      </div> 
      <div class="mb-3 ">
     	 <label for="twe_prac_bio_cs" class="form-label">Computer Application</label>
     	 <input type="text" class="form-control" id="twe_prac_bio_cs" name="twe_prac_bio_cs"placeholder="Computer Application Marks" required>
      </div>
      <hr>
      <h2>Enter your class 12 practical marks outof 20</h2>
       <div class="mb-3 ">
     	 <label for="twe_prac_twe_eco" class="form-label">Economics</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_eco" name="twe_prac_twe_eco"placeholder="Economics Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_math" class="form-label">Math</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_math" name="twe_prac_twe_math"placeholder="Math Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_beng" class="form-label">Bengali/Hindi</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_beng" name="twe_prac_twe_beng"placeholder="Bengali/Hindi Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_eng" class="form-label">English</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_eng" name="twe_prac_twe_eng"placeholder="English Marks" required>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>


     
	</form>	
  <br>

</div>














 <?php 
 		include 'footer.php';
  ?>