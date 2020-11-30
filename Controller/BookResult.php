<?php
include_once "../Model/Sql.php";
session_start();
$link = new Connection();
$json = '{}';
if (isset($_POST['check1'])) {
    $json = $_POST['check1'];
    $arr = json_decode($json, true);
}

$json2 = '{}';
if (isset($_POST['check2'])) {
    $json2 = $_POST['check2'];
    $arr2 = json_decode($json2, true);
}


$json3 = '{}';
if (isset($_POST['check3'])) {
    $json3 = $_POST['check3'];
}
$arr3 = json_decode($json3, true);
if (isset($_SESSION['code'])) {
    if ($arr3['code'] == $_SESSION['code']) {
        $BookingToSql = false;
        if (isset($arr)) {
            $BookingToSql = new BookingToSql($link, $arr3['reference'], $arr['id'], $arr['dep'], $arr['time'], $arr['arr'], $arr['arrtime'], $arr['deptime'], $arr['date'], $arr3['name'], $arr3['email'], $arr3['tel']);
            if ($BookingToSql == true) {
                $avaleSeat = new AvailableSeats($link, $arr['id'], $arr['dep'], $arr['arr'], $arr['time'], $arr['deptime']);
                for ($n = 0; $n < $avaleSeat->getNum(); ++$n) {
                    $seat = (int)$avaleSeat->getData($n);

                }
                $newSeats = $seat - 1;

                $changeSeat = new ChangeSeats($link, $arr['id'], $newSeats, $arr['dep'], $arr['arr'], $arr['time'], $arr['deptime']);

            }
        }
        $BookingToSql1 = false;
        if (isset($arr2)) {
            $BookingToSql1 = new BookingToSql($link, $arr3['reference'], $arr2['id'], $arr2['dep'], $arr2['time'], $arr2['arr'], $arr2['arrtime'], $arr2['deptime'], $arr2['rdate'], $arr3['name'], $arr3['email'], $arr3['tel']);
            if ($BookingToSql1 == true) {
                $avaleSeat = new AvailableSeats($link, $arr2['id'], $arr2['dep'], $arr2['arr'], $arr2['time'], $arr2['deptime']);
                for ($n = 0; $n < $avaleSeat->getNum(); ++$n) {
                    $seat1 = (int)$avaleSeat->getData($n);
                }
                $newSeats1 = $seat1 - 1;

                $changeSeat1 = new ChangeSeats($link, $arr2['id'], $newSeats1, $arr2['dep'], $arr2['arr'], $arr2['time'], $arr2['deptime']);

            }
        }
    }
}
$link->SqlClose();
?>
<html>
<head>
    <title>Detail</title>
    <link rel="stylesheet" href="../View/style.css">
    <script src="../View/jQuery/jQuery3.5.1.js"></script>
</head>
<script type="text/javascript">
    $(function () {
        $('#back').click(function () {
            window.location.href='../View/Index.html';
        })
    })
</script>
<body>
<div id="header">
    <div class="logo">&nbspFictitious&nbspAirline</div>
        <div class="logo" style="margin-left: 40%">Booking&nbspResult</div>
</div>
<center>
    <div style="margin-top: 25%"></div>
    <div>

        <form method="post" name="book" action="">
                <?php
                if (isset($_SESSION['code'])) {
                    if ($arr3['code'] == $_SESSION['code']) {
                        echo "<div class='auto' ><h2>Submit Result</h2></div>";
                        if ($BookingToSql == true || $BookingToSql1 == true) {
                            echo "<div>";
                            echo "<h2>Congratulations, you have successfully booked your flight. If you need to book again, please press the return button.</h2>";
                            echo "</div>";
                        }
                        unset($_SESSION["code"]);
                    }
                }else {
                    echo "<h1>You have successfully submitted</h1>";
                    echo "<h1>Please do not refresh this page or submit the form repeatedly</h1>";
                }
                ?>
        </form>
        <div style="margin-top: 15%"></div>
        <button class="button" id="back">Return</button>
    </div>
</center>
</body>
</html>
