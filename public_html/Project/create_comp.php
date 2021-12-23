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
    <h1>Create Competition</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="comp_name" class="form-label">Name</label>
            <input id="comp_name" name="comp_name" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="reward" class="form-label">Starting Reward</label>
            <input id="reward" type="number" name="starting_reward" class="form-control" onchange="updateCost()" placeholder=">= 1" min="1" />
        </div>
        <div class="mb-3">
            <label for="ms" class="form-label">Min. Score</label>
            <input id="ms" name="min_score" type="number" class="form-control" placeholder=">= 1" min="1" />
        </div>
        <div class="mb-3">
            <label for="mp" class="form-label">Min. Participants</label>
            <input id="mp" name="min_participants" type="number" class="form-control" placeholder=">= 3" min="3" />
        </div>
        <div class="mb-3">
            <label for="jc" class="form-label">Join Fee</label>
            <input id="jc" name="join_fee" type="number" class="form-control" onchange="updateCost()" placeholder=">= 0" min="0" />
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duration (in Days)</label>
            <input id="duration" name="duration" type="number" class="form-control" placeholder=">= 3" min="3" />
        </div>
        <!-- Payout for 1st place -->
        <div class="mb-3">
            <label for="fp" class="form-label">1st Place Payout</label>
            <input id="fp" name="first_place_per" type="number" class="form-control" placeholder="Enter percentage (%)"/>
        </div>
        <!-- Payout for 2nd place -->
        <div class="mb-3">
            <label for="sp" class="form-label">2nd Place Payout</label>
            <input id="sp" name="second_place_per" type="number" class="form-control" placeholder="Enter percentage (%)"/>
        </div>
        <!-- Payout for 3rd place -->
        <div class="mb-3">
            <label for="tp" class="form-label">3rd Place Payout</label>
            <input id="tp" name="third_place_per" type="number" class="form-control" placeholder="Enter percentage (%)"/>
        </div>
        <!-- <div class="mb-3">
            <label for="po" class="form-label">Payout Option (1st, 2nd, 3rd)</label>
            <select id="po" name="payout_option" class="form-control">
                <option value="1">60%, 30%, 10%</option>
                <option value="2">70%, 20%, 10%</option>
                <option value="3">80%, 20%, 0%</option>
                <option value="4">75%, 20%, 5%</option>
                <option value="5">65%, 25%, 10%</option>
                <option value="6">80%, 10%, 10%</option>
                <option value="7">75%, 15%, 10%</option>
                <option value="8">50%, 30%, 20%</option>
            </select>
        </div> -->
        <div class="mb-3">
            <input type="submit" value="Create Competition (Cost: 2)" class="btn btn-primary" />
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