<?php
require_once(__DIR__ . "/../../partials/nav.php"); 
?>
<?php
if (!is_logged_in()) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>
<?php

$db = getDB();

$per_page = 10;
$theID = get_user_id();
$query = "SELECT count(*) as total FROM Participants WHERE user_id = $theID ORDER BY created DESC";
paginate($query, [], $per_page);

$stmt = $db->prepare("SELECT u.*, c.compName FROM Participants u LEFT JOIN Competitions c ON c.id=u.comp_id WHERE u.user_id = :id ORDER BY u.created DESC LIMIT :offset,:count");
$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
$stmt->bindValue(":count", $per_page, PDO::PARAM_INT);
$stmt->bindValue(":id", get_user_id(), PDO::PARAM_INT);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid">
    <h2>Competition Recs!</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Competition Name</th>
                <th scope="col">Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($results) && count($results)): ?>
                <?php foreach ($results as $r): ?>
                    <tr>
                        <td><?php se($r, "compName"); ?></td>
                        <td><?php se($r, "created"); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="100%">No active competitions</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php include(__DIR__ . "/../../partials/pagination.php"); ?>
</div>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>