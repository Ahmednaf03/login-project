<?php

function validateUsername($username) {
    if (empty($username)) {
        return "Username is required";
    }
    if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
        return "Username must be 3–20 characters";
    }
    return "";
}

function validateEmail($email) {
    if (empty($email)) {
        return "Email is required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }
    return "";
}

function validatePassword($password) {
    if (empty($password)) {
        return "Password is required";
    }
    if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/", $password)) {
        return "Password must contain uppercase, lowercase, number & symbol";
    }
    return "";
}
