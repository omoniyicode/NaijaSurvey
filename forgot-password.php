<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --green: #0b6b3a;
    }

    body {
      background: #e5f7e4ff;
      font-family: Segoe UI, sans-serif;
    }

    .auth-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .auth-card {
      width: 100%;
      max-width: 420px;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, .1);
    }

    .auth-title {
      text-align: center;
      color: var(--green);
      font-weight: 700;
    }

    .auth-sub {
      text-align: center;
      font-size: 14px;
      color: #666;
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .btn-green {
      background: var(--green);
      color: #fff;
      border-radius: 8px;
      padding: 10px;
      width: 100%;
      font-weight: 600;
    }

    .auth-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .auth-link a {
      color: var(--green);
      text-decoration: none;
    }

    .back-link {
      font-size: 14px;
      margin-bottom: 15px;
      display: inline-block;
      color: var(--green);
      text-decoration: none;
    }
  </style>
</head>

<body>

  <div class="auth-wrapper">
    <div class="auth-card">

      <!-- Back to Login -->
      <a href="login.php" class="back-link">← Back to Login</a>

      <h4 class="auth-title">Forgot Password</h4>
      <p class="auth-sub">
        Enter your registered email or phone number.<br>
        We’ll send you a reset link.
      </p>

      <!-- Forgot Password Form -->
      <form method="post" action="send-reset.php">
        <input
          type="text"
          class="form-control"
          placeholder="Email or Phone"
          name="user_identity"
          required>

        <button type="submit" class="btn btn-green">
          Send Reset Link
        </button>
      </form>

      <div class="auth-link">
        Remember your password?
        <a href="login.php">Login</a>
      </div>

    </div>
  </div>

</body>

</html>