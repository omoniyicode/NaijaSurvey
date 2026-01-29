<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
:root{
  --green:#0b6b3a;
}

body{
  background:#f4f6f8;
  font-family:Segoe UI, sans-serif;
  background: #e5f7e4ff;
}

.auth-wrapper{
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:20px;
}

.auth-card{
  width:100%;
  max-width:420px;
  background:#fff;
  padding:30px;
  border-radius:12px;
  box-shadow:0 6px 18px rgba(0,0,0,.1);
}

.auth-title{
  text-align:center;
  color:var(--green);
  font-weight:700;
}

.auth-sub{
  text-align:center;
  font-size:14px;
  color:#666;
  margin-bottom:20px;
}

.form-control{
  border-radius:8px;
  margin-bottom:15px;
}

.btn-green{
  background:var(--green);
  color:#fff;
  border-radius:8px;
  padding:10px;
  width:100%;
  font-weight:600;
}

.auth-link{
  text-align:center;
  margin-top:15px;
  font-size:14px;
}

.auth-link a,
.forgot-link{
  color:var(--green);
  text-decoration:none;
}

.forgot-wrap{
  text-align:right;
  margin-bottom:15px;
  font-size:13px;
}

#alert-error {
  animation: fadeOut 5s forwards;
  animation-delay: 2s; /* stay visible for 2 seconds */
}

@keyframes fadeOut {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
    display: none;
  }
}
</style>
</head>

<body>

<div class="auth-wrapper">
  <div class="auth-card">

    <h4 class="auth-title">Login</h4>
    <p class="auth-sub">Access your SurveyConnect account</p>

    <?php
      if (!empty($_SESSION['error'])) {
          echo '<div id="alert-error" class="alert alert-danger text-center fw-bold">'
              . $_SESSION['error'] .
          '</div>';

          unset($_SESSION['error']); // clear after showing
      }

      if (!empty($_SESSION['success'])) {
          echo '<div id="alert-success" class="alert alert-success text-center fw-bold">'
              . $_SESSION['success'] .
          '</div>';

          unset($_SESSION['success']); // clear after showing
      }
    ?>

    <!-- Form -->
    <form action="processes/login-process.php" method="POST">
      <input type="email" name="email" class="form-control" placeholder="Email" required>
      
      <input type="password" name="password" class="form-control" placeholder="Password" required>

      <!-- Forgot Password -->
      <div class="forgot-wrap">
        <a href="forgot-password.php" class="forgot-link">Forgot Password?</a>
      </div>

      <button class="btn btn-green" name="login">Login</button>
    </form>

    <div class="auth-link">
      Don’t have an account?
      <a href="register.php">Register</a>
    </div>

  </div>
</div>

<script>
  setTimeout(() => {
    const alert = document.getElementById('alert-error');
    
    if (alert) {
      alert.style.transition = "opacity 1.5s";
      alert.style.opacity = "0";
      setTimeout(() => alert.remove(), 1500);
    }
  }, 4000);

  setTimeout(() => {
    const alertSuccess = document.getElementById('alert-success');
    
    if (alertSuccess) {
      alertSuccess.style.transition = "opacity 1.5s";
      alertSuccess.style.opacity = "0";
      setTimeout(() => alertSuccess.remove(), 1500);
    }
  }, 4000);

</script>

</body>
</html>
