<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Job Management – Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include "../includes/nav.php"; ?>
<?php include "../includes/admin-dashboard.php"; ?>

<!-- MAIN CONTENT -->
<div class="container-fluid px-3 px-md-4 main">

  <!-- PAGE TITLE -->
  <div class="mb-4">
    <h2 class="section-title">Job Management</h2>
    <p class="text-muted mb-0">
      Monitor and manage all jobs posted on SurveyConnect
    </p>
  </div>

  <!-- JOB TABLE -->
  <div class="content-card">

    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Client</th>
            <th>Job Type</th>
            <th>Surveyor</th>
            <th>Date Posted</th>
            <th>Status</th>
            <th class="text-end">Action</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>Grace O.</td>
            <td>Boundary Survey</td>
            <td>Engr. Musa Lawal</td>
            <td>22 Dec 2025</td>
            <td>
              <span class="badge bg-success">Completed</span>
            </td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-success">View</button>
            </td>
          </tr>

          <tr>
            <td>2</td>
            <td>John A.</td>
            <td>Land Verification</td>
            <td>—</td>
            <td>21 Dec 2025</td>
            <td>
              <span class="badge bg-warning text-dark">Open</span>
            </td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-primary">Assign</button>
            </td>
          </tr>

          <tr>
            <td>3</td>
            <td>Hassan M.</td>
            <td>Topographic Survey</td>
            <td>Surveyor Ade</td>
            <td>20 Dec 2025</td>
            <td>
              <span class="badge bg-info text-dark">Assigned</span>
            </td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary">View</button>
            </td>
          </tr>

          <tr>
            <td>4</td>
            <td>Bola S.</td>
            <td>Engineering Survey</td>
            <td>—</td>
            <td>18 Dec 2025</td>
            <td>
              <span class="badge bg-danger">Cancelled</span>
            </td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-danger">Flag</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

</div>

</body>
</html>