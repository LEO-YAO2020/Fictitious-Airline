<?php
include_once "../Model/Sql.php";
session_start();
$link = new Connection();
$json = '{}';
if (isset($_POST['check1'])) {
    $json = $_POST['check1'];
}
$arr = json_decode($json, true);
if (isset($_SESSION['delete'])) {
    if ($arr['code'] == $_SESSION['delete']) {
        $cancel = new CancelBooking($link, $arr['deptime'], $arr['arrtime']);
        if ($cancel == true) {
            $avaSeat = new AvailableSeats($link, $arr['id'], $arr['dep'], $arr['arr'], $arr['day'], $arr['deptime']);
            for ($n = 0; $n < $avaSeat->getNum(); ++$n) {
                $seat = (int)$avaSeat->getData($n);
            }
            $newSeat = $seat + 1;
            $addSeat = new ChangeSeats($link, $arr['id'], $newSeat, $arr['dep'], $arr['arr'], $arr['day'], $arr['deptime']);
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
    <script type="text/javascript">
        $(function () {
            $("#back").click(function () {
                window.location.href='../View/Index.html';
            })
        })
    </script>
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
    <div class="logo" style="margin-left: 40%">Booking&nbspInformation</div>
</div>
</div>
<div style="margin-top: 70px"></div>
</div>
<center>
    <?php
    if (isset($_SESSION['delete'])) {
        if ($arr['code'] == $_SESSION['delete']) {
            echo "<h2>Result</h2>";
            echo "<div style='margin-top: 15%'></div>";
            if ($cancel) {
                echo "<h3>You have successfully cancelled the flight reservation</h3><br>";
                echo "<h3>If you need to book a flight again, please click the button below</h3><br>";
                echo "<input style='background-color: #488fce;color: white;height: 30px;width: 80px' type='button' value='Booking' id='back'/>";
            }else {
                echo "<h3>Please select one flight which you want to cancel</h3><br>";
                echo "<a href='../View/Bookinginfo.html'><button class='button'>Back</button></a>";
            }

            unset($_SESSION["delete"]);
        }
    }else{
        echo "<div style='margin-top: 15%'></div>";
        echo "<h1>You have successfully submitted</h1>";
        echo "<h1>Please do not refresh this page or submit the form repeatedly</h1>";
        echo " <div style='margin-top: 15%'></div>";
        echo "<button class='button' id='back'>Return</button>";
    }
    ?>
</center>
</body>
</html>