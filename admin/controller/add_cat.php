<?php
session_start();
include "../model/model.php";
$action = $_POST['action'];
$name = $_POST['name'];
if ($action == "add" ) {
    $model->add_category($name);
}
$id = $_POST['id'];
$new_text = $_POST['new_text'];
if ($action == "update") {
    $model->update($id, $new_text);
}
if ($action == 'delete') {
    $model->delete($id);
}
