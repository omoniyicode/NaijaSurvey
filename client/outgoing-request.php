<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'client') {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: outgoing-requests.php");
    exit();
}

require_once "../config/db-connect.php";
require_once "../models/ClientProfile.php";
require_once "../models/Request.php";

// account id
$account_id = $_SESSION['id'];
$request_id = (int) $_GET['id'];

// get client profile
$clientProfileModel = new ClientProfile();
$profile = $clientProfileModel->getClientProfileByAccountId($account_id, $pdo);

if (!$profile) {
    header("Location: profile.php");
    exit();
}

$client_profile_id = $profile['id'];

// get outgoing request details
$requestModel = new Request();
$request = $requestModel->getClientOutgoingRequestById(
    $request_id,
    $client_profile_id,
    $pdo
);

if (!$request) {
    header("Location: outgoing-requests.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outgoing Request Details - Survey Connect</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
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
        <strong>Outgoing Request Details</strong>
      </div>
      <div class="topbar-actions">
        <i class="bi bi-bell-fill"></i>
        <i class="bi bi-person-circle"></i>
      </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-content">

      <div class="row justify-content-center">
        <div class="col-lg-10">

          <!-- Back Button -->
          <a href="outgoing-requests.php" class="btn btn-outline-secondary mb-4">
            <i class="bi bi-arrow-left me-2"></i>Back to Requests
          </a>

          <div class="request-detail-card">

            <!-- Job Image -->
            <img src="../assets/images/boundary survey job.png" alt="Job" class="job-image">

            <!-- Surveyor Information -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-person-fill"></i> Surveyor Information
              </h3>
              <div class="detail-grid">
                <div class="detail-item">
                  <strong>Name</strong>
                  <span><?= htmlspecialchars($request['first_name'] . ' ' . $request['surname']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>SURCON No</strong>
                  <span><?= htmlspecialchars($request['surcon_number']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Phone</strong>
                  <span><?= htmlspecialchars($request['phone_number']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Email</strong>
                  <span><?= htmlspecialchars($request['email']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>WhatsApp</strong>
                  <span><?= htmlspecialchars($request['whatsapp_number']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>State</strong>
                  <span><?= htmlspecialchars($request['state']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>LGA</strong>
                  <span><?= htmlspecialchars($request['lga']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Address</strong>
                  <span><?= htmlspecialchars($request['address']) ?></span>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                  <strong>Bio</strong>
                  <<span><?= htmlspecialchars($request['bio']) ?></span>
                </div>
              </div>
            </div>

            <hr>

            <!-- Job Details -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-briefcase-fill"></i> Job Details
              </h3>
              <div class="detail-grid">
                <div class="detail-item">
                  <strong>Service Category</strong>
                  <span><?= htmlspecialchars($request['service_category']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Project State</strong>
                  <span><?= htmlspecialchars($request['project_state']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Project LGA</strong>
                  <span><?= htmlspecialchars($request['project_lga']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Project Address</strong>
                  <span><?= htmlspecialchars($request['project_address']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Estimated Budget</strong>
                  <span class="text-success fw-bold">
                    ₦<?= number_format($request['estimated_budget']) ?>
                  </span>
                </div>
                <div class="detail-item">
                  <strong>Request Status</strong>
                  <span class="status-badge <?= strtolower($request['request_status']) ?>">
                    <?= ucfirst($request['request_status']) ?>
                  </span>
                </div>
                <div class="detail-item">
                  <strong>Created At</strong>
                  <span><?= date('d M Y', strtotime($request['created_at'])) ?></span>
                </div>
              </div>
            </div>

            <hr>

            <!-- Job Description -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-file-text-fill"></i> Project Description
              </h3>
              <p class="text-muted">
                <?= nl2br(htmlspecialchars($request['project_description'])) ?>
              </p>
            </div>

            <hr>

            <!-- Action Button -->
            <div class="d-flex justify-content-end">
              <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deliverableModal">
                <i class="bi bi-folder2-open me-1"></i> View Deliverables
              </button>
            </div>

          </div>

        </div>
      </div>

    </div>
  </div>

  <!-- Deliverable Modal -->
  <div class="modal fade" id="deliverableModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Surveyor Submitted Deliverable</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <p class="small mb-3">
            <strong>Surveyor:</strong> PrimeGeo Surveys Ltd<br>
            <strong>Service Category:</strong> Boundary Survey – Benue
          </p>

          <div class="file-item">
            <span><i class="bi bi-file-pdf text-danger"></i> Boundary_Report.pdf</span>
            <a href="../uploads/boundary_report.pdf" class="btn btn-sm btn-outline-success" download>
              Download
            </a>
          </div>

          <p>Note to Client: Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis similique rerum voluptate, laudantium eveniet qui obcaecati impedit commodi nulla numquam reiciendis id praesentium quia nesciunt ullam. Voluptatum eligendi minima tempora!</p>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary w-100" data-bs-dismiss="modal">
            Close
          </button>
        </div>

      </div>
    </div>
  </div>

  <style>
    .file-item {
      border: 1px solid #e5e5e5;
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 12px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>