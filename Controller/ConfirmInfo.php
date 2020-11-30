<?php
include_once "../Model/Sql.php";
$link = new Connection();
$cityFrom='';
$cityTo='';
if (isset($_GET['check1']) || isset($_GET['check2'])) {
    if (isset($_GET['check1'])) {
        $json = $_GET['check1'];
        $arr = json_decode($json, true);
        $from = $arr['dep'];
        $To = $arr['arr'];
        $city = new convertCity($link,$from);
        for ($i=0;$i<$city->getNum();$i++){
            $cityFrom = $city->getCity($i);
        }
        $city2 = new convertCity($link,$To);
        for ($i=0;$i<$city2->getNum();$i++){
            $cityTo = $city2->getCity($i);
        }

    }
    if (isset($_GET['check2'])) {
        $json2 = $_GET['check2'];
        $arr2 = json_decode($json2, true);
        $from1 = $arr2['dep'];
        $To1 = $arr2['arr'];
        $city1 = new convertCity($link,$from1);
        for ($i=0;$i<$city1->getNum();$i++){
            $cityFrom1 = $city1->getCity($i);
        }
        $city3 = new convertCity($link,$To1);
        for ($i=0;$i<$city3->getNum();$i++){
            $cityTo1 = $city3->getCity($i);
        }
    }
} else {
    echo "<h2 style='text-align: center;margin-top: 20%'>Please select one flight before going to the next step</h2>";
    echo "<a href='../View/Index.html'><center><button >Back</button></center></a>";
    return;
}
$link->SqlClose();
?>
<link rel="stylesheet" href="../View/style.css">
<div id="header">
    <div class="logo">&nbspFictitious&nbspAirline</div>
    <div style="margin-left: 45%;font-size:20px;font-weight:bold;color: white">
        Online&nbspBooking&nbspInformation
    </div>
</div>
<div style="margin-top: 55px"></div>

<div style="margin-top: 20px" class="auto">
    <h3>Here is your Booking Information</h3>
</div>
<center>

    <br><br>
    <?php
    if (isset($_GET['check1'])) {
        if ($arr != null) {
            echo "
    <div class='auto'><h2>Leave Date: ".$arr['date']."(".$arr['time'].")"."</h2></div>
    <h4> From "."(".$cityFrom.")"." To "."(".$cityTo.")"."</h4>
    <br><br><br><br>
    <form action='FinalInfo.php' >
    <table>
    <tr>
        <tr>
            <th>Model</th>
            <th>Dep</th>
            <th>Arr</th></tr>";
            echo "<tr ><td height = '100px'>" . $arr['model'] . "</td >";
            echo "<td height = '100px'>" . $arr['deptime'] . "</td >";
            echo "<td height = '100px'>" . $arr['arrtime'] . "</td >";
            echo "<td height = '100px'> <input type='radio' value='$json' id='display' name='check1' checked></td ></tr></table>";
        }
    } else {
        echo "<h2>You are not choose any flights on leave</h2><br><br><br>";
    }
    ?>
    <br><br>
    <?php
    if (isset($_GET['check2'])) {
        if ($arr2 != null) {
            echo "
    <div class='auto'><h2>Return Date: ".$arr2['rdate']."(".$arr2['time'].")"."</h2></div>
     <h4> From "."(".$cityFrom1.")"." To "."(".$cityTo1.")"."</h4>
    <br><br><br><br>
    <form action='FinalInfo.php' method='post'>
    <table>
    <tr>
        <tr>
            <th>Model</th>
            <th>Dep</th>
            <th>Arr</th></tr>";
            echo "<tr ><td height = '100px'>" . $arr2['model'] . "</td >";
            echo "<td height = '100px'>" . $arr2['deptime'] . "</td >";
            echo "<td height = '100px'>" . $arr2['arrtime'] . "</td >";
            echo "<td height = '100px'> <input type='radio' value='$json2' id='display' name='check2' checked></td ></tr></table>";

        }
    } else {
        echo "<h2>You are not choose any flights on here</h2><br><br><br>";
    }
    ?>
    <tr>
        <td>
            <a href="../View/Index.html">
                <input style="background-color: #488fce;color: white;height: 30px;width: 80px" type="button" value="Restart"/>
            </a>
        </td>
        <td>
            <input style="margin-left: 60%;color: white;background-color: #488fce;height: 30px;width: 80px" type="submit"
                   value="Confirm"/>
        </td>
    </tr>
    </table>
    </form>
    <div class="auto" style="margin-bottom: 10%"></div>
</center>

