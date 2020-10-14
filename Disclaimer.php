<?php session_start()?> <!-- Retrieve Session -->
<?php include("./Lab4Common/Header.php")?>

<?php
//Initializing session variable to check if user agree with terms and conditions  
if(isset($_POST)){
  $_SESSION["agree"] = $_POST["agree"];
}
?>

<div class="container main" >
<form action="Disclaimer.php" method="POST">
<h1 style="text-align:center;">Terms and Conditions</h1>
<ul class="list-group">
  <li class="list-group-item">I agree to abide by the Bank's Terms and Conditions and rules. In force and the changes thereto in Terms and Conditions from time to time relating to my account as communicated and made available on the Bank's website. </li>
  <li class="list-group-item">I agree that the bank before opening any deposit account, will carry out a due diligence as required under Know Your Customer guideilines of the bank. I would be required to submit necessary documents or proof, such as identity, address, photograph and such information, I agree to submit the above documents again at periodic intervals, as may be required by the Bank. </li>
  <li class="list-group-item">I agree that the Bank can at its sole direction, amend any of the services/facilities given in my account either wholly or partially at any time by giving me at least 30 days notice and/or provide an option to me to switch to other services/facilities.
  </li>
</ul>

    <input type="checkbox" name="agree" id="yes" value="1">
    <label for="agree">I have read and agree with terms and conditions</label>
    <!-- Checking if checkbox has been submitted -->
    <?php if(isset($_POST["submit"])):?>
    <!-- if user did not checked the checkbox, he will be provided with error message -->
      <?php if(!isset($_POST["agree"])):?>
      <br/>
      <span class="alert-danger" style="margin-top:10px; padding:5px;">
      <?php echo "You have to agree the terms and conditions first";?>
      </span>
      <?php else:?>
      <?php  
        // if user checks the agreement checkbox, he will be redirected to Customer Info page
        header("Location: CustomerInfo.php");
        ?>
        <?endif;?>
    <?php endif;?>
    <div class="form-group" style="margin-top:15px;">

    <button type="submit" class="btn btn-primary" name="submit" id="submit">I Agree with Terms and Conditions</button>
    
    </div>
    </form>
</div>

<?php include("./Lab4Common/Footer.php")?>