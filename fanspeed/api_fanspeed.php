<?php


if(!isset($api))
{
    die("Direct call to api_PHP.php is not allowed!");
}

//$data = array();

$dbFanSpeed ="/etc/pihole/fanspeed.db";

$setupVars = parse_ini_file("/etc/pihole/setupVars.conf");


if (isset($_GET['getFanSpeed24hrs'])  && $auth)
{
    $data = array_merge($data,  getFanSpeedData24hrs($dbFanSpeed));
}

if (isset($_GET['getLastFanSpeedResult'])  && $auth)
{
    $data = array_merge($data,  getLastFanSpeedResult($dbFanSpeed));
}

if (isset($_GET['getAllFanSpeedData'])  && $auth)
{
    $data = array_merge($data,  getAllFanSpeedData($dbFanSpeed));
}


function getAllFanSpeedData($dbFanSpeed)
{
    $data = getFanSpeedData($dbFanSpeed,-1);
    if(isset($data['errr']))
        return [];
    $newarr = array();
    foreach ($data as  $array) {
        array_push($newarr,array_values($array));
    }
    return  array('data' => $newarr );
}

function getLastFanSpeedResult($dbFanSpeed){
    if(!file_exists($dbFanSpeed)){
        // create db of not exists
        exec('sudo pihole -a -sn');
        return array();
    }

    $db = new SQLite3($dbFanSpeed);
    if(!$db) {
        return array("error"=>"Unable to open DB");
    } else {
        // return array("status"=>"success");
    }

    $curdate = date('Y-m-d H:i:s');
    $date = new DateTime();
    $date->modify('-'.$durationdays.' day');
    $start_date =$date->format('Y-m-d H:i:s');

    $sql ="SELECT * from fanspeed order by id DESC limit 1";

    $dbResults = $db->query($sql);

    $dataFromFanSpeedDB= array();


    if(!empty($dbResults)){
        while($row = $dbResults->fetchArray(SQLITE3_ASSOC) ) {
            array_push($dataFromFanSpeedDB, $row);
        }
        return($dataFromFanSpeedDB);
    }
    else{
        return array("error"=>"No Results");
    }
    $db->close();
}

function getFanSpeedData($dbFanSpeed,$durationdays="1")
{
    if(!file_exists($dbFanSpeed)){
        // create db of not exists
        exec('sudo pihole -a -sn');
        return array();
    }
    $db = new SQLite3($dbFanSpeed);
    if(!$db) {
        return array("error"=>"Unable to open DB");
    } else {
        // return array("status"=>"success");
    }

    $curdate = date('Y-m-d H:i:s');
    $date = new DateTime();
    $date->modify('-'.$durationdays.' day');
    $start_date =$date->format('Y-m-d H:i:s');

    if($durationdays == -1)
    {
        $sql ="SELECT * from fanspeed order by id asc";
    }
    else{
        $sql ="SELECT * from fanspeed where start_time between '${start_date}' and  '${curdate}'  order by id asc;";
    }

    $dbResults = $db->query($sql);

    $dataFromFanSpeedDB= array();


    if(!empty($dbResults)){
        while($row = $dbResults->fetchArray(SQLITE3_ASSOC) ) {
            array_push($dataFromFanSpeedDB, $row);
        }
        return($dataFromFanSpeedDB);
    }
    else{
        return array("error"=>"No Results");
    }
    $db->close();
}


function getFanSpeedData24hrs($dbFanSpeed){
    global $log, $setupVars;
    if(isset($setupVars["FANSPEED_CHART_DAYS"]))
    {
        $dataFromFanSpeedDB = getFanSpeedData($dbFanSpeed,$setupVars["FANSPEED_CHART_DAYS"]);
    }
    else{
        $dataFromFanSpeedDB = getFanSpeedData($dbFanSpeed);
    }


    return $dataFromFanSpeedDB;
}
