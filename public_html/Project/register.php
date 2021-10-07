<?php

require(__DIR__ . "/../../partials/nav.php");

?>


<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <div>
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }
</script>
<?php
 //TODO 2: add PHP Code
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"]))
{
    // get email key from post, default to "" if not a set, return the value
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);
    $confirm = se($_POST, "confirm", "", false);

    //TODO 3: validate/use

    //create array to show all errors
    //$errors = [];

    $hasErrors = false;

    if (empty($email))
    {
        //adds to the end of the array
        //array_push($errors, "Email must be set");
        flash("Email must be set");
        $hasErrors = true;
    }

    //sanitize
    $email = sanitize_email($email);
    //validate

    if(!is_valid_email($email))
    {
        //array_push($errors, "Invalid email address");
        flash("Invalid email address");
        $hasErrors = true;
    }


    if (empty($password))
    {
        //array_push($errors, "Password must be set");
        flash("Password must be set");
        $hasErrrors = true;
    }

    if (empty($confirm))
    {
        //array_push($errors, "Confirm password must be set");
        flash("Confirm password must be set");
        $hasErrrors = true;
    }

    //strlen for the length of string
    if (strlen($password) < 8)
    {
        //array_push($errors, "Password must be 8 characters or more");
        flash("Password must be 8 characters or more", "Warning");
        $hasErrors = true;
    }

    if (strlen($password) > 0 && $password !== $confirm)
    {
        //array_push($errors, "Passwords do not match");
        flash("Password do not match", "Warning");
        $hasErrors = true;
    }

    /*
    // count for the length of an array
    if (count($errors) > 0)
    {
        echo "<prev>" . var_export($errors, true) . "</prev";
    }
    */

    else
    {
        flash("Welcome, $email!");

        $hash = password_hash($password, PASSWORD_BCRYPT);
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Users (email, password) VALUES (:email, :password)");
        
        try
        {
            $stmt->execute([":email" => $email, ":password" => $hash]);
            flash("You've been registered!");
        }

        catch (Exception $e)
        {
            flash("There was a problem registering");
            flash(var_export($e, true));
        }
        
    }

}

?>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>