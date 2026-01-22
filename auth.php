<?php
session_start();
require 'includes/validation.php';
$users = require 'includes/users.php';
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']);

$errors = [
    validateUsername($username),
    validateEmail($email),
    validatePassword($password)
];

foreach ($errors as $error) {
    if ($error) {
        $_SESSION['error'] = $error;
         $_SESSION['old'] = [
        'username' => $username,
        'email' => $email
    ];
        header("Location: login.php");
        exit;
    }
}



$authenticatedUser = null;

foreach ($users as $user) {
    if (
        ($user['email'] === $email || $user['username'] === $username) &&
        $user['password'] === $password
    ) {
        $authenticatedUser = $user;
        break;
    }
}

if ($authenticatedUser) {

    $theme = $authenticatedUser['theme'];

    $_SESSION['username'] = $authenticatedUser['username'];
    $_SESSION['email'] = $authenticatedUser['email'];
    $_SESSION['theme'] = $theme;

    if ($remember) {
        setcookie("remember_username", $authenticatedUser['username'], time() + 60);
        setcookie("user_theme", $theme, time() + 60);
    } else {
        setcookie("remember_username", "", time() - 3600);
    }

    header("Location: dashboard.php");
    exit;
}


    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['theme'] = $theme;

    if ($remember) {
        setcookie("remember_username", $username, time() + 60);
        setcookie("user_theme", $theme, time() + 60);
    } else {
        setcookie("remember_username", "", time() - 3600);
    }

    header("Location: dashboard.php");
    exit;


$_SESSION['error'] = "Invalid login credentials";
header("Location: login.php");
exit;
