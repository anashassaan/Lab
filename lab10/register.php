<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register — Library</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <span class="brand">Library</span>
    </div>
    <div class="card">
      <h1>Create account</h1>
      <p class="lead">Register to manage library books</p>
      <form action="register_save.php" method="POST" class="box">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button class="btn" type="submit">Register</button>
      </form>
      <div class="small" style="margin-top:10px">
        <span>Already registered?</span> <a class="link" href="login.php">Sign in</a>
      </div>
    </div>
    <footer>Library Management • Lab 10</footer>
  </div>
</body>
</html>
