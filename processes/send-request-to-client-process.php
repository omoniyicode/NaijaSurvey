<?php
if(isset($_POST['apply_for_job'])){

    session_start();
    require_once "../config/db-connect.php"; 
    require_once "../models/Request.php";
    require_once "../models/SurveyorProfile.php";

    $job_id = trim($_POST['job_id']);
    $client_profile_id = trim($_POST['client_profile_id']);
    $url = "Location: ../jobs.php";

    //VALIDATIONS
    //Check if user is logged in
    if(!isset($_SESSION['id'])){
        $_SESSION['error'] = "You must be logged in to apply for jobs.";
        header("Location: ../login.php");
        exit();
    }

    //Check if user is a surveyor
    if($_SESSION['user_type'] !== 'surveyor'){
        $_SESSION['error'] = "Only surveyors can apply for jobs.";
        header($url);
        exit();
    }

    //Validate required fields
    if(empty($job_id) || empty($client_profile_id)){
        $_SESSION['error'] = "Invalid job application. Please try again.";
        header($url);
        exit();
    }

    //Validate IDs are numeric
    if(!is_numeric($job_id) || !is_numeric($client_profile_id)){
        $_SESSION['error'] = "Invalid job data.";
        header($url);
        exit();
    }

    //Get surveyor profile ID
    $account_id = $_SESSION['id'];
    $surveyorProfileInstance = new SurveyorProfile();
    $surveyorProfile = $surveyorProfileInstance->getSurveyorProfileByAccountId($account_id, $pdo);

    //Check if surveyor profile exists
    if(!$surveyorProfile){
        $_SESSION['error'] = "Please complete your profile before applying for jobs.";
        header("Location: ../surveyor/profile.php");
        exit();
    }

    // Surveyor must be verified
    if ($surveyorProfile['verification_status'] !== 'verified') {
        $_SESSION['error'] = "Your account must be verified to apply for jobs.";
        header($url);
        exit();
    }

    $surveyor_profile_id = $surveyorProfile['id'];

    //Create an instance of Request class
    $requestInstance = new Request();

    //Check if surveyor has already applied for this job
    try {
        if($requestInstance->surveyorHasAppliedForThisJob($job_id, $surveyor_profile_id, $pdo)){
            $_SESSION['error'] = "You have already applied for this job.";
            header($url);
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error checking application status.";
        header($url);
        exit();
    }

    //Create the request to client
    if($requestInstance->createRequestToClient($job_id, $surveyor_profile_id, $client_profile_id, $pdo)){
        //Redirect with success message
        $_SESSION['success'] = "Job application submitted successfully! Always check your dashboard for updates.";
        header($url);
        exit();
    } else {
        //Request creation failed
        $_SESSION['error'] = "Failed to submit application. Please try again.";
        header($url);
        exit();
    }
}
