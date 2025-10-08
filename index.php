<?php
include_once("./users/view/header.php");
include_once("./users/model/user_model.php");
$all = $user_model->get_categories();
?>

<div class="container py-5" style="background-color: #fffaf5;;">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold" style="color: #4e342e;">Photography Categories</h1>
        <p class="lead" style="color: #6d4c41;">Explore our curated collections</p>
    </div>

    <?php if (count($all) > 0) { ?>
        <ul class="list-group list-group-flush mx-auto" style="max-width: 600px;">
            <?php foreach ($all as $category) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #efebe9;">
                    <span contenteditable style="color: #3e2723; font-weight: 500;">
                        <?= htmlspecialchars($category['name']) ?>
                    </span>
                    <a href="users/view/products.php?cat_id=<?= htmlspecialchars($category['id']) ?>" class="btn">View</a>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <div class="alert alert-warning text-center">No category available</div>
    <?php } ?>
</div>