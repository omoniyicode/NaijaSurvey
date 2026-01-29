<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SurveyConnect – Review Moderation</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link href="../assets/css/style.css" rel="stylesheet">

<style>
:root{
  --green:#0b6b3a;
  --gold:#d4af37;
  --bg:#f4f6f8;
  --card:#ffffff;
  --shadow:0 8px 20px rgba(0,0,0,.08);
}

body{ background:var(--bg); }

.card-box{
  background:var(--card);
  border-radius:12px;
  box-shadow:var(--shadow);
  padding:20px;
  margin-bottom:20px;
}

.star{ color:var(--gold); }
</style>
</head>

<body>

<?php include "../includes/nav.php"; ?>
<?php include "../includes/admin-dashboard.php"; ?>

<!-- MAIN CONTENT -->
<div class="container-fluid px-3 px-md-4 main">

  <!-- PAGE TITLE -->
  <div class="mb-4">
    <h2 class="section-title">Review Moderation</h2>
    <p class="text-muted mb-0">
      Approve or reject client reviews before they go live
    </p>
  </div>

  <!-- REVIEW ITEM -->
  <div class="content-card">
    <div class="d-flex justify-content-between flex-wrap">
      <div>
        <h6 class="fw-bold mb-1">John A.</h6>
        <small class="text-muted">
          Surveyor: <strong>Engr. Musa Lawal</strong> • Boundary Survey
        </small>
      </div>

      <div>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
      </div>
    </div>

    <p class="mt-3">
      Very professional and punctual. Explained everything clearly and delivered on time.
    </p>

    <div class="d-flex gap-2 mt-3">
      <button class="btn btn-success btn-sm">
        <i class="fa fa-check"></i> Approve
      </button>

      <button class="btn btn-danger btn-sm">
        <i class="fa fa-times"></i> Reject
      </button>
    </div>

    <small class="text-muted d-block mt-3">
      Submitted on 12 Dec 2025
    </small>
  </div>

  <!-- REVIEW ITEM -->
  <div class="content-card">
    <div class="d-flex justify-content-between flex-wrap">
      <div>
        <h6 class="fw-bold mb-1">Grace O.</h6>
        <small class="text-muted">
          Surveyor: <strong>Surveyor Ade</strong> • Land Verification
        </small>
      </div>

      <div>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star star"></i>
        <i class="fa fa-star text-muted"></i>
      </div>
    </div>

    <p class="mt-3">
      Good service but communication could be improved.
    </p>

    <div class="d-flex gap-2 mt-3">
      <button class="btn btn-success btn-sm">
        <i class="fa fa-check"></i> Approve
      </button>

      <button class="btn btn-danger btn-sm">
        <i class="fa fa-times"></i> Reject
      </button>
    </div>

    <small class="text-muted d-block mt-3">
      Submitted on 08 Dec 2025
    </small>
  </div>

</div>

</body>
</html>