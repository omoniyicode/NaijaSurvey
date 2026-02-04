<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'surveyor') {
    header("Location: ../../login.php");
    exit();
}

require_once "../../config/db-connect.php";
require_once "../../models/SurveyorProfile.php";
require_once "../../models/Request.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../incoming-requests.php");
    exit();
}

if (
    !isset($_POST['request_id']) ||
    !isset($_FILES['deliverable']) ||
    !is_numeric($_POST['request_id'])
) {
    header("Location: ../incoming-requests.php");
    exit();
}

$request_id = (int) $_POST['request_id'];
$note = trim($_POST['note'] ?? '');
$account_id = $_SESSION['id'];

// get surveyor profile
$surveyorProfileModel = new SurveyorProfile();
$profile = $surveyorProfileModel->getSurveyorProfileByAccountId($account_id, $pdo);

if (!$profile) {
    header("Location: ../profile.php");
    exit();
}

$surveyor_profile_id = $profile['id'];

// get client id from request
$sql = "SELECT client_profile_id FROM request_to_surveyors WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$request_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    header("Location: ../incoming-requests.php");
    exit();
}

$client_profile_id = $row['client_profile_id'];

// file validation
$file = $_FILES['deliverable'];
$allowed = ['pdf', 'doc', 'docx', 'zip'];
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $allowed) || $file['error'] !== UPLOAD_ERR_OK) {
    header("Location: ../incoming-request.php?id=$request_id");
    exit();
}

// ensure directory exists
$uploadDir = "../../uploads/deliverables/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$filename = uniqid('deliverable_', true) . '.' . $ext;
$destination = $uploadDir . $filename;

if (!move_uploaded_file($file['tmp_name'], $destination)) {
    header("Location: ../incoming-request.php?id=$request_id");
    exit();
}

// INSERT INTO CORRECT TABLE
$sql = "
    INSERT INTO deliverables (
        request_to_surveyor_id,
        client_profile_id,
        surveyor_profile_id,
        file_path,
        note_to_client
    ) VALUES (?, ?, ?, ?, ?)
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $request_id,
    $client_profile_id,
    $surveyor_profile_id,
    $filename,
    $note
]);

header("Location: ../incoming-request.php?id=$request_id");
exit();
