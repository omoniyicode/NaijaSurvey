<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: admin_login.php");
    exit();
}

require_once "../config/db-connect.php";

// validate job id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: job_management.php");
    exit();
}

$job_id = (int) $_GET['id'];

// fetch job with client info
$sql = "
    SELECT 
        j.*,
        c.first_name,
        c.surname,
        c.phone_number,
        c.state,
        c.lga,
        c.address
    FROM jobs j
    JOIN clients_profile c ON j.client_profile_id = c.id
    WHERE j.id = ?
    LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$job_id]);
$job = $stmt->fetch(PDO::FETCH_ASSOC);

// if job not found
if (!$job) {
    header("Location: job_management.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin – Job Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include "../components/nav.php"; ?>
<?php include "../components/admin-sidebar.php"; ?>

<div class="container-fluid px-4 main">

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Job Details</h4>
    <a href="job_management.php" class="btn btn-outline-secondary btn-sm">
      ← Back to Job Management
    </a>
  </div>

  <!-- JOB DETAILS -->
  <div class="card mb-4">
    <div class="card-body">

      <h5 class="fw-bold mb-3"><?php echo htmlspecialchars($job['job_title']); ?></h5>

      <span class="badge mb-3
        <?php
          echo match ($job['job_status']) {
            'available' => 'bg-success',
            'taken' => 'bg-warning',
            'completed' => 'bg-secondary',
            default => 'bg-dark'
          };
        ?>">
        <?php echo ucfirst($job['job_status']); ?>
      </span>

      <div class="row g-3 mt-2">

        <div class="col-md-6">
          <strong>Proposed Budget:</strong><br>
          ₦<?php echo htmlspecialchars($job['proposed_budget']); ?>
        </div>

        <div class="col-md-6">
          <strong>Date Posted:</strong><br>
          <?php echo date("d M Y, h:i A", strtotime($job['created_at'])); ?>
        </div>

        <div class="col-md-6">
          <strong>Job State:</strong><br>
          <?php echo htmlspecialchars($job['job_state']); ?>
        </div>

        <div class="col-md-6">
          <strong>Job LGA:</strong><br>
          <?php echo htmlspecialchars($job['job_lga']); ?>
        </div>

        <div class="col-md-12">
          <strong>Job Address:</strong><br>
          <?php echo htmlspecialchars($job['job_address']); ?>
        </div>

        <div class="col-md-12">
          <strong>Job Description:</strong>
          <p class="mt-2 text-muted">
            <?php echo nl2br(htmlspecialchars($job['job_description'])); ?>
          </p>
        </div>

      </div>

    </div>
  </div>

  <!-- CLIENT DETAILS -->
  <div class="card">
    <div class="card-body">

      <h5 class="fw-bold mb-3">Client Information</h5>

      <div class="row g-3">

        <div class="col-md-6">
          <strong>Name:</strong><br>
          <?php echo htmlspecialchars($job['first_name'] . ' ' . $job['surname']); ?>
        </div>

        <div class="col-md-6">
          <strong>Phone:</strong><br>
          <?php echo htmlspecialchars($job['phone_number']); ?>
        </div>

        <div class="col-md-6">
          <strong>State:</strong><br>
          <?php echo htmlspecialchars($job['state']); ?>
        </div>

        <div class="col-md-6">
          <strong>LGA:</strong><br>
          <?php echo htmlspecialchars($job['lga']); ?>
        </div>

        <div class="col-md-12">
          <strong>Address:</strong><br>
          <?php echo htmlspecialchars($job['address']); ?>
        </div>

      </div>

    </div>
  </div>

  <!-- ADMIN ACTION -->
  <div class="mt-4">
    <form 
      method="post"
      action="processes/delete-job.php"
      onsubmit="return confirm('Delete this job permanently?');"
    >
      <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
      <button type="submit" class="btn btn-danger">
        Delete Job
      </button>
    </form>
  </div>

</div>

</body>
</html>
