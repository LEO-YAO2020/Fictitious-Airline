<?php
$json = '{}';
if (isset($_POST['check1'])) {
    $json = $_POST['check1'];
}
$arr = json_decode($json, true);
$json2 = '{}';
if (isset($_POST['check2'])) {
    $json2 = $_POST['check2'];
}
$arr2 = json_decode($json2, true);

$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];


$str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
$randStr = str_shuffle($str);
$rands= substr($randStr,0,10);

session_start();
$code = mt_rand(0,1000000);
$_SESSION['code'] = $code;

$arr3 = ['name'=>$name,'email'=>$email,'tel'=>$tel,'reference'=>$rands,'code'=>$code];
$json3 = json_encode($arr3);

?>

<html>
<head>
    <title>Detail</title>
    <link rel="stylesheet" href="../View/style.css">
    <script src="../View/jQuery/jQuery3.5.1.js"></script>
    <script src="../View/js/FinalInfo.js"></script>
</head>
<script type="text/javascript">
</script>
<body>
<div id="header">
    <div class="logo">&nbspFictitious&nbspAirline</div>
    <div class="logo" style="margin-left: 40%">Customer&nbsp&nbspInvoice</div>
</div>
<center>
<div style="margin-top: 70px"></div>
<div>
    <div class="auto" ><h2>Submit Information</h2></div>
    <form method="post" name="book" action="BookResult.php">
        <div style="margin-top: 2%"></div>
        <table width="400" height="400">

            <tr>
                <th>Reference number:</th>
                <th><?php echo $rands ?></th>
            </tr>
            <tr>
                <th>Name: </th>
                <th><?php echo $name ?></th>
            </tr>
            <tr>
                <th>Email: </th>
                <th><?php echo $email ?></th>
            </tr>
            <tr>
                <th>Tel: </th>
                <th><?php echo $tel ?></th>
            </tr>
            <?php echo "<input id='display' type='radio' name='check3' value='$json3' checked/>";?>
        </table>
        <br>
        <br>
        <br>
        <br>
        <table border="1" cellspacing="0" width="400" height="450">
            <tr>
                <?php
                if (isset($_POST['check1'])) {
                    echo "<th colspan='2'>Leave</th></tr>";
                    echo "<tr><th>Date: </th>";
                    echo "<td>" . $arr['date'] . "(" . $arr['time'] . ")" . "</td></tr>";
                    echo "<tr> <th>Flight model: </th>";
                    echo "<td>" . $arr['model'] . "</td></tr>";
                    echo "<tr>";
                    echo "<th>Departure Time: </th>";
                    echo "<td>" . $arr['deptime'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Arrive Time: </th>";
                    echo "<td>" . $arr['arrtime'] . "</td>";
                    echo "</tr>";
                    echo "<th>Price: </th>";
                    echo "<td>" . "$" . $arr['price'] . "</td>";
                    echo "</tr>";
                    echo "<input id='display' type='radio' name='check1' value='$json' checked/>";
                }
                if (isset($_POST['check2'])) {
                    echo "<th colspan='2'>Return</th></tr>";
                    echo " <th>Date: </th>";
                    echo "<td>" . $arr2['rdate'] . "(" . $arr2['time'] . ")" . "</td></tr>";
                    echo "<tr> <th>Flight model: </th>";
                    echo "<td>" . $arr2['model'] . "</td></tr>";
                    echo "<tr>";
                    echo "<th>Departure Time: </th>";
                    echo "<td>" . $arr2['deptime'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Arrive Time: </th>";
                    echo "<td>" . $arr2['arrtime'] . "</td>";
                    echo "</tr>";
                    echo "<th>Price: </th>";
                    echo "<td>" . "$" . $arr2['price'] . "</td>";
                    echo "</tr>";
                    echo "<input id='display' type='radio' name='check2' value='$json2' checked/>";
                } else {
                    echo "";
                }
                ?>
        </table>
        <div style="margin-top: 5%"></div>
        <input class="button" type="submit" value="submit" />
    </form>
</div>
</center>
</body>
</html>