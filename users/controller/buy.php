<?php
session_start();
include_once("../model/user_model.php");
$action = isset($_POST['action']) ? $_POST['action'] : "";
$user_id = $_SESSION['user_id'];
if ($action == "order-item" ) {
    $order = $user_model->add_to_order($user_id);
    if ($order) {
        $returnArr['action'] = "1";
        $returnArr['message'] = "Order creates";
        echo json_encode(['status' => 'success', 'action' => "1", 'message' => "Order creates"]);
    }
}
