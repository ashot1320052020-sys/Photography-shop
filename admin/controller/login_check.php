<?php
session_start();
include_once "../model/model.php";
if (!isset($_POST['btn_enter'])) {
    header("location:../view/login.php");
    die;
}
if (empty($_POST['login']) || empty($_POST['password'])) {
    $_SESSION['error'] = "Empty login or password";
    header("location:../view/login.php");
    die;
}
$login = $_POST['login'];
$pass = $_POST['password'];
$count = $model->admin($login, $pass);
if ($count > 0) {
    $_SESSION['admin'] = $login;
    header("location:../view/home.php");
    die;
} else {
    $_SESSION['error'] = "Wrong login or password";
    header("location:../view/login.php");
    die;
}
