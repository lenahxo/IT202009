<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
$payout_options = [];
$db = getDB();
$stmt = $db->prepare("SELECT id, CONCAT(first_place,'% - ', second_place, '% - ', third_place, '%') as place FROM Competitions");
try {
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $payout_options = $r;
    }
} catch (PDOException $e) {
    flash("There was a problem fetching first, second, third place options", "danger");
    error_log("Error Getting Places: " . var_export($e, true));
}
// save

// collect value of competition name input field. make sure field is NOT empty
if (isset($_POST["compName"]) && !empty($_POST["compName"])) {
    if ($_POST["first_place"] + $_POST["second_place"] + $_POST["third_place"] == 100) {
        // collect value of competition's starting reward --> minimum will be one
        $cost = (int)se($_POST, "start_reward", 0, false);

        // increment cost (for creator) --> starting reward starts at 1 point
        $cost++;
        // The cost to the creator of the competition will be (1 + starting reward value)
        // collect value of cost to join, then add to reward

        $cost += (int)se($_POST, "join_fee", 0, false);
        // collect value of competition name
        $comp_name = se($_POST, "compName", "N/A", false);

        // retrieve user's points --> CURRENCY
        $bal = get_points(get_user_id());
        // if user's balance is greater than competition cost
        if ($bal >= $cost) {
            // begin the transaction
            $db->beginTransaction();
            // deduct points

            //-->if (point_change($cost, "create_comp", get_user_id())) {
                $_POST["creator_id"] = get_user_id();
                // store competition info, then add it to Competitions table
                $id = save_data("Competitions", $_POST);
                // 
                if ($id > 0) {
                    if (add_to_comp($id, get_user_id())) {
                        flash("Successfully created competition", "success");
                        $db->commit();
                    } else {
                        $db->rollback();
                    }
                } else {
                    $db->rollback();
                }
            //-->} 

           /* else {

                flash("There was a problem deducting points", "warning");
                $db->rollback();
            }*/


        } else {
            flash("You can't afford this right now", "warning");
        }
    } else {
        flash("Invalid payout option", "warning");
    }
}

/*
INSERT INTO Competitions (the data) --> save_data()
deduct points after purchase AND prior to join --
then $comp_id = $db->lastInsertId(); --> from save_data() function
*/
?>

<div class="container-fluid">
    <h2>Make your competition!</h2>
    <form method="POST">
        <div class="form-floating mb-3">
            <input id="cName" name="compName" class="form-control" type="text" placeholder="name"/>
            <label for="compName">Competition Name</label>
        </div>
        <div class="form-floating mb-3">
            <input id="reward" type="number" name="start_reward" class="form-control" onchange="updateCost()" placeholder="Value 1 or greater" min="1" />
            <label for="reward">Starting Reward</label>
        </div>
        <div class="form-floating mb-3">
            <input id="ms" name="min_score" type="number" class="form-control" placeholder="Value 1 or greater" min="1" />
            <label for="ms">Minimum Score</label>
        </div>
        <div class="form-floating mb-3">
            <input id="mp" name="min_partic" type="number" class="form-control" placeholder="Value 3 or greater" min="3" />
            <label for="mp">Minimum Participants</label>
        </div>
        <div class="form-floating mb-3">
            <input id="jc" name="join_fee" type="number" class="form-control" onchange="updateCost()" placeholder="Value 0 or greater" min="0" />
            <label for="jc" class="form-label">Joining Fee</label>
        </div>
        <div class="form-floating mb-3">
            <input id="duration" name="duration" type="number" class="form-control" placeholder="Value 3 or greater" min="3" />
            <label for="duration">Duration (days)</label>
        </div>
        <!-- Payout for 1st place -->
        <div class="form-floating mb-3">
            <input id="fp" name="first_place" type="number" class="form-control" placeholder="Enter percentage (%)"/>
            <label for="fp">1st Place Prize</label>
        </div>
        <!-- Payout for 2nd place -->
        <div class="form-floating mb-3">
            <input id="sp" name="second_place" type="number" class="form-control" placeholder="Enter percentage (%)"/>
            <label for="fp">2nd Place Prize</label>
        </div>
        <!-- Payout for 3rd place -->
        <div class="form-floating mb-3">
            <input id="tp" name="third_place" type="number" class="form-control" placeholder="Enter percentage (%)"/>
            <label for="fp">3rd Place Prize</label>
        </div>
        <div class="form-floating mb-3">
            <input type="submit" value="Create Competition" class="btn btn-outline-secondary btn-sm" />
        </div>
    </form>
    <script>
        function updateCost() {
            let starting = parseInt(document.getElementById("reward").value || 0) + 1;
            let join = parseInt(document.getElementById("jc").value || 0);
            if (join < 0) {
                join = 1;
            }
            let cost = starting + join;
            document.querySelector("[type=submit]").value = `Create Competition (Cost: ${cost})`;
        }
    </script>
</div>

<?php
require_once(__DIR__ . "/../../partials/flash.php");