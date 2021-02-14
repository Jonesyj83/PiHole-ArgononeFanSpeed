#!/bin/bash
echo ""
echo "PiHole Argonone Fan Hat Monitor installation"
echo ""
if ! [ -x "$(command -v argonone-cli)" ]; then
    echo 'Error: Argononed is not installed. Install from https://gitlab.com/DarkElvenAngel/argononed' >&2
    exit
fi
if ! [ -x "$(command -v pihole)" ]; then
    echo "Error: PiHole is not installed. Aborting!" >&2
    exit
fi
defaultpiholedir=/var/www/html/admin
read -p "Where is your Pi-Hole Admin folder? (Default = $defaultpiholedir)" piholedir
: ${piholedir:=$defaultpiholedir}

if [ ! -d "$piholedir" ]; then
    echo "Directory $piholedir does not exist!! Aborting!"
    exit
fi

echo Cloning Git dir
git clone -b v2.0.1 https://github.com/Jonesyj83/PiHole-ArgononeFanSpeed.git
sudo cp -r "PiHole-ArgononeFanSpeed/fanspeed" "$piholedir/scripts/pi-hole"
sudo cp "PiHole-ArgononeFanSpeed/fanspeed.php" "$piholedir"
sudo cp "PiHole-ArgononeFanSpeed/api_fanspeed.php" "$piholedir"
sudo cp "$piholedir/scripts/pi-hole/fanspeed/fanspeed.db" "/etc/pihole/"
echo 'FANSPEEDDAYS=1' | sudo tee -a /etc/pihole/setupVars.conf
echo 'FANSPEED_CHART_DAYS=1' | sudo tee -a /etc/pihole/setupVars.conf
sudo sed -i $'/topItems/{irequire("scripts/pi-hole/fanspeed/FTL_fanspeed.php");\n:a;n;ba}' "$piholedir/api_FTL.php"
sudo sed -i '/if($auth){ ?>/a <?php include "./scripts/pi-hole/fanspeed/index_fanspeed.php"; ?>' "$piholedir/index.php"
sudo sed -i '/index.js/a <script src="scripts/pi-hole/js/fanspeed.js"></script>\n' "$piholedir/index.php"
sudo sed -i '/$FTL = ($FTLpid !== 0 ? true : false);/a     include ("./scripts/pi-hole/fanspeed/header_fanspeed.php");' "$piholedir/scripts/pi-hole/php/header.php"
sudo sed -i $'/db_lists.php/{i\t<?php include "./scripts/pi-hole/fanspeed/header_fanspeed1.php"; ?>\n:a;n;ba}' "$piholedir/scripts/pi-hole/php/header.php"
sudo sed -i $'/piholeFTLConfig/{i$dbFanSpeed ="/etc/pihole/fanspeed.db";\n:a;n;ba}' "$piholedir/settings.php"
sudo sed -i '/Other API functions/a require("api_fanspeed.php");\n' "$piholedir/api.php"
sudo sed -i '/Other API functions/a include('scripts/pi-hole/fanspeed/data_fanspeed.php');\n' "$piholedir/api.php"
sudo crontab -l > crontab.tmp
echo "* *  *  *  * $piholedir/scripts/pi-hole/fanspeed/fanspeed.sh" >> crontab.tmp
sudo crontab crontab.tmp
sudo rm crontab.tmp
rm -rf ArgononeFanSpeed

echo ""
echo "Installation complete. Refresh your Pihole admin page to see changes."
echo ""

echo 0
