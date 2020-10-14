<?php session_start();?> <!-- Retrieve session -->
<?php include("./Lab4Common/Header.php");?> <!-- Include header of the page -->
<?php include("./Lab4Common/Functions.php");?> <!-- Include all of the necessary functions  -->



<?php 

// Check wether agree checkbox is set or not 
if(!isset($_SESSION["agree"])){
    // if true user will be redirected to disclaimer page
    header("Location: Disclaimer.php");
    exit();
}


// Initialize all necessary variables 
$errorArray = array();
$customerInfo = array();
$_SESSION["customerInfo"] = $customerInfo;
$name = $_POST["name"];
$postalCode =  $_POST["postalCode"];
$phoneNumber = $_POST["phoneNumber"];
$emailAddress = $_POST["emailAddress"];
$contactMethod = $_POST["contactMethod"];
$contactTime = $_POST["contactTime"];

$validate = FALSE;

// Variables for checkboxes and radio buttons
$phoneCheck = "";
$emailCheck = "";
$morningCheck = "";
$afternoonCheck = "";
$eveningCheck = "";

    if(isset($_POST["submit"]))
    {
        // Validation
        $nameError = ValidateName($name);
        if(!empty($nameError)){
            $errorArray["nameError"] = $nameError;
            $customerInfo["nameInfo"] = $name;
        }else{
            $customerInfo["nameInfo"] = $name;
        }

        $postalError = ValidatePostalCode($postalCode);
        if(!empty($postalError)){
          $errorArray['postalCode'] = $postalError;
          $customerInfo["postalInfo"] = $postalCode;
        }else{
            $customerInfo["postalInfo"] = $postalCode;
        }

        $phoneNumberError = ValidatePhoneNumber($phoneNumber);
        if(!empty($phoneNumberError)){
            $errorArray["phoneNumberError"] = $phoneNumberError;
            $customerInfo["phoneInfo"] = $phoneNumber;
        }else{
            $customerInfo["phoneInfo"] = $phoneNumber;
        }

        $emailAddressError = ValidateEmail($emailAddress);
        if(!empty($emailAddressError)){
            $errorArray["emailError"] = $emailAddressError;
            $customerInfo["emailInfo"] = $emailAddress;
        }else{
            $customerInfo["emailInfo"] = $emailAddress;
        }

        if (!isset($contactMethod)) {
            $errorArray["contactMethod"] = "Contact method is required";
        }else{
            $customerInfo["contactMethodInfo"] = $contactMethod;
        }

        if ($contactMethod == "phone" && !isset($contactTime)) {
            $errorArray["contactTime"] = "If phone is contact method, time must be selected";
        }else{
            $customerInfo["contactTimeInfo"] = $contactTime;
        }

        // Keep checked radio buttons checked, when user submits form 
        switch($customerInfo["contactMethodInfo"])
        {
            case "phone":
                $phoneCheck = "checked";
                $emailCheck = "";
            break;

            case "email":
                $phoneCheck = "";
                $emailCheck = "checked";
            break;

            default:
            $phoneCheck="";
            $emailCheck="";
        break;
        }

        // Keep all checked checkboxes, when user submits form 
        if(isset($customerInfo["contactTimeInfo"]))
        {
        foreach ($customerInfo["contactTimeInfo"] as $key => $value)
        {
            if($value == "Morning")
            {
                $morningCheck = "checked";
            }else if($value == "Afternoon")
            {
                $afternoonCheck = "checked";
            }else if($value == "Evening")
            {
                $eveningCheck = "checked";
            }
        }
        }
        
        // if users input is valid and array of errors is empty variable validate is set to true
        if(empty($errorArray))
        {
            $validate = TRUE;
            
        }
        
    }

    if($validate)
    {
        // assigning session variables
        $_SESSION['errorArray1'] = $errorArray;
        $_SESSION["customerInfo"] = $customerInfo;
        // redirect user to Deposit Calculator Page
        header("Location: DepositCalculator.php");
        exit();
    }
?>



