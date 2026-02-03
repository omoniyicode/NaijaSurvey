<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: ../admin_login.php");
    exit();
}

require_once "../../config/db-connect.php";

if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    empty($_POST['id']) ||
    empty($_POST['role']) ||
    empty($_POST['action'])
) {
    header("Location: ../verify_users.php");
    exit();
}

$id     = (int) $_POST['id'];
$role   = $_POST['role'];
$action = $_POST['action'];

if (!in_array($role, ['client','surveyor']) || !in_array($action, ['approve','reject'])) {
    header("Location: ../verify_users.php");
    exit();
}

$table  = $role === 'client' ? 'clients_profile' : 'surveyors_profile';
$status = $action === 'approve' ? 'verified' : 'rejected';

$sql = "UPDATE $table SET verification_status = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$status, $id]);

header("Location: ../verify_users.php");
exit();
