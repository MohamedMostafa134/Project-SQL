<?php
session_start(); 
include_once 'C:\xampp\htdocs\Final/env/db.php';
define("Base_url", "http://localhost/Final/");
function url($var = null){
    return Base_url . $var;
}


function redirect($var = null){
echo "<script>

window.location.replace('http://localhost/Final/$var')

</script>";
}

if(isset($_POST['CloseSession'])){
   $fullpath= $_POST['fullpath'];
    unset($_SESSION['success']);
    echo "<script>

window.location.replace('$fullpath')

</script>";
}
function guest()
{
if (isset($_SESSION['auth'])){
}else {
  redirect('index.php');
}

function auth()
{
if (isset($_SESSION['auth'])){
}else {
  redirect('login.php');
}
}
}

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    redirect('login.php');
}







