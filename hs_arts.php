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
	    $elv_beng=$_POST['elv_beng'];
	    $elv_eng=$_POST['elv_eng'];
	    $elv_edu=$_POST['elv_edu'];
	    $elv_pol_sc=$_POST['elv_pol_sc'];
	    $elv_hist=$_POST['elv_hist'];
	    $elv_psy=$_POST['elv_psy'];//70-30

	    // class 12 marks
	    //70-30
	    $twe_prac_psy=$_POST['twe_prac_psy'];
	    // 80-20
	    $twe_prac_twe_beng=$_POST['twe_prac_twe_beng'];
	    $twe_prac_twe_eng=$_POST['twe_prac_twe_eng'];
	    $twe_prac_twe_edu=$_POST['twe_prac_twe_edu'];
	    $twe_prac_twe_hist=$_POST['twe_prac_twe_hist'];
	    $twe_prac_twe_pol_sc=$_POST['twe_prac_twe_pol_sc'];

	     if(($m1>=101||$m1<0)||($m2>=101||$m2<0)||($m3>=101||$m3<0)||($m4>=101||$m4<0))
	    {
	      $mad=true;
	   
	    }
	    if(($elv_beng>=81||$elv_beng<0)||($elv_eng>=81||$elv_eng<0)||($elv_edu>=81||$elv_edu<0)||($elv_pol_sc>=81||$elv_pol_sc<0)||($elv_hist>=81||$elv_hist<0)||($elv_psy>=71||$elv_psy<0))

	    {
	    	$hs=true;
	    }
	    if(( $twe_prac_twe_beng>=21 || $twe_prac_twe_beng<0)||( $twe_prac_twe_eng>=21 || $twe_prac_twe_eng<0)||( $twe_prac_twe_edu>=21 || $twe_prac_twe_edu<0)||( $twe_prac_twe_hist>=21 || $twe_prac_twe_hist<0)||( $twe_prac_twe_pol_sc>=21 || $twe_prac_twe_pol_sc<0)||( $twe_prac_psy>=31 || $twe_prac_psy<0))
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
	        $new_edu=$madh_thir+ceil(($elv_edu*48)/80)+$twe_prac_twe_edu;
	        $new_pol_sc=$madh_thir+ceil(($elv_pol_sc*48)/80)+$twe_prac_twe_pol_sc;
	        $new_hist=$madh_thir+ceil(($elv_hist*48)/80)+$twe_prac_twe_hist;

	        $new_psy=$madh_twe+ceil(($elv_psy*42)/70)+$twe_prac_psy;

	        $min=min($new_beng, $new_eng,$new_edu,$new_pol_sc,$new_hist,$new_psy);
	        $total=($new_beng+ $new_eng+$new_edu+$new_pol_sc+$new_hist+$new_psy)-$min;
	        $percent=round((($total*100)/500),2);
	        $show=true;
	        $sql="insert into hs values(NULL,'$username','$phone','$total','$percent','Arts')";
        	$sql_run=mysqli_query($con,$sql);
        	
	    }


	}



 ?>




<div class="container">
	<br>
 
	<h1>Check Your Arts HS result </h1>
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
        <li class='list-group-item'>Education:-$new_edu</li>
        <li class='list-group-item'>Political Science/Sociology:-$new_pol_sc</li>
        <li class='list-group-item'>History:-$new_hist</li>
        <li class='list-group-item'>Geography/Psychology :-$new_psy</li>
        <li class='list-group-item list-group-item-success'>Best Of 5 marks :- $total</li>
        <li class='list-group-item list-group-item-info'>Percent:- $percent %</li>
      </ul>
      
      ";
    }



   ?>
	<hr>
	<form action="hs_arts.php" method="post">
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
      <label for="elv_beng" class="form-label">Bengali</label>
     	 <input type="text" class="form-control" id="elv_beng" name="elv_beng"placeholder="Bengali Marks" 			required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_eng" class="form-label">English</label>
     	 <input type="text" class="form-control" id="elv_eng" name="elv_eng"placeholder="English Marks" 			required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_edu" class="form-label">Education</label>
     	 <input type="text" class="form-control" id="elv_edu" name="elv_edu"placeholder="Education Marks" 			required>
      </div>
      <div class="mb-3 ">
      <label for="elv_pol_sc" class="form-label">Political Science/Sociology</label>
     	 <input type="text" class="form-control" id="elv_pol_sc" name="elv_pol_sc"placeholder="Political Science/Sociology Marks" required>
      </div> 
      <div class="mb-3 ">
      <label for="elv_psy" class="form-label">Geography/Psychology</label>
     	 <input type="text" class="form-control" id="elv_psy" name="elv_psy"placeholder="Geography/Psychology Marks" required>
      </div>
       <div class="mb-3 ">
      <label for="elv_hist" class="form-label">History</label>
     	 <input type="text" class="form-control" id="elv_hist" name="elv_hist"placeholder="History Marks" required>
      </div>
      <hr>
      <h2>Enter your class 12 practical marks outof 30</h2>
        <div class="mb-3 ">
     	 <label for="twe_prac_psy" class="form-label">Geography/Psychology</label>
     	 <input type="text" class="form-control" id="twe_prac_psy" name="twe_prac_psy"placeholder="Geography/Psychology Marks" required>
      </div> 
      <!-- <div class="mb-3 ">
     	 <label for="twe_prac_chem" class="form-label">Chemistry</label>
     	 <input type="text" class="form-control" id="twe_prac_chem" name="twe_prac_chem"placeholder="Chemistry Marks" required>
      </div> 
      <div class="mb-3 ">
     	 <label for="twe_prac_bio_cs" class="form-label">Biology/Computer Science/Statistics/Computer Application</label>
     	 <input type="text" class="form-control" id="twe_prac_bio_cs" name="twe_prac_bio_cs"placeholder="Biology/Computer Science/Statistics/Application Marks" required>
      </div> -->
      <hr>
      <h2>Enter your class 12 practical marks outof 20</h2>
       <div class="mb-3 ">
     	 <label for="twe_prac_twe_beng" class="form-label">Bengali</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_beng" name="twe_prac_twe_beng"placeholder="Bengali Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_eng" class="form-label">English</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_eng" name="twe_prac_twe_eng"placeholder="English Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_edu" class="form-label">Education</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_edu" name="twe_prac_twe_edu"placeholder="Education Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_hist" class="form-label">History</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_hist" name="twe_prac_twe_hist"placeholder="History Marks" required>
      </div>
      <div class="mb-3 ">
     	 <label for="twe_prac_twe_pol_sc" class="form-label">Political Science/Sociology</label>
     	 <input type="text" class="form-control" id="twe_prac_twe_pol_sc" name="twe_prac_twe_pol_sc"placeholder="Political Science/Sociology Marks" required>
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