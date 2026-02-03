<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: admin_login.php");
    exit();
}

require_once "../config/db-connect.php";

/* ==========================
   DASHBOARD STATISTICS
========================== */

// total users (clients + surveyors)
$stmt = $pdo->query("SELECT COUNT(*) FROM accounts");
$totalUsers = $stmt->fetchColumn();

// verified surveyors
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM surveyors_profile 
    WHERE verification_status = 'verified'
");
$stmt->execute();
$verifiedSurveyors = $stmt->fetchColumn();

// total jobs
$stmt = $pdo->query("SELECT COUNT(*) FROM jobs");
$totalJobs = $stmt->fetchColumn();

// pending reviews (NOT IMPLEMENTED YET)
$pendingReviews = 0;

/* ==========================
   RECENT ACTIVITIES
========================== */

// recent surveyor verifications
$recentSurveyors = $pdo->query("
    SELECT first_name, surname, verified_at 
    FROM surveyors_profile 
    WHERE verification_status = 'verified'
    ORDER BY verified_at DESC
    LIMIT 3
")->fetchAll(PDO::FETCH_ASSOC);

// recent jobs
$recentJobs = $pdo->query("
    SELECT j.job_title, j.created_at, c.first_name, c.surname
    FROM jobs j
    JOIN clients_profile c ON j.client_profile_id = c.id
    ORDER BY j.created_at DESC
    LIMIT 3
")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SurveyConnect – Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include __DIR__ . '/../components/nav.php'; ?>
<?php include __DIR__ . '/../components/admin-sidebar.php'; ?>

<div class="container-fluid px-6 px-md-4 main">

  <!-- STAT BOXES -->
  <div class="row g-3">
    <div class="col-md-3"><div class="stat-card active" data-box="users">
      <div class="icon-circle users"><span class="material-symbols-outlined">group</span></div>
      <div class="stat-label">Total Users</div><div class="stat-value"><?php echo number_format($totalUsers); ?></div>
    </div></div>

    <div class="col-md-3"><div class="stat-card" data-box="verified">
      <div class="icon-circle verified"><span class="material-symbols-outlined">verified</span></div>
      <div class="stat-label">Verified Surveyors</div><div class="stat-value"><?php echo number_format($verifiedSurveyors); ?></div>
    </div></div>

    <div class="col-md-3"><div class="stat-card" data-box="jobs">
      <div class="icon-circle jobs"><span class="material-symbols-outlined">folder</span></div>
      <div class="stat-label">Total Jobs</div><div class="stat-value"><?php echo number_format($totalJobs); ?></div>
    </div></div>

    <div class="col-md-3"><div class="stat-card" data-box="reviews">
      <div class="icon-circle reviews"><span class="material-symbols-outlined">star</span></div>
      <div class="stat-label">Pending Reviews</div><div class="stat-value"><?php echo number_format($pendingReviews); ?></div>
    </div></div>
  </div>

  <!-- DYNAMIC CONTENT -->

  <!-- RECENT ACTIVITIES TABLE -->
  <div class="recent">
    <h6 class="fw-bold mb-3">Recent Activities</h6>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr><th>Activity</th><th>User</th><th>Date</th><th>Status</th></tr>
        </thead>
        <tbody>

          <?php foreach ($recentSurveyors as $s): ?>
            <tr>
              <td>Surveyor Verification</td>
              <td><?php echo htmlspecialchars($s['first_name'].' '.$s['surname']); ?></td>
              <td><?php echo date("d M Y", strtotime($s['verified_at'])); ?></td>
              <td><span class="badge badge-approved">Approved</span></td>
            </tr>
          <?php endforeach; ?>

          <?php foreach ($recentJobs as $j): ?>
            <tr>
              <td>New Job Posted</td>
              <td><?php echo htmlspecialchars($j['first_name'].' '.$j['surname']); ?></td>
              <td><?php echo date("d M Y", strtotime($j['created_at'])); ?></td>
              <td><span class="badge badge-new">New</span></td>
            </tr>
          <?php endforeach; ?>

        </tbody>

      </table>
    </div>
  </div>

</div>


</body>
</html>