<?php
if (!isset($pdo)) {
    require_once __DIR__ . '/../config/db-connect.php';
}

// Pending surveyors
$pendingSurveyors = $pdo->query("
    SELECT COUNT(*) 
    FROM surveyors_profile 
    WHERE verification_status = 'pending'
")->fetchColumn();

// Pending clients
$pendingClients = $pdo->query("
    SELECT COUNT(*) 
    FROM clients_profile 
    WHERE verification_status = 'pending'
")->fetchColumn();

$totalPendingVerifications = $pendingSurveyors + $pendingClients;
?>


<!-- SIDEBAR OVERLAY (MOBILE) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR -->
<aside class="admin-sidebar" id="adminSidebar">

  <!-- MOBILE CLOSE -->
  <div class="sidebar-header d-md-none">
    <span class="material-symbols-outlined" onclick="closeSidebar()">close</span>
  </div>

  <!-- MENU -->
  <nav class="sidebar-menu">

    <!-- DASHBOARD -->
    <a href="dashboard.php" class="sidebar-link active">
      <span class="material-symbols-outlined">dashboard</span>
      Dashboard
    </a>

    <!-- JOBS -->
    <a href="job_management.php" class="sidebar-link">
      <span class="material-symbols-outlined">work_outline</span>
      Job Management
    </a>

    <!-- USERS -->
    <a href="users.php" class="sidebar-link">
      <span class="material-symbols-outlined">group</span>
      Users
    </a>

    <!-- VERIFICATION -->
    <a href="verification.php" class="sidebar-link has-badge">
      <span class="material-symbols-outlined">verified</span>
      Verification

      <?php if ($totalPendingVerifications > 0): ?>
        <span class="sidebar-badge">
          <?php echo $totalPendingVerifications; ?>
        </span>
      <?php endif; ?>
    </a>


    <!-- RATINGS -->
    <a href="surveyor_ratings.php" class="sidebar-link">
      <span class="material-symbols-outlined">star_rate</span>
      Surveyor Ratings
    </a>

  </nav>

  <!-- LOGOUT -->
  <div class="sidebar-footer">
    <a href="logout.php" class="sidebar-link logout">
      <span class="material-symbols-outlined">logout</span>
      Logout
    </a>
  </div>

</aside>
