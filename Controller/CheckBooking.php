<?php
include_once "../Model/Sql.php";
$link = new Connection();

$name = $_GET['name'];
$reference = $_GET['reference'];
$BookingInfo = new BookingInfo($link, $reference, $name);
for ($n = 0; $n < $BookingInfo->getNum(); ++$n) {
    $from = $BookingInfo->getDep($n);
    $to = $BookingInfo->getArr($n);
}
if ($BookingInfo->getNum() != null) {
    $city = new convertCity($link, $from);
    for ($i = 0; $i < $city->getNum(); $i++) {
        $cityFrom = $city->getCity($i);
    }
    $city2 = new convertCity($link, $to);
    for ($i = 0; $i < $city2->getNum(); $i++) {
        $cityTo = $city2->getCity($i);
    }
    session_start();
    $code = mt_rand(0, 1000000);
    $_SESSION['delete'] = $code;
}
$link->SqlClose();
?>
<html>
<head>
    <title>Detail</title>
    <link rel="stylesheet" href="../View/style.css">
    <script src="../View/jQuery/jQuery3.5.1.js"></script>
    <script src="../View/js/CheckBooking.js"></script>
</head>
<script type="text/javascript">
</script>
<body>
<div id="header">
    <div class="logo">&nbspFictitious&nbspAirline</div>
    <div class="logo" style="margin-left: 40%">Flight&nbspInformation</div>
</div>
<div style="margin-top: 70px"></div>
<div class="auto" style="text-align: center">
    <h2>Check Result</h2>
    <br>
    <?php
    if ($BookingInfo->getNum() != null) {
        echo "<h3>" . $from . ": <h4>" . $cityFrom . "</h4></h3><br><br><h3>" . "$to" . " :<h4>" . "$cityTo" . "</h4></h3>";
    }
    ?>
</div>
<center>
    <div style="margin-top: 5%"></div>
    <form method="post" name="manageBook" action="CancelBooking.php" id="manageBook">
        <table width="500dp">
            <tr>
                <?php
                if ($BookingInfo->getNum() != null) {
                    echo "<table>
                <tr>
                <th>DepTime</th>
                <td>&nbsp&nbsp</td>
                <th>ArrTime</th>
                <td>&nbsp&nbsp</td>
                <th>From</th>
                <td>&nbsp&nbsp</td>
                <th>To</th>
                <td>&nbsp&nbsp</td>
                <th>Time</th>
                <td>&nbsp&nbsp</td>
                <th>Date</th>
                <td>&nbsp&nbsp</td>
                <th>Name</th>
                <td>&nbsp&nbsp</td>
                <th>Email</th>
                <td>&nbsp&nbsp</td>
                <th>Tel</th></tr>";
                    for ($n = 0; $n < $BookingInfo->getNum(); ++$n) {
                        echo "<tr>";
                        echo "<td>" . $BookingInfo->getDeptime($n) . "&nbsp&nbsp" . '</td>';
                        echo "<td>&nbsp&nbsp</td>";
                        echo "<td>" . $BookingInfo->getArrtime($n) . "&nbsp&nbsp" . '</td>';
                        echo "<td>&nbsp&nbsp</td>";
                        echo "<td>" . $BookingInfo->getDep($n) . "&nbsp&nbsp" . '</td>';
                        echo "<td>&nbsp&nbsp</td>";
                        echo "<td>" . $BookingInfo->getArr($n) . "&nbsp&nbsp" . '</td>';
                        echo "<td>&nbsp&nbsp</td>";
                        echo "<td>" . $BookingInfo->getDay($n) . "</td>";
                        echo "<td>&nbsp&nbsp</td>";
                        echo "<td>" . $BookingInfo->getDate($n) . "</td>";
                        echo "<td>&nbsp&nbsp</td>";
                        echo "<td>" . $BookingInfo->getName($n) . "</td>";
                        echo "<td>&nbsp&nbsp</td>";
                        echo "<td>" . $BookingInfo->getEmail($n) . "</td>";
                        echo "<td>&nbsp&nbsp</td>";
                        echo "<td>" . $BookingInfo->getTel($n) . "</td>";
                        echo "<td>&nbsp&nbsp</td>";
                        $arr = array('deptime' => $BookingInfo->getDeptime($n), 'arrtime' => $BookingInfo->getArrtime($n), 'reference' => $BookingInfo->getReference($n),
                            'day' => $BookingInfo->getDay($n), 'dep' => $BookingInfo->getDep($n), 'arr' => $BookingInfo->getArr($n), 'id' => $BookingInfo->getCraftid($n)
                            ,'code'=>$code);
                        $json = json_encode($arr);
                        echo "<td style='height: 100px'> <input type='radio' name='check1' value='$json' id='check'/>Choose</td>";
                        if ($n < $BookingInfo->getNum() - 1) {
                            echo "<tr><th>AND</th></tr>";
                        }
                    }
                    echo "</table>";

                    echo "</tr>";
                    echo " </table>";
                    echo "</form>";

                } else {
                    echo "<h3>You have not booked any flight tickets or entered a wrong information</h3>";
                    echo "<br><h3></h3>";
                    echo "<h3>Start Booking ? or Try again ?</h3>";
                    echo "<input style='background-color: #488fce;color: white;height: 30px;width: 80px' type='button' value='Booking' id='back'/>";
                    echo "<input style='margin-left: 20%; margin-top: 5%;background-color: #488fce;color: white;height: 30px;width: 80px' type='button' value='Try Again'
           id='bookagain'/>";
                }
                ?>

                <?php
                if ($BookingInfo->getNum() != null) {
                    echo "<div style='margin-top: 5%'></div>";
                    echo "<input style='background-color: #488fce;color: white;height: 30px;width: 80px' type='button' value='Back' id='back'/>";
                    echo "<input style='margin-left: 60%;background-color: #488fce;color: white;height: 30px;width: 80px' type='button' value='Cancel'
           id='delete'/>";
                }
                ?>

</center>
</body>
</html>
