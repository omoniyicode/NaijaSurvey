<?php
if(isset($_POST['register'])){

    session_start();
    require_once "../config/db-connect.php"; 
    require_once "../models/Account.php";

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $user_type = trim($_POST['user_type']);
    $url = "Location: ../register.php";

    //VALIDATIONS
    //Validate required fields
    if(empty($email) || empty($password) || empty($confirm_password) || empty($user_type)){
        $_SESSION['error'] = "Please fill in all required fields.";
        header($url);
        exit();
    }

    //Validate email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = "Invalid email format.";
        header($url);
        exit();
    }

    //Password must be at least 6 characters
    if(strlen($password) < 6){
        $_SESSION['error'] = "Password must be at least 6 characters long.";
        header($url);
        exit();
    }

    //Confirm password match
    if($password !== $confirm_password){
        $_SESSION['error'] = "Passwords do not match.";
        header($url);
        exit();
    }

    //Create an instance of Account class
    $accountInstance = new Account();

    $account = $accountInstance->getAccountByEmail($email, $pdo);

    //Check if account already exists
    if($account){
        $_SESSION['error'] = "An account with this email already exists.";
        header($url);
        exit();
    }

    //Create the account
    if($accountInstance->createAccount($email, $password, $user_type, $pdo)){
        //Redirect to login page with success message
        $_SESSION['success'] = "Account created successfully. Please log in.";
        header("Location: ../login.php");
        exit();
    } else {
        //Account creation failed
        $_SESSION['error'] = "Account creation failed. Please try again.";
        header($url);
        exit();
    }
}