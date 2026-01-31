<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'client') {
  header("Location: ../login.php");
  exit();
}

require_once "../config/db-connect.php";
require_once "../models/ClientProfile.php";
require_once "../models/Request.php";

// get account id
$account_id = $_SESSION['id'];

// get client profile
$clientProfile = new ClientProfile();
$profile = $clientProfile->getClientProfileByAccountId($account_id, $pdo);
$clientName = $profile['first_name'];

//surveyor profile display
$profileImage = !empty($profile['profile_image'])
    ? "../uploads/profile_images/" . $profile['profile_image']
    : "../assets/images/client_avatar.jpg";


//If client profile does not exist, redirect to profile setup page
if(!$profile){
    header("Location: profile.php");
    exit();
}

$client_profile_id = $profile['id'];

// get request stats
$request = new Request();

$totalIncomingRequests = $request->getClientTotalIncomingRequests($client_profile_id, $pdo);
$totalOutgoingRequests = $request->getClientTotalOutgoingRequests($client_profile_id, $pdo);
$totalCompletedRequests = $request->getClientTotalCompletedRequests($client_profile_id, $pdo);
$totalPendingRequests = $request->getClientTotalPendingRequests($client_profile_id, $pdo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Client Dashboard - Survey Connect</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

  <?php include '../components/clientSidebar.php'; ?>

  <!-- Main Content -->
  <div class="surveyor-main">

    <!-- Top Navigation -->
    <nav class="surveyor-topbar">
      <div class="d-flex align-items-center gap-3">
        <button class="menu-toggle" onclick="openSidebar()">
          <i class="bi bi-list"></i>
        </button>
        <strong>Dashboard</strong>
      </div>
      <div class="topbar-actions">
        <i class="bi bi-bell-fill"></i>
        <img 
        src="<?php echo $profileImage; ?>" 
        alt="Profile"
        class="rounded-circle"
        style="width: 36px; height: 36px; object-fit: cover;"
        >
      </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-content">

      <!-- Welcome Section -->
      <div class="mb-4">
        <h2 class="mb-2" style="color: var(--primary-green); font-weight: 700;">
          Welcome Back, <?php echo ($clientName); ?>!
        </h2>
        <p class="text-muted">Here's an overview of your activities and requests.</p>
      </div>

      <!-- Stat Cards -->
      <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
          <div class="surveyor-stat-card">
            <div class="surveyor-stat-icon blue">
              <i class="bi bi-inbox-fill"></i>
            </div>
            <div class="surveyor-stat-info">
              <div class="stat-value"><?php echo $totalIncomingRequests["total"]; ?></div>
              <div class="stat-label">Incoming Requests</div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="surveyor-stat-card">
            <div class="surveyor-stat-icon gray">
              <i class="bi bi-send-fill"></i>
            </div>
            <div class="surveyor-stat-info">
              <div class="stat-value"><?php echo $totalOutgoingRequests["total"]; ?></div>
              <div class="stat-label">Outgoing Requests</div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="surveyor-stat-card">
            <div class="surveyor-stat-icon green">
              <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="surveyor-stat-info">
              <div class="stat-value"><?php echo $totalCompletedRequests["total"]; ?></div>
              <div class="stat-label">Completed Requests</div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="surveyor-stat-card">
            <div class="surveyor-stat-icon gold">
              <i class="bi bi-clock-fill"></i>
            </div>
            <div class="surveyor-stat-info">
              <div class="stat-value"><?php echo $totalPendingRequests["total"]; ?></div>
              <div class="stat-label">Pending Requests</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>