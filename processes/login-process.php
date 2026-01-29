<?php
if(isset($_POST["login"])){

    session_start();
    require_once "../config/db-connect.php"; 
    require_once "../models/Account.php";

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //VALIDATIONS
    //Check for empty fields
    if(empty($email) || empty($password)){
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: ../login.php");
        exit();
    }

    //Validate email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error'] = "Invalid email format.";
        header("Location: ../login.php");
        exit();
    }

    //Create an instance of Account class
    $accountInstance = new Account();

    $account = $accountInstance->getAccountByEmail($email, $pdo);

    //If user does not exist, redirect back to login page with error
    if(!$account){
        $_SESSION['error'] = "Account does not exist.";
        header("Location: ../login.php");
        exit();
    }

    // Verify password - use this if passwords are hashed in the database
    if(!password_verify($password, $account['password'])){
        $_SESSION['error'] = "Incorrect password.";
        header("Location: ../login.php");
        exit();
    }

    //Verify if account is active
    if($account['status'] !== 'active'){
        $_SESSION['error'] = "Your account has been deactivated. Please contact support for more info.";
        header("Location: ../login.php");
        exit();
    }

    //Set session variables
    $_SESSION['id'] = $account['id'];
    $_SESSION['email'] = $account['email'];
    $_SESSION['user_type'] = $account['user_type'];

    //Redirect to surveyor dashboard or client dashboard based on user role
    if($account['user_type'] === 'surveyor'){
        header("Location: ../surveyor/dashboard.php");
    } elseif($account['user_type'] === 'client'){
        header("Location: ../client/dashboard.php");
    } else {
        //Unknown user role
        $_SESSION['error'] = "Unknown user role.";
        header("Location: ../login.php");
        exit();
    }
}