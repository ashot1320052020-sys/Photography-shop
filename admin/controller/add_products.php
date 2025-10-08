<?php
session_start();
include_once("../model/model.php");
$action = $_POST['action'];
if ($action == 'add') {
    $cat_id = $_SESSION['cat_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $img = $_FILES['img']['name'];
    if (
        empty($price) || empty($name) ||
        empty($price) || empty($desc) || empty($img)
    ) {
        $_SESSION['error'] = "Input all fields";
        header('location:../view/products.php');
        die;
    }
    move_uploaded_file($_FILES['img']['tmp_name'], "../assets/image/$img");
    $model->add_products($cat_id, $name, $price, $desc, $img);
    header("location:../view/products.php");
}
if ($action == 'update_product') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $update_product = $model->update_product($name, $desc, $price, $id);
    if ($update_product) {
        echo 'updated';
    } else {
        echo 'didnt updated';
    }
}
if ($action == 'delete_product') {
    $id = $_POST['id'];
    $model->delete_product($id);
}
