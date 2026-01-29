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
                  <span class="status-badge pending">Pending</span>
                </div>
                <div class="detail-item">
                  <strong>Sent At</strong>
                  <span>14 Jan 2026, 10:10 AM</span>
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
                  <strong>Service Type</strong>
                  <span>Boundary Survey</span>
                </div>
                <div class="detail-item">
                  <strong>State</strong>
                  <span>Benue, Nigeria</span>
                </div>
                <div class="detail-item">
                  <strong>L.G.A</strong>
                  <span>Makurdi</span>
                </div>
                <div class="detail-item">
                  <strong>Address</strong>
                  <span>No. 45 GRA</span>
                </div>
                <div class="detail-item">
                  <strong>Land Size</strong>
                  <span>600 sqm</span>
                </div>
                <div class="detail-item">
                  <strong>Proposed Budget</strong>
                  <span class="text-success fw-bold">₦150,000 – ₦250,000</span>
                </div>
                <div class="detail-item">
                  <strong>Expected Start</strong>
                  <span>20 Feb 2026</span>
                </div>
              </div>
            </div>

            <hr>

            <!-- Job Description -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-file-text-fill"></i> Job Description
              </h3>
              <p class="text-muted">Client needs a professional boundary survey for land documentation.</p>
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
                    <span>Ade Johnson</span>
                  </div>
                  <div class="detail-item">
                    <strong>Contact</strong>
                    <span>0802 555 8899</span>
                  </div>
                  <div class="detail-item">
                    <strong>Address</strong>
                    <span>No.45 Makurdi Benue</span>
                  </div>
                  <div class="detail-item">
                    <strong>Status</strong>
                    <span class="text-success fw-bold">Active Client</span>
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
          <form>
            <div class="mb-4">
              <label class="form-label fw-semibold">Upload Work Deliverable</label>
              <div class="upload-deliverable-box">
                <label class="upload-label">
                  <i class="bi bi-cloud-upload fs-1 d-block mb-2"></i>
                  Click to upload file
                  <input type="file" accept=".pdf,.doc,.docx,.zip">
                </label>
                <p class="text-muted small mt-3 mb-0">
                  Survey reports, images, drawings, signed documents, if applicable, all bundled as a single document (PDF
                  preferred).
                </p>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Note to Client</label>
              <textarea class="form-control" rows="3"
                placeholder="Add any notes or instructions for the client..."></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-gold">
            <i class="bi bi-send me-2"></i>Submit for Client Confirmation
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>