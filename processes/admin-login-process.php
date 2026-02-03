<?php
session_start();
require_once "../config/db-connect.php";

// Only process POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['admin_login'])) {
    header("Location: ../admin/login.php");
    exit();
}

// Sanitize inputs
$email = trim($_POST['email']);
$password = $_POST['password'];

// Basic validation
if (empty($email) || empty($password)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../admin/login.php");
    exit();
}

// Fetch admin by email
$sql = "SELECT id, email, password, status FROM admins WHERE email = ? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if admin exists
if (!$admin) {
    $_SESSION['error'] = "Invalid login credentials.";
    header("Location: ../admin/login.php");
    exit();
}

// Check status
if ($admin['status'] !== 'active') {
    $_SESSION['error'] = "Admin account is inactive.";
    header("Location: ../admin/login.php");
    exit();
}

// Verify password
if (!password_verify($password, $admin['password'])) {
    $_SESSION['error'] = "Invalid login credentials.";
    header("Location: ../admin/login.php");
    exit();
}

// ✅ LOGIN SUCCESS
$_SESSION['is_admin'] = true;
$_SESSION['admin_id'] = $admin['id'];
$_SESSION['admin_email'] = $admin['email'];

// Optional: regenerate session ID (security)
session_regenerate_id(true);

// Redirect to dashboard
header("Location: ../admin/dashboard.php");
exit();
