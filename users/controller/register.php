<?php
session_start();
include_once("../model/user_model.php");
$action  = isset($_POST['btn_reg']) ? $_POST['btn_reg'] : "";
if ($action != "") {
    if ($action === "btn") {
        $name = $_POST['name'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $conf_pass = $_POST['conf_pass'];
        if (empty($name) || empty($login) || empty($email) || empty($pass) || empty($conf_pass)) {
            $_SESSION['error'] = "Please fill all fields";
            header('location:../view/reg_form.php');
            exit;
        }
        if ($pass != $conf_pass) {
            $_SESSION['error'] = "Password don't match";
            header('location:../view/reg_form.php');
            exit;
        }
        $reg_check = $user_model->check_user($email);
        if ($reg_check > 0) {
            $_SESSION['error'] = "Email already exists";
            header('location:../view/reg_form.php');
            exit;
        }
        $add_user = $user_model->add_user($name, $login, $pass, $email);
        if ($add_user) {
            $_SESSION['success'] = "Registration completed successfully";
            header('location:../view/login_form.php');
            exit;
        } else {
            $_SESSION['error'] = "Failed to register user";
            header('location:../view/reg_form.php');
            exit;
        }
    }
}
