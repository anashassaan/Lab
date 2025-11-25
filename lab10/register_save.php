<?php
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!preg_match('/^[A-Za-z]+$/', $username)) {
    http_response_code(400);
    echo "Invalid username";
    exit;
}
if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).+$/', $password)) {
    http_response_code(400);
    echo "Weak password";
    exit;
}

$users = @file("users.txt", FILE_IGNORE_NEW_LINES) ?: [];
foreach ($users as $u) {
    if (explode(":", $u)[0] === $username) {
        http_response_code(409);
        echo "User exists";
        exit;
    }
}

file_put_contents("users.txt", "$username:$password\n", FILE_APPEND);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Registered</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card" style="text-align:center">
      <h1>Registered</h1>
      <p class="lead">Your account has been created.</p>
      <div class="actions">
        <a class="btn" href="login.php">Go to login</a>
      </div>
    </div>
    <footer>Library Management • Lab 10</footer>
  </div>
</body>
</html>
