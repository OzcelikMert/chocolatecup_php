<!DOCTYPE html>
<html lang="tr">
<head>
    <title>ChocolateCup | Yarışma Yönetimi</title>
    <?php include("./tools/head.php"); ?>
    <link rel="stylesheet" href="./sameparts/sidebar/sidebar.css?v=<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="./assets/styles/contest_management.css?v=<?php echo date("YmdHis"); ?>">
</head>
<body>
    <?php
        include("./sameparts/account_control/check_cookie.php");
        include("./sameparts/sidebar/get_values.php");
        include("./sameparts/sidebar/sidebar.php");
    ?>
    <div class="container full-height full-width">
        <div class="row">
            <?php
                include("./pages/contest_management/functions/get_values.php");
                include("./pages/contest_management/active_button.php");
            ?>
        </div>
    </div>
    <?php include("./tools/script.php"); ?>
    <script src="./assets/scripts/contest_management.js?v=<?php echo date("YmdHis"); ?>"></script>
    <script src="./sameparts/sidebar/sidebar.js?v=<?php echo date("YmdHis"); ?>"></script>
</body>
</html>