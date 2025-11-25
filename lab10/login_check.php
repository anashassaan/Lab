<?php
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

$users = @file("users.txt", FILE_IGNORE_NEW_LINES) ?: [];
$ok = false;

foreach ($users as $u) {
    list($usr, $pass) = explode(":", $u);
    if ($usr === $username && $pass === $password) { $ok = true; break; }
}

if ($ok) {
    header("Location: Welcome.php?user=" . urlencode($username));
    exit;
} else {
    // show a simple styled error page
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Login failed</title>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <div class="container">
        <div class="card">
          <h1>Invalid login</h1>
          <p class="notice">The username or password you entered is incorrect.</p>
          <div class="actions">
            <a class="btn secondary" href="login.php">Back to login</a>
          </div>
        </div>
        <footer>Library Management • Lab 10</footer>
      </div>
    </body>
    </html>
    <?php
}
?>
