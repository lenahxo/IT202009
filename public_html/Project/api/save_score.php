<?php
//remember, API endpoints should only echo/output precisely what you want returned
//any other unexpected characters can break the handling of the response
$response = ["message" => "There was a problem saving your score"];
http_response_code(400);
$contentType = $_SERVER["CONTENT_TYPE"];
error_log("Content Type $contentType");
if ($contentType === "application/json") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true)["data"];
} else if ($contentType === "application/x-www-form-urlencoded") {
    $data = $_POST;
}

error_log(var_export($data, true));

//validate request has the data wanted
if (isset($data["score"])) {
    session_start();
    $reject = false;
    require_once(__DIR__ . "/../../../lib/functions.php");
    $user_id = get_user_id();

    //if user is not logged in, display friendly error message
    if ($user_id <= 0) {
        $reject = true;
        error_log("User not logged in");
        http_response_code(403);
        $response["message"] = "You must be logged in to save your score";
        flash($response["message"], "warning");
    }

    if (!$reject) {
        $score = (int)se($data, "score", 0, false);
        $calced = 0;
        $data = $data["data"]; //anti-cheating
        //$duck_value = (int)se($_SESSION, "duck_value", 10, false);
        $lastDate = null;
        $startDate = null;
        $data_count = count($data);
        $duplicate_dates = 0;
        //anti-cheating checks (some TODOs may not be implemented and are there for example as to things you may need to consider)
        //1) calculate expected score vs passed score
        //2) ensure each record is older than the previous
        //3) check number of duplicate dates for records (it's only possible to have the same date for all records if only 1 shot was fired during the whole game)
        //4) TODO: ensure sufficient time elapsed between records
        //5) TODO: pass in location data and validate position trajectory (may be overkill)
        foreach ($data as $r) {
            $time = (int)se($r, "ts", 0, false);
            $time /= 1000;
            $date = DateTime::createFromFormat("U", floor($time));
            if (!$lastDate || $date >= $lastDate) {
                if ($date === $lastDate) {
                    $duplicate_dates++;
                }
                if (!$startDate) {
                    //Note: technically the best option is to let the server set the start date/time when it fetches the list of effects
                    //that way it's less likely it can be altered on the client side
                    $startDate = $date;
                    error_log("set start date " . var_export($startDate, true));
                }
                $lastDate = $date;
                $ducks = (int)$r["d"];
                $calced += $ducks * $duck_value;
                if ($calced > $score) {
                    $reject = true;
                    error_log("Calced score is greater than provided score");
                    break;
                }
            } else {
                $reject = true;
                error_log("Invalid ts validation for game activity");
                break;
            }
        }
        if (!$reject) {
            if ($calced != $score) {
                $reject = true;
                error_log("Invalid calculated score");
            }
            if ($duplicate_dates >= $data_count) {
                error_log("Too many duplicate dates");
                $reject = true;
            }
            //https://pretagteam.com/question/get-interval-seconds-between-two-datetime-in-php
            $seconds = abs($lastDate->getTimestamp() - $startDate->getTimestamp());
            error_log("last date " . var_export($lastDate, true));
            error_log("Elapsed seconds $seconds");
            if ($seconds > 60) {
                error_log("Modified game duration greater than 60 seconds");
                $reject = true;
            }
        }
        error_log("Rejected " . ($reject ? "true" : "false"));
        if (!$reject) {
            http_response_code(200);
            //2x and 3x score mod logic
            $mod = (int)se($_SESSION, "score_mod", 1, false);
            unset($_SESSION["score_mod"]);
            error_log("Score $score x $mod = " . ($score * $mod));
            save_score($score * $mod, $user_id, true);
            //purchase feature to pay to earn points (free play doesn't earn)
            if (se($_SESSION, "gen_points", false, false)) {
                $p = ceil($score / 100);
                unset($_SESSION["gen_points"]); //remove flag
                change_bills($p, "win", -1, get_user_account_id(), "You won $p bills with a score of $score (" . $mod . "x multiplier)!");
                flash("You won $p bills!");
                $response["message"] = "You won $p bills!";
            } else {
                $response["message"] = "Score Saved!";
            }
            error_log("Score of $score saved successfully for $user_id");
        } else {
            $response["message"] = "AntiCheat Detection Triggered. Score rejected.";
            flash($response["message"], "danger");
        }
    }
}
echo json_encode($response);