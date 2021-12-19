<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<div class="container-fluid">
    <h2>What it doooo!</h2>
</div>
<?php
/*
if (is_logged_in(true)) {
    echo "Logged in succesfully as: " . get_username();
} else {
    echo "You're not logged in";
}
//shows session info
//echo "<pre>" . var_export($_SESSION, true) . "</pre>";
*/

$duration = "week";
?>
<?php require(__DIR__ . "/../../partials/top10_table.php"); ?>
</div>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>