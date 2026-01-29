<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
:root{
  --green:#0b6b3a;
  --gold:#d4af37;
}

body{
  background: #e5f7e4ff;
  font-family:Segoe UI, sans-serif;
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

/* User type cards */
.user-type{
  display:flex;
  gap:10px;
  margin-bottom:20px;
}

.user-box{
  flex:1;
  border:1px solid #ddd;
  border-radius:10px;
  padding:15px 10px;
  text-align:center;
  cursor:pointer;
}

.user-box input{
  display:none;
}

.user-box.active{
  border-color:var(--green);
  background:#f0f8f4;
}

.user-box h6{
  margin:0;
  font-weight:600;
}

.user-box small{
  font-size:12px;
  color:#777;
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
.auth-link a{
  color:var(--green);
  text-decoration:none;
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

    <h4 class="auth-title">User Registration</h4>
    <p class="auth-sub">Please provide accurate information</p>

    <!-- User Type -->
    <div class="user-type">
      <label class="user-box">
        <input type="radio" name="userType">
        <h6>Client</h6>
        <small>Looking to hire a surveyor</small>
      </label>

      <label class="user-box">
        <input type="radio" name="userType">
        <h6>Surveyor</h6>
        <small>Licensed professional</small>
      </label>
    </div>

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
    <form action="processes/register-process.php" method="POST" id="registerForm">

      <input type="hidden" name="user_type" id="user_type" value="" required>

      <input type="email" name="email" class="form-control" placeholder="Email Address" required>

      <input type="password" name="password" class="form-control" placeholder="Password" required>

      <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>

      <button class="btn btn-green" type="submit" name="register">
        Continue Registration
      </button>

  </form>


    <div class="auth-link">
      Already have an account?
      <a href="login.php">Login</a>
    </div>

  </div>
</div>

<script>
const boxes = document.querySelectorAll('.user-box');
const userTypeInput = document.getElementById('user_type');
const form = document.getElementById('registerForm');

boxes.forEach((box, index) => {
  box.addEventListener('click', () => {
    boxes.forEach(b => b.classList.remove('active'));
    box.classList.add('active');

    userTypeInput.value = index === 0 ? 'client' : 'surveyor';
  });
});

form.addEventListener('submit', (e) => {
  if (!userTypeInput.value) {
    e.preventDefault();
    alert('Please select a user type (Client or Surveyor)');
  }
});

setTimeout(() => {
  const alert = document.getElementById('alert-error');
  if (alert) {
    alert.style.transition = "opacity 1.5s";
    alert.style.opacity = "0";
    setTimeout(() => alert.remove(), 1500);
  }
}, 4000);

</script>


</body>
</html>