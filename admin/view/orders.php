<?php
include_once("header.php");
include_once("../model/model.php");

$orders = $model->get_orders_grouped_by_users();
?>

<div class="container mt-5">
    <h2 class="mb-4 d-flex justify-content-between">
        <p>Manage Orders <a class="px-4" href="home.php">Home</a></p>
    </h2>

    <?php if (count($orders) > 0): ?>
        <?php
        $current_user = null;
        foreach ($orders as $index => $order) {
            if ($order['user_name'] !== $current_user) {
                if ($current_user !== null) {
                    echo "</tbody></table></div>";
                }
                $current_user = $order['user_name'];
                echo '<div class="card p-4 shadow-sm mb-4">';
                echo "<h5 class='mb-3'>Orders by <strong>" . htmlspecialchars($current_user) . "</strong></h5>";
                echo '<table class="table table-striped table-hover align-middle">';
                echo '<thead><tr><th>Product</th><th>Quantity</th><th>Order Date</th></tr></thead><tbody>';
            }

            echo "<tr>";
            echo "<td>" . htmlspecialchars($order['product_name']) . "</td>";
            echo "<td>" . htmlspecialchars($order['quantity']) . "</td>";
            echo "<td>" . htmlspecialchars($order['created_date']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
        ?>
    <?php else: ?>
        <div class="alert alert-info">No orders found.</div>
    <?php endif; ?>
</div>