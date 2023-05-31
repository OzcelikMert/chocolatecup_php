<!DOCTYPE html>
<html lang="tr">
<head>
    <title>ChocolateCup | Puan Ver</title>
    <?php include("./tools/head.php"); ?>
    <link rel="stylesheet" href="./assets/styles/give_point.css?v=<?php echo date("YmdHis"); ?>">
    <link rel="stylesheet" href="./sameparts/sidebar/sidebar.css?v=<?php echo date("YmdHis"); ?>">
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
                include("./pages/give_point/functions/get_values.php");
                include("./pages/give_point/question_list.php");
            ?>
        </div>
    </div>
    <?php include("./tools/script.php"); ?>
    <script src="./assets/scripts/give_point.js?v=<?php echo date("YmdHis"); ?>"></script>
    <script src="./sameparts/sidebar/sidebar.js?v=<?php echo date("YmdHis"); ?>"></script>
</body>
</html>