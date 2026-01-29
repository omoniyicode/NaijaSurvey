<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SurveyConnect – Admin Login</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
:root{
  --green:#0b6b3a;
  --gold:#d4af37;
  --bg:#f4f6f8;
  --card:#ffffff;
  --shadow:0 8px 20px rgba(0,0,0,.08);
}

body{
  background:var(--bg);
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
}

/* ===== CARD ===== */
.login-card{
  background:var(--card);
  border-radius:14px;
  box-shadow:var(--shadow);
  padding:30px;
  width:100%;
  max-width:420px;
}

.login-card h4{
  font-weight:700;
  color:var(--green);
}

.btn-admin{
  background:var(--green);
  color:#fff;
}

.btn-admin:hover{
  background:#095a32;
}
</style>
</head>

<body>

<div class="login-card">

  <!-- TITLE -->
  <div class="text-center mb-4">
    <h4>Admin Login</h4>
    <p class="text-muted mb-0">SurveyConnect Control Panel</p>
  </div>

  <!-- LOGIN FORM -->
  <form method="post" action="">
    
    <div class="mb-3">
      <label class="form-label">Email Address</label>
      <input type="email" class="form-control" placeholder="admin@surveyconnect.com" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" placeholder="••••••••" required>
    </div>

    <button type="submit" class="btn btn-admin w-100">
      <i class="fa fa-lock me-1"></i> Login
    </button>

  </form>

  <!-- FOOTER -->
  <div class="text-center mt-3">
    <small class="text-muted">Authorized personnel only</small>
  </div>

</div>

</body>
</html>