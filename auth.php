<?php
session_start();
require 'includes/validation.php';
require 'includes/helpers.php';
$users = require 'includes/users.php';
// getting the value from form
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']);  // remember me checkbox

//validate fields and store errors
$errors = [
    validateUsername($username),
    validateEmail($email),
    validatePassword($password)
];


foreach ($errors as $error) {
    if ($error) {
        $_SESSION['error'] = $error; // setting error message in session
         $_SESSION['old'] = [
        'username' => $username, // storing old input values for persistence between relaod
        'email' => $email
    ];
        header("Location: login.php"); // redirect to login page
        exit;
    }
}



$authenticatedUser = null;
// login validation with data layer
foreach ($users as $user) {
    if (
        ($user['email'] === $email && $user['username'] === $username) &&
        $user['password'] === $password
    ) {
        $authenticatedUser = $user;
        break;
    }

     if (
        ($user['email'] === $email || $user['username'] === $username) ||
        $user['password'] === $password
        ) {
        $_SESSION['error'] = validator($username,$email,$password,$user) ;
        }
}
// if user is authenticated
if ($authenticatedUser) {

    $theme = $authenticatedUser['theme'];

    $_SESSION['username'] = $authenticatedUser['username'];
    $_SESSION['email'] = $authenticatedUser['email'];
    $_SESSION['theme'] = $theme;
    // remember me checkbox
    if ($remember) {
        setcookie("remember_username", $authenticatedUser['username'], time() + 60);
        setcookie("user_theme", $theme, time() + 60);
    } else {
        setcookie("remember_username", "", time() - 60);
    }

    header("Location: dashboard.php"); // if validated redirect to dashboard
    exit;
}else{
    
// $_SESSION['error'] = "Invalid login credentials";
 $_SESSION['old'] = [
        'username' => $username, // storing old input values for persistence between relaod
        'email' => $email
    ];
header("Location: login.php"); // if not authenticated redirect to login
exit;
}





