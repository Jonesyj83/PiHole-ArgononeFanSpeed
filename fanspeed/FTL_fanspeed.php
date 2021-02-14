<?php
    if (isset($_GET['getAllFanSpeedData'])  && $auth)
    {
        $data = array_merge($data,  getAllFanSpeedData($dbFanSpeed));
    }
?>
