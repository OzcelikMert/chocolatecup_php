<!DOCTYPE html>
<html lang="tr">
<head>
    <title>ChocolateCup | Sıralama</title>
    <?php include("./tools/head.php"); ?>
    <link rel="stylesheet" href="./assets/styles/rank.css?v=<?php echo date("YmdHis"); ?>">
</head>
<body>
    <div class="container full-height full-width">
        <div class="row"> 
            <?php
                include("./pages/rank/table.php");
            ?>
        </div>
    </div>
    <?php include("./tools/script.php"); ?>
    <script src="./assets/scripts/rank.js?v=<?php echo date("YmdHis"); ?>"></script>
</body>
</html>