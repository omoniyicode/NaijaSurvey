<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: admin_login.php");
    exit();
}

require_once "../config/db-connect.php";

// search
$search = trim($_GET['search'] ?? "");

// ===== FETCH VERIFIED SURVEYORS =====
$surveyorsSql = "
    SELECT 
        s.id AS user_id,
        s.first_name,
        s.surname,
        a.email,
        s.state,
        s.verification_status,
        'surveyor' AS user_type
    FROM surveyors_profile s
    JOIN accounts a ON s.account_id = a.id
    WHERE s.verification_status = 'verified'
";


$params = [];

if ($search !== "") {
    $surveyorsSql .= " AND (s.first_name LIKE ? OR s.surname LIKE ? OR a.email LIKE ?)";
    $clientsSql   .= " AND (c.first_name LIKE ? OR c.surname LIKE ? OR a.email LIKE ?)";

    $params = ["%$search%", "%$search%", "%$search%"];
} else {
    $params = [];
}

// ===== FETCH VERIFIED CLIENTS =====
$clientsSql = "
    SELECT 
        c.id AS user_id,
        c.first_name,
        c.surname,
        a.email,
        c.state,
        c.verification_status,
        'client' AS user_type
    FROM clients_profile c
    JOIN accounts a ON c.account_id = a.id
    WHERE c.verification_status = 'verified'
";


if ($search !== "") {
    $clientsSql .= " AND (first_name LIKE ? OR surname LIKE ? OR email LIKE ?)";
}

// execute
$stmt1 = $pdo->prepare($surveyorsSql);
$stmt1->execute($params);
$surveyors = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare($clientsSql);
$stmt2->execute($params);
$clients = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// merge
$users = array_merge($surveyors, $clients);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin – Users Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include "../components/nav.php"; ?>
<?php include "../components/admin-sidebar.php"; ?>

<div class="container-fluid px-4 main">

  <h4 class="fw-bold mb-4">Verified Users</h4>

  <!-- SEARCH -->
  <div class="card mb-3">
    <div class="card-body">
      <form method="get" class="row g-2 align-items-center">

        <div class="col-md-4">
          <input 
            type="text" 
            name="search" 
            class="form-control"
            placeholder="Search by name or email..."
            value="<?php echo htmlspecialchars($search); ?>"
          >
        </div>

        <div class="col-md-auto">
          <button class="btn btn-primary">Search</button>
        </div>

        <?php if ($search !== ""): ?>
          <div class="col-md-auto">
            <a href="users.php" class="btn btn-outline-secondary">Clear</a>
          </div>
        <?php endif; ?>

      </form>
    </div>
  </div>

  <!-- USERS TABLE -->
  <div class="card">
    <div class="card-body table-responsive">

      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>State</th>
            <th>User Type</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php if (empty($users)): ?>
            <tr>
              <td colspan="7" class="text-center text-muted">
                No verified users found
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($users as $i => $u): ?>
              <tr>
                <td><?php echo $i + 1; ?></td>

                <td><?php echo htmlspecialchars($u['first_name'].' '.$u['surname']); ?></td>

                <td><?php echo htmlspecialchars($u['email']); ?></td>

                <td><?php echo htmlspecialchars($u['state']); ?></td>

                <td>
                  <span class="badge bg-<?php echo $u['user_type'] === 'surveyor' ? 'info' : 'secondary'; ?>">
                    <?php echo ucfirst($u['user_type']); ?>
                  </span>
                </td>

                <td>
                  <span class="badge bg-success">Verified</span>
                </td>

                <td>
                  <form 
                    method="post" 
                    action="processes/flag-user.php"
                    onsubmit="return confirm('Flag this user? Verification will be revoked.');"
                  >
                    <input type="hidden" name="user_id" value="<?php echo $u['user_id']; ?>">
                    <input type="hidden" name="user_type" value="<?php echo $u['user_type']; ?>">

                    <button class="btn btn-sm btn-danger">
                      🚩 Flag
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
