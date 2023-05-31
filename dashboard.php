<!DOCTYPE html>
<html lang="tr">
<head>
    <title>ChocolateCup | Dashboard</title>
    <?php include("./tools/head.php"); ?>
    <link rel="stylesheet" href="./sameparts/sidebar/sidebar.css?v=<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="./assets/styles/dashboard.css?v=<?php echo date("YmdHis"); ?>">
</head>
<body>
    <?php
        include("./sameparts/account_control/check_cookie.php");
        include("./sameparts/sidebar/get_values.php");
        include("./sameparts/sidebar/sidebar.php");
    ?>
    <div class="container full-height full-width">
        <div class="row mt-2">
            <div class="col-12">
                <?php
                    include("./pages/dashboard/saved_points.php");
                ?>
            </div>
        </div>
    </div>
    <?php include("./tools/script.php"); ?>
    <script src="./assets/scripts/dashboard.js?v=<?php echo date("YmdHis"); ?>"></script>
    <script src="./sameparts/sidebar/sidebar.js?v=<?php echo date("YmdHis"); ?>"></script>
</body>
</html>