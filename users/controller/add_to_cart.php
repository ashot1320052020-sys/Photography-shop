<?php
session_start();
include_once "../model/user_model.php";
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please log in first";
    echo json_encode(['success' => false]);
    die;
}
$user_id = $_SESSION['user_id'];
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $id = $_POST['id'];
    $check_cart = $user_model->check_cart($user_id, $id);
    if ($check_cart) {
        $quant = $user_model->check_cart_quantity($user_id, $id);
        $newquant = $quant + 1;
        $user_model->update_cart_quantity($user_id, $id, $newquant);
    } else {
        $user_model->add_to_cart($user_id, $id, 1);
    }
    echo json_encode(['success' => true, 'message' => "successfully added"]);
}
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $plusquant = $_POST['quant'];
    $result = $user_model->update_cart($user_id, $id, $plusquant);
    if ($result) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Quantity updated successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to update quantity.'
        ]);
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $user_model->delete($user_id, $id);
    echo json_encode([
        'status' => 'success'
    ]);
}
