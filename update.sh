#!/bin/bash
read -p "Are you sure you want to update PiHole Argonone Fan Hat Monitor and PiHole? " prompt
if [[ $prompt == "y" || $prompt == "Y" || $prompt == "yes" || $prompt == "Yes" ]]; then
    echo "############################################"
    echo "Updating PiHole Argonone Fan Hat Monitor and PiHole"
    echo "############################################"
    defaultpiholedir=/var/www/html/admin
    read -p "Where is your Pi-Hole Admin folder? (Default = $defaultpiholedir)" piholedir
    piholedir=${piholedir:=$defaultpiholedir}

    if [ ! -d "$piholedir" ]; then
        echo "Directory $piholedir does not exist!! Aborting!"
        exit
    fi
    echo "Removing Old Files"
    sudo rm -r "$piholedir/scripts/pi-hole/fanspeed"
    sudo rm "$piholedir/fanspeed.php"
    sudo rm "$piholedir/api_fanspeed.php"
    cd "$piholedir"
    sudo git fetch
    sudo git reset --hard HEAD
    sudo pihole -up
    cd
    echo "Cloning Git dir"
    if [ -d "./PiHole-ArgononeFanSpeed" ]; then
        sudo rm -r ./PiHole-ArgononeFanSpeed
    fi
    git clone https://github.com/Jonesyj83/PiHole-ArgononeFanSpeed.git
    echo "Moving files into PiHole directory"
    sudo cp "Pihole-ArgononeFanSpeed/fanspeed.js" "$piholedir/scripts/js/"
    sudo cp "PiHole-ArgononeFanSpeed/fanspeedresults.js" "$piholedir/scripts/js/"
    sudo cp -r "PiHole-ArgononeFanSpeed/fanspeed" "$piholedir/scripts/pi-hole"
    sudo cp "PiHole-ArgononeFanSpeed/fanspeed.php" "$piholedir"
    sudo cp "PiHole-ArgononeFanSpeed/api_fanspeed.php" "$piholedir"
    echo "Editing PiHole files to accept changes"
    sudo sed -i $'/topItems/{irequire("scripts/pi-hole/fanspeed/FTL_fanspeed.php");\n:a;n;ba}' "$piholedir/api_FTL.php"
    sudo sed -i '/if($auth){ ?>/a <?php include "./scripts/pi-hole/fanspeed/index_fanspeed.php"; ?>' "$piholedir/index.php"
    sudo sed -i '/index.js/a <script src="scripts/pi-hole/js/fanspeed.js"></script>\n' "$piholedir/index.php"
    sudo sed -i '/$FTL = ($FTLpid !== 0 ? true : false);/a     include ("./scripts/pi-hole/fanspeed/header_fanspeed.php");' "$piholedir/scripts/pi-hole/php/header.php"
    sudo sed -i $'/db_lists.php/{i\t<?php include "./scripts/pi-hole/fanspeed/header_fanspeed1.php"; ?>\n:a;n;ba}' "$piholedir/scripts/pi-hole/php/header.php"
    sudo sed -i $'/piholeFTLConfig/{i$dbFanSpeed ="/etc/pihole/fanspeed.db";\n:a;n;ba}' "$piholedir/settings.php"
    sudo sed -i '/Other API functions/a require("api_fanspeed.php");\n' "$piholedir/api.php"
    sudo sed -i '/Other API functions/a include('scripts/pi-hole/fanspeed/data_fanspeed.php');\n' "$piholedir/api.php"
    sudo sed -i -e '$a input {\ncolor:#556068;\nbackground-color:#32393e;\ncursor:pointer;\noutline:none;\nborder:none;\n}\ninput:hover,\ninput:focus{\ncolor: #fff;\nbackground-color:#22272a;\noutline:none;\nborder:none;\n}' "$pirholedir/style/themes/default-dark.css"
    sudo sed -i -e '$a input {\ncolor:#4b646f;\nbackground-color:#fff;\ncursor:pointer;\noutline:none;\nborder:none;\n}\ninput:hover,\ninput:focus{\ncolor: #fff;\nbackground-color:#1e282c;\noutline:none;\nborder:none;\n}' "$piholedir/style/themes/default-light.css"

    echo "Cleaning up"
    sudo rm -r ./PiHole-ArgononeFanSpeed

    echo "################"
    echo "Update complete."
    echo "################"
else
    exit 0
fi
