<?php
session_start();
$url = "http://localhost/online_shop/";
$_SESSION['url'] = $url;
$parsed_url = parse_url($url);
$path = trim($parsed_url['path'], '/');
$base_folder = basename($path);
function createUrl($path)
{
    $baseUrl = $_SERVER['REQUEST_SCHEME'] . "://"
        . $_SERVER['HTTP_HOST'] . "/"
        . $GLOBALS['base_folder'] . "/users/view/";
    return $baseUrl . $path;
}
$urls = [
    "Home" => "http://localhost/" . $GLOBALS['base_folder'] . "/index.php",
    "Cart" => createUrl("cart.php"),
    "Orders" => createUrl("orders.php")
];
if (isset($_SESSION['user_email'])) {
    $urls['Logout'] = "http://localhost/" . $GLOBALS['base_folder']
        . "/users/controller/logout.php";
    $urls[$_SESSION['user_email']] = '#';
} else {
    $urls['Login'] = createUrl('login_form.php');
    $urls['Registration'] = createUrl('reg_form.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?= $url ?>/users/assets/Javascript/main.js"></script>
    <style>
        .btn {
            background-color: #4e342e;
            color: white;
        }

        .btn:hover {
            background-color: #be8174ff;
        }
    </style>
</head>

<body style="background-color: #fffaf5;">

    <nav class="navbar navbar-expand-lg" style="background-color: #4e342e;">
        <div class="container-fluid px-5">
            <a class="navbar-brand text-white fw-bold" href="<?= $url ?>">Photography Shop</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    foreach ($urls as $label => $url) {
                        echo '<li class="nav-item">
                            <a class="nav-link text-white" href="' . $url . '">' . $label . '</a>
                          </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>