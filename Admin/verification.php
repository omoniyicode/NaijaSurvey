<?php
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: admin_login.php");
    exit();
}

require_once "../config/db-connect.php";

// filters
$type   = $_GET['type']   ?? 'all';      // all | client | surveyor
$search = trim($_GET['search'] ?? "");

// build queries
$users = [];

/* ===== CLIENTS ===== */
if ($type === 'all' || $type === 'client') {
    $sql = "
        SELECT 
            id,
            first_name,
            surname,
            phone_number AS extra,
            'client' AS role,
            created_at
        FROM clients_profile
        WHERE verification_status = 'pending'
    ";

    $params = [];

    if ($search !== "") {
        $sql .= " AND (first_name LIKE ? OR surname LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $users = array_merge($users, $stmt->fetchAll(PDO::FETCH_ASSOC));
}

/* ===== SURVEYORS ===== */
if ($type === 'all' || $type === 'surveyor') {
    $sql = "
        SELECT 
            id,
            first_name,
            surname,
            surcon_number AS extra,
            'surveyor' AS role,
            created_at
        FROM surveyors_profile
        WHERE verification_status = 'pending'
    ";

    $params = [];

    if ($search !== "") {
        $sql .= " AND (first_name LIKE ? OR surname LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $users = array_merge($users, $stmt->fetchAll(PDO::FETCH_ASSOC));
}

// sort by newest
usort($users, fn($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at']));
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin – Verify Users</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include "../components/nav.php"; ?>
<?php include "../components/admin-sidebar.php"; ?>

<div class="container-fluid px-4 main">

  <h4 class="fw-bold mb-4">Verify Users</h4>

  <!-- FILTER BAR -->
  <div class="card mb-3">
    <div class="card-body">
      <form method="get" class="row g-2 align-items-center">

        <div class="col-md-3">
          <select name="type" class="form-select">
            <option value="all"      <?php if($type==='all') echo 'selected'; ?>>All</option>
            <option value="client"   <?php if($type==='client') echo 'selected'; ?>>Clients</option>
            <option value="surveyor" <?php if($type==='surveyor') echo 'selected'; ?>>Surveyors</option>
          </select>
        </div>

        <div class="col-md-4">
          <input 
            type="text" 
            name="search" 
            class="form-control"
            placeholder="Search by name..."
            value="<?php echo htmlspecialchars($search); ?>"
          >
        </div>

        <div class="col-md-auto">
          <button class="btn btn-primary">Filter</button>
        </div>

        <?php if ($search || $type !== 'all'): ?>
          <div class="col-md-auto">
            <a href="verification.php" class="btn btn-outline-secondary">Clear</a>
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
            <th>Name</th>
            <th>Role</th>
            <th>Extra</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php if (empty($users)): ?>
            <tr>
              <td colspan="6" class="text-center text-muted">No pending users</td>
            </tr>
          <?php else: ?>
            <?php foreach ($users as $i => $u): ?>
              <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo htmlspecialchars($u['first_name'].' '.$u['surname']); ?></td>
                <td>
                  <span class="badge bg-<?php echo $u['role']==='surveyor'?'info':'secondary'; ?>">
                    <?php echo ucfirst($u['role']); ?>
                  </span>
                </td>
                <td><?php echo htmlspecialchars($u['extra']); ?></td>
                <td><?php echo date("d M Y", strtotime($u['created_at'])); ?></td>
                <td class="d-flex gap-2">

                  <form method="post" action="processes/verify-user.php">
                    <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                    <input type="hidden" name="role" value="<?php echo $u['role']; ?>">
                    <input type="hidden" name="action" value="approve">
                    <button class="btn btn-sm btn-success">Verify</button>
                  </form>

                  <form method="post" action="processes/verify-user.php"
                        onsubmit="return confirm('Reject this user?');">
                    <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                    <input type="hidden" name="role" value="<?php echo $u['role']; ?>">
                    <input type="hidden" name="action" value="reject">
                    <button class="btn btn-sm btn-danger">Reject</button>
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
