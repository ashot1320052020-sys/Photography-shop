<?php
include_once "header.php";
include_once "../model/user_model.php";

if (isset($_GET['cat_id'])) {
    $_SESSION['cat_id'] = $_GET['cat_id'];
}

$cat_id = $_SESSION['cat_id'];
$category_name = $user_model->get_cat_name_by_id($cat_id);
$all = $user_model->get_products($cat_id);
?>

<body style="background-color: #fffaf5;">
    <div class="container py-4">
        <?php if ($category_name): ?>
            <h4 class="text-center mb-4 fw-semibold" style="color: #4e342e;">
                <?= htmlspecialchars($category_name) ?> - Products
            </h4>
        <?php endif; ?>

        <?php if (count($all) > 0) { ?>
            <div class="row g-3">
                <?php foreach ($all as $product) { ?>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card h-100 border-0 shadow-sm" style="background-color: #fbe9e7;" id="<?= htmlspecialchars($product['id']) ?>">
                            <img src="../../admin/assets/Image/<?= htmlspecialchars($product['image']) ?>"
                                class="card-img-top img-fluid p-2"
                                alt="Product Image"
                                style="max-height: 130px; width: 100%; object-fit: contain; background: #fff;">
                            <div class="card-body p-2 d-flex flex-column">
                                <h6 contenteditable class="td_name mb-1" style="color: #3e2723; font-size: 0.9rem;">
                                    <?= htmlspecialchars($product['name']) ?>
                                </h6>
                                <p contenteditable class="td_desc mb-1" style="color: #5d4037; font-size: 0.85rem;">
                                    <?= htmlspecialchars($product['description']) ?>
                                </p>
                                <p contenteditable class="td_price fw-semibold mb-2" style="color: #4e342e; font-size: 0.9rem;">
                                    <?= htmlspecialchars($product['price']) ?> ֏
                                </p>
                                <button class="btn btn_add btn-sm btn-primary w-100 mt-auto">Add to cart</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning text-center">No product available</div>
        <?php } ?>
    </div>
</body>