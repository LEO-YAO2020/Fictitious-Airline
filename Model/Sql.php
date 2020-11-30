<?php

// Connect with database
class Connection extends mysqli{
    private $link;
    public $hostname;
    public $username;
    public $password;
    public $mydatabase;
    public $portn;

    # Constructor makes the connection
    public function __construct() {
        $this->hostname = "localhost";
        $this->username = "root";
        $this->password = "YaoZeLin476200";
        $this->mydatabase = "airline";
        $this->portn = "3306";
        $this->link = @mysqli_connect($this->hostname, $this->username, $this->password,
            $this->mydatabase, $this->portn);
        if(mysqli_connect_errno()){
            exit(mysqli_connect_error());
        }
    }

    public function doquery($sql) {
        $result = $this->link->query($sql);
        $table = Array();
        $n = 0;
        while ($row = $result->fetch_assoc()) {
            $table[$n] = $row;
            ++$n;
        }
        return $table;
    }
    function execute($query){
        $result=mysqli_query($this->link,$query);
        if(mysqli_errno($this->link)){
            exit(mysqli_error($this->link));
        }
        return $result;
    }

    public function bind_param(){

    }
    public function SqlClose(){
        $this->link->close();
    }
}

//Search for flights by departure date and destination
class flightQuery{
    private $num;
    private $table="";

    public function __construct($link,$time,$dep,$arrive){
        $query = "select a.model,t.craftid,t.deptime,t.arrtime, t.price, t.seats from timetable t  join aircraft a on 
t.craftID = a.craftID where t.origIn = '$dep' and t.dest = '$arrive' and t.depDay = '$time' ";
        $result = $link->doquery($query);
        $this ->table = $result;
        $this->num = count($this->table);
    }
    public function getNum()
    {
        return $this->num;
    }
    public function getModel($rowNo) {
        return $this->table[$rowNo]['model'];
    }
    public function getDeptime($rowNo) {
        return $this->table[$rowNo]['deptime'];
    }
    public function getArrtime($rowNo) {
        return $this->table[$rowNo]['arrtime'];
    }
    public function getPrice($rowNo) {
        return $this->table[$rowNo]['price'];
    }
    public function getSeat($rowNo) {
        return $this->table[$rowNo]['seats'];
    }
    public function getCraftid($rowNo) {
        return $this->table[$rowNo]['craftid'];
    }
}
// use for AJAX to get departure areas
class depQuery{
    private $table;

    public function __construct($link){
        $query = "SELECT DISTINCT t.dest, d.region FROM timetable t JOIN destinations d ON t.dest=d.`code`;";
        $result = $link->doquery($query);
        $this->table=$result;
    }
    public function getTable(){
        return $this->table;
    }
}
// use for AJAX to get arrive areas
class arrQuery{
    private $table;

    public function __construct($link,$depName){
        $query = "SELECT DISTINCT t.dest, d.region FROM timetable t JOIN destinations d ON t.dest=d.`code` WHERE t.origin='$depName'";
        $result = $link->doquery($query);
        $this->table=$result;
    }
    public function getTable(){
        return $this->table;
    }

}
// check how many seats are available on the flight
class AvailableSeats{
    private $data;
    private $num;
    public function __construct($link,$craftID,$orign,$dest,$depDay,$depTime)
    {

        $query = "SELECT seats FROM timetable WHERE craftID = '$craftID' and origin = '$orign' and dest = '$dest' and depDay = '$depDay' and depTime = '$depTime'";
        $result = $link->doquery($query);
        $this->data = $result;
        $this->num = count($this->data);
    }
    public function getNum(){
        return $this->num;
    }
    public function getData($rowNo){
         return $this->data[$rowNo]['seats'];
    }
}

// Determine whether the user has successfully booked or cancel booking, and change the corresponding number of seats

class ChangeSeats{
    private $result;
    public function __construct($link,$craftID,$data,$orign,$dest,$depDay,$depTime)
    {

        $query = "UPDATE timetable  SET seats = {$data} WHERE craftID = '$craftID' and origin = '$orign' and dest = '$dest' and depDay = '$depDay' and depTime = '$depTime'";
        $this->result = $link->execute($query);

    }

}

// The return bool value is true to indicate whether the user is booked successfully
class BookingToSql{
    private $result;
    public function __construct($link,$reference,$craftid,$dep,$depday,$arr,$arrtime,$deptime,$date,$name,$email,$tel)
    {
        $query = "INSERT INTO userinfomation(Reference,craftid,dep,depday,arr,arrtime,deptime,date,name,email,tel) VALUES ('$reference','$craftid','$dep','$depday','$arr','$arrtime','$deptime','$date','$name','$email','$tel')";
        $result = $link->execute($query);
        $this->result = $result;

    }
    public function getResult(){
        return $this->result;
    }
}
//If the customer cancels the reservation, return true to indicate success
class CancelBooking{
    private $result;
    public function __construct($link,$dep,$arr)
    {
        $query = "DELETE FROM userinfomation WHERE arrTime = '$arr' and depTime = '$dep'";
        $result = $link->execute($query);
        $this->result = $result;

    }
    public function getResult(){
        return $this->result;
    }
}

// return the user booking information, when user input their personal information
class BookingInfo{
    private $num;
    private $table;


    public function __construct($link,$reference,$name){
        $query = "SELECT Reference,craftid,dep,arr,depday,deptime,arrtime,date,name,email,tel FROM userinfomation WHERE Reference = '$reference' AND `name` = '$name' ";
        $result = $link->doquery($query);
        $this ->table = $result;
        $this->num = count($this->table);
    }
    public function getNum()
    {
        return $this->num;
    }

    public function getDeptime($rowNo) {
        return $this->table[$rowNo]['deptime'];
    }
    public function getArrtime($rowNo) {
        return $this->table[$rowNo]['arrtime'];
    }
    public function getDep($rowNo){
        return $this->table[$rowNo]['dep'];
    }
    public function getArr($rowNo){
        return $this->table[$rowNo]['arr'];
    }
    public function getDay($rowNo){
        return $this->table[$rowNo]['depday'];
    }
    public function getName($rowNo){
        return $this->table[$rowNo]['name'];
    }
    public function getEmail($rowNo){
        return $this->table[$rowNo]['email'];
    }
    public function getTel($rowNo){
        return $this->table[$rowNo]['tel'];
    }
    public function getReference($rowNo){
        return $this->table[$rowNo]['Reference'];
    }
    public function getDate($rowNo){
        return $this->table[$rowNo]['date'];
    }
    public function getCraftid($rowNo) {
        return $this->table[$rowNo]['craftid'];
    }
}
//change city code to city name
class convertCity{
    private $num;
    private $city;
    public function __construct($link,$code)
    {
        $query = "SELECT airport FROM destinations WHERE `code` = '$code'";
        $result = $link->doquery($query);
        $this->city = $result;
        $this->num = count($this->city);
    }
    public function getNum()
    {
        return $this->num;
    }

    public function getCity($rowNo) {
        return $this->city[$rowNo]['airport'];
    }
}
