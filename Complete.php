<?php session_start();?>
<?php include("./Lab4Common/Header.php")?>

<?php

$customerInfo = $_SESSION["customerInfo"];

?>

<div class="container" style="padding:30px; margin-top:40px;">

<?php if(!isset($_SESSION["customerInfo"])):?>
    <h1>Thank you, for using our deposit calculation tool!</h1>
<?php else:?>
    <?php $customerInfo = $_SESSION["customerInfo"];?>
    <h1>Thank you <?php  echo ", <span class='text-primary'>" . $customerInfo["nameInfo"] . "</span>,"; ?> for using our deposit calculation tool!</h1>
    <div class="div-success">
    <?php if($customerInfo["contactMethodInfo"] == "phone"): ?>
        <p>Our customer service department will call you tomorrow <?php for ($i = 0; $i < count($customerInfo["contactTimeInfo"]); $i++) { if ($i < count($customerInfo["contactTimeInfo"]) - 1) { echo $customerInfo["contactTimeInfo"][$i] . " or "; continue; } echo $customerInfo["contactTimeInfo"][$i]; } ?> at <?php echo $customerInfo["phoneInfo"]; ?>.</p>
    <?php elseif($customerInfo["contactMethodInfo"]=="email"):?>
    <p>An email about the details of our GIC has been sent to <?php echo $customerInfo["emailInfo"]; ?></p>
    <?php endif;?>
    </div>
<?php endif;?>
</div>


<?php session_destroy();?>
<?php include("./Lab4Common/Footer.php")?>