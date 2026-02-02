<?php
require_once "config/db-connect.php";


//SEARCH FILTERS
$name = trim($_GET['name'] ?? '');
$state = trim($_GET['state'] ?? '');
$specialization = trim($_GET['specialization'] ?? '');

//PAGINATION SETTINGS
$page  = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 6; // surveyors per page
$offset = ($page - 1) * $limit;


// COUNT TOTAL SURVEYORS
$countSql = "
    SELECT COUNT(*)
    FROM surveyors_profile
    WHERE verification_status = 'verified'
";

$countParams = [];

if (!empty($name)) {
    $countSql .= " AND CONCAT(first_name, ' ', surname) LIKE ?";
    $countParams[] = "%$name%";
}

if (!empty($state)) {
    $countSql .= " AND state = ?";
    $countParams[] = $state;
}

if (!empty($specialization)) {
    $countSql .= " AND specialization = ?";
    $countParams[] = $specialization;
}

$countStmt = $pdo->prepare($countSql);
$countStmt->execute($countParams);
$totalSurveyors = (int)$countStmt->fetchColumn();

$totalPages = ceil($totalSurveyors / $limit);


// FETCH SURVEYORS (WITH PAGINATION)
$sql = "
    SELECT *
    FROM surveyors_profile
    WHERE verification_status = 'verified'
";

$params = [];

if (!empty($name)) {
    $sql .= " AND CONCAT(first_name, ' ', surname) LIKE ?";
    $params[] = "%$name%";
}

if (!empty($state)) {
    $sql .= " AND state = ?";
    $params[] = $state;
}

if (!empty($specialization)) {
    $sql .= " AND specialization = ?";
    $params[] = $specialization;
}

