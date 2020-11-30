<?php
include_once "../Model/Sql.php";
$link = new Connection();
$time = $_GET['leaveTime'];
if (isset($_GET['returnTime'])) {
    $time1 = $_GET['returnTime'];
}
$dep = $_GET['dep'];
$arrDep = $_GET['arr'];
$dep1 = $_GET['arr'];
$arr1 = $_GET['dep'];
$query= null;
try {
    $dt1 = new DateTime($time);
    if (isset($_GET['returnTime'])) {
        $dt2 = new DateTime($time1);
    }
} catch (Exception $e) {
}
$dt = clone $dt1;
if (isset($_GET['returnTime'])) {
    $rdt = clone $dt2;
}
$daysreq = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
if($time!="") {
    $dow = $dt->format('D');
    if (in_array($dow, $daysreq)) {
        $day = $dow;
        $query = new flightQuery($link, $day, $dep, $arrDep);
    }
}
if (isset($_GET['returnTime'])) {
    if ($time1 != "") {
        $dow1 = $rdt->format('D');
        if (in_array($dow1, $daysreq)) {
            $day = $dow1;
            $query1 = new flightQuery($link, $day, $arrDep, $dep);
        }
    }
}
$link->SqlClose();
?>
<html>
<head>
    <title>LIST</title>
    <link rel="stylesheet" type="text/css" href="../View/style.css" />
    <script src="../View/jQuery/jQuery3.5.1.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#cancel").click(function () {
                window.location.href='../View/Index.html';
            })
            $("#submit").click(function (){
                $("#form2").submit()
            })
        })
    </script>
</head>
    <body>
   <div id="header">
        <div class="logo">&nbspFictitious&nbspAirline</div>
        <div style="margin-left: 45%;font-size:20px;font-weight:bold;color: white" >
            Online&nbspBooking&nbspSystem
        </div>
    </div>
    <div style="margin-top: 55px"></div>
    <center>
        <br><br><div class="auto"><h2>Leave</h2></div><br><br><br><br>
        <form id="form2" action="ConfirmInfo.php" method="get">
            <div class='nav'>
            <table>
                <?php
                if($time!=""&&$query->getNum()!=null) {
                    for ($n = 0; $n < $query->getNum(); ++$n) {
                        if ($query->getSeat($n) > 0 ) {
                            echo "
                                <tr style='margin-top: 10px'>
                                <th>ID</th>
                                <th>Model</th>
                                <th>Dep</th>
                                <th>Arr</th>
                                <th>Price&nbsp&nbsp&nbsp&nbsp</th>
                                <th>Seats</th>
                                <th>Booking</th></tr>";
                            echo "<tr><td>" . $query->getCraftid($n) . '</td>';
                            echo "<td >" . $query->getModel($n) . "&nbsp&nbsp" . '</td> ';
                            echo "<td>" . $query->getDeptime($n) . "&nbsp&nbsp" . '</td>';
                            echo "<td>" . $query->getArrtime($n) . "&nbsp&nbsp" . '</td>';
                            echo "<td>" . "$" . $query->getPrice($n) . "&nbsp&nbsp" . '</td>';
                            echo "<td>" . $query->getSeat($n) . '</td>';
                            $arr = array('id' => $query->getCraftid($n), 'model' => $query->getModel($n), 'deptime' => $query->getDeptime($n), 'arrtime' => $query->getArrtime($n), 'price' => $query->getPrice($n), 'seat' => $query->getSeat($n)
                            , 'date' => $time, 'time' => $dow, 'dep' => $dep, 'arr' => $arrDep);
                            $json = json_encode($arr);
                            echo "<td height='100px'> <input type='radio' name='check1' value='$json' id='check1'/>Choose" . "&nbsp&nbsp" . '</td></tr>';
                            if ($n < $query->getNum()-1) {
                                echo "<tr><td colspan='7' style='border-bottom: 1px solid black; font-size: 700px'></td></tr>";
                            }
                        }else{
                            echo "<td height='100px' colspan='7' style='text-align: center;font-weight: 700'>Fully booked</td></tr>";
                            if ($n < $query->getNum()-1) {
                                echo "<tr><td colspan='7' style='border-bottom: 1px solid black; font-size: 700px'></td></tr>";
                            }
                        }
                    }
                }else{
                    echo "<h3>There are no flights on this date</h3>";
                }
                ?>
            </table>
            </div>
            <?php
            if (isset($_GET['returnTime'])) {

                echo "<br><br><br><br><div class='auto'><h2>Return</h2></div><br><br><br><br>";
                echo "<div class='nav'>";
                echo "<table>";
                if ($time1 != "" && $query1->getNum() != null) {
                    for ($n = 0; $n < $query1->getNum(); ++$n) {
                        if ($query1->getSeat($n) > 0) {
                            echo "
                            <tr >
                            <th>ID</th>
                            <th>Model</th>
                            <th>Dep</th>
                            <th>Arr</th>
                            <th>Price&nbsp&nbsp&nbsp&nbsp</th>
                            <th>Seats</th>
                            <th>Booking</th></tr>";
                            echo "<tr><td>" . $query1->getCraftid($n) . '</td>';
                            echo "<td>" . $query1->getModel($n) . "&nbsp&nbsp" . '</td> ';
                            echo "<td>" . $query1->getDeptime($n) . "&nbsp&nbsp" . '</td>';
                            echo "<td>" . $query1->getArrtime($n) . "&nbsp&nbsp" . '</td>';
                            echo "<td>" . "$" . $query1->getPrice($n) . "&nbsp&nbsp" . '</td>';
                            echo "<td>" . $query1->getSeat($n) . '</td>';
                            $arr = array('id' => $query1->getCraftid($n), 'model' => $query1->getModel($n), 'deptime' => $query1->getDeptime($n), 'arrtime' => $query1->getArrtime($n), 'price' => $query1->getPrice($n), 'seat' => $query1->getSeat($n)
                            , 'rdate' => $time1, 'time' => $dow1, 'dep' => $dep1, 'arr' => $arr1);
                            $json = json_encode($arr);
                            echo "<td height='100px'> <input type='radio' name='check2' value='$json' id='check2'/>Choose" . "&nbsp&nbsp" . '</td></tr>';
                            if ($n < $query1->getNum()-1) {
                                echo "<tr><td colspan='7' style='border-bottom: 1px solid black'></td></tr>";
                            }
                        } else {
                            echo "<td height='100px' colspan='7' style='text-align: center ;font-weight: 700'>Fully booked</td></tr>";
                            if ($n < $query1->getNum()-1) {
                                echo "<tr><td colspan='7' style='border-bottom: 1px solid black;'></td></tr>";
                            }
                        }
                    }
                } else {
                    echo "<h3>There are no flights on this date</h3>";
                }
                echo " </table>
            </div>";
            }
            ?>

        </form>
        <input style="background-color: #488fce;color: white;height: 30px;width: 80px" type="button" value="Back" id="cancel"/>
        <input style="margin-left: 60%;background-color: #488fce;color: white;height: 30px;width: 80px" type="button" value="Next" id="submit"/>
        <div class="auto" style="margin-bottom: 10%"></div>
    </center>
    </body>
</html>




