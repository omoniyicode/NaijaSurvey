<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SurveyConnect – Reviews & Ratings</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<link href="../assets/css/style.css" rel="stylesheet">

<style>
:root{
  --green:#0b6b3a;
  --gold:#d4af37;
  --bg:#f4f6f8;
  --card:#ffffff;
  --border:#e5e5e5;
  --shadow:0 8px 20px rgba(0,0,0,.08);
}

body{
  background:var(--bg);
}

/* REVIEW CARD */
.review-card{
  background:var(--card);
  border-radius:12px;
  box-shadow:var(--shadow);
  padding:20px;
  margin-bottom:20px;
}

.star{
  color:var(--gold);
}

/* MOBILE OPTIMIZATION */
@media (max-width: 576px){
  .review-card{
    padding:15px;
  }
}
</style>
</head>

<body>

<?php include '../includes/nav.php'; ?>
<?php include '../includes/admin-dashboard.php'; ?>

<div class="container-fluid px-3 px-md-4 main">

  <!-- PAGE TITLE -->
  <div class="mb-4">
    <h4 class="fw-bold text-dark">Reviews & Ratings</h4>
    <p class="text-muted mb-0">
      See what clients are saying about you
    </p>
  </div>

  <!-- OVERALL RATING -->
  <div class="review-card">
    <div class="row align-items-center">
      <div class="col-12 col-md-6 mb-3 mb-md-0">
        <h2 class="fw-bold mb-1">4.6</h2>

        <div class="mb-1">
          <i class="fa fa-star star"></i>
          <i class="fa fa-star star"></i>
          <i class="fa fa-star star"></i>
          <i class="fa fa-star star"></i>
          <i class="fa fa-star-half-alt star"></i>
        </div>

        <small class="text-muted">
          Based on 28 reviews
        </small>
      </div>
    </div>
  </div>

  <!-- SINGLE REVIEW -->
  <div class="review-card">
    <div class="d-flex justify-content-between flex-wrap gap-2">
      <div>
        <h6 class="fw-bold mb-0">John A.</h6>
        <small class="text-muted">Boundary survey</small>
      </div>

      <div>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
      </div>
    </div>

    <p class="mt-3 mb-0">
      Very professional and punctual. Explained everything clearly and delivered on time.
    </p>

    <small class="text-muted d-block mt-2">
      Reviewed on 12 Dec 2025
    </small>
  </div>

  <!-- SINGLE REVIEW -->
  <div class="review-card">
    <div class="d-flex justify-content-between flex-wrap gap-2">
      <div>
        <h6 class="fw-bold mb-0">Grace O.</h6>
        <small class="text-muted">Land verification</small>
      </div>

      <div>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star text-muted"></i>
      </div>
    </div>

    <p class="mt-3 mb-0">
      Good experience overall. Communication could be faster, but service was solid.
    </p>

    <small class="text-muted d-block mt-2">
      Reviewed on 05 Dec 2025
    </small>
  </div>

</div>

</body>
</html>
