<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Find Verified Surveyors - Survey Connect</title>
  <meta name="description" content="Browse and connect with verified, licensed surveyors across Nigeria. View profiles, credentials, and reviews.">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include "components/header.php"; ?>

  <!-- Page Header -->
  <section class="page-header-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8 mx-auto text-center">
          <span class="section-subtitle">Our Network</span>
          <h1 class="page-header-title">Licensed Surveyors</h1>
          <p class="page-header-desc">Browse verified surveyors across different locations. All professionals are manually verified and licensed.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Search & Filter Section -->
  <section class="search-filter-section">
    <div class="container">
      <div class="search-filter-card">
        <div class="row g-3 align-items-end">
          <div class="col-lg-4 col-md-6">
            <label class="form-label fw-semibold">Search by Name</label>
            <input type="text" class="form-control" placeholder="Enter surveyor name...">
          </div>
          <div class="col-lg-3 col-md-6">
            <label class="form-label fw-semibold">Location</label>
            <select class="form-select">
              <option value="">All States</option>
              <option>Lagos</option>
              <option>Abuja (FCT)</option>
              <option>Kaduna</option>
              <option>Rivers</option>
              <option>Oyo</option>
            </select>
          </div>
          <div class="col-lg-3 col-md-6">
            <label class="form-label fw-semibold">Specialization</label>
            <select class="form-select">
              <option value="">All Types</option>
              <option>Land & Boundary</option>
              <option>Engineering Survey</option>
              <option>Topographic Survey</option>
              <option>Cadastral Survey</option>
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

  <!-- Surveyors List Section -->
  <section class="surveyors-list-section">
    <div class="container">
      
      <!-- Results Header -->
      <div class="results-header">
        <h5>Showing <span class="text-primary">9 Surveyors</span></h5>
        <div class="view-toggle">
          <button class="btn btn-sm btn-outline-secondary active">
            <i class="bi bi-grid"></i>
          </button>
          <button class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-list"></i>
          </button>
        </div>
      </div>

      <!-- Surveyors Grid -->
      <div class="row g-4">

        <!-- Surveyor Card 1 -->
        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-listing">
            <div class="surveyor-card-header">
              <div class="surveyor-avatar-wrapper">
                <img src="assets/images/survey gallary (1).jpg" alt="Surveyor" class="surveyor-avatar-img">
                <span class="verified-badge-overlay">
                  <i class="bi bi-patch-check-fill"></i>
                </span>
              </div>
              <div class="surveyor-header-info">
                <h5>Engr. Samuel Okoro</h5>
                <p class="location-text">
                  <i class="bi bi-geo-alt"></i> Lagos State
                </p>
              </div>
            </div>

            <div class="surveyor-card-body">
              <div class="info-row">
                <span class="info-label">License No:</span>
                <span class="info-value">SURV-NG-10234</span>
              </div>
              <div class="info-row">
                <span class="info-label">Specialization:</span>
                <span class="info-value">Land & Boundary Survey</span>
              </div>
              <div class="info-row">
                <span class="info-label">Experience:</span>
                <span class="info-value">10+ Years</span>
              </div>

              <div class="rating-reviews">
                <div class="rating-stars">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-half text-warning"></i>
                  <span class="rating-number">4.8</span>
                </div>
                <span class="reviews-count">(45 reviews)</span>
              </div>
            </div>

            <div class="surveyor-card-footer">
              <a href="surveyor-details.php" class="btn btn-outline-primary w-100">
                <i class="bi bi-eye me-2"></i>View Profile
              </a>
            </div>
          </div>
        </div>

        <!-- Surveyor Card 2 -->
        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-listing">
            <div class="surveyor-card-header">
              <div class="surveyor-avatar-wrapper">
                <img src="assets/images/survey gallary (2).jpg" alt="Surveyor" class="surveyor-avatar-img">
                <span class="verified-badge-overlay">
                  <i class="bi bi-patch-check-fill"></i>
                </span>
              </div>
              <div class="surveyor-header-info">
                <h5>Surveyor Aisha Bello</h5>
                <p class="location-text">
                  <i class="bi bi-geo-alt"></i> Abuja (FCT)
                </p>
              </div>
            </div>

            <div class="surveyor-card-body">
              <div class="info-row">
                <span class="info-label">License No:</span>
                <span class="info-value">SURV-NG-22451</span>
              </div>
              <div class="info-row">
                <span class="info-label">Specialization:</span>
                <span class="info-value">Engineering Survey</span>
              </div>
              <div class="info-row">
                <span class="info-label">Experience:</span>
                <span class="info-value">8+ Years</span>
              </div>

              <div class="rating-reviews">
                <div class="rating-stars">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <span class="rating-number">5.0</span>
                </div>
                <span class="reviews-count">(62 reviews)</span>
              </div>
            </div>

            <div class="surveyor-card-footer">
              <a href="surveyor-details.php" class="btn btn-outline-primary w-100">
                <i class="bi bi-eye me-2"></i>View Profile
              </a>
            </div>
          </div>
        </div>

        <!-- Surveyor Card 3 -->
        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-listing">
            <div class="surveyor-card-header">
              <div class="surveyor-avatar-wrapper">
                <img src="assets/images/survey gallary (3).jpg" alt="Surveyor" class="surveyor-avatar-img">
                <span class="verified-badge-overlay">
                  <i class="bi bi-patch-check-fill"></i>
                </span>
              </div>
              <div class="surveyor-header-info">
                <h5>Engr. Ibrahim Musa</h5>
                <p class="location-text">
                  <i class="bi bi-geo-alt"></i> Kaduna State
                </p>
              </div>
            </div>

            <div class="surveyor-card-body">
              <div class="info-row">
                <span class="info-label">License No:</span>
                <span class="info-value">SURV-NG-33890</span>
              </div>
              <div class="info-row">
                <span class="info-label">Specialization:</span>
                <span class="info-value">Topographic Survey</span>
              </div>
              <div class="info-row">
                <span class="info-label">Experience:</span>
                <span class="info-value">12+ Years</span>
              </div>

              <div class="rating-reviews">
                <div class="rating-stars">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star text-warning"></i>
                  <span class="rating-number">4.5</span>
                </div>
                <span class="reviews-count">(38 reviews)</span>
              </div>
            </div>

            <div class="surveyor-card-footer">
              <a href="surveyor-details.php" class="btn btn-outline-primary w-100">
                <i class="bi bi-eye me-2"></i>View Profile
              </a>
            </div>
          </div>
        </div>

        <!-- Repeat cards for more surveyors (Cards 4-9) -->
        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-listing">
            <div class="surveyor-card-header">
              <div class="surveyor-avatar-wrapper">
                <img src="assets/images/survey gallary (1).jpg" alt="Surveyor" class="surveyor-avatar-img">
                <span class="verified-badge-overlay">
                  <i class="bi bi-patch-check-fill"></i>
                </span>
              </div>
              <div class="surveyor-header-info">
                <h5>Dr. Chidinma Okafor</h5>
                <p class="location-text">
                  <i class="bi bi-geo-alt"></i> Rivers State
                </p>
              </div>
            </div>

            <div class="surveyor-card-body">
              <div class="info-row">
                <span class="info-label">License No:</span>
                <span class="info-value">SURV-NG-45672</span>
              </div>
              <div class="info-row">
                <span class="info-label">Specialization:</span>
                <span class="info-value">Cadastral Survey</span>
              </div>
              <div class="info-row">
                <span class="info-label">Experience:</span>
                <span class="info-value">15+ Years</span>
              </div>

              <div class="rating-reviews">
                <div class="rating-stars">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <span class="rating-number">4.9</span>
                </div>
                <span class="reviews-count">(71 reviews)</span>
              </div>
            </div>

            <div class="surveyor-card-footer">
              <a href="surveyor-details.php" class="btn btn-outline-primary w-100">
                <i class="bi bi-eye me-2"></i>View Profile
              </a>
            </div>
          </div>
        </div>

        <!-- Cards 5-6 (shortened for brevity) -->
        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-listing">
            <div class="surveyor-card-header">
              <div class="surveyor-avatar-wrapper">
                <img src="assets/images/survey gallary (2).jpg" alt="Surveyor" class="surveyor-avatar-img">
                <span class="verified-badge-overlay">
                  <i class="bi bi-patch-check-fill"></i>
                </span>
              </div>
              <div class="surveyor-header-info">
                <h5>Surveyor Oluwaseun Balogun</h5>
                <p class="location-text">
                  <i class="bi bi-geo-alt"></i> Oyo State
                </p>
              </div>
            </div>

            <div class="surveyor-card-body">
              <div class="info-row">
                <span class="info-label">License No:</span>
                <span class="info-value">SURV-NG-56789</span>
              </div>
              <div class="info-row">
                <span class="info-label">Specialization:</span>
                <span class="info-value">Land Development</span>
              </div>
              <div class="info-row">
                <span class="info-label">Experience:</span>
                <span class="info-value">7+ Years</span>
              </div>

              <div class="rating-reviews">
                <div class="rating-stars">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-half text-warning"></i>
                  <span class="rating-number">4.7</span>
                </div>
                <span class="reviews-count">(29 reviews)</span>
              </div>
            </div>

            <div class="surveyor-card-footer">
              <a href="surveyor-details.php" class="btn btn-outline-primary w-100">
                <i class="bi bi-eye me-2"></i>View Profile
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-listing">
            <div class="surveyor-card-header">
              <div class="surveyor-avatar-wrapper">
                <img src="assets/images/survey gallary (3).jpg" alt="Surveyor" class="surveyor-avatar-img">
                <span class="verified-badge-overlay">
                  <i class="bi bi-patch-check-fill"></i>
                </span>
              </div>
              <div class="surveyor-header-info">
                <h5>Engr. Fatima Abdullahi</h5>
                <p class="location-text">
                  <i class="bi bi-geo-alt"></i> Kano State
                </p>
              </div>
            </div>

            <div class="surveyor-card-body">
              <div class="info-row">
                <span class="info-label">License No:</span>
                <span class="info-value">SURV-NG-67890</span>
              </div>
              <div class="info-row">
                <span class="info-label">Specialization:</span>
                <span class="info-value">Hydrographic Survey</span>
              </div>
              <div class="info-row">
                <span class="info-label">Experience:</span>
                <span class="info-value">9+ Years</span>
              </div>

              <div class="rating-reviews">
                <div class="rating-stars">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <span class="rating-number">4.9</span>
                </div>
                <span class="reviews-count">(54 reviews)</span>
              </div>
            </div>

            <div class="surveyor-card-footer">
              <a href="surveyor-details.php" class="btn btn-outline-primary w-100">
                <i class="bi bi-eye me-2"></i>View Profile
              </a>
            </div>
          </div>
        </div>

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
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>

    </div>
  </section>

  <?php include "components/footer.php"; ?>

</body>
</html>