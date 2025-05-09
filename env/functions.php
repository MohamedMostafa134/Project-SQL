<?php
session_start();
include_once __DIR__ . '/../env/db.php';

define("Base_url", "http://localhost/Final/");

function url($var = null) {
    return Base_url . $var;
}

// function redirect($var = null) {
//     header("Location: " . Base_url . $var);
//     exit;
// }

function redirect($var = null){
echo "<script>

window.location.replace('http://localhost/Final/$var')

</script>";
}

// Close success alert session
if (isset($_POST['CloseSession'])) {
    $fullpath = $_POST['fullpath'];
    unset($_SESSION['success']);
    header("Location: $fullpath");
    exit;
}

// Auth middleware
function auth() {
    if (!isset($_SESSION['auth'])) {
        redirect('login.php');
    }
}

// Guest middleware
function guest() {
    if (!isset($_SESSION['auth'])) {
        redirect('index.php');
    }
}

// Logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    redirect('login.php');
}
