<?php
$a1 = [10.001, 11.591, 0.011, 5.991, 16.121, 0.131, 100.981, 1.001];
$a2 = [1.99, 1.99, 0.99, 1.99, 0.99, 1.99, 0.99, 0.99];
$a3 = [0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01, 0.01];
$a4 = [10.01, -12.22, 0.23, 19.20, -5.13, 3.12];
function getTotal($arr) {
    echo "<br>Processing Array:<br><pre>" . var_export($arr, true) . "</pre>";
    $total = 0.00;

    /* 18 September 2021
     * Problem 2
     * 
     * Description: Create a loop that adds floats/decimals of "currency" to get a total value for the passed in array.
     * Make sure it rounds to 2 decimal places and does not face any rounding issues.
     * https://njit.instructure.com/courses/20242/assignments/174553?module_item_id=606614
     * 
     * @author Alen Holsey
     */

    //TODO do adding here

    //variable for loop counter
    $arrLen = count($arr);

    //for loop to iterate array
    for ($i = 0; $i < $arrLen; $i++)
    {
        //checking correct iter
        //echo "Adding $arr[$i]<br>";

        //adding numbers
        $total += $arr[$i];

    }

    //TODO do rounding stuff here

    //round total to 2 decimal places
    $total = round($total, 2);



    echo "The total is " . var_export($total, true);
}
echo "Problem 2: Adding Floats<br>";
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
                <?php getTotal($a1) ?>
            </td>
            <td>
                <?php getTotal($a2) ?>
            </td>
            <td>
                <?php getTotal($a3) ?>
            </td>
            <td>
                <?php getTotal($a4); ?>
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