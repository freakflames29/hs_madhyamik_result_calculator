<?php 
include 'header.php';
?>
<?php 
  
  $show=false;
  $mad=false;
  $hs=false;
  $hs_prac=false;
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
    $elv_phy=$_POST['elv_phys'];
    $elv_chem=$_POST['elv_chem'];
    $elv_math=$_POST['elv_math'];
    $elv_bio_cs=$_POST['elv_bio_cs'];
    $elv_beng=$_POST['elv_beng'];
    $elv_eng=$_POST['elv_eng'];

    //class 12 practical marks outof 30
    $twe_prac_phys=$_POST['twe_prac_phys'];
    $twe_prac_chem=$_POST['twe_prac_chem'];
    $twe_prac_bio_cs=$_POST['twe_prac_bio_cs'];

    //class 12 practical marks outof 20
    $twe_prac_twe_math=$_POST['twe_prac_twe_math'];
    $twe_prac_twe_beng=$_POST['twe_prac_twe_beng'];
    $twe_prac_twe_eng=$_POST['twe_prac_twe_eng'];

    if(($m1>=101||$m1<0)||($m2>=101||$m2<0)||($m3>=101||$m3<0)||($m4>=101||$m4<0))
    {
      $mad=true;
   
    }
    if(($elv_phy>=71||$elv_phy<0)||($elv_chem>=71||$elv_chem<0)||($elv_bio_cs>=71||$elv_bio_cs<0)||($elv_math>=81||$elv_math<0)||($elv_beng>=81||$elv_beng<0)||($elv_eng>=81||$elv_eng<0))
    {
        $hs=true;
    
    }
    if(($twe_prac_phys>=31||$twe_prac_phys<0)||($twe_prac_chem>=31||$twe_prac_chem<0)||($twe_prac_bio_cs>=31||$twe_prac_bio_cs<0)||($twe_prac_twe_math>=21||$twe_prac_twe_math<0)||($twe_prac_twe_beng>=21||$twe_prac_twe_beng<0)||($twe_prac_twe_eng>=21||$twe_prac_twe_eng<0))
    {
      $hs_prac=true;

    }

    if(!$mad&&!$hs&&!$hs_prac)
    {
       //madh 28 marks-70-30
        $madh_twe=ceil((($m1+$m2+$m3+$m4)*28)/400);
        //madh 32 marks-80-20
        $madh_thir=ceil((($m1+$m2+$m3+$m4)*32)/400);

        // 70-30
        $new_phy=$madh_twe+ceil(($elv_phy*42)/70)+$twe_prac_phys;
        $new_chem=$madh_twe+ceil(($elv_chem*42)/70)+$twe_prac_chem;
        $new_bio_cs=$madh_twe+ceil(($elv_bio_cs*42)/70)+$twe_prac_bio_cs;

        //80-20
        $new_math=$madh_thir+ceil(($elv_math*48)/80)+$twe_prac_twe_math;
        $new_ben=$madh_thir+ceil(($elv_beng*48)/80)+$twe_prac_twe_beng;
        $new_eng=$madh_thir+ceil(($elv_eng*48)/80)+$twe_prac_twe_eng;

        $min=min($new_phy,$new_chem,$new_bio_cs, $new_math,$new_ben,$new_eng);
        $total=($new_phy+$new_chem+$new_bio_cs+$new_math+$new_ben+$new_eng)-$min;
        $percent=round((($total*100)/500),2);
        $show=true;
        $sql="insert into hs values(NULL,'$username','$phone','$total','$percent','Science')";
        $sql_run=mysqli_query($con,$sql);
        
    }
   
  }
?>

<div class="container">
	<br>
 
	<h1>Check Your Science HS result </h1>
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
        <li class='list-group-item'>Bengali/Hindi:- $new_ben</li>
        <li class='list-group-item'>English:-$new_eng </li>
        <li class='list-group-item'>Math:-$new_math</li>
        <li class='list-group-item'>Biology/Computer Science/Statistics/Computer Application:-$new_bio_cs</li>
        <li class='list-group-item'>Chemistry:-$new_chem</li>
        <li class='list-group-item'>Physics :-$new_phy</li>
        <li class='list-group-item list-group-item-success'>Best Of 5 marks :- $total</li>
        <li class='list-group-item list-group-item-info'>Percent:- $percent %</li>
      </ul>
      
      ";
    }



   ?>
	<hr>
	<form action="hs_science.php" method="post">
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
      <label for="elv_phys" class="form-label">Physics</label>
     	 <input type="text" class="form-control" id="elv_phys" name="elv_phys"placeholder="Physics Marks" 			required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_chem" class="form-label">Chemistry</label>
     	 <input type="text" class="form-control" id="elv_chem" name="elv_chem"placeholder="Chemistry Marks" 			required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_math" class="form-label">Math</label>
     	 <input type="text" class="form-control" id="elv_math" name="elv_math"placeholder="Math Marks" 			required>
      </div>
      <div class="mb-3 ">
      <label for="elv_bio_cs" class="form-label">Biology/Computer Science/Statistics/Computer Application</label>
     	 <input type="text" class="form-control" id="elv_bio_cs" name="elv_bio_cs"placeholder="Biology/Computer Science/Statistics/Computer Application Marks" required>
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
     	 <label for="twe_prac_phys" class="form-label">Physics</label>
     	 <input type="text" class="form-control" id="twe_prac_phys" name="twe_prac_phys"placeholder="Physics Marks" required>
      </div> 
      <div class="mb-3 ">
     	 <label for="twe_prac_chem" class="form-label">Chemistry</label>
     	 <input type="text" class="form-control" id="twe_prac_chem" name="twe_prac_chem"placeholder="Chemistry Marks" required>
      </div> 
      <div class="mb-3 ">
     	 <label for="twe_prac_bio_cs" class="form-label">Biology/Computer Science/Statistics/Computer Application</label>
     	 <input type="text" class="form-control" id="twe_prac_bio_cs" name="twe_prac_bio_cs"placeholder="Biology/Computer Science/Statistics/Application Marks" required>
      </div>
      <hr>
      <h2>Enter your class 12 practical marks outof 20</h2>
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
         <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
      <label class="form-check-label" for="flexCheckDefault">
        I am agree with the <a href="/result/terms_and_condition.php">Terms and condition</a>
      </label>
    </div>
    <br>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>


     
	</form>	
  <br>

</div>





 <?php 
 		include 'footer.php';
  ?>