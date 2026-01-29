<?php
session_start();
require_once "config/db-connect.php";
require_once "models/Job.php";

$jobsInstance = new Job();
$jobs = $jobsInstance->getAllJobs($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Survey Jobs - Find & Post Jobs | Survey Connect</title>
  <meta name="description" content="Browse available survey jobs or post a new one. Connect with verified surveyors and clients across Nigeria.">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include "components/header.php"; ?>

  <!-- Page Header Section -->
  <section class="page-header-section mt-5 mb-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8 mx-auto text-center">
          <span class="section-subtitle">Opportunities</span>
          <h1 class="page-header-title">Survey Jobs</h1>
          <p class="page-header-desc">Browse available survey jobs or post a new opportunity. Connect with professionals across Nigeria.</p>
          
          <?php if (isset($_SESSION['id']) && $_SESSION['user_type'] === 'client'): ?>
                <button class="btn btn-gold btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#postJobModal">
                <i class="bi bi-plus-circle me-2"></i>Post a Job
                </button>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>

  <?php
    if (!empty($_SESSION['error'])) {
        echo '<div id="alert-error" class="alert alert-danger text-center fw-bold">'
            . $_SESSION['error'] .
        '</div>';

        unset($_SESSION['error']); // clear after showing
    }

    if (!empty($_SESSION['success'])) {
        echo '<div id="alert-success" class="alert alert-success text-center fw-bold">'
            . $_SESSION['success'] .
        '</div>';

        unset($_SESSION['success']); // clear after showing
    }
  ?>

  <!-- Search & Filter Section -->
  <section class="search-filter-section">
    <div class="container">
      <div class="search-filter-card">
        <div class="row g-3 align-items-end">
          <div class="col-lg-4 col-md-6">
            <label class="form-label fw-semibold">Search Jobs</label>
            <input type="text" class="form-control" placeholder="Enter job title or keyword...">
          </div>
          <div class="col-lg-3 col-md-6">
            <label class="form-label fw-semibold">Location</label>
            <select class="form-select">
              <option value="">All Locations</option>
              <option>Lagos</option>
              <option>Abuja (FCT)</option>
              <option>Benue</option>
              <option>Kaduna</option>
              <option>Rivers</option>
            </select>
          </div>
          <div class="col-lg-3 col-md-6">
            <label class="form-label fw-semibold">Survey Type</label>
            <select class="form-select">
              <option value="">All Types</option>
              <option>Boundary Survey</option>
              <option>Topographic Survey</option>
              <option>GIS Survey</option>
              <option>Site Layout</option>
            </select>
          </div>
          <div class="col-lg-2 col-md-6">
            <button class="btn btn-gold w-100">
              <i class="bi bi-search me-2"></i>Search
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Jobs List Section -->
  <section class="jobs-list-section">
    <div class="container">
      
      <!-- Results Header -->
      <div class="results-header">
        <h5>Showing <span class="text-primary"><?php echo count($jobs); ?> Jobs Available</span></h5>
        <div class="view-toggle">
          <button class="btn btn-sm btn-outline-secondary active">
            <i class="bi bi-grid"></i>
          </button>
          <button class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-list"></i>
          </button>
        </div>
      </div>

      <!-- Jobs Grid -->
      <div class="row g-4">

        <?php if(empty($jobs)): ?>
          <div class="col-12">
            <div class="alert alert-info text-center">
              <i class="bi bi-info-circle me-2"></i>
              No jobs available at the moment. Check back later!
            </div>
          </div>
        <?php else: ?>
          <?php foreach($jobs as $job): ?>
            <?php 
              $client_name = htmlspecialchars($job['first_name'] . ' ' . $job['surname']);
              $location = htmlspecialchars($job['job_state'] . ', ' . $job['job_lga']);
              $full_address = htmlspecialchars($job['job_state'] . ', ' . $job['job_lga'] . ' - ' . $job['job_address']);
              $created_date = date('d M Y', strtotime($job['created_at']));
            ?>
            <div class="col-lg-4 col-md-6">
              <div class="job-card">
                
                <div class="job-card-body">
                  <h5 class="job-title"><?php echo htmlspecialchars($job['job_title']); ?></h5>
                  
                  <div class="job-meta">
                    <div class="meta-item">
                      <i class="bi bi-geo-alt-fill"></i>
                      <span><?php echo $location; ?></span>
                    </div>
                    <div class="meta-item">
                      <i class="bi bi-person-fill"></i>
                      <span><?php echo $client_name; ?></span>
                    </div>
                  </div>

                  <div class="job-budget">
                    <i class="bi bi-currency-exchange"></i>
                    <span>₦<?php echo number_format($job['proposed_budget']); ?></span>
                  </div>
                </div>

                <div class="job-card-footer">
                  <button class="btn btn-outline-primary w-100"
                      data-bs-toggle="modal"
                      data-bs-target="#jobDetailModal"
                      data-job-id="<?php echo $job['job_id']; ?>"
                      data-client-profile-id="<?php echo $job['client_profile_id']; ?>"
                      data-title="<?php echo htmlspecialchars($job['job_title']); ?>"
                      data-client="<?php echo $client_name; ?>"
                      data-location="<?php echo $full_address; ?>"
                      data-budget="₦<?php echo number_format($job['proposed_budget']); ?>"
                      data-date="<?php echo $created_date; ?>"
                      data-desc="<?php echo htmlspecialchars($job['job_description']); ?>">
                    <i class="bi bi-eye me-2"></i>View Details
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>

      <!-- Pagination -->
      <div class="pagination-wrapper">
        <nav>
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link"><i class="bi bi-chevron-left"></i></a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item">
              <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>

    </div>
  </section>

  <!-- Job Details Modal -->
  <div class="modal fade" id="jobDetailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title">Job Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <!-- Job Info Grid -->
          <div class="job-detail-grid">
            <div class="detail-item">
              <span class="detail-label">Job Title</span>
              <span class="detail-value" id="detailTitle"></span>
            </div>
            
            <div class="detail-item">
              <span class="detail-label">Posted By</span>
              <span class="detail-value" id="detailClient"></span>
            </div>
            
            <div class="detail-item">
              <span class="detail-label">Location</span>
              <span class="detail-value" id="detailLocation"></span>
            </div>
            
            <div class="detail-item">
              <span class="detail-label">Budget</span>
              <span class="detail-value text-success fw-bold" id="detailBudget"></span>
            </div>
            
            <div class="detail-item">
              <span class="detail-label">Posted Date</span>
              <span class="detail-value" id="detailDate"></span>
            </div>
          </div>

          <hr class="my-4">

          <div class="mb-4">
            <h6 class="fw-bold mb-2">Job Description</h6>
            <p class="text-muted" id="detailDesc"></p>
          </div>

          <div class="alert alert-info d-flex align-items-center">
            <i class="bi bi-info-circle me-2"></i>
            <span>Contact the job poster for more information.</span>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <?php if (isset($_SESSION['id']) && $_SESSION['user_type'] === 'surveyor'): ?>
            <form action="processes/send-request-to-client-process.php" method="POST" id="applyJobForm">
              <input type="hidden" name="job_id" id="modalJobId">
              <input type="hidden" name="client_profile_id" id="modalClientProfileId">
              <button type="submit" name="apply_for_job" class="btn btn-gold">
                <i class="bi bi-send me-2"></i>Apply for Job
              </button>
            </form>
          <?php elseif (isset($_SESSION['id']) && $_SESSION['user_type'] === 'client'): ?>
            <button type="button" class="btn btn-gold" disabled title="Clients cannot apply for jobs">
              <i class="bi bi-send me-2"></i>Apply for Job
            </button>
          <?php else: ?>
            <a href="login.php" class="btn btn-gold">
              <i class="bi bi-box-arrow-in-right me-2"></i>Login to Apply
            </a>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>

  <!-- Post Job Modal -->
  <div class="modal fade" id="postJobModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title">Post a New Job</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          
          <form action="processes/post-job-process.php" method="POST">
            <div class="row g-3">
              
              <div class="col-12">
                <label class="form-label fw-semibold">Job Title <span class="text-danger">*</span></label>
                <input type="text" name="job_title" class="form-control" placeholder="e.g., Boundary Survey for Residential Plot" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-semibold">Job Description <span class="text-danger">*</span></label>
                <textarea name="job_description" class="form-control" rows="5" placeholder="Describe your project requirements in detail..." required></textarea>
              </div>

              <div class="col-md-12">
                <label class="form-label fw-semibold">Proposed Budget (₦) <span class="text-danger">*</span></label>
                <input type="number" name="proposed_budget" class="form-control" placeholder="e.g., 150000" min="0" step="1000" required>
                <small class="text-muted">Enter your budget in Naira</small>
              </div>

              <div class="col-md-4">
                <label class="form-label fw-semibold">State <span class="text-danger">*</span></label>
                <input type="text" name="job_state" class="form-control" placeholder="e.g., Benue" required>
              </div>

              <div class="col-md-4">
                <label class="form-label fw-semibold">LGA <span class="text-danger">*</span></label>
                <input type="text" name="job_lga" class="form-control" placeholder="e.g., Makurdi" required>
              </div>

              <div class="col-md-4">
                <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                <input type="text" name="job_address" class="form-control" placeholder="Street/Area" required>
              </div>

              <button type="submit" name="post_job" class="btn btn-gold">
                <i class="bi bi-check-circle me-2"></i>Submit Job
              </button>
            </div>
          </form>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>

      </div>
    </div>
  </div>

  <?php include "components/footer.php"; ?>

  <script>
    // Populate job details modal
    const jobDetailModal = document.getElementById('jobDetailModal');
    jobDetailModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      
      document.getElementById('detailTitle').textContent = button.getAttribute('data-title');
      document.getElementById('detailClient').textContent = button.getAttribute('data-client');
      document.getElementById('detailLocation').textContent = button.getAttribute('data-location');
      document.getElementById('detailBudget').textContent = button.getAttribute('data-budget');
      document.getElementById('detailDate').textContent = button.getAttribute('data-date');
      document.getElementById('detailDesc').textContent = button.getAttribute('data-desc');
      
      // Populate hidden form fields for apply job form
      const jobId = button.getAttribute('data-job-id');
      const clientProfileId = button.getAttribute('data-client-profile-id');
      
      if (document.getElementById('modalJobId')) {
        document.getElementById('modalJobId').value = jobId;
      }
      if (document.getElementById('modalClientProfileId')) {
        document.getElementById('modalClientProfileId').value = clientProfileId;
      }
    });
  </script>

</body>

</html>
