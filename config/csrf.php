<?php
session_start();

function generateToken() {
    return bin2hex(random_bytes(32));
}

function getToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = generateToken();
    }
    return $_SESSION['csrf_token'];
}

function verifyToken($token) {
    return $token === $_SESSION['csrf_token'];
}
?>
