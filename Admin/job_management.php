<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: admin_login.php");
    exit();
}

require_once "../config/db-connect.php";

// GET FILTER VALUES
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$status = isset($_GET['status']) ? trim($_GET['status']) : "";

// BUILD SQL
$sql = "
    SELECT 
        j.id,
        j.job_title,
        j.job_status,
        j.created_at,
        c.first_name,
        c.surname
    FROM jobs j
    JOIN clients_profile c ON j.client_profile_id = c.id
";

$conditions = [];
$params = [];

// search by client name
if ($search !== "") {
    $conditions[] = "(c.first_name LIKE ? OR c.surname LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// filter by job status
if ($status !== "") {
    $conditions[] = "j.job_status = ?";
    $params[] = $status;
}

// apply WHERE clause if needed
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY j.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin – Job Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include "../components/nav.php"; ?>
<?php include "../components/admin-sidebar.php"; ?>

<div class="container-fluid px-4 main">

  <!-- PAGE HEADER -->
  <h4 class="fw-bold mb-4">Job Management</h4>

  <!-- SEARCH & FILTER BAR -->
  <div class="card mb-3">
    <div class="card-body">
      <form method="get" class="row g-2 align-items-center">

        <div class="col-md-4">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by client name..."
            value="<?php echo htmlspecialchars($search); ?>"
          >
        </div>

        <div class="col-md-3">
          <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="available" <?php if ($status === 'available') echo 'selected'; ?>>Available</option>
            <option value="taken" <?php if ($status === 'taken') echo 'selected'; ?>>Taken</option>
            <option value="completed" <?php if ($status === 'completed') echo 'selected'; ?>>Completed</option>
          </select>
        </div>

        <div class="col-md-auto">
          <button type="submit" class="btn btn-primary">
            Filter
          </button>
        </div>

        <?php if ($search !== "" || $status !== ""): ?>
          <div class="col-md-auto">
            <a href="job_management.php" class="btn btn-outline-secondary">
              Clear
            </a>
          </div>
        <?php endif; ?>

      </form>
    </div>
  </div>

  <!-- JOB TABLE -->
  <div class="card">
    <div class="card-body table-responsive">

      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Job Title</th>
            <th>Client</th>
            <th>Status</th>
            <th>Date Posted</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php if (empty($jobs)): ?>
            <tr>
              <td colspan="6" class="text-center text-muted">
                No jobs found
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($jobs as $index => $job): ?>
              <tr>
                <td><?php echo $index + 1; ?></td>

                <td><?php echo htmlspecialchars($job['job_title']); ?></td>

                <td><?php echo htmlspecialchars($job['first_name'] . ' ' . $job['surname']); ?></td>

                <td>
                  <span class="badge 
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
                </td>

                <td><?php echo date("d M Y", strtotime($job['created_at'])); ?></td>

               <td class="d-flex gap-2">
                  <a href="job_view.php?id=<?php echo $job['id']; ?>" class="btn btn-sm btn-primary">
                    View
                  </a>

                  <form 
                    method="post"
                    action="processes/delete-job.php"
                    onsubmit="return confirm('Delete this job permanently?');"
                  >
                    <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-danger">
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>

      </table>

    </div>
  </div>

</div>

</body>
</html>
