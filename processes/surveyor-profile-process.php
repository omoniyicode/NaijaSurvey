<?php

//SAVE SURVEYOR PROFILE (Create or Update)
if(isset($_POST['save_profile'])){

    session_start();
    require_once "../config/db-connect.php";
    require_once "../models/SurveyorProfile.php";

    //Get form data
    $account_id = $_SESSION['id'];
    $first_name = trim($_POST['first_name']);
    $surname = trim($_POST['surname']);
    $other_names = trim($_POST['other_names'] ?? '');
    $phone_number = trim($_POST['phone_number']);
    $whatsapp_number = trim($_POST['whatsapp_number']);
    $years_of_experience = trim($_POST['years_of_experience']);
    $bio = trim($_POST['bio']);
    $state = trim($_POST['state']);
    $lga = trim($_POST['lga']);
    $address = trim($_POST['address']);
    $id_type = trim($_POST['id_type']);
    $surcon_number = trim($_POST['surcon_number']);
    $surveyor_profile_url = "Location: ../surveyor/profile.php";


    //VALIDATIONS
    //Check if user is logged in
    if(!$account_id){
        $_SESSION['error'] = "Please log in to save your profile.";
        header("Location: ../login.php");
        exit();
    }

    //Validate required fields
    if(empty($first_name) || empty($surname) || empty($phone_number) || empty($whatsapp_number) || 
       empty($years_of_experience) || empty($bio) || empty($state) || empty($lga) || 
       empty($address) || empty($id_type) || empty($surcon_number)){
        $_SESSION['error'] = "Please fill in all required fields.";
        header($surveyor_profile_url);
        exit();
    }

    //Validate phone numbers
    if(!preg_match('/^[0-9]{10,15}$/', $phone_number)){
        $_SESSION['error'] = "Invalid phone number format.";
        header($surveyor_profile_url);
        exit();
    }

    if(!preg_match('/^[0-9]{10,15}$/', $whatsapp_number)){
        $_SESSION['error'] = "Invalid WhatsApp number format.";
        header($surveyor_profile_url);
        exit();
    }

    //Validate years of experience
    if(!is_numeric($years_of_experience) || $years_of_experience < 0){
        $_SESSION['error'] = "Invalid years of experience.";
        header($surveyor_profile_url);
        exit();
    }

    //Create instance of SurveyorProfile
    $surveyorProfileInstance = new SurveyorProfile();

    //Check if profile already exists
    $existing_profile = $surveyorProfileInstance->getSurveyorProfileByAccountId($account_id, $pdo);
    $is_update = $existing_profile ? true : false;

    //Initialize file variables
    $profile_image = $is_update ? $existing_profile['profile_image'] : null;
    $id_document = $is_update ? $existing_profile['id_document'] : null;

    //Handle profile image upload
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE){
        $upload_dir = "../uploads/profile_images/";
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $max_size = 2097152; // 2MB
        
        $upload_result = $surveyorProfileInstance->uploadFile($_FILES['profile_image'], $upload_dir, $allowed_extensions, $max_size, 'profile_');

        if(!$upload_result['success']){
            $_SESSION['error'] = "Profile image upload failed: " . $upload_result['message'];
            header($surveyor_profile_url);
            exit();
        }

        //Delete old profile image if updating
        if($is_update && $profile_image && file_exists($upload_dir . $profile_image)){
            unlink($upload_dir . $profile_image);
        }

        $profile_image = $upload_result['filename'];
    }

    //Handle ID document upload
    if(isset($_FILES['id_document']) && $_FILES['id_document']['error'] !== UPLOAD_ERR_NO_FILE){
        $upload_dir = "../uploads/id_documents/";
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $max_size = 5242880; // 5MB
        
        $upload_result = $surveyorProfileInstance->uploadFile($_FILES['id_document'], $upload_dir, $allowed_extensions, $max_size, 'id_');

        if(!$upload_result['success']){
            $_SESSION['error'] = "ID document upload failed: " . $upload_result['message'];
            header($surveyor_profile_url);
            exit();
        }

        //Delete old ID document if updating
        if($is_update && $id_document && file_exists($upload_dir . $id_document)){
            unlink($upload_dir . $id_document);
        }

        $id_document = $upload_result['filename'];
    }

    //Save the profile (Create or Update)
    if($is_update){
        //Update existing profile
        $result = $surveyorProfileInstance->editSurveyorProfileByAccountId(
            $account_id, $first_name, $surname, $other_names, $phone_number, $whatsapp_number,
            $years_of_experience, $bio, $state, $lga, $address, $profile_image, $id_type,
            $id_document, $surcon_number, $pdo
        );

        if($result){
            $_SESSION['success'] = "Profile updated successfully.";
            header("Location: ../surveyor/profile.php");
            exit();
        } else {
            $_SESSION['error'] = "No changes were made or update failed.";
            header($surveyor_profile_url);
            exit();
        }
    } else {
        //Create new profile
        $result = $surveyorProfileInstance->createSurveyorProfile(
            $account_id, $first_name, $surname, $other_names, $phone_number, $whatsapp_number,
            $years_of_experience, $bio, $state, $lga, $address, $profile_image, $id_type,
            $id_document, $surcon_number, $pdo
        );

        if($result){
            $_SESSION['success'] = "Profile created successfully.";
            header("Location: ../surveyor/profile.php");
            exit();
        } else {
            $_SESSION['error'] = "Profile creation failed. Please try again.";
            header($surveyor_profile_url);
            exit();
        }
    }
}