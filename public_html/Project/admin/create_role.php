<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

if (isset($_POST["name"]) && isset($_POST["description"])) {
    $name = se($_POST, "name", "", false);
    $desc = se($_POST, "description", "", false);
    if (empty($name)) {
        flash("Name is required", "warning");
    } else {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Roles (name, description, is_active) VALUES(:name, :desc, 1)");
        try {
            $stmt->execute([":name" => $name, ":desc" => $desc]);
            flash("Successfully created role $name!", "success");
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                flash("A role with this name already exists, please try another", "warning");
            } else {
                flash(var_export($e->errorInfo, true), "danger");
            }
        }
    }
}
?>
<div class="container-fluid">
    <h2>New Role, Yaaay!</h2>
    <form method="POST">
        <div class="form-floating mb-3">
            <input class="form-control" id="name" name="name" placeholder="role_title" required />
            <label for="name">Role Title</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" name="description" id="d" placeholder="Type description here.."></textarea>
            <label for="d">Description</label>
        </div>
        <input type="submit" class="btn btn-outline-secondary btn-sm" value="Create Role" />
    </form>
</div>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>