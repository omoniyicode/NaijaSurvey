<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: admin_login.php");
    exit();
}

require_once "../config/db-connect.php";

// search
$search = trim($_GET['search'] ?? "");

// fetch verified surveyors
$sql = "
    SELECT 
        id,
        first_name,
        surname,
        surcon_number,
        rating,
        reviews_count,
        state
    FROM surveyors_profile
    WHERE verification_status = 'verified'
";

$params = [];

if ($search !== "") {
    $sql .= " AND (first_name LIKE ? OR surname LIKE ? OR surcon_number LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$sql .= " ORDER BY first_name ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$surveyors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin – Surveyor Ratings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include "../components/nav.php"; ?>
<?php include "../components/admin-sidebar.php"; ?>

<div class="container-fluid px-4 main">

  <h4 class="fw-bold mb-4">Surveyor Ratings</h4>

  <!-- SEARCH -->
  <div class="card mb-3">
    <div class="card-body">
      <form method="get" class="row g-2 align-items-center">

        <div class="col-md-4">
          <input 
            type="text" 
            name="search" 
            class="form-control"
            placeholder="Search surveyor by name or SURCON..."
            value="<?php echo htmlspecialchars($search); ?>"
          >
        </div>

        <div class="col-md-auto">
          <button class="btn btn-primary">Search</button>
        </div>

        <?php if ($search !== ""): ?>
          <div class="col-md-auto">
            <a href="surveyor_ratings.php" class="btn btn-outline-secondary">Clear</a>
          </div>
        <?php endif; ?>

      </form>
    </div>
  </div>

  <!-- TABLE -->
  <div class="card">
    <div class="card-body table-responsive">

      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Surveyor</th>
            <th>SURCON</th>
            <th>State</th>
            <th>Current Rating</th>
            <th>Update Rating</th>
          </tr>
        </thead>

        <tbody>
          <?php if (empty($surveyors)): ?>
            <tr>
              <td colspan="6" class="text-center text-muted">
                No verified surveyors found
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($surveyors as $i => $s): ?>
              <tr>
                <td><?php echo $i + 1; ?></td>

                <td>
                  <?php echo htmlspecialchars($s['first_name'].' '.$s['surname']); ?>
                </td>

                <td><?php echo htmlspecialchars($s['surcon_number']); ?></td>

                <td><?php echo htmlspecialchars($s['state']); ?></td>

                <td>
                  <span class="badge bg-warning text-dark">
                    <?php echo number_format($s['rating'], 1); ?> ★
                  </span>
                </td>

                <td>
                  <form method="post" action="processes/update-surveyor-rating.php" class="d-flex gap-2">
                    <input type="hidden" name="surveyor_id" value="<?php echo $s['id']; ?>">

                    <select name="rating" class="form-select form-select-sm" required>
                      <option value="">Rate</option>
                      <?php for ($r = 0; $r <= 5; $r += 0.5): ?>
                        <option value="<?php echo $r; ?>">
                          <?php echo number_format($r, 1); ?>
                        </option>
                      <?php endfor; ?>
                    </select>

                    <button class="btn btn-sm btn-success">
                      Save
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
