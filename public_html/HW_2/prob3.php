<?php
$a1 = [-1, -2, -3, -4, -5, -6, -7, -8, -9, -10];
$a2 = [-1, 1, -2, 2, 3, -3, -4, 5];
$a3 = [-0.01, -0.0001, -.15];
$a4 = ["-1", "2", "-3", "4", "-5", "5", "-6", "6", "-7", "7"];

function bePositive($arr) {
    echo "<br>Processing Array:<br><pre>" . var_export($arr, true) . "</pre>";
    echo "<br>Positive output:<br>";

    /* 18 September 2021
     * Problem 3
     * 
     * Description: Create a loop that converts all values passed in to a positive value and output it to the screen.
     * https://njit.instructure.com/courses/20242/assignments/174553?module_item_id=606614
     * 
     * @author Alen Holsey
     */

    //TODO use echo to output all of the values as positive (even if they were originally positive)

    //variable for loop counter
    $arrLen = count($arr);

    //for loop to iterate array
    for ($i = 0; $i < $arrLen; $i++)
    {
        //converting num to pos
        $arr[$i] = abs($arr[$i]);

        //printing to console
        echo "$arr[$i]<br>";
    }

}
echo "Problem 3: Be Positive<br>";
?>
<table>
    <thread>
        <th>A1</th>
        <th>A2</th>
        <th>A3</th>
        <th>A4</th>
    </thread>
    <tbody>
        <tr>
            <td>
                <?php bePositive($a1); ?>
            </td>
            <td>
                <?php bePositive($a2); ?>
            </td>
            <td>
                <?php bePositive($a3); ?>
            </td>
            <td>
                <?php bePositive($a4); ?>
            </td>
        </tr>
</table>
<style>
    table {
        border-spacing: 2em 3em;
        border-collapse: separate;
    }

    td {
        border-right: solid 1px black;
        border-left: solid 1px black;
    }
</style>