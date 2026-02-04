<!-- Surveyor Sidebar -->
<div class="surveyor-sidebar" id="surveyorSidebar">
  <div class="close-btn" onclick="closeSidebar()">×</div>

  <div class="brand">SurveyConnect</div>

  <a href="../index.php"><i class="bi bi-house-fill"></i> Home</a>
  <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
  </a>
  <a href="../jobs.php"><i class="bi bi-briefcase-fill"></i> Find Jobs</a>
  <a href="incoming-requests.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'incoming-requests.php' || basename($_SERVER['PHP_SELF']) == 'incoming-request.php' ? 'active' : ''; ?>">
    <i class="bi bi-inbox-fill"></i> Incoming Requests
  </a>
  <a href="outgoing-requests.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'outgoing-requests.php' || basename($_SERVER['PHP_SELF']) == 'outgoing-request.php' ? 'active' : ''; ?>">
    <i class="bi bi-send-fill"></i> Outgoing Requests
  </a>
  <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>

  <div class="logout">
    <a href="../includes/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
</div>

<script>
  function openSidebar() {
    document.getElementById('surveyorSidebar').classList.add('active');
  }

  function closeSidebar() {
    document.getElementById('surveyorSidebar').classList.remove('active');
  }
</script>