<?php
include_once('header.php');
include_once("../model/user_model.php");
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please log in first";
    header('location:login_form.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$all = $user_model->get_cart_items($user_id);
?>
<h2 class="px-3 py-1">Cart</h2>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Sum</th>
        <th>Remove</th>
    </tr>
    <?php
    if (count($all) > 0) {
        $total = 0;
        foreach ($all as $value) {
            $price = $value['price'];
            $quantity = $value['quantity'];
            $sum = $price * $quantity;
            $total += $sum;

    ?>
            <tr id="<?= $value['id'] ?>">
                <td class="td_name"><?= $value['name'] ?></td>
                <td><img style="max-width: 200px; height: auto;" src="../../admin/assets/Image/<?= $value['image'] ?>"></td>
                <td class="td_desc"><?= $value['description'] ?></td>
                <td class="td_price"><?= $value['price'] ?></td>
                <td>
                    <button class="btn minus">-</button>
                    <span class="quant"><?= $quantity ?></span>
                    <button class="btn plus">+</button>
                </td>
                <td class="sum"><?= $sum ?></td>
                <td><button class="btn btn_remove">Remove</button></td>
            </tr>
    <?php
        }

        echo  "<tr>
    <td colspan='6'>Total</td>
    <td class='total'>$total</td>
    </tr>";
    } else {
        echo "<tr><td colspan = '6'>Your cart is empty</td></tr>";
    }
    ?>
    <tr>
        <td colspan="7" align="right">
            <button class="btn order"
                style="background-color: green;">
                BUY
            </button>
        </td>
    </tr>
</table>
<p class="error px-3 py-1" style="color: red;"></p>
<p class="success px-3 py-1" style="color: green;"></p>