<?php 
 include 'header.php';
 $nine_flag=false;
 $ten_flag=false;
 $res=false;
?>
<?php 

    if(isset($_POST['submit']))
    {
        // $bengali=mysqli_real_escape_string($con, $_POST['eng']);
      $username=mysqli_real_escape_string($con,$_POST['username']);
      $phone=mysqli_real_escape_string($con,$_POST['phone']);

       $bengali=$_POST['beng'];
       $english=$_POST['eng'];
       $math=$_POST['math'];
       $history=$_POST['hist'];
       $geography=$_POST['geo'];
       $phy_sc=$_POST['psc'];
       $life_sc=$_POST['lsc'];



       // class 10 marks
       $ten_bengali=$_POST['ten_beng'];
       $ten_english=$_POST['ten_eng'];
       $ten_math=$_POST['ten_math'];
       $ten_history=$_POST['ten_hist'];
       $ten_geo=$_POST['ten_geo'];
       $ten_phy_sc=$_POST['ten_psc'];
       $ten_life_sc=$_POST['ten_lsc'];

       if(($bengali>=101||$bengali<0)||($english>=101||$english<0)||($math>=101||$math<0)||($history>=101||$history<0)||($geography>=101||$geography<0)||($phy_sc>=101||$phy_sc<0)||($life_sc>=101||$life_sc<0))
       {
          $nine_flag=true;
       }
       if(($ten_bengali>=11||$ten_bengali<0)||($ten_english>=11||$ten_english<0)||($ten_math>=11||$ten_math<0)||($ten_history>=11||$ten_history<0)||($ten_geo>=11||$ten_geo<0)||($ten_phy_sc>=11||$ten_phy_sc<0)||($ten_life_sc>=11||$ten_life_sc<0))
       {
          $ten_flag=true;
       }

       $res_bengali=ceil($bengali/2)+($ten_bengali*5);
       $res_english=ceil($english/2)+($ten_english*5);
       $res_math=ceil($math/2)+($ten_math*5);
       $res_history=ceil($history/2)+($ten_history*5);
       $res_geo=ceil($geography/2)+($ten_geo*5);
       $res_phy_sc=ceil($phy_sc/2)+($ten_phy_sc*5);
       $res_life_sc=ceil($life_sc/2)+($ten_life_sc*5);

       $total=$res_bengali+$res_english+$res_math+ $res_history+$res_geo+$res_phy_sc+$res_life_sc;
       $percent=round((($total*100)/700),2);
      $res=true;
      $sql="insert into madhya values (NULL,'$username','$phone','$total','$percent')";
      $sql_run=mysqli_query($con,$sql);
    


       

    }


   ?>
<div class="container">
    <h1>Check Your Madhyamik result</h1>
    <hr>
    <?php 

      if($nine_flag)
      {
        echo "<div class='alert alert-danger' role='alert'>
                     Class 9 data is invalid ! check and submit again
                    </div>";
        // echo "ji";
      }
      if($ten_flag)
      {
        echo "<div class='alert alert-danger' role='alert'>
                     Class 10 data is invalid ! check and submit again
                    </div>";
        // echo "ji";
      }

     ?>
  
    <!-- <hr> -->

  <form action="madh_form.php" method="post"> 
     <div class="mb-3 ">
      <label for="username" class="form-label">Name</label>
      <input type="text" class="form-control" id="username" name="username"placeholder="Name" required>
    </div>
    <div class="mb-3 ">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="number" class="form-control" id="phone" name="phone"placeholder="Phone Number" required>
    </div>
    <h2>Enter Your class 9 final marks of 7 subject out of 100</h2>
    <div class="mb-3 ">
      <label for="beng" class="form-label">Bengali</label>
      <input type="text" class="form-control" id="beng" name="beng"placeholder="Bengali marks" required>
    </div>
    <div class="mb-3">
      <label for="eng" class="form-label">English</label>
      <input type="text" class="form-control" id="eng" name="eng"placeholder="English marks" required>
    </div>
    <div class="mb-3">
      <label for="math" class="form-label">Math</label>
      <input type="text" class="form-control" id="math" name="math" placeholder="Math marks" required>
    </div>
    <div class="mb-3">
      <label for="hist" class="form-label">History</label>
      <input type="text" class="form-control" id="hist" name="hist" placeholder="History marks" required>
    </div>
    <div class="mb-3">
      <label for="geo" class="form-label">Geography</label>
      <input type="text" class="form-control" id="geo" name="geo" placeholder="Geography marks" required>
    </div>
    <div class="mb-3">
      <label for="psc" class="form-label">Physical Science</label>
      <input type="text" class="form-control" id="psc" name="psc" placeholder="Physical Science marks" required>
    </div>
    <div class="mb-3">
      <label for="lsc" class="form-label">Life Science</label>
      <input type="text" class="form-control" id="lsc" name="lsc" placeholder="Life Science marks" required>
    </div>
    <hr>
    <h2>Now enter your class 10 practical or internal assessment marks of 7 subjects out of 10</h2>
    <div class="mb-3 ">
      <label for="ten_beng" class="form-label">Bengali</label>
      <input type="text" class="form-control" id="ten_beng" name="ten_beng"placeholder="Bengali marks" required>
    </div>
    <div class="mb-3">
      <label for="ten_eng" class="form-label">English</label>
      <input type="text" class="form-control" id="ten_eng" name="ten_eng"placeholder="English marks" required>
    </div>
    <div class="mb-3">
      <label for="ten_math" class="form-label">Math</label>
      <input type="text" class="form-control" id="ten_math" name="ten_math" placeholder="Math marks" required>
    </div>
    <div class="mb-3">
      <label for="ten_hist" class="form-label">History</label>
      <input type="text" class="form-control" id="ten_hist" name="ten_hist" placeholder="History marks" required>
    </div>
    <div class="mb-3">
      <label for="ten_geo" class="form-label">Geography</label>
      <input type="text" class="form-control" id="ten_geo" name="ten_geo" placeholder="Geography marks" required>
    </div>
    <div class="mb-3">
      <label for="ten_psc" class="form-label">Physical Science</label>
      <input type="text" class="form-control" id="ten_psc" name="ten_psc" placeholder="Physical Science marks" required>
    </div>
    <div class="mb-3">
      <label for="ten_lsc" class="form-label">Life Science</label>
      <input type="text" class="form-control" id="ten_lsc" name="ten_lsc" placeholder="Life Science marks" required>
    </div>


    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>


  <?php 

  if($res)
  {
    echo "<hr>";
    echo "<h1>Your result will be </h1>";
    echo " <ul class='list-group'>
      <li class='list-group-item'>Bengali:- $res_bengali</li>
      <li class='list-group-item'>English:-$res_english </li>
      <li class='list-group-item'>Math:-$res_math</li>
      <li class='list-group-item'>Life Science:-$res_life_sc</li>
      <li class='list-group-item'>Physical Science:-$res_phy_sc</li>
      <li class='list-group-item'>History :-$res_history</li>
      <li class='list-group-item'>Geography:-$res_geo</li>
      <li class='list-group-item list-group-item-success'>Total:- $total</li>
      <li class='list-group-item list-group-item-info'>Percent:- $percent %</li>
    </ul>";
  }
       



   ?>

</div>
<br>




<?php 
  include 'footer.php';
 ?>
   






