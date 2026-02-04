<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'surveyor') {
    header("Location: ../../login.php");
    exit();
}

require_once "../../config/db-connect.php";
require_once "../../models/SurveyorProfile.php";
require_once "../../models/Request.php";

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../incoming-requests.php");
    exit();
}

// Validate inputs
if (
    !isset($_POST['request_id'], $_POST['action']) ||
    !is_numeric($_POST['request_id'])
) {
    header("Location: ../incoming-requests.php");
    exit();
}

$request_id = (int) $_POST['request_id'];
$action = $_POST['action'];

if ($action !== 'accepted') {
    header("Location: ../incoming-requests.php");
    exit();
}

$account_id = $_SESSION['id'];

// Get surveyor profile
$surveyorModel = new SurveyorProfile();
$surveyorProfile = $surveyorModel->getSurveyorProfileByAccountId($account_id, $pdo);

if (!$surveyorProfile) {
    header("Location: ../profile.php");
    exit();
}

$surveyor_profile_id = $surveyorProfile['id'];

// Update request status
$requestModel = new Request();
$updated = $requestModel->updateRequestToSurveyorStatus(
    $request_id,
    $surveyor_profile_id,
    'accepted',
    $pdo
);

// Redirect back to request details
header("Location: ../incoming-request.php?id=" . $request_id);
exit();
