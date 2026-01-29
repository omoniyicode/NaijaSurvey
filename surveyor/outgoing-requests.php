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

//If surveyor profile does not exist, redirect to profile setup page
if(!$profile){
    header("Location: profile.php");
    exit();
}

$surveyor_profile_id = $profile['id'];

// get list of outgoing requests to clients
$request = new Request();

$outgoingRequestsFromSurveyor = $request->getSurveyorOutgoingRequests($surveyor_profile_id, $pdo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outgoing Requests - Survey Connect</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        <strong>Outgoing Requests</strong>
      </div>
      <div class="topbar-actions">
        <i class="bi bi-bell-fill"></i>
        <i class="bi bi-person-circle"></i>
      </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-content">
      
      <!-- Page Header -->
      <div class="mb-4">
        <h2 class="mb-2" style="color: var(--primary-green); font-weight: 700;">Outgoing Requests to Clients</h2>
        <p class="text-muted">Track all job proposals you've sent to clients.</p>
      </div>

      <!-- Requests Table -->
      <?php if (empty($outgoingRequestsFromSurveyor)): ?>
        <div class="alert alert-info text-center py-5">
          <i class="bi bi-send" style="font-size: 3rem; color: var(--primary-green);"></i>
          <h5 class="mt-3 mb-2">No Outgoing Requests</h5>
          <p class="text-muted">You haven't sent any proposals to clients yet.</p>
        </div>
      <?php else: ?>
        <div class="request-table">
          <table class="table table-hover align-middle mb-0">
            <thead>
              <tr>
                <th>Client Name</th>
                <th>Job Title</th>
                <th>Job Location</th>
                <th>Request Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($outgoingRequestsFromSurveyor as $request) : ?>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="ms-3">
                        <p class="fw-bold mb-1"><?php echo htmlspecialchars($request['first_name'] . ' ' . $request['surname']); ?></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($request['surname']); ?></p>
                      </div>
                    </div>
                  </td>
                  <td><?php echo htmlspecialchars($request['job_title']); ?></td>
                  <td><?php echo htmlspecialchars($request['job_state']); ?></td>
                  <td><span class="status-badge <?php echo strtolower($request['request_status']); ?>"><?php echo htmlspecialchars($request['request_status']); ?></span></td>
                  <td>
                    <a href="outgoing-request.php?id=<?php echo urlencode($request['id']); ?>" class="btn btn-sm btn-primary">
                      <i class="bi bi-eye me-1"></i> View
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