<div class="container">
    <form action="CustomerInfo.php" method="POST" name="customerInfo">
    <h2>Customer Information</h2>
    <hr>
        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;">Name:</span>
            <div class="col-sm-6">
                <input type="text" name="name" class="form-control w-25" id="name" value="<?php echo isset($customerInfo["nameInfo"]) ? $customerInfo["nameInfo"] : '' ?>">
            </div>
            <?php if(!empty($errorArray["nameError"])):?>
                <span class="alert-danger" style="">
                <?php echo $errorArray["nameError"];?>
                </span>
            <?endif;?>
        </div>

        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;" >Postal Code:</span>
            <div class="col-sm-6">
                <input type="text" name="postalCode" class="form-control w-25" id="postalCode" value="<?php echo isset($customerInfo["postalInfo"]) ? $customerInfo["postalInfo"] : '' ?>">
            </div>
            <?php if(!empty($errorArray["postalCode"])):?>
                <span class="alert-danger" style="">
                <?php echo $errorArray["postalCode"];?>
                </span>
            <?endif;?>
        </div>

        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;">Phone Number:</span>
            <div class="col-sm-6">
                <input type="phone" name="phoneNumber" class="form-control w-25" id="phoneNumber" placeholder="(nnn)-(nnn)-(nnnn)" value="<?php echo isset($customerInfo["phoneInfo"]) ? $customerInfo["phoneInfo"] : '' ?>">
            </div>
            <?php if(!empty($errorArray["phoneNumberError"])):?>
                <span class="alert-danger" style="">
                <?php echo $errorArray["phoneNumberError"];?>
                </span>
            <?endif;?>
        </div>

        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;">Email Address:</span>
            <div class="col-sm-6">
                <input type="email" name="emailAddress" class="form-control w-25" id="emailAdrdess" value="<?php echo isset($customerInfo["emailInfo"]) ? $customerInfo["emailInfo"] : '' ?>">
            </div>
            <?php if (!empty($errorArray["emailError"])) : ?>
                    <span class="alert-danger p-1">
                    <?php echo $errorArray["emailError"]; ?>
                    </span>
                    <?php endif; ?>
        </div>
        <hr>
        
        <div class="form-group row">
                <label class="col-sm-3 col-form-label">Preferred Contact Method:</label>
                <div class="col-sm-9">
                    <div class="form-check" style="padding:10px;">
                        <label for="phoneMethod" class="form-check-label">
                            <input type="radio" name="contactMethod" id="phoneMethod" value="phone" class="form-check-input"  <?php echo $phoneCheck; ?> />
                            Phone
                        </label>
                        <label for="emailMethod" class="form-check-label">
                            <input type="radio" name="contactMethod" id="emailMethod" value="email" <?php echo $emailCheck; ?>  />
                            Email
                        </label>
                    </div>
                    <?php if (!empty($errorArray["contactMethod"])) : ?>
                    <span class="alert-danger p-1">
                    <?php echo $errorArray["contactMethod"]; ?>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <label class="col-sm-3 col-form-label">If phone is selected, when can we contact you? (Check all applicable)</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <label for="morning" class="form-check-label">
                                <input type="checkbox" name="contactTime[]" value="Morning"  class="form-check-input" <?php echo $morningCheck;?>/>
                                Morning
                            </label>
                        
                        
                            <label for="morning" class="form-check-label">
                                <input type="checkbox" name="contactTime[]" value="Afternoon"  class="form-check-input" <?php echo $afternoonCheck;?>/>
                                Afternoon
                            </label>
                        
                        
                            <label for="evening" class="form-check-label">
                                <input type="checkbox" name="contactTime[]" value="Evening"  class="form-check-input" <?php echo $eveningCheck;?>/>
                                Evening
                            </label>
                        </div>
                    </div>
                    <?php if (!empty($errorArray["contactTime"])) : ?>
                    <span class="alert-danger p-1">
                    <?php echo $errorArray["contactTime"]; ?>
                    </span>
                    <?php endif; ?>
                </div>
            </fieldset>

            <div class="form group row">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <button name="reset" value="reset" class="btn btn-danger">Clear</button>
            </div>
    </form>
</div>
<?php include("./Lab4Common/Footer.php");?>