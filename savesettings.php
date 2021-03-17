if(isset($_POST["fanfield"]))
	{
		// Handle CSRF
    check_csrf(isset($_POST["token"]) ? $_POST["token"] : "");
    switch ($_POST["fanfield"]) {

    case "fanspeed":
            $commandlist = 'argonone-cli ';
            if(isset($_POST["temp0"]) && is_numeric($_POST["temp0"]))
            {
                $commandlist .= ' --temp0='.$_POST["temp0"];
            }
            else
            {
                $temp0 = '';
            }
            if(isset($_POST["fan0"]) && is_numeric($_POST["fan0"]))
            {
                $commandlist .= ' --fan0='.$_POST["fan0"];
            }
            else
            {
                $fan0 = '';
            }
            if(isset($_POST["temp1"]) && is_numeric($_POST["temp1"]))
            {
                $commandlist .= ' --temp1='.$_POST["temp1"];
            }
            else
            {
                $temp1 = '';
            }
            if(isset($_POST["fan1"]) && is_numeric($_POST["fan1"]))
            {
                $commandlist .= ' --fan1='.$_POST["fan1"];
            }
            else
            {
                $fan1 = '';
            }
            if(isset($_POST["temp2"]) && is_numeric($_POST["temp2"]))
            {
                $commandlist .= ' --temp2='.$_POST["temp2"];
            }
            else
            {
                $temp2 = '';
            }
            if(isset($_POST["fan2"]) && is_numeric($_POST["fan2"]))
            {
                $commandlist .= ' --fan2='.$_POST["fan2"];
            }
            else
            {
                $fan2 = '';
            }
            if(isset($_POST["hysteresis"]) && is_numeric($_POST["hysteresis"]))
            {
                $commandlist .= ' --hysteresis='.$_POST["hysteresis"];
            }
            else
            {
                $hysteresis = '';
            }
            if(isset($_POST["cooldowntemp"]) && is_numeric($_POST["cooldowntemp"]) && isset($_POST["cooldownfan"]) && is_numeric($_POST["cooldownfan"]))
            {
                exec('argonone-cli -cooldown=' .$_POST["cooldowntemp"] .' --fan=' .$_POST["cooldownfan"] .' -r');
            }
            else
            {
            }
            if(isset($_POST["cooldowntemp"]) && is_numeric($_POST["cooldowntemp"]))
            {
                exec('argonone-cli --cooldown=' .$_POST["cooldowntemp"] .' -r');
            }
            else
            {
            }
            if(isset($_POST["manual"]) && is_numeric($_POST["manual"]))
            {
                exec('argonone-cli --manual=' .$_POST["manual"] .' -r');
            }
            else
            {
            }
            exec("$commandlist -r");
            $success .= "The Argononed settings have been updated";
            break;
    case "fanauto":
            exec('argonone-cli -a');
            $success = "Argononed is now in Auto Mode";
            break;
    case "fanoff":
            exec('argonone-cli -off');
            $success = "Argononed fan is now off";
            break;
    case "clearfandb":
            $rootdir = $_SERVER['DOCUMENT_ROOT'];
            shell_exec('cp /var/www/html/admin/scripts/pi-hole/fanspeed/fanspeed.db /etc/pihole/fanspeedtest.db');
            $success = "Fanspeed database is cleared";
            break;

}
}