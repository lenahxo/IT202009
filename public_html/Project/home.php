<?php

//navigation
require(__DIR__."/../../partials/nav.php");
?>

<h1>Home</h1>
<?php

if(is_logged_in())
{
    flash("Welcome, " . $_SESSION["user"]["email"]); 
}

else
{
    flash("You're not logged in");
}

?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>