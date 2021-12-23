<?php
require_once(__DIR__ . "/../../partials/nav.php");
if (!is_logged_in()) {
    die(header("Location: login.php"));
}
?>
<?php
if (isset($_POST["save"])) {
    $email = se($_POST, "email", null, false);
    $username = se($_POST, "username", null, false);

    $params = [":email" => $email, ":username" => $username, ":id" => get_user_id()];
    $db = getDB();
    $stmt = $db->prepare("UPDATE Users set email = :email, username = :username where id = :id");
    try {
        $stmt->execute($params);
    } catch (Exception $e) {
        if ($e->errorInfo[1] === 1062) {
            //https://www.php.net/manual/en/function.preg-match.php
            preg_match("/Users.(\w+)/", $e->errorInfo[2], $matches);
            if (isset($matches[1])) {
                flash("The chosen " . $matches[1] . " is not available.", "warning");
            } else {
                //TODO come up with a nice error message
                echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
            }
        } else {
            //TODO come up with a nice error message
            echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
        }
    }
    //select fresh data from table
    $stmt = $db->prepare("SELECT id, email, IFNULL(username, email) as `username` from Users where id = :id LIMIT 1");
    try {
        $stmt->execute([":id" => get_user_id()]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            //$_SESSION["user"] = $user;
            $_SESSION["user"]["email"] = $user["email"];
            $_SESSION["user"]["username"] = $user["username"];
        } else {
            flash("User doesn't exist", "danger");
        }
    } catch (Exception $e) {
        flash("An unexpected error occurred, please try again", "danger");
        //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
    }


    //check/update password
    $current_password = se($_POST, "currentPassword", null, false);
    $new_password = se($_POST, "newPassword", null, false);
    $confirm_password = se($_POST, "confirmPassword", null, false);
    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        if ($new_password === $confirm_password) {
            //TODO validate current
            $stmt = $db->prepare("SELECT password from Users where id = :id");
            try {
                $stmt->execute([":id" => get_user_id()]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if (isset($result["password"])) {
                    if (password_verify($current_password, $result["password"])) {
                        $query = "UPDATE Users set password = :password where id = :id";
                        $stmt = $db->prepare($query);
                        $stmt->execute([
                            ":id" => get_user_id(),
                            ":password" => password_hash($new_password, PASSWORD_BCRYPT)
                        ]);

                        flash("Password reset", "success");
                    } else {
                        flash("Current password is invalid", "warning");
                    }
                }
            } catch (Exception $e) {
                echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
            }
        } else {
            flash("New passwords don't match", "warning");
        }
    }
}
?>

<?php
$email = get_user_email();
$username = get_username();

//user can see scores
$user_id = get_user_id();
?>
<div class="container-fluid">
    <h2>Profile</h2>
    <div>
        <h5>Points: </h5><?php echo get_points(); ?>
        <h5>Best Score: </h5><?php echo get_best_score($user_id); ?>
    </div>
    <div>
        <?php $last10 = get_latest_scores($user_id); ?>
        <h5>Your Last 10 Scores</h5>
        <table class="table">
            <thead>
                <th>Score</th>
                <th>Time</th>
            </thead>
            <tbody>

                <!-- add no score message like in list_roles.php --> 
                
                <?php foreach ($last10 as $score) : ?>
                    <tr>
                        <td><?php se($score, "score", 0); ?></td>
                        <td><?php se($score, "created", "-"); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <h2>What we updating!?</h2>
    <form method="POST" onsubmit="return validate(this);">
        <div class="form-floating mb-3">
            <input class="form-control" type="email" name="email" id="email" value="<?php se($email); ?>" />
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="username" id="username" value="<?php se($username); ?>" />
            <label for="username">Username</label>
        </div>
        <!-- DO NOT PRELOAD PASSWORD -->
        <h6>Password Reset</h6>
        <div class="form-floating mb-3">
            <input class="form-control" type="password" name="currentPassword" id="cp" placeholder="current_pw"/>
            <label for="cp">Current Password</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="password" name="newPassword" id="np" placeholder="new_pw"/>
            <label for="np">New Password</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="password" name="confirmPassword" id="conp" placeholder="confirm_pw" />
            <label for="conp">Confirm Password</label>
        </div>
        <input type="submit" class="btn btn-outline-secondary btn-sm" value="Update Profile" name="save" />
    </form>
</div>

<script>
    function validate(form) {
        let pw = form.newPassword.value;
        let con = form.confirmPassword.value;
        let isValid = true;
        //TODO add other client side validation....

        //example of using flash via javascript
        //find the flash container, create a new element, appendChild
        if (pw !== con) {
            //find the container
            /*let flash = document.getElementById("flash");
            //create a div (or whatever wrapper we want)
            let outerDiv = document.createElement("div");
            outerDiv.className = "row justify-content-center";
            let innerDiv = document.createElement("div");

            //apply the CSS (these are bootstrap classes which we'll learn later)
            innerDiv.className = "alert alert-warning";
            //set the content
            innerDiv.innerText = "Password and Confirm password must match";

            outerDiv.appendChild(innerDiv);
            //add the element to the DOM (if we don't it merely exists in memory)
            flash.appendChild(outerDiv);*/
            flash("Password and Confirm password must match", "warning");
            isValid = false;
        }
        return isValid;
    }
</script>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>