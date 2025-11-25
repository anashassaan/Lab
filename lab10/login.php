<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login — Library</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <span class="brand">Library</span>
    </div>
    <div class="card">
      <h1>Login</h1>
      <p class="lead">Sign in to access the library dashboard</p>
      <form action="login_check.php" method="POST" class="box">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button class="btn" type="submit">Sign in</button>
      </form>
      <div class="small" style="margin-top:10px">
        <span>Don't have an account?</span> <a class="link" href="register.php">Register</a>
      </div>
    </div>
    <footer>Library Management • Lab 10</footer>
  </div>
</body>
</html>
