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
if (isset($data["score"])) 
{
    session_start();
    $reject = false;
    require_once(__DIR__ . "/../../../lib/functions.php");
    $user_id = get_user_id();

    //if user is not logged in, display friendly error message
    if ($user_id <= 0) 
    {
        $reject = true;
        error_log("User not logged in");
        http_response_code(403);
        $response["message"] = "You must be logged in to save your score";
        flash($response["message"], "warning");
    }

    if (!$reject) 
    {
        $score = (int)se($data, "score", 0, false);

        error_log("Rejected " . ($reject ? "true" : "false"));

        if (!$reject) 
        {
            http_response_code(200);

            //2x and 3x score mod logic
            $mod = (int)se($_SESSION, "score_mod", 1, false);
            unset($_SESSION["score_mod"]);
            error_log("Score $score x $mod = " . ($score * $mod));
            save_score($score * $mod, $user_id, true);

            error_log("Score of $score saved successfully for $user_id");
        } 
        
        else 
        {
            $response["message"] = "AntiCheat Detection Triggered. Score rejected.";
            flash($response["message"], "danger");
        }
    }
}

echo json_encode($response);