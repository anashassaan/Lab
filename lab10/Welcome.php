<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Welcome</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <span class="brand">Library</span>
    </div>
    <div class="card" style="text-align:center">
      <h1>Welcome</h1>
      <p class="lead"><?php echo "Hello, " . htmlspecialchars($_GET['user']); ?></p>
      <p class="small">You can return to the <a class="link" href="login.php">login</a> page.</p>
    </div>
    <footer>Library Management • Lab 10</footer>
  </div>
</body>
</html>
