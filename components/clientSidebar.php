<!-- MENU BUTTON -->
<div class="menu-btn" onclick="openSidebar()">
  <i class="bi bi-list"></i>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
  <div class="close-btn" onclick="closeSidebar()">✕</div>

  <div class="brand">SurveyConnect</div>

  <a href="../index.php"><i class="bi bi-house"></i> Home</a>
  <a href="../client/dashboard.php"><i class="bi bi-briefcase"></i> Dashboard</a>
  <a href="../surveyor-listing.php"><i class="bi bi-file-earmark-plus"></i> Find Surveyors</a>
  <a href="../jobs.php"><i class="bi bi-clipboard-plus"></i> Post Job</a>
  <a href="../client/incoming-requests.php"><i class="bi bi-inbox"></i> Incoming Requests</a>
  <a href="../client/outgoing-requests.php"><i class="bi bi-send"></i> Outgoing Requests</a>
  <a href="../client/confirm-job-completion.php"><i class="bi bi-briefcase"></i> Deliverables</a>
  <a href="../client/profile.php"><i class="bi bi-person"></i> Profile</a>

  <div class="logout">
    <a href="../includes/logout.php"><i class="bi bi-door-open"></i> Logout</a>
  </div>
</div>

<!-- Client Sidebar -->
<div class="surveyor-sidebar" id="clientSidebar">
  <div class="close-btn" onclick="closeSidebar()">×</div>

  <div class="brand">SurveyConnect</div>

  <a href="../index.php"><i class="bi bi-house-fill"></i> Home</a>
  <a href="../client/dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
  </a>
  <a href="../surveyor-listing.php"><i class="bi bi-search"></i> Find Surveyors</a>
  <a href="../jobs.php"><i class="bi bi-clipboard-plus"></i> Post Job</a>
  <a href="../client/incoming-requests.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'incoming-requests.php' || basename($_SERVER['PHP_SELF']) == 'incoming-request.php' ? 'active' : ''; ?>">
    <i class="bi bi-inbox-fill"></i> Incoming Requests
  </a>
  <a href="../client/outgoing-requests.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'outgoing-requests.php' || basename($_SERVER['PHP_SELF']) == 'outgoing-request.php' ? 'active' : ''; ?>">
    <i class="bi bi-send-fill"></i> Outgoing Requests
  </a>
  <a href="../client/profile.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
    <i class="bi bi-person-fill"></i> Profile
  </a>

  <div class="logout">
    <a href="../includes/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
  </div>
</div>

<script>
  function openSidebar() {
    document.getElementById('clientSidebar').classList.add('active');
  }

  function closeSidebar() {
    document.getElementById('clientSidebar').classList.remove('active');
  }
</script>