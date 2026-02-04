<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'surveyor') {
    header("Location: ../login.php");
    exit();
}

require_once "../config/db-connect.php";
require_once "../models/SurveyorProfile.php";
require_once "../models/Request.php";

// validate request id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: incoming-requests.php");
    exit();
}

$request_id = (int) $_GET['id'];
$account_id = $_SESSION['id'];

// get surveyor profile
$surveyorModel = new SurveyorProfile();
$surveyorProfile = $surveyorModel->getSurveyorProfileByAccountId($account_id, $pdo);

if (!$surveyorProfile) {
    header("Location: profile.php");
    exit();
}

$surveyor_profile_id = $surveyorProfile['id'];

// get request details
$requestModel = new Request();
$request = $requestModel->getSurveyorIncomingRequestById(
    $request_id,
    $surveyor_profile_id,
    $pdo
);

// get latest deliverable for this request (if any)
$sql = "
    SELECT *
    FROM deliverables
    WHERE request_to_surveyor_id = ?
      AND surveyor_profile_id = ?
    ORDER BY created_at DESC
    LIMIT 1
";


$stmt = $pdo->prepare($sql);
$stmt->execute([$request_id, $surveyor_profile_id]);
$deliverable = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$request) {
    header("Location: incoming-requests.php");
    exit();
}

// client profile image (fallback safe)
$clientImage = !empty($request['profile_image'])
    ? "../uploads/profile_images/" . $request['profile_image']
    : "../assets/images/client_avatar.jpg";


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Request Details - Survey Connect</title>
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
        <strong>Incoming Request Details</strong>
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
          <a href="incoming-requests.php" class="btn btn-outline-secondary mb-4">
            <i class="bi bi-arrow-left me-2"></i>Back to Requests
          </a>

          <div class="request-detail-card">
            
            <!-- Job Image -->
            <img 
              src="<?php echo htmlspecialchars($clientImage); ?>" 
              alt="Client"
              class="job-image"
              style="object-fit: cover;"
            >



            <!-- Request Information -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-info-circle-fill"></i> Request Information
              </h3>
              <div class="detail-grid">
                <div class="detail-item">
                  <strong>Request Status</strong>
                  <span class="status-badge <?php echo strtolower($request['request_status']); ?>">
                    <?php echo ucfirst($request['request_status']); ?>
                  </span>
                </div>
                <div class="detail-item">
                  <strong>Created At</strong>
                  <span>
                    <?php echo date("d M Y, g:i A", strtotime($request['created_at'])); ?>
                  </span>
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
                  <span>Boundary Survey for Residential Plot</span>
                </div>
                <div class="detail-item">
                  <strong>Service Category</strong>
                  <span><?php echo htmlspecialchars($request['service_category']); ?></span>
                </div>
                <div class="detail-item">
                  <strong>State</strong>
                  <span><?php echo htmlspecialchars($request['project_state']); ?></span>
                </div>
                <div class="detail-item">
                  <strong>L.G.A</strong>
                  <span><?php echo htmlspecialchars($request['lga']); ?></span>
                </div>
                <div class="detail-item">
                  <strong>Address</strong>
                  <span><?php echo htmlspecialchars($request['project_address']); ?></span>
                </div>
               
                <div class="detail-item">
                  <strong>Proposed Budget</strong>
                  <span class="fw-bold text-success">
                    ₦<?php echo number_format($request['estimated_budget']); ?>
                  </span>
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
                <?php echo nl2br(htmlspecialchars($request['project_description'])); ?>
              </p>

            </div>

            <hr>

            <!-- Client Information -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-person-fill"></i> Client Information
              </h3>
              <div class="client-info-box">
                <img src="<?php echo htmlspecialchars($clientImage); ?>" class="client-avatar">
                <div class="verified-client mb-3">
                  <i class="bi bi-patch-check-fill"></i> Verified Client
                </div>
                <div class="detail-grid">
                  <div class="detail-item">
                    <strong>Name</strong>
                    <span>
                      <?php echo htmlspecialchars($request['first_name'].' '.$request['surname']); ?>
                    </span>

                  </div>
                  <div class="detail-item">
                    <strong>State</strong>
                    <span><?php echo htmlspecialchars($request['state']); ?></span>
                  </div>
                  <div class="detail-item">
                    <strong>L.G.A</strong>
                    <span><?php echo htmlspecialchars($request['lga']); ?></span>
                  </div>
                  <div class="detail-item">
                    <strong>Member Since</strong>
                    <span>
                     <?php echo htmlspecialchars($request['created_at']); ?>
                    </span>

                  </div>
                </div>
                <div class="mt-3">
                  <p class="text-muted">
                    <?php echo nl2br(htmlspecialchars($request['bio'])); ?>
                  </p>
                  <p class="text-muted mt-2 mb-0">Professional real estate investor with multiple properties across Benue state. Looking for reliable and licensed surveyors for ongoing projects.</p>
                </div>
              </div>
            </div>

            <hr>

            <?php if ($deliverable): ?>
              <hr>

              <div class="detail-section">
                <h3 class="detail-section-title">
                  <i class="bi bi-folder2-open"></i> Submitted Deliverable
                </h3>

                <div class="file-item">
                  <span>
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Survey Deliverable
                  </span>

                  <a 
                    href="../uploads/deliverables/<?php echo htmlspecialchars($deliverable['file_path']); ?>"
                    class="btn btn-sm btn-outline-success"
                    download
                  >
                    Download
                  </a>
                </div>

                <?php if (!empty($deliverable['note'])): ?>
                  <p class="text-muted mt-2">
                    <strong>Note:</strong><br>
                    <?php echo nl2br(htmlspecialchars($deliverable['note'])); ?>
                  </p>
                <?php endif; ?>

                <small class="text-muted">
                  Uploaded on <?php echo date("d M Y, g:i A", strtotime($deliverable['uploaded_at'])); ?>
                </small>
              </div>
            <?php endif; ?>


            <!-- Action Buttons -->
            <div class="action-buttons">
              <form method="post" action="processes/update-request.php">
                  <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
                  <input type="hidden" name="action" value="accepted">

                  <button type="submit" class="btn btn-success">
                      <i class="bi bi-check-circle me-1"></i> Accept
                  </button>
              </form>

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

            <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">

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
                placeholder="Add any notes or instructions..."
              ></textarea>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-gold w-40">
                <i class="bi bi-send me-2"></i>Submit for client confirmation
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