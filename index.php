<!DOCTYPE html>
<html lang="tr">
<head>
    <title>ChocolateCup | Giriş</title>
    <?php include("./tools/head.php"); ?>
    <link rel="stylesheet" href="./assets/styles/index.css?v=<?php echo date("YmdHis"); ?>">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <?php
                include("./pages/index/functions/login_cookie.php");
                include("./pages/index/hidden_inputs.php");
                include("./pages/index/form.php");
            ?>
        </div>
    </div>
    <?php include("./tools/script.php"); ?>
    <script src="./assets/scripts/index.js?v=<?php echo date("YmdHis"); ?>"></script>
</body>
</html>