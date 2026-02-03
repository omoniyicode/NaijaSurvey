<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: ../admin_login.php");
    exit();
}

require_once "../../config/db-connect.php";

if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    empty($_POST['surveyor_id']) ||
    !isset($_POST['rating'])
) {
    header("Location: ../surveyor_ratings.php");
    exit();
}

$surveyor_id = (int) $_POST['surveyor_id'];
$rating      = (float) $_POST['rating'];

if ($rating < 0 || $rating > 5) {
    header("Location: ../surveyor_ratings.php");
    exit();
}

$sql = "
    UPDATE surveyors_profile 
    SET rating = ?
    WHERE id = ?
      AND verification_status = 'verified'
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$rating, $surveyor_id]);

header("Location: ../surveyor_ratings.php");
exit();
