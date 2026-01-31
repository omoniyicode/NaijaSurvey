<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'client') {
    $_SESSION['error'] = "Unauthorized action.";
    header("Location: ../jobs.php");
    exit();
}

if(isset($_POST['post_job'])){

    session_start();
    require_once "../config/db-connect.php"; 
    require_once "../models/Job.php";
    require_once "../models/ClientProfile.php";

    $job_title = trim($_POST['job_title']);
    $job_description = trim($_POST['job_description']);
    $proposed_budget = trim($_POST['proposed_budget']);
    $job_state = trim($_POST['job_state']);
    $job_lga = trim($_POST['job_lga']);
    $job_address = trim($_POST['job_address']);
    $url = "Location: ../jobs.php";

    //VALIDATIONS
    //Check if user is logged in
    if(!isset($_SESSION['id'])){
        $_SESSION['error'] = "You must be logged in to post a job.";
        header("Location: ../login.php");
        exit();
    }

    //Check if user is a client
    if($_SESSION['user_type'] !== 'client'){
        $_SESSION['error'] = "Only clients can post jobs.";
        header($url);
        exit();
    }

    //Validate required fields
    if(empty($job_title) || empty($job_description) || empty($proposed_budget) || empty($job_state) || empty($job_lga) || empty($job_address)){
        $_SESSION['error'] = "Please fill in all required fields.";
        header($url);
        exit();
    }

    //Validate budget is numeric and positive
    if(!is_numeric($proposed_budget) || $proposed_budget <= 0){
        $_SESSION['error'] = "Please enter a valid budget amount.";
        header($url);
        exit();
    }

    //Get client profile ID
    $account_id = $_SESSION['id'];
    $clientProfileInstance = new ClientProfile();
    $clientProfile = $clientProfileInstance->getClientProfileByAccountId($account_id, $pdo);

    //Check if client profile exists
    if(!$clientProfile){
        $_SESSION['error'] = "Please complete your profile before posting a job.";
        header("Location: ../client/profile.php");
        exit();
    }

    // Client account must be verified
    if ($clientProfile['verification_status'] !== 'verified') {
        $_SESSION['error'] = "Your account must be verified to post a job.";
        header($url);
        exit();
    }

    $client_profile_id = $clientProfile['id'];

    //Create an instance of Job class
    $jobInstance = new Job();

    //Add the job
    if($jobInstance->addJob($client_profile_id, $job_title, $job_description, $proposed_budget, $job_state, $job_lga, $job_address, $pdo)){
        //Redirect with success message
        $_SESSION['success'] = "Job posted successfully!";
        header($url);
        exit();
    } else {
        //Job creation failed
        $_SESSION['error'] = "Failed to post job. Please try again.";
        header($url);
        exit();
    }
}
