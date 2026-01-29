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

<?php include "../includes/nav.php"; ?>
<?php include "../includes/admin-dashboard.php"; ?>

<div class="container-fluid px-6 px-md-4 main">

  <!-- STAT BOXES -->
  <div class="row g-3">
    <div class="col-md-3"><div class="stat-card active" data-box="users">
      <div class="icon-circle users"><span class="material-symbols-outlined">group</span></div>
      <div class="stat-label">Total Users</div><div class="stat-value">1,248</div>
    </div></div>

    <div class="col-md-3"><div class="stat-card" data-box="verified">
      <div class="icon-circle verified"><span class="material-symbols-outlined">verified</span></div>
      <div class="stat-label">Verified Surveyors</div><div class="stat-value">312</div>
    </div></div>

    <div class="col-md-3"><div class="stat-card" data-box="jobs">
      <div class="icon-circle jobs"><span class="material-symbols-outlined">folder</span></div>
      <div class="stat-label">Total Jobs</div><div class="stat-value">876</div>
    </div></div>

    <div class="col-md-3"><div class="stat-card" data-box="reviews">
      <div class="icon-circle reviews"><span class="material-symbols-outlined">star</span></div>
      <div class="stat-label">Pending Reviews</div><div class="stat-value">14</div>
    </div></div>
  </div>

  <!-- DYNAMIC CONTENT -->
  <div class="content-card" id="contentArea"></div>

  <!-- RECENT ACTIVITIES TABLE -->
  <div class="recent">
    <h6 class="fw-bold mb-3">Recent Activities</h6>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr><th>Activity</th><th>User</th><th>Date</th><th>Status</th></tr>
        </thead>
        <tbody>
          <tr><td>Surveyor Verification</td><td>Musa Lawal</td><td>22 Dec 2025</td>
            <td><span class="badge badge-approved">Approved</span></td></tr>
          <tr><td>New Job Posted</td><td>Grace O.</td><td>21 Dec 2025</td>
            <td><span class="badge badge-new">New</span></td></tr>
          <tr><td>Review Submitted</td><td>John A.</td><td>20 Dec 2025</td>
            <td><span class="badge badge-pending">Pending</span></td></tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- POPUP -->
<div class="popup" id="popup">
  <div class="popup-box">
    <h6 id="popName"></h6>
    <p id="popInfo"></p>
    <button class="btn btn-secondary btn-sm w-100" onclick="closePopup()">Close</button>
  </div>
</div>

<script>
const content=document.getElementById('contentArea');
const popup=document.getElementById('popup');
const popName=document.getElementById('popName');
const popInfo=document.getElementById('popInfo');

function openPopup(name,info){
  popName.innerText=name;
  popInfo.innerText=info;
  popup.style.display='flex';
}
function closePopup(){popup.style.display='none';}

function loadUsers(){
  content.innerHTML=`
    <div class="list-item" onclick="openPopup('John Doe','Email: john@mail.com | Joined: 2024')">John Doe</div>
    <div class="list-item" onclick="openPopup('Grace O.','Email: grace@mail.com | Joined: 2023')">Grace O.</div>`;
}
function loadVerified(){
  content.innerHTML=`
    <div class="list-item" onclick="openPopup('Surveyor Musa','License: SURV-221 | State: Lagos')">Surveyor Musa</div>`;
}
function loadJobs(){content.innerHTML='<p>No job selected</p>';}
function loadReviews(){content.innerHTML='<p>Pending reviews list</p>';}

document.querySelectorAll('.stat-card').forEach(card=>{
  card.onclick=()=>{
    document.querySelectorAll('.stat-card').forEach(c=>c.classList.remove('active'));
    card.classList.add('active');
    if(card.dataset.box==='users') loadUsers();
    if(card.dataset.box==='verified') loadVerified();
    if(card.dataset.box==='jobs') loadJobs();
    if(card.dataset.box==='reviews') loadReviews();
  };
});

loadUsers();

function openSidebar(){
  document.getElementById('adminSidebar').classList.add('show');
  document.getElementById('sidebarOverlay').classList.add('show');
}

function closeSidebar(){
  document.getElementById('adminSidebar').classList.remove('show');
  document.getElementById('sidebarOverlay').classList.remove('show');
}
</script>


</body>
</html>