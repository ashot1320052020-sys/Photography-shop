<?php
include_once("header.php");
include_once("../model/model.php");

if (isset($_GET['cat_id'])) {
    $_SESSION["cat_id"] = $_GET['cat_id'];
}
$all = $model->get_products($_SESSION["cat_id"]);
$cat_name = $model->get_cat_name_by_id($_SESSION["cat_id"]);
?>

<div class="container mt-5">
    <h2 class="mb-4 d-flex justify-content-between">
        <a class="px-4" href="home.php">Home</a>
        <p class="px-4"> Category <?= $cat_name ?></p>
    </h2>

    <div class="card p-4 shadow-sm mb-4">
        <h5 class="mb-3">Add New Product</h5>
        <form action="../controller/add_products.php" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-3 mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="desc" class="form-control" placeholder="Description" required>
                </div>
                <div class="col-md-2 mb-2">
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="file" name="img" class="form-control" required>
                </div>
            </div>
            <button name="action" value="add" class="btn btn-primary">Add Product</button>
        </form>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mt-3 alert alert-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (count($all) > 0) { ?>
        <div class="card p-4 shadow-sm">
            <h5 class="mb-3">Product List</h5>
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $product) { ?>
                        <tr id="<?= htmlspecialchars($product['id']) ?>">
                            <td contenteditable="true" class="td_name"><?= htmlspecialchars($product['name']) ?></td>
                            <td>
                                <img src="../assets/Image/<?= htmlspecialchars($product['image']) ?>" class="img-thumbnail" style="max-width: 100px; height: auto;">
                            </td>
                            <td contenteditable="true" class="td_desc"><?= htmlspecialchars($product['description']) ?></td>
                            <td contenteditable="true" class="td_price"><?= htmlspecialchars($product['price']) ?></td>
                            <td><button class="btn btn-sm btn-success btn_update">Update</button></td>
                            <td><button class="btn btn-sm btn-danger btn_delete">Delete</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-info">No products available.</div>
    <?php } ?>
</div>