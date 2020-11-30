<?php
$json = '{}';
if (isset($_GET['check1'])) {
    $json = $_GET['check1'];
}
$arr = json_decode($json, true);
$json2 = '{}';
if (isset($_GET['check2'])) {
    $json2 = $_GET['check2'];
}
$arr2 = json_decode($json2, true);



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
    <div class="logo" style="margin-left: 40%">Flight&nbspInformation</div>
</div>
<div style="margin-top: 5%"></div>

<center>
    <div class="auto" ><h2>Leave</h2></div>
    <form method="post" name="finalinfo" action="Booking.php" id="final">
        <table width="500dp">
            <tr>
                <?php
                if (isset($_GET['check1'])) {
                    echo " <th>Date: </th>";
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
                ?>
        </table>
        <?php
        if (isset($_GET['check2'])) {
            echo "
    <div class='auto'><h2>Return</h2></div>
    <table width='500dp' >
        <tr>";
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

        <div class="auto" style="margin-top: 10%"><h2>Please Enter your personal information</h2></div>
        <br>
        <br>
        <br>
        <table width="500dp">
            <tr>
                <td>Name:</td>
                <td>
                    <input type="text" name="name" id="name"/>
                    <span id="nameSpan"></span>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input type="email" name="email" id="email"/>
                    <span id="emailSpan"></span>
                </td>
            </tr>
            <tr>
                <td>Tel:</td>
                <td>
                    <input type="text" name="tel" id="tel"/>
                    <span id="telSpan"></span>
                </td>
            </tr>
        </table>
    </form>
    <div style="margin-top: 5%"></div>
    <input style="background-color: #488fce;color: white;height: 30px;width: 80px" type="button" value="Cancel" id="cancel"/>
    <input style="margin-left: 60%;background-color: #488fce;color: white;height: 30px;width: 80px" type="button" value="Next"
           id="submit"/>
</center>>
</body>
</html>
