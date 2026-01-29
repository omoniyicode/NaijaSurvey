<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* ===== HARD-LOCKED NAVBAR PROFILE (NO OVERFLOW POSSIBLE) ===== */
.nav-profile{
  width:40px !important;
  height:40px !important;
  min-width:40px !important;
  min-height:40px !important;

  border-radius:50%;
  overflow:hidden !important;

  display:block !important;
  position:relative;

  border:2px solid rgba(255,255,255,.6);
}

/* kill bootstrap + browser image behavior */
.nav-profile img{
  width:100% !important;
  height:100% !important;

  max-width:none !important;
  max-height:none !important;

  object-fit:cover !important;
  object-position:center !important;

  display:block !important;
}

</style>
<body>

<!-- NAVBAR -->
<div class="admin-navbar">
  <div class="nav-inner">

    <!-- LEFT -->
    <div class="nav-left">
      <span class="material-symbols-outlined d-md-none text-white"
            style="cursor:pointer"
            onclick="openSidebar()">menu</span>

      <img src="../assets/images/Sconnect 2.jpeg" class="nav-logo">

      <div class="nav-title">
        <h6>Admin Dashboard</h6>
        <small>SurveyConnect platform overview</small>
      </div>
    </div>

    <div class="nav-right">
        <div class="nav-profile">
            <img src="../assets/images/Gemini_Generated_Image_vsk3f3vsk3f3vsk3.png" alt="Admin Profile">
        </div>
    </div>



  </div>
</div>

</body>
</html>