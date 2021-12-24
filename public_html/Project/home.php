<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<div class="container-fluid">
    <h2>What it doooo!</h2>
</div>
<div>
    <?php $duration = "week"; ?>
    <?php require(__DIR__ . "/../../partials/top10_table.php"); ?>
    <?php include(__DIR__ . "/../../partials/pagination.php"); ?>
</div>

<div>
    <?php $duration = "month"; ?>
    <?php require(__DIR__ . "/../../partials/top10_table.php"); ?>
    <?php include(__DIR__ . "/../../partials/pagination.php"); ?>
</div>

<div>
    <?php $duration = "lifetime"; ?>
    <?php require(__DIR__ . "/../../partials/top10_table.php"); ?>
    <?php include(__DIR__ . "/../../partials/pagination.php"); ?>
</div>