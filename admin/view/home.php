<?php
include_once('header.php');
include_once('../model/model.php');
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
    die;
}
$all = $model->get_categories();
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?></h1>
        <div>
            <a href="../view/orders.php" class="btn btn-secondary me-2">Orders</a>
            <a href="../controller/logout.php" class="btn btn-danger">Log out</a>
        </div>
    </div>

    <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3">Add New Category</h5>
        <div class="input-group">
            <input type="text" id="inp" class="form-control" placeholder="Category name">
            <button id="btn_add" class="btn btn-primary">Add</button>
        </div>
        <p id="p_mess" class="mt-2 text-danger"></p>
    </div>

    <?php if (count($all) > 0) { ?>
        <div class="card p-4 shadow-sm">
            <h5 class="mb-3">All Categories</h5>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Update</th>
                        <th>Delete</th>
                        <th>Show</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $category) { ?>
                        <tr id="<?= htmlspecialchars($category['id']) ?>">
                            <td contenteditable="true"><?= htmlspecialchars($category['name']) ?></td>
                            <td><button class="btn btn-sm btn-success btn_upd">Update</button></td>
                            <td><button class="btn btn-sm btn-danger btn_del">Delete</button></td>
                            <td><a href="products.php?cat_id=<?= htmlspecialchars($category['id']) ?>" class="btn btn-sm btn-primary">Show</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-info">No categories available.</div>
    <?php } ?>
</div>