<?php

/*
+-------------------------------------------------------+
| Session Vars                                          |
+-------------------------------------------------------+
| bdMessageFlag     Purpose                             |
| 0                 Normal state                        |
| 1                 Display success message (bdMessageTxt)|
| 2                 Display error message (bdMessageTxt)  |
+-------------------------------------------------------+
*/

// Capture Session Vars
$bdMessageTxt = $_SESSION['bdMessageTxt'];
$bdMessageFlag = $_SESSION['bdMessageFlag'];

// Reset Session Vars
$_SESSION['bdMessageTxt'] = null;
$_SESSION['bdMessageFlag'] = 0;

/*
+-------------------------------------------------------+
| Static Vars                                           |
+-------------------------------------------------------+
*/
$monthCal2Num = [
    "Jan" => "01",
    "Feb" => "02",
    "Mar" => "03",
    "Apr" => "04",
    "May" => "05",
    "Jun" => "06",
    "Jul" => "07",
    "Aug" => "08",
    "Sep" => "09",
    "Oct" => "10",
    "Nov" => "11",
    "Dec" => "12"
];

$monthNum2Cal = [
    "01" => "Jan",
    "02" => "Feb",
    "03" => "Mar",
    "04" => "Apr",
    "05" => "May",
    "06" => "Jun",
    "07" => "Jul",
    "08" => "Aug",
    "09" => "Sep",
    "10" => "Oct",
    "11" => "Nov",
    "12" => "Dec",
];

/*
+-------------------------------------------------------+
| Functions                                             |
+-------------------------------------------------------+
*/
function bdGo2uri(string $uri): bool
{
    header("Location:?$uri");
    die;

    return true;
}

function bdLoadFn(array $fx): bool
{

    for ($i = 0; $i < count($fx); $i++) {

        $fn = $fx[$i];
        $f = BD . "Controller/" . $fn . "/" . $fn . ".php";

        if (file_exists($f)) {
            require_once $f;
        } else {
            die("Error [bdLoadFn]: Could not load " . $fn);
        }
    }

    return true;
}



function bdLoadView(array $fx): bool
{

    for ($i = 0; $i < count($fx); $i++) {

        $fn = $fx[$i];  // Path relative to View folder
        $f = BD . "View/" . $fn . ".php";

        if (file_exists($f)) {
            require_once $f;
        } else {
            die("Error [bdLoadFn]: Could not load " . $fn);
        }
    }

    return true;
}


function bdAddHourMin(int $hour, int $min): string
{

    // Convert min into hours and min
    $h = floor($min / 60);
    $m = $min - ($h * 60);

    // send hh:mm
    return ($hour + $h) . ":" . $m;
}

/**
 * @param date 
 * 
 * @return MySQL format date
 */
function bdDateCal2Mysql(string $date): string
{

    $monthX = array(
        "Jan" => "01",
        "Feb" => "02",
        "Mar" => "03",
        "Apr" => "04",
        "May" => "05",
        "Jun" => "06",
        "Jul" => "07",
        "Aug" => "08",
        "Sep" => "09",
        "Oct" => "10",
        "Nov" => "11",
        "Dec" => "12"
    );

    $a = explode("-", $date);

    $year   = "20" . $a[2];
    $month  = $monthX[$a[1]];
    $day    = $a[0];

    $mysqldt = $year . "-" . $month . "-" . $day;

    return $mysqldt;
}


/**
 * @param date Date in MySQL format yyyy-mm-dd
 * 
 * @return date Calendar format date
 */
function bdDateMysql2Cal(string $date): string
{

    $monthX = array(
        "01" => "Jan",
        "02" => "Feb",
        "03" => "Mar",
        "04" => "Apr",
        "05" => "May",
        "06" => "Jun",
        "07" => "Jul",
        "08" => "Aug",
        "09" => "Sep",
        "10" => "Oct",
        "11" => "Nov",
        "12" => "Dec"
    );

    $a = explode("-", $date);

    $year   = $a[0];
    $month  = $monthX[$a[1]];
    $day    = $a[2];

    // Parse Year into 2 digits
    $x = str_split($year);
    $year = $x[2] . $x[3];

    // Result
    $dt = $day . "-" . $month . "-" . $year;

    return $dt;
}

/**
 * @param date input Date in calendar format
 * 
 * @return date output Date in unix timestamp
 */
function bdDateCal2UnixTS(string $date): string
{

    $monthX = array(
        "Jan" => "01",
        "Feb" => "02",
        "Mar" => "03",
        "Apr" => "04",
        "May" => "05",
        "Jun" => "06",
        "Jul" => "07",
        "Aug" => "08",
        "Sep" => "09",
        "Oct" => "10",
        "Nov" => "11",
        "Dec" => "12"
    );

    $a = explode("-", $date);

    $year = "20" . $a[2];
    $month = $monthX[$a[1]];
    $day = $a[0];

    // To do - Validate if its a true date
    // Get Unix timestamp
    $unixTimestamp = mktime(0, 0, 0, $month, $day, $year);

    return $unixTimestamp;
}


function bdTimeH(int $h, int $m): int
{
    return $h + (floor($m / 60));
}
