<?php
include_once "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body style="background-color: #fffaf5;">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border p-4 shadow-sm rounded" style="background-color: #efebe9;">
                    <h2 class="text-center mb-4" style="color: #4e342e;">Login</h2>
                    <form action="../controller/login.php" method="post">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="pass" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="inp_check" id="rememberMe">
                            <label class="form-check-label" for="rememberMe" style="color: #3e2723;">
                                Remember me
                            </label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="btn_login" value="btn" class="btn">
                                Login
                            </button>
                        </div>
                    </form>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center mt-3">
                            <?= $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success text-center mt-2">
                            <?= $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>