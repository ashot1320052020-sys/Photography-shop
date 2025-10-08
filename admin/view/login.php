<?php
include_once("header.php")
?>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-5 shadow" style="max-width: 450px; width: 100%;">
            <h2 class="mb-4 text-center">Admin Login</h2>
            <form action="../controller/login_check.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="login" placeholder="Login" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" name="btn_enter" class="btn btn-primary">Enter</button>
                </div>
            </form>
            <p style="color: red;">
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </p>
        </div>
    </div>
</body>

</html>