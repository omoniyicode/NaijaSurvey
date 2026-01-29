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
              <img src="assets/images/confidence.jpg" alt="John Adewale" class="profile-img">
              <span class="verified-badge-large">
                <i class="bi bi-patch-check-fill"></i>
              </span>
            </div>
          </div>
          
          <div class="col-lg-6 col-md-8 mt-3 mt-md-0">
            <h1 class="profile-name">John Adewale</h1>
            <p class="profile-title">Licensed Land Surveyor</p>
            
            <div class="profile-meta">
              <div class="meta-item">
                <i class="bi bi-geo-alt-fill"></i>
                <span>Lagos, Nigeria</span>
              </div>
              <div class="meta-item">
                <i class="bi bi-award-fill"></i>
                <span>License: S123456789</span>
              </div>
              <div class="meta-item">
                <i class="bi bi-briefcase-fill"></i>
                <span>10+ Years Experience</span>
              </div>
            </div>

            <div class="profile-rating">
              <div class="rating-stars-large">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
                <span class="rating-number-large">4.8</span>
              </div>
              <span class="reviews-text">(128 reviews)</span>
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
              Experienced land surveyor with over 10 years of expertise in boundary surveys, topographic mapping, and cadastral surveys. Committed to delivering accurate and reliable survey services to clients across Lagos and neighboring states. Member of the Nigerian Institution of Surveyors (NIS) and fully licensed by SURCON.
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
                <p>+234 801 234 5678</p>
              </div>
            </div>
            <div class="contact-item">
              <i class="bi bi-envelope-fill"></i>
              <div>
                <small>Email</small>
                <p>john.adewale@email.com</p>
              </div>
            </div>
            <div class="contact-item">
              <i class="bi bi-geo-alt-fill"></i>
              <div>
                <small>Location</small>
                <p>Lagos State, Nigeria</p>
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
                <small>License No: S123456789</small>
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
          <h5 class="modal-title">Contact John Adewale</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          
          <div class="mb-3">
            <label class="form-label fw-semibold">Service Needed</label>
            <select class="form-select" id="serviceSelect">
              <option value="">Select service type</option>
              <option>Bathymetric Mapping</option>
              <option>Bill of Quantities (BOQ)</option>
              <option>Boundary Survey</option>
              <option>Certificate of Occupancy (C of O)</option>
              <option>Contour Mapping</option>
              <option>Cost Estimation</option>
              <option>Elevation & Slope Data</option>
              <option>GIS Database Creation</option>
              <option>GPS / GNSS Measurements</option>
              <option>Land Demarcation</option>
              <option>Mining Layout & Monitoring</option>
              <option>National & Regional Mapping</option>
              <option>Property Subdivision</option>
              <option>Quarry Surveys</option>
              <option>Site Layout</option>
              <option>Spatial Data Analysis</option>
              <option>Terrain Analysis</option>
              <option>Title & Land Ownership Verification</option>
              <option>Topographic Survey</option>
              <option>Volume Calculations</option>
              <option value="other">Other (Specify below)</option>
            </select>
          </div>

          <div class="mb-3 d-none" id="otherServiceBox">
            <label class="form-label fw-semibold">Specify Service</label>
            <input type="text" class="form-control" placeholder="Enter your specific service need">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Project Location</label>
            <input type="text" class="form-control" placeholder="Enter project location">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Estimated Budget</label>
            <select class="form-select">
              <option selected disabled>Select budget range</option>
              <option>₦50,000 – ₦100,000</option>
              <option>₦100,000 – ₦250,000</option>
              <option>₦250,000 – ₦500,000</option>
              <option>₦500,000+</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Project Description</label>
            <textarea class="form-control" rows="4" placeholder="Describe your project requirements in detail..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Your Contact Information</label>
            <div class="row g-2">
              <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="col-md-6">
                <input type="tel" class="form-control" placeholder="Phone Number">
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-gold">
            <i class="bi bi-send me-2"></i>Send Request
          </button>
        </div>

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