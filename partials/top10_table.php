<?php
//require(__DIR__ . "/../../lib/functions.php");
//requires a duration to be set
if (!isset($duration)) {
    $duration = "day"; //choosing to default to day
}
$results = get_top_10($duration);

switch ($duration) {
    case "day":
        $title = "Top Today";
        break;
    case "week":
        $title = "Top Weekly";
        break;
    case "month":
        $title = "Top Monthly";
        break;
    case "lifetime":
        $title = "Top Lifetime";
        break;
    default:
        $title = "Invalid Scoreboard";
        break;
}
?>
<div class="container-fluid">
    <div class="fw-bold fs-3">
        <?php se($title); ?>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Score</th>
                <th scope="col">Achieved</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$results || count($results) == 0) : ?>
                <tr>
                    <td colspan="100%">Daaw, No scores available yet :-(</td>
                </tr>
            <?php else : ?>
                <?php foreach ($results as $result) : ?>
                    <tr>
                        <td><?php se($result, "score"); ?></td>
                        <td><?php se($result, "created"); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table> 
</div>