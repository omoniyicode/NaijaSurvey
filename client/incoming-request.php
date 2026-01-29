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

  <?php include "../components/clientSidebar.php"; ?>

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
            <img src="../assets/images/Sconnect 2.jpeg" alt="Job" class="job-image">

            <!-- Surveyor Information -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-person-fill"></i> Surveyor Information
              </h3>
              <div class="detail-grid">
                <div class="detail-item">
                  <strong>Name</strong>
                  <span>John Survey Ltd</span>
                </div>
                <div class="detail-item">
                  <strong>Years of Experience</strong>
                  <span>8 Years</span>
                </div>
                <div class="detail-item">
                  <strong>SURCON No</strong>
                  <span>SURCON/45221</span>
                </div>
                <div class="detail-item">
                  <strong>Phone</strong>
                  <span>0803 123 4567</span>
                </div>
                <div class="detail-item">
                  <strong>WhatsApp</strong>
                  <span>0803 123 4567</span>
                </div>
                <div class="detail-item">
                  <strong>State</strong>
                  <span>Kogi</span>
                </div>
                <div class="detail-item">
                  <strong>LGA</strong>
                  <span>Olamaboro</span>
                </div>
                <div class="detail-item">
                  <strong>Address</strong>
                  <span>Street View 1</span>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                  <strong>Bio</strong>
                  <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime vero voluptatum quam fugit amet maiores ab qui eius culpa, a odio magnam, fugiat odit suscipit eligendi repellendus commodi animi necessitatibus.</span>
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
                  <span>Boundary Survey</span>
                </div>
                <div class="detail-item">
                  <strong>State</strong>
                  <span>Benue</span>
                </div>
                <div class="detail-item">
                  <strong>LGA</strong>
                  <span>Makurdi</span>
                </div>
                <div class="detail-item">
                  <strong>Job Address</strong>
                  <span>8. Gorge Akume street</span>
                </div>
                <div class="detail-item">
                  <strong>Proposed Budget</strong>
                  <span class="text-success fw-bold">₦150,000 – ₦250,000</span>
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

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex gap-2">
                <button class="btn btn-success">
                  <i class="bi bi-check-circle me-1"></i> Accept
                </button>
                <button class="btn btn-danger">
                  <i class="bi bi-x-circle me-1"></i> Reject
                </button>
              </div>

              <!-- View Deliverables Button -->
              <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#deliverableModal">
                <i class="bi bi-folder2-open me-1"></i> View Deliverables
              </button>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Deliverables Modal -->
  <div class="modal fade" id="deliverableModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Surveyor Submitted Deliverable</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <p><strong>Surveyor:</strong> John Survey Ltd</p>
          <p><strong>Job Title:</strong> Boundary Survey – Benue</p>

          <hr>

          <div class="file-item">
            <span><i class="bi bi-file-pdf text-danger"></i> Boundary_Report.pdf</span>
            <a href="../uploads/boundary_report.pdf" class="btn btn-sm btn-outline-success" download>
              Download
            </a>
          </div>

          <p>Note to Client: Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis similique rerum voluptate, laudantium eveniet qui obcaecati impedit commodi nulla numquam reiciendis id praesentium quia nesciunt ullam. Voluptatum eligendi minima tempora!</p>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <style>
    .file-item {
      border: 1px solid #e5e5e5;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
