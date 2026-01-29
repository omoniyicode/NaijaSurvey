<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outgoing Requests - Survey Connect</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

  <?php include "../components/clientSidebar.php"; ?>

  <!-- Main Content -->
  <div class="surveyor-main">
    
    <!-- Top Navigation -->
    <nav class="surveyor-topbar">
      <div class="d-flex align-items-center gap-3">
        <button class="menu-toggle" onclick="openSidebar()">
          <i class="bi bi-list"></i>
        </button>
        <strong>Outgoing Requests</strong>
      </div>
      <div class="topbar-actions">
        <i class="bi bi-bell-fill"></i>
        <i class="bi bi-person-circle"></i>
      </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-content">
      
      <!-- Page Header -->
      <div class="mb-4">
        <h2 class="mb-2" style="color: var(--primary-green); font-weight: 700;">Outgoing Requests to Surveyors</h2>
        <p class="text-muted">Track all job proposals you've sent to surveyors.</p>
      </div>

      <!-- Requests Table -->
      <div class="request-table">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>Surveyor</th>
              <th>Service Category</th>
              <th>Request Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>PrimeGeo Surveys Ltd</td>
              <td>Boundary Survey</td>
              <td><span class="status-badge pending">Pending</span></td>
              <td>
                <a href="outgoing-request.php" class="btn btn-sm btn-primary">
                  <i class="bi bi-eye me-1"></i> View
                </a>
              </td>
            </tr>
            <tr>
              <td>Atlas Mapping Co.</td>
              <td>Topographic Survey</td>
              <td><span class="status-badge accepted">Accepted</span></td>
              <td>
                <a href="outgoing-request.php" class="btn btn-sm btn-primary">
                  <i class="bi bi-eye me-1"></i> View
                </a>
              </td>
            </tr>
            <tr>
              <td>Atlas Mapping Co.</td>
              <td>Topographic Survey</td>
              <td><span class="status-badge rejected">Rejected</span></td>
              <td>
                <a href="outgoing-request.php" class="btn btn-sm btn-primary">
                  <i class="bi bi-eye me-1"></i> View
                </a>
              </td>
            </tr>
            <tr>
              <td>Atlas Mapping Co.</td>
              <td>Topographic Survey</td>
              <td><span class="status-badge completed">Completed</span></td>
              <td>
                <a href="outgoing-request.php" class="btn btn-sm btn-primary">
                  <i class="bi bi-eye me-1"></i> View
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>