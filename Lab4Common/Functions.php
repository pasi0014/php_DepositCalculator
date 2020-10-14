<?php

function ValidatePrincipal($principalAmount)
{
  if(empty($principalAmount)){
    return "Principal Amount is required";
  }
  if(!is_numeric($principalAmount) || $principalAmount <= 0 ){
    return 'Principal Amount must be numeric and greater than zero';
  }else{
    return "";
  }
}

function ValidateInterest($interestRate)
{
  if(empty($interestRate)){
    return "Interest Rate is required";
  }
  if(!is_numeric($interestRate) || $interestRate<=0){
    return "Interest Rate must be numeric and not negative";
  }else{
    return "";
  }
}

function ValidateYearsToDeposit($yearsToDeposit)
{
  if($yearsToDeposit[0] == "0"){
    return "Required years to deposit";
  }
  else{
    return "";
  }
}

function ValidateName($name){
    if(empty($name)){
      return "Name is required";
    }else{
      return "";
    }
  }

  function ValidatePostalCode($postalCode) {
    if ($postalCode === "") {
        return "Postal code is required";
    }
    if (preg_match("/[a-z]\d[a-z]\ ?\d[a-z]\d$/i", $postalCode) === 1) {
        return "";
    }
    return "Postal code is invalid";
}

  function ValidatePhoneNumber($phoneNumber){
    if(empty($phoneNumber)){
      return "Phone Number is required";
    }
    if(preg_match("/^[0-9]{3}-[0-9]{3}-\d{4}$/", $phoneNumber) === 1){
      return "";
    }else{
      return "Phone Number is invalid";
    }
  }
  
  function ValidateEmail($email){
    if(empty($email)){
      return "Email Address is required";
    }
    if(preg_match("/[A-Za-z\d.]+\@[A-Za-z\d]+\.[A-Za-z.]{2,4}$/", $email) === 1){
      return "";
    }else{
      return "Email Address in invalid";
    }
  }


?>