//MySQL-safe pagination
$sql .= " ORDER BY rating DESC LIMIT $limit OFFSET $offset";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$surveyors = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

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
          <form method="GET" action="">
              <div class="row g-3 align-items-end">

                <div class="col-lg-4 col-md-6">
                  <label class="form-label fw-semibold">Search by Name</label>
                  <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Enter surveyor name..."
                    value="<?php echo $_GET['name'] ?? ''; ?>">
                </div>

                <div class="col-lg-3 col-md-6">
                  <label class="form-label fw-semibold">Search by State</label>
                  <input
                    type="text"
                    name="state"
                    class="form-control"
                    placeholder="Search by state"
                    value="<?php echo $_GET['state'] ?? ''; ?>">
                </div>                

                <div class="col-lg-3 col-md-6">
                  <label class="form-label fw-semibold">Specialization</label>
                  <select name="specialization" class="form-select">
                    <option value="">All Types</option>

                    <option value="Land & Boundary Survey"
                      <?php echo ($_GET['specialization'] ?? '') === 'Land & Boundary Survey' ? 'selected' : ''; ?>>
                      Land & Boundary Survey
                    </option>

                    <option value="Engineering Survey"
                      <?php echo ($_GET['specialization'] ?? '') === 'Engineering Survey' ? 'selected' : ''; ?>>
                      Engineering Survey
                    </option>

                    <option value="Topographic Survey"
                      <?php echo ($_GET['specialization'] ?? '') === 'Topographic Survey' ? 'selected' : ''; ?>>
                      Topographic Survey
                    </option>
                    
                    <option value="Cadastral Survey"
                      <?php echo ($_GET['specialization'] ?? '') === 'Cadastral Survey' ? 'selected' : ''; ?>>
                      Cadastral Survey
                    </option>
                    
                    <option value="Hydrographic Survey"
                      <?php echo ($_GET['specialization'] ?? '') === 'Hydrographic Survey' ? 'selected' : ''; ?>>
                      Hydrographic Survey
                    </option>

                    <option value="GIS Survey"
                      <?php echo ($_GET['specialization'] ?? '') === 'GIS Survey' ? 'selected' : ''; ?>>
                      GIS Survey
                    </option>

                  </select>
                </div>

                <div class="col-lg-2 col-md-6">
                  <button class="btn btn-gold w-100">
                    <i class="bi bi-search me-2"></i>Search
                  </button>
                </div>

              </div>
            </form>

        </div>
      </div>
    </div>
  </section>

  <!-- Surveyors List Section -->
  <section class="surveyors-list-section">
    <div class="container">
      
      <!-- Results Header -->
      <div class="results-header">
        <h5>Showing <span class="text-primary"><?php echo count($surveyors); ?> Surveyors</span></h5>
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

        <?php if (empty($surveyors)): ?>
          <div class="col-12">
            <div class="alert alert-info text-center">
              No verified surveyors available at the moment.
            </div>
          </div>
        <?php else: ?>
          <?php foreach ($surveyors as $surveyor): ?>
            <div class="col-lg-4 col-md-6">
              <div class="surveyor-card-listing">

                <div class="surveyor-card-header">
                  <div class="surveyor-avatar-wrapper">
                    <img src="uploads/profile_images/<?php echo htmlspecialchars($surveyor['profile_image']); ?>"
                        class="surveyor-avatar-img"
                        alt="Surveyor">

                    <?php if ($surveyor['verification_status'] === 'verified'): ?>
                      <span class="verified-badge-overlay">
                        <i class="bi bi-patch-check-fill"></i>
                      </span>
                    <?php endif; ?>
                  </div>

                  <div class="surveyor-header-info">
                    <h5><?php echo htmlspecialchars($surveyor['first_name'] . ' ' . $surveyor['surname']); ?></h5>
                    <p class="location-text">
                      <i class="bi bi-geo-alt"></i>
                      <?php echo htmlspecialchars($surveyor['state']); ?>
                    </p>
                  </div>
                </div>

                <div class="surveyor-card-body">
                  <div class="info-row">
                    <span class="info-label">License No:</span>
                    <span class="info-value"><?php echo htmlspecialchars($surveyor['surcon_number']); ?></span>
                  </div>


                  <div class="info-row">
                    <span class="info-label">Specialization:</span>
                    <span class="info-value"><?php echo htmlspecialchars($surveyor['specialization']); ?></span>
                  </div>

                 
                  <div class="info-row">
                    <span class="info-label">Experience:</span>
                    <span class="info-value">
                      <?php echo (int)$surveyor['years_of_experience']; ?>+ Years
                    </span>
                  </div>

                  <div class="rating-reviews">
                    <div class="rating-stars">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-half text-warning"></i>
                      <span class="rating-number"><?php echo $surveyor['rating']; ?></span>
                    </div>
                    <span class="reviews-count">
                      (<?php echo (int)$surveyor['reviews_count']; ?> reviews)
                    </span>
                  </div>
                </div>

                <div class="surveyor-card-footer">
                  <a href="surveyor-details.php?id=<?php echo $surveyor['id']; ?>"
                    class="btn btn-outline-primary w-100">
                    <i class="bi bi-eye me-2"></i>View Profile
                  </a>
                </div>

              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>

      <!-- Pagination -->
      <?php if ($totalPages > 1): ?>
        <div class="pagination-wrapper">
          <nav>
            <ul class="pagination justify-content-center">

              <!-- Previous -->
              <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link"
                  href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>">
                  <i class="bi bi-chevron-left"></i>
                </a>
              </li>

              <!-- Page Numbers -->
              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                  <a class="page-link"
                    href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>">
                    <?php echo $i; ?>
                  </a>
                </li>
              <?php endfor; ?>

              <!-- Next -->
              <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                <a class="page-link"
                  href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>">
                  <i class="bi bi-chevron-right"></i>
                </a>
              </li>

            </ul>
          </nav>
        </div>
        <?php endif; ?>


    </div>
  </section>

  <?php include "components/footer.php"; ?>

</body>
</html>