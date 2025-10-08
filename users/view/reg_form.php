<?php
include_once("header.php");
?>

<body style="background-color: #fffaf5;">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border p-4 shadow-sm rounded" style="background-color: #efebe9;">
                    <h2 class="text-center mb-4" style="color: #4e342e;">Register</h2>
                    <form action="../controller/register.php" method="post">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="login" class="form-control" placeholder="Login" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="pass" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="conf_pass" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="btn_reg" value="btn" class="btn">
                                Register
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-3 text-danger">
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>