<?php session_start();?> <!--Retrieve session-->
<?php include("./Lab4Common/Header.php")?> <!--Include header of the page-->
<?php include("./Lab4Common/Functions.php")?> <!--Include all necessary functions-->

<?php

// if user tries to access page, when agreement isn't set he will be redirected back to Disclaimer page
if(!isset($_SESSION["agree"]))
{
    header("Location: Disclaimer.php");
    exit();
}
// If users input on Customer Info page is not valid and have errors, he will be redirected back to Customer Info page
if(!isset($_SESSION["errorArray1"]) && empty($_SESSION["errorArray1"]))
{
    header("Location: CustomerInfo.php");  
    exit();
}



// Initializing variables
$customerInfo = $_SESSION["customerInfo"];
$calculator = array();
$_SESSION["calculator"] = $calculator;
$principalAmount = $_POST["principalAmount"];
$interestRate = $_POST["interestRate"];
$yearsToDeposit = $_POST["yearsToDeposit"];
$_SESSION["yearsToDeposit"] = $yearsToDeposit;
$errorArray = array();
$validate = false;




if(isset($_POST["calculate"]))
{
    // Validations
    $principalError = ValidatePrincipal($principalAmount);
    if(!empty($principalError)){
        $errorArray["principalError"] = $principalError;
        $calculator["principal"] = $principalAmount;
    }else
    {
        $calculator["principal"] = $principalAmount;
    }

    $interestError = ValidateInterest($interestRate);
    if(!empty($interestError))
    {
        $errorArray["interestError"] = $interestError;
        $calculator["interest"] = $interestRate;
    }else
    {
        $calculator["interest"] = $interestRate;
    }

    $yearsToDepositError = ValidateYearsToDeposit($yearsToDeposit);
    if(!empty($yearsToDepositError)){
        $errorArray["yearsToDepositError"] = $yearsToDepositError;
        $calculator["yearsToDeposit"] = $yearsToDeposit;
    }else
    {
        $calculator["yearsToDeposit"] = $yearsToDeposit;
    }
    // if array of errors is empty validate variable is set to true
    if(empty($errorArray)){
        $validate = true;
    }
}





?>

<div class="container">
    <form action="DepositCalculator.php" name="depositCalculator" method="POST">
        <h4 style="text-align:left; padding:20px;">Enter principal amount, interest rate and select number of years to deposit</h4>
        <hr>
        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;" >Principal Amount:</span>
            <div class="col-sm-6">
                <input type="text" name="principalAmount" class="form-control w-25" id="number" value="<?php echo isset($calculator["principal"]) ? $calculator["principal"] : '' ?>">
            </div>
            <?php if(!empty($errorArray["principalError"])):?>
                <span class="alert-danger" style="">
                <?php echo $errorArray["principalError"];?>
                </span>
            <?endif;?>
        </div>

        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;" >Interest Rate (%):</span>
            <div class="col-sm-6">
                <input type="text" name="interestRate" class="form-control w-25" id="interestRate" value="<?php echo isset($calculator["interest"]) ? $calculator["interest"] : '' ?>">
            </div>
            <?php if(!empty($errorArray["interestError"])):?>
                <span class="alert-danger" style="">
                <?php echo $errorArray["interestError"];?>
                </span>
            <?endif;?>
        </div>

        <div class="form-gourp row" style="padding:10px;">
            <span class="col-sm-2 col-form-label" style="font-weight:600;" >Years to Deposit:</span>
            <div class="col-sm-6">
               <select name="yearsToDeposit" id="yearsToDeposit" class="form-control w-25" >
                   <option value="0">Select..</option>
                   <!-- Keeping selected value after form submission -->
                   <option value="1" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '1') ? 'selected' : ''; ?>>1</option>
                   <option value="2" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '2') ? 'selected' : ''; ?> >2</option>
                   <option value="3" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '3') ? 'selected' : ''; ?>>3</option>
                   <option value="4" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '4') ? 'selected' : ''; ?>>4</option>
                   <option value="5" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '5') ? 'selected' : ''; ?>>5</option>
                   <option value="6" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '6') ? 'selected' : ''; ?>>6</option>
                   <option value="7" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '7') ? 'selected' : ''; ?>>7</option>
                   <option value="8" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '8') ? 'selected' : ''; ?>>8</option>
                   <option value="9" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '9') ? 'selected' : ''; ?>>9</option>
                   <option value="10" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '10') ? 'selected' : ''; ?>>10</option>
                   <option value="11" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '11') ? 'selected' : ''; ?>>11</option>
                   <option value="12" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '12') ? 'selected' : ''; ?>>12</option>
                   <option value="13" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '13') ? 'selected' : ''; ?>>13</option>
                   <option value="14" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '14') ? 'selected' : ''; ?>>14</option>
                   <option value="15" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '15') ? 'selected' : ''; ?>>15</option>
                   <option value="16" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '16') ? 'selected' : ''; ?>>16</option>
                   <option value="17" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '17') ? 'selected' : ''; ?>>17</option>
                   <option value="18" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '18') ? 'selected' : ''; ?>>18</option>
                   <option value="19" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '19') ? 'selected' : ''; ?>>19</option>
                   <option value="20" <?php echo (isset($_SESSION['yearsToDeposit']) && $_SESSION['yearsToDeposit'] === '20') ? 'selected' : ''; ?>>20</option>
               </select>
            </div>
            <?php if(!empty($errorArray["yearsToDepositError"])):?>
                <span class="alert-danger" style="">
                <?php echo $errorArray["yearsToDepositError"];?>
                </span>
            <?endif;?>
        </div>

        <div class="form-group row" style="padding:20px;">
            <button type="submit" name="calculate" class="btn btn-primary">Calculate</button>
            <button name="reset" value="reset" class="btn btn-warning" onclick="$('select').prop('selectedIndex',0);">Clear</button>
        </div>

    </form>
</div>
<!-- If validate variable is true this block is excecuted -->
<?php if ($validate) : ?>
    <div class="result-panel container">
            <p>The following is the result of the calculation:</p>
            <table id="tblResult" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Principal at Year Start</th>
                        <th>Interest for the Year</th>
                    </tr>
                </thead>
                <tbody>
                <!-- Calculations and displaying table -->
                    <?php for ($i = 1; $i <= $yearsToDeposit; $i++) : ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php printf("\$%.2f", $principalAmount); ?></td>
                        <td><?php $interest = $principalAmount * $interestRate / 100; $principalAmount += $interest; printf("\$%.2f", $interest); ?></td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>

    </div>
<?php endif;?>



<?php include("./Lab4Common/Footer.php")?> <!-- Including footer of the page -->