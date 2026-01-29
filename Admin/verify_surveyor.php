<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Verify Surveyors – Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">

<style>

</style>
</head>

<body>

<?php include "../includes/nav.php"; ?>
<?php include "../includes/admin-dashboard.php"; ?>

<div class="container-fluid px-3 px-md-4 main">

  <!-- PAGE TITLE -->
  <div class="mb-4">
    <h2 class="section-title">Verify Surveyors</h2>
    <p class="text-muted mb-0">
      Review and approve or decline submitted surveyor licenses
    </p>
  </div>

  <!-- REQUEST LIST -->
  <div class="content-card">

    <div class="request-item"
      onclick="openPopup(
        'Surveyor Musa Lawal',
        'Lagos',
        'SURV-22134',
        'assets/licenses/musa_license.jpg'
      )">
      <strong>Surveyor Musa Lawal</strong><br>
      <small class="text-muted">Submitted on 22 Dec 2025</small>
    </div>

    <div class="request-item"
      onclick="openPopup(
        'Surveyor Ade Johnson',
        'Oyo',
        'SURV-99811',
        'assets/licenses/ade_license.jpg'
      )">
      <strong>Surveyor Ade Johnson</strong><br>
      <small class="text-muted">Submitted on 21 Dec 2025</small>
    </div>

  </div>

</div>

<!-- POPUP -->
<div class="popup" id="popup">
  <div class="popup-box">
    <h6 id="pName"></h6>
    <p class="mb-1"><strong>State:</strong> <span id="pState"></span></p>
    <p class="mb-1"><strong>License Number:</strong> <span id="pLicense"></span></p>

    <p class="mt-3">
      <a href="#" target="_blank">View Uploaded License</a>
    </p>

    <div class="action-btns mt-3">
      <button class="btn btn-success btn-sm w-100">Approve</button>
      <button class="btn btn-danger btn-sm w-100">Decline</button>
    </div>

    <button class="btn btn-secondary btn-sm w-100 mt-3" onclick="closePopup()">
      Close
    </button>
  </div>
</div>

<script>
const popup = document.getElementById('popup');
const pName = document.getElementById('pName');
const pState = document.getElementById('pState');
const pLicense = document.getElementById('pLicense');

function openPopup(name,state,license,doc){
  pName.innerText = name;
  pState.innerText = state;
  pLicense.innerText = license;
  popup.style.display = 'flex';
}

function closePopup(){
  popup.style.display = 'none';
}
</script>

</body>
</html>