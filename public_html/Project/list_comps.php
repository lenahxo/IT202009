<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
$db = getDB();
//handle join
if (isset($_POST["join"])) {
    $user_id = get_user_id();
    $comp_id = se($_POST, "comp_id", 0, false);
    $cost = se($_POST, "join_fee", 0, false);
    $balance = get_points();
    join_comp($comp_id, $user_id, $cost);
}
$per_page = 5;
paginate("SELECT count(1) as total FROM Competitions WHERE expires > current_timestamp() AND paid_out < 1");

//TODO fix join
$stmt = $db->prepare("SELECT c.* FROM Competitions c
LEFT JOIN (SELECT * FROM Participants cp WHERE cp.user_id = :uid) as t ON t.comp_id = c.id
WHERE paid_out = 0 AND expires > current_timestamp() ORDER BY expires desc");

    
/*"SELECT Competitions.id, compName, min_partic, curr_partic, curr_reward, expires, user_id, min_score, join_fee, 
IF(comp_id is null, 0, 1) as joined,  CONCAT(first_place,'% - ', second_place, '% - ', third_place, '%') as place FROM Competitions
LEFT JOIN (SELECT * FROM Participants WHERE user_id = :uid) as uc ON uc.comp_id = Competitions.id WHERE expires > current_timestamp() AND paid_out < 1 ORDER BY expires desc"
*/

$results = [];
try {
    $stmt->execute([":uid" => get_user_id()]);
    $r = $stmt->fetchAll();
    if ($r) {
        $results = $r;
    }
} catch (PDOException $e) {
    flash("There was a problem fetching competitions, please try again later", "danger");
    error_log("List competitions error: " . var_export($e, true));
}
?>
<div class="container-fluid">
    <h2>Thee Competitions</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Participants</th>
                <th scope="col">Reward</th>
                <th scope="col">Min Score</th>
                <th scope="col">Expires</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($results) > 0) : ?>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?php se($row, "compName"); ?></td>
                        <td><?php se($row, "curr_partic"); ?>/<?php se($row, "min_partic"); ?></td>
                        <td><?php se($row, "curr_reward"); ?><br>Payout: <?php se($row, "place", "-"); ?></td>
                        <td><?php se($row, "min_score"); ?></td>
                        <td><?php se($row, "expires", "-"); ?></td>
                        <td>
                            <?php if (se($row, "joined", 0, false)) : ?>
                                <button class="btn btn-outline-secondary btn-sm disabled" onclick="event.preventDefault()" disabled>Already Joined</button>
                            <?php else : ?>
                                <form method="POST">
                                    <input type="hidden" name="comp_id" value="<?php se($row, 'id'); ?>" />
                                    <input type="hidden" name="cost" value="<?php se($row, 'join_fee', 0); ?>" />
                                    <input type="submit" name="join" class="btn btn-outline-secondary btn-sm" value="Join (Cost: <?php se($row, "join_fee", 0) ?>)" />
                                </form>
                            <?php endif; ?>
                            <a class="btn btn-outline-secondary btn-sm" href="view_comps.php?id=<?php se($row, 'id'); ?>">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
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