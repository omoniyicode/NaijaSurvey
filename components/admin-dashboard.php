<!-- SIDEBAR OVERLAY (MOBILE) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR -->
<aside class="admin-sidebar" id="adminSidebar">

  <!-- MOBILE CLOSE -->
  <div class="sidebar-header d-md-none">
    <span class="material-symbols-outlined" onclick="closeSidebar()">close</span>
  </div>

  <!-- MENU -->
  <nav class="sidebar-menu">

    <a href="dashboard.php" class="sidebar-link active">
      <span class="material-symbols-outlined">dashboard</span>
      Dashboard
    </a>

    <a href="job_management.php" class="sidebar-link">
      <span class="material-symbols-outlined">work</span>
      Job Management
    </a>

    <a href="moderation.php" class="sidebar-link">
      <span class="material-symbols-outlined">gavel</span>
      Moderation
    </a>

    <a href="review.php" class="sidebar-link has-badge">
      <span class="material-symbols-outlined">verified_user</span>
      Review & Rating
    </a>
    <a href="verify_surveyor.php" class="sidebar-link has-badge">
      <span class="material-symbols-outlined">verified_user</span>
      Verify Surveyor
      <span class="sidebar-badge">9</span>
    </a>

  </nav>

  <!-- LOGOUT -->
  <div class="sidebar-footer">
    <a href="logout.php" class="sidebar-link logout">
      <span class="material-symbols-outlined">door_open</span>
      Logout
    </a>
  </div>

</aside>