<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'surveyor') {
  header("Location: ../login.php");
  exit();
}

require_once "../config/db-connect.php";
require_once "../models/SurveyorProfile.php";
require_once "../models/Request.php";

// get account id
$account_id = $_SESSION['id'];

// get surveyor profile
$surveyorProfile = new SurveyorProfile();
$profile = $surveyorProfile->getSurveyorProfileByAccountId($account_id, $pdo);
$surveyorName = $profile['first_name']; // e.g. Godsown

//surveyor profile display
$profileImage = !empty($profile['profile_image'])
    ? "../uploads/profile_images/" . $profile['profile_image']
    : "../assets/images/client_avatar.jpg";



//If surveyor profile does not exist, redirect to profile setup page
if(!$profile){
    header("Location: profile.php");
    exit();
}

$surveyor_profile_id = $profile['id'];

// get request stats
$request = new Request();
$recentActivities = $request->getRecentActivity($surveyor_profile_id, $pdo);
$totalIncomingRequests = $request->getSurveyorTotalIncomingRequests($surveyor_profile_id, $pdo);
$totalOutgoingRequests = $request->getSurveyorTotalOutgoingRequests($surveyor_profile_id, $pdo);
$totalCompletedRequests = $request->getSurveyorTotalCompletedRequests($surveyor_profile_id, $pdo);
$totalPendingRequests = $request->getSurveyorTotalPendingRequests($surveyor_profile_id, $pdo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Surveyor Dashboard - Survey Connect</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

  <?php include "../components/surveyorSidebar.php"; ?>

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
          Welcome Back, <?php echo ($surveyorName); ?>!
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

      <!-- Quick Actions -->
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="request-card">
            <div class="request-card-header">
              <h5>Quick Actions</h5>
            </div>
            <div class="d-grid gap-3">
              <a href="../jobs.php" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-search me-2"></i>Find New Jobs
              </a>
              <a href="incoming-requests.php" class="btn btn-outline-success btn-lg">
                <i class="bi bi-inbox me-2"></i>View Incoming Requests
              </a>
              <a href="outgoing-requests.php" class="btn btn-outline-warning btn-lg">
                <i class="bi bi-send me-2"></i>View Outgoing Requests
              </a>
            </div>
          </div>
        </div>

         <!-- Recent Activity -->
        <div class="col-lg-6">
          <div class="request-card">
            <div class="request-card-header">
              <h5>Recent Activity</h5>
            </div>
            <div class="list-group list-group-flush">
              <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="list-group list-group-flush">
                      <?php if (empty($recentActivities)): ?>
                        <div class="list-group-item text-muted">
                          No recent activity yet.
                        </div>
                      <?php else: ?>
                        <?php foreach ($recentActivities as $activity): ?>
                          <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <div>
                                <h6 class="mb-1">
                                  <?php echo ucfirst($activity['status']); ?> request
                                  <?php if (!empty($activity['client_name'])): ?>
                                    from <?php echo htmlspecialchars($activity['client_name']); ?>
                                  <?php endif; ?>
                                </h6>
                                <small class="text-muted">
                                  <?php echo date("M j, Y g:i A", strtotime($activity['created_at'])); ?>
                                </small>
                              </div>

                              <span class="status-badge <?php echo strtolower($activity['status']); ?>">
                                <?php echo ucfirst($activity['status']); ?>
                              </span>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>