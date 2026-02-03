<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: ../admin_login.php");
    exit();
}

require_once "../../config/db-connect.php";

// validate request
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['job_id'])) {
    header("Location: ../job_management.php");
    exit();
}

$job_id = (int) $_POST['job_id'];

if ($job_id <= 0) {
    header("Location: ../job_management.php");
    exit();
}

// delete job
$sql = "DELETE FROM jobs WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$job_id]);

header("Location: ../job_management.php");
exit();
