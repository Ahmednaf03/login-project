<?php
session_start(); // initialize session
$old = $_SESSION['old'] ?? []; // retrieve old input values

$username = $old['username'] ?? ($_COOKIE['remember_username'] ?? ''); // use old username or cookie or default to empty
$theme = $_COOKIE['user_theme'] ?? 'light'; // use theme from cookie or default to light
$email = $old['email'] ?? ''; // use old email or default to empty
$error = $_SESSION['error'] ?? ''; // retrieve error message
unset($_SESSION['old'], $_SESSION['error']); // clear old input values and error message from session
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-<?php echo $theme === 'dark' ? 'dark text-white' : 'light'; ?>">
<div class="container mt-5">
    <div class="col-md-6 mx-auto">
        <div class="card p-4">
            <h3 class="text-center">Login</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="auth.php">
              <input type="text" name="username" class="form-control mb-3"
              value="<?= htmlspecialchars($username) ?>" placeholder="Username">

                <input type="email" name="email" class="form-control mb-3"
                 value="<?= htmlspecialchars($email) ?>" placeholder="Email">


                <input type="password" name="password" class="form-control mb-3"
                       placeholder="Password">

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember">
                    <label class="form-check-label">Remember Me</label>
                </div>

                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
