<!DOCTYPE html>
<html lang="en">
<?php
function getTitleOfWeb()
{
    return basename(dirname(dirname(dirname(__FILE__))));
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getTitleOfWeb() ?></title>
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/JavaScript/ajax.js"></script>
    <script src="../assets/JavaScript/product.js"></script>
</head>

<body>

</body>

</html>

<?php
session_start();
