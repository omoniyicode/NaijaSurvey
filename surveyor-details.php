<?php
session_start();

require_once "config/db-connect.php";
require_once "models/SurveyorProfile.php";
require_once "models/ClientProfile.php";
require_once "models/Request.php";

/* Validate surveyor ID (GET) */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: surveyor-listing.php");
    exit();
}

$surveyor_id = (int) $_GET['id'];

/* Fetch verified surveyor profile */
$surveyorModel = new SurveyorProfile();
$surveyor = $surveyorModel->getVerifiedSurveyorById($surveyor_id, $pdo);

if (!$surveyor) {
    header("Location: surveyor-listing.php");
    exit();
}

/* Handle "Contact Surveyor" form submission (POST) */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_surveyor'])) {

    // must be logged in as client
    if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'client') {
        header("Location: login.php");
        exit();
    }

    // get client profile
    $clientProfileModel = new ClientProfile();
    $clientProfile = $clientProfileModel->getClientProfileByAccountId(
        $_SESSION['id'],
        $pdo
    );

    if (!$clientProfile) {
        header("Location: client/profile.php");
        exit();
    }

    // sanitize inputs
    $service_category     = trim($_POST['service_category']);
    $project_state        = trim($_POST['project_state']);
    $project_lga          = trim($_POST['project_lga']);
    $project_address      = trim($_POST['project_address']);
    $estimated_budget     = trim($_POST['estimated_budget']);
    $project_description  = trim($_POST['project_description']);

    // create request
    $requestModel = new Request();
    $requestModel->createRequestToSurveyor(
        $clientProfile['id'],      // client_profile_id
        $surveyor['id'],           // surveyor_profile_id
        $service_category,
        $project_state,
        $project_lga,
        $project_address,
        $estimated_budget,
        $project_description,
        $pdo
    );

    // redirect to client outgoing requests
    header("Location: client/outgoing-requests.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Surveyor Profile - John Adewale | Survey Connect</title>
  <meta name="description" content="View the complete profile of verified surveyor John Adewale. Check credentials, portfolio, services, and client reviews.">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include "components/header.php"; ?>

  <!-- Profile Header Section -->
  <section class="profile-header-section">
    <div class="container">
      <div class="profile-header-card">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 text-center text-md-start">
            <div class="profile-avatar-large">
              <img src="uploads/profile_images/<?php echo htmlspecialchars($surveyor['profile_image']); ?>"
                  alt="<?php echo htmlspecialchars($surveyor['first_name']); ?>"
                  class="profile-img">
              <span class="verified-badge-large">
                <i class="bi bi-patch-check-fill"></i>
              </span>
            </div>
          </div>
          
          <div class="col-lg-6 col-md-8 mt-3 mt-md-0">
           <h1 class="profile-name">
              <?php echo htmlspecialchars($surveyor['first_name'] . ' ' . $surveyor['surname']); ?>
           </h1>
            <p class="profile-title">
              <?php echo htmlspecialchars($surveyor['specialization']); ?>
            </p>
            
            <div class="profile-meta">
              <div class="meta-item">
                <i class="bi bi-geo-alt-fill"></i>
               <span>
                  <?php echo htmlspecialchars($surveyor['state']); ?>, Nigeria
               </span>
              </div>
              <div class="meta-item">
                <i class="bi bi-award-fill"></i>
                <span>
                  License: <?php echo htmlspecialchars($surveyor['surcon_number']); ?>
                </span>
              </div>
              <div class="meta-item">
                <i class="bi bi-briefcase-fill"></i>
                <span>
                  <?php echo (int)$surveyor['years_of_experience']; ?>+ Years Experience
                </span>
              </div>
            </div>

            <div class="profile-rating">
              <div class="rating-stars-large">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
                <span class="rating-number-large">
                  <?php echo $surveyor['rating']; ?>
                </span>
              </div>
              <span class="reviews-text">
                (<?php echo (int)$surveyor['reviews_count']; ?> reviews)
              </span>
            </div>
          </div>

          <div class="col-lg-3 mt-3 mt-lg-0 text-center text-lg-end">
            <button class="btn btn-gold btn-lg w-100 mb-2" data-bs-toggle="modal" data-bs-target="#contactSurveyorModal">
              <i class="bi bi-envelope me-2"></i>Contact Surveyor
            </button>
            <button class="btn btn-outline-primary w-100">
              <i class="bi bi-share me-2"></i>Share Profile
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="profile-stats-section">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-3 col-md-6">
          <div class="stat-box">
            <div class="stat-icon-box bg-success-subtle">
              <i class="bi bi-check-circle-fill text-success"></i>
            </div>
            <div class="stat-info">
              <h3>124</h3>
              <p>Completed Projects</p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="stat-box">
            <div class="stat-icon-box bg-primary-subtle">
              <i class="bi bi-people-fill text-primary"></i>
            </div>
            <div class="stat-info">
              <h3>89</h3>
              <p>Happy Clients</p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="stat-box">
            <div class="stat-icon-box bg-warning-subtle">
              <i class="bi bi-trophy-fill text-warning"></i>
            </div>
            <div class="stat-info">
              <h3>98%</h3>
              <p>Success Rate</p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="stat-box">
            <div class="stat-icon-box bg-info-subtle">
              <i class="bi bi-clock-fill text-info"></i>
            </div>
            <div class="stat-info">
              <h3>24h</h3>
              <p>Response Time</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content Section -->
  <section class="profile-content-section">
    <div class="container">
      <div class="row g-4">
        
        <!-- Left Column -->
        <div class="col-lg-8">
          
          <!-- About Section -->
          <div class="content-card">
            <h3 class="content-title">
              <i class="bi bi-person-circle me-2"></i>About
            </h3>
            <p class="text-muted">
              <?php echo nl2br(htmlspecialchars($surveyor['bio'])); ?>
            </p>
            <div class="specializations">
              <h5 class="mb-3">Specializations</h5>
              <div class="d-flex flex-wrap gap-2">
                <span class="badge-tag">Boundary Survey</span>
                <span class="badge-tag">Topographic Survey</span>
                <span class="badge-tag">Site Layout</span>
                <span class="badge-tag">Land Demarcation</span>
                <span class="badge-tag">GPS Measurements</span>
              </div>
            </div>
          </div>

          <!-- Services Section -->
          <div class="content-card">
            <h3 class="content-title">
              <i class="bi bi-gear-fill me-2"></i>Professional Services
            </h3>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="service-item">
                  <div class="service-icon">
                    <i class="bi bi-pin-map-fill"></i>
                  </div>
                  <div class="service-content">
                    <h5>Boundary Survey</h5>
                    <p>Accurate land boundary definition and demarcation.</p>
                    <span class="service-price">From ₦150,000</span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="service-item">
                  <div class="service-icon">
                    <i class="bi bi-map-fill"></i>
                  </div>
                  <div class="service-content">
                    <h5>Topographic Survey</h5>
                    <p>Terrain and elevation mapping for construction.</p>
                    <span class="service-price">From ₦200,000</span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="service-item">
                  <div class="service-icon">
                    <i class="bi bi-rulers"></i>
                  </div>
                  <div class="service-content">
                    <h5>Site Layout</h5>
                    <p>Precise construction positioning and setting out.</p>
                    <span class="service-price">From ₦180,000</span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="service-item">
                  <div class="service-icon">
                    <i class="bi bi-geo-fill"></i>
                  </div>
                  <div class="service-content">
                    <h5>GPS/GNSS Measurements</h5>
                    <p>High-precision positioning and coordinates.</p>
                    <span class="service-price">From ₦120,000</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Portfolio Section -->
          <div class="content-card">
            <h3 class="content-title">
              <i class="bi bi-images me-2"></i>Portfolio
            </h3>
            <div class="row g-3">
              <div class="col-md-4">
                <div class="portfolio-item">
                  <img src="assets/images/boundary survey job.png" alt="Project">
                  <div class="portfolio-overlay">
                    <div class="portfolio-info">
                      <h6>Boundary Survey</h6>
                      <span class="badge bg-success">Completed</span>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="portfolio-item">
                  <img src="assets/images/boundary survey job.png" alt="Project">
                  <div class="portfolio-overlay">
                    <div class="portfolio-info">
                      <h6>Topographic Survey</h6>
                      <span class="badge bg-success">Completed</span>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="portfolio-item">
                  <img src="assets/images/boundary survey job.png" alt="Project">
                  <div class="portfolio-overlay">
                    <div class="portfolio-info">
                      <h6>Site Layout</h6>
                      <span class="badge bg-success">Completed</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Reviews Section -->
          <div class="content-card">
            <h3 class="content-title">
              <i class="bi bi-star-fill me-2"></i>Client Reviews
            </h3>
            
            <div class="review-item">
              <div class="review-header">
                <div class="reviewer-avatar">A</div>
                <div class="reviewer-info">
                  <h6>Adebayo Johnson</h6>
                  <div class="review-rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                  </div>
                  <small class="text-muted">2 weeks ago</small>
                </div>
              </div>
              <p class="review-text">
                Excellent service! John was very professional and completed the boundary survey ahead of schedule. Highly recommend for anyone needing surveying services in Lagos.
              </p>
            </div>

            <div class="review-item">
              <div class="review-header">
                <div class="reviewer-avatar">M</div>
                <div class="reviewer-info">
                  <h6>Mrs. Okonkwo</h6>
                  <div class="review-rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                  </div>
                  <small class="text-muted">1 month ago</small>
                </div>
              </div>
              <p class="review-text">
                Very thorough and detail-oriented. The topographic survey was exactly what we needed for our construction project. Great communication throughout.
              </p>
            </div>

            <button class="btn btn-outline-primary w-100 mt-3">
              <i class="bi bi-chevron-down me-2"></i>Load More Reviews
            </button>
          </div>

        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
          
          <!-- Contact Info Card -->
          <div class="sidebar-card">
            <h4 class="sidebar-title">Contact Information</h4>
            <div class="contact-item">
              <i class="bi bi-telephone-fill"></i>
              <div>
                <small>Phone</small>
                <p><?php echo htmlspecialchars($surveyor['phone_number']); ?></p>
              </div>
            </div>
            <div class="contact-item">
              <i class="bi bi-envelope-fill"></i>
              <div>
                <small>Email</small>
                <p><?php echo htmlspecialchars($surveyor['email']); ?></p>
              </div>
            </div>
            <div class="contact-item">
              <i class="bi bi-geo-alt-fill"></i>
              <div>
                <small>Location</small>
                <p><?php echo htmlspecialchars($surveyor['state']); ?> State, Nigeria</p>
              </div>
            </div>
          </div>

          <!-- Certifications Card -->
          <div class="sidebar-card">
            <h4 class="sidebar-title">Certifications & Licenses</h4>
            <div class="certification-item">
              <i class="bi bi-patch-check-fill text-success"></i>
              <div>
                <h6>SURCON Licensed</h6>
                 <p><?php echo htmlspecialchars($surveyor['surcon_number']); ?></p>
              </div>
            </div>
            <div class="certification-item">
              <i class="bi bi-patch-check-fill text-success"></i>
              <div>
                <h6>NIS Member</h6>
                <small>Member since 2013</small>
              </div>
            </div>
            <div class="certification-item">
              <i class="bi bi-patch-check-fill text-success"></i>
              <div>
                <h6>BSc. Surveying & Geoinformatics</h6>
                <small>University of Lagos</small>
              </div>
            </div>
          </div>

          <!-- Working Hours Card -->
          <div class="sidebar-card">
            <h4 class="sidebar-title">Working Hours</h4>
            <div class="working-hours">
              <div class="hours-item">
                <span>Monday - Friday</span>
                <span class="fw-bold">8:00 AM - 6:00 PM</span>
              </div>
              <div class="hours-item">
                <span>Saturday</span>
                <span class="fw-bold">9:00 AM - 2:00 PM</span>
              </div>
              <div class="hours-item">
                <span>Sunday</span>
                <span class="text-muted">Closed</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- Contact Modal -->
  <div class="modal fade" id="contactSurveyorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title">Contact: <?php echo htmlspecialchars($surveyor['first_name'] . ' ' . $surveyor['surname']); ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          
          <form method="post">
            <input type="hidden" name="contact_surveyor" value="1">

            <input type="hidden" name="project_state" value="<?= htmlspecialchars($surveyor['state']) ?>">

            <div class="mb-3">
              <label class="form-label fw-semibold">Service Needed</label>
              <select class="form-select" name="service_category" required>
                <option value="">Select service type</option>
                <option>Boundary Survey</option>
                <option>Topographic Survey</option>
                <option>Site Layout</option>
                <option>GIS Survey</option>
                <option value="other">Other</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Project LGA</label>
              <input type="text" class="form-control" name="project_lga" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Project Address</label>
              <input type="text" class="form-control" name="project_address" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Estimated Budget</label>
              <input type="text" class="form-control" name="estimated_budget" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Project Description</label>
              <textarea class="form-control" rows="4" name="project_description" required></textarea>
            </div>

            <button type="submit" class="btn btn-gold">
              <i class="bi bi-send me-2"></i>Send Request
            </button>
          </form>

      </div>
    </div>
  </div>

  <?php include "components/footer.php"; ?>

  <script>
    // Service dropdown toggle for "Other" option
    document.getElementById('serviceSelect').addEventListener('change', function() {
      const otherBox = document.getElementById('otherServiceBox');
      if (this.value === 'other') {
        otherBox.classList.remove('d-none');
      } else {
        otherBox.classList.add('d-none');
      }
    });
  </script>

</body>

</html>