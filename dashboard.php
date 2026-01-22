<?php
session_start();

// checking if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// getting user theme from session if exists
$theme = $_SESSION['theme'] ?? 'light';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-<?php echo $theme === 'dark' ? 'dark text-white' : $theme; ?>"> 
<div class="container mt-5 ">
    <div class="card p-4 bg-<?php echo $theme === 'dark' ? 'dark text-white border-light ' : $theme; ?>">
        <h2>Welcome, <?= $_SESSION['username'] ?></h2>
        <p>Email: <?= $_SESSION['email'] ?></p>
        <p>Theme: <?= $theme ?></p>
        <!-- <p>Remember Me: <?= $_COOKIE["remember_username"] ?></p> -->
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>
</body>
</html>
