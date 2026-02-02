<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'client') {
    header("Location: ../login.php");
    exit();
}

require_once "../config/db-connect.php";
require_once "../models/ClientProfile.php";
require_once "../models/Request.php";

// account id
$account_id = $_SESSION['id'];

// get client profile
$clientProfileModel = new ClientProfile();
$profile = $clientProfileModel->getClientProfileByAccountId($account_id, $pdo);

if (!$profile) {
    header("Location: profile.php");
    exit();
}

$client_profile_id = $profile['id'];

// get outgoing requests (client → surveyors)
$requestModel = new Request();
$outgoingRequests = $requestModel->getClientOutgoingRequests($client_profile_id, $pdo);

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

  <?php include "../components/clientSidebar.php"; ?>

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
        <h2 class="mb-2" style="color: var(--primary-green); font-weight: 700;">Outgoing Requests to Surveyors</h2>
        <p class="text-muted">Track all job proposals you've sent to surveyors.</p>
      </div>

      <!-- Requests Table -->
      <div class="request-table">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>Surveyor</th>
              <th>Service Category</th>
              <th>Request Status</th>
              <th>Action</th>
            </tr>
          </thead>
         <tbody>
            <?php if (empty($outgoingRequests)): ?>
              <tr>
                <td colspan="4" class="text-center text-muted">
                  You have not sent any requests yet.
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($outgoingRequests as $request): ?>
                <tr>
                  <td>
                    <?= htmlspecialchars($request['first_name'] . ' ' . $request['surname']) ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($request['service_category']) ?>
                  </td>

                  <td>
                    <span class="status-badge <?= strtolower($request['request_status']) ?>">
                      <?= ucfirst($request['request_status']) ?>
                    </span>
                  </td>

                  <td>
                    <a href="outgoing-request.php?id=<?= $request['id'] ?>" 
                      class="btn btn-sm btn-primary">
                      <i class="bi bi-eye me-1"></i> View
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>

        </table>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>