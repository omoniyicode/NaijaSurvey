<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: ../admin_login.php");
    exit();
}

require_once "../../config/db-connect.php";

if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    empty($_POST['user_id']) ||
    empty($_POST['user_type'])
) {
    header("Location: ../users.php");
    exit();
}

$user_id   = (int) $_POST['user_id'];
$user_type = $_POST['user_type'];

if (!in_array($user_type, ['surveyor', 'client'])) {
    header("Location: ../users.php");
    exit();
}

$table = $user_type === 'surveyor' ? 'surveyors_profile' : 'clients_profile';

$sql = "
    UPDATE {$table}
    SET verification_status = 'pending'
    WHERE id = ?
      AND verification_status = 'verified'
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);

header("Location: ../users.php");
exit();
