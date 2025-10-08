<?php
include_once("../view/header.php");
include_once("../Model/user_model.php");

$action = isset($_POST['action']) ? $_POST['action'] : "";
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please log in first";
    header('location:login_form.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$all = $user_model->get_order($user_id);
?>

<div class="container my-5">
    <h2 class="mb-4 text-center text-uppercase"> Your Photo Orders</h2>

    <?php if (count($all) > 0) { ?>
        <div class="table-responsive rounded">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-secondary text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($all as $index => $order) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td>
                                <?= $user_model->get_product_name_by_id($order['prod_id']) ?>
                            </td>
                            <td><?= htmlspecialchars($order['quantity']) ?></td>
                            <td><?= date("F j, Y", strtotime($order['created_date'])) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-info text-center" role="alert">
            You haven’t placed any orders yet. Start capturing moments now!
        </div>
    <?php } ?>
</div>