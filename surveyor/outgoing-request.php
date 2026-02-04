<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'surveyor') {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: outgoing-requests.php");
    exit();
}

require_once "../config/db-connect.php";
require_once "../models/SurveyorProfile.php";
require_once "../models/Request.php";

$account_id = $_SESSION['id'];
$request_id = (int) $_GET['id'];

// get surveyor profile
$surveyorProfileModel = new SurveyorProfile();
$profile = $surveyorProfileModel->getSurveyorProfileByAccountId($account_id, $pdo);

if (!$profile) {
    header("Location: profile.php");
    exit();
}

$surveyor_profile_id = $profile['id'];

// get outgoing request details (surveyor → client)
$requestModel = new Request();
$request = $requestModel->getSurveyorOutgoingRequestById(
    $request_id,
    $surveyor_profile_id,
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

  <?php include "../components/surveyorSidebar.php"; ?>

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

            <!-- Request Information -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-info-circle-fill"></i> Request Information
              </h3>
              <div class="detail-grid">
                <div class="detail-item">
                  <strong>Request Status</strong>
                 <span class="status-badge <?= strtolower($request['request_status']) ?>">
                    <?= ucfirst($request['request_status']) ?>
                 </span>
                </div>
                <div class="detail-item">
                  <strong>Sent At</strong>
                  <span><?= date('d M Y, h:i A', strtotime($request['created_at'])) ?></span>
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
                  <strong>Job Title</strong>
                 <span><?= htmlspecialchars($request['job_title']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Service Type</strong>
                  <span><?= htmlspecialchars($request['service_category'] ?? 'N/A') ?></span>
                </div>
                <div class="detail-item">
                  <strong>State</strong>
                  <span><?= htmlspecialchars($request['job_state']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>L.G.A</strong>
                 <span><?= htmlspecialchars($request['job_lga']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Address</strong>
                  <span><?= htmlspecialchars($request['job_address']) ?></span>
                </div>
                <div class="detail-item">
                  <strong>Land Size</strong>
                  <span>600 sqm</span>
                </div>
                <div class="detail-item">
                  <strong>Proposed Budget</strong>
                 <span class="text-success fw-bold">
                    ₦<?= number_format($request['proposed_budget']) ?>
                 </span>
                </div>
                <div class="detail-item">
                  <strong>Expected Start</strong>
                  <span><?= date('d M Y', strtotime($request['created_at'])) ?></span>
                </div>
              </div>
            </div>

            <hr>

            <!-- Job Description -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-file-text-fill"></i> Job Description
              </h3>
              <p class="text-muted">
                <?= nl2br(htmlspecialchars($request['job_description'])) ?>
              </p>
            </div>

            <hr>

            <!-- Client Summary -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-person-fill"></i> Client Summary
              </h3>
              <div class="client-info-box">
                <div class="detail-grid">
                  <div class="detail-item">
                    <strong>Client Name</strong>
                    <span><?= htmlspecialchars($request['first_name'] . ' ' . $request['surname']) ?></span>
                  </div>
                  <div class="detail-item">
                    <strong>Contact</strong>
                    <span><?= htmlspecialchars($request['phone_number']) ?></span>
                  </div>
                  <div class="detail-item">
                    <strong>Address</strong>
                    <span><?= htmlspecialchars($request['address']) ?></span>
                  </div>
                  <div class="detail-item">
                    <strong>Status</strong>
                    <span class="text-success fw-bold">
                      <?= ucfirst($request['verification_status']) ?> Client
                    </span>

                  </div>
                </div>
              </div>
            </div>

            <hr>

            <!-- Action Button -->
            <div class="d-flex justify-content-between align-items-center">
              <div class="text-muted small">
                <i class="bi bi-clock-history me-2"></i>
                This request has been sent to the client and is awaiting approval.
              </div>
              <button class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#deliverableModal">
                <i class="bi bi-cloud-upload me-2"></i>Upload Deliverables
              </button>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Upload Deliverable Modal -->
  <div class="modal fade" id="deliverableModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Job Deliverables</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form 
            method="post"
            action="processes/upload-deliverable.php"
            enctype="multipart/form-data"
          >
            <input type="hidden" name="request_id" value="<?= $request_id ?>">
            <input type="hidden" name="client_profile_id" value="<?= $request['client_profile_id'] ?>">

            <div class="mb-4">
              <label class="form-label fw-semibold">Upload Work Deliverable</label>
              <input 
                type="file"
                name="deliverable"
                class="form-control"
                accept=".pdf,.doc,.docx,.zip"
                required
              >
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Note to Client</label>
              <textarea 
                name="note"
                class="form-control"
                rows="3"
                placeholder="Add any notes or instructions for the client..."
              ></textarea>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-gold">
                <i class="bi bi-send me-2"></i>Submit for Client Confirmation
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>