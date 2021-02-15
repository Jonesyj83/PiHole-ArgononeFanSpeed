#!/bin/bash
read -p "Are you sure you want to uninstall PiHole Argonone Fan Hat Monitor? " prompt
if [[ $prompt == "y" || $prompt == "Y" || $prompt == "yes" || $prompt == "Yes" ]]; then
    echo "############################################"
    echo "Uninstalling PiHole Argonone Fan Hat Monitor"
    echo "############################################"
    defaultpiholedir=/var/www/html/admin
    read -p "Where is your Pi-Hole Admin folder? (Default = $defaultpiholedir)" piholedir
    piholedir=${piholedir:=$defaultpiholedir}

    if [ ! -d "$piholedir" ]; then
        echo "Directory $piholedir does not exist!! Aborting!"
        exit
    fi
    echo "Removing Crontab"
    sudo crontab -l | sudo grep -v "$piholedir/scripts/pi-hole/fanspeed/fanspeed.sh" | sudo crontab -
    echo "Removing Files and config"
    sudo rm -r "$piholedir/scripts/pi-hole/fanspeed"
    sudo rm "$piholedir/fanspeed.php"
    sudo rm "$piholedir/api_fanspeed.php"
    read -p "Do you wish to delete the database file? " dbfile
    if [[ $dbfile == "y" || $dbfile == "Y" || $dbfile == "yes" || $dbfile == "Yes" ]]; then
        sudo rm /etc/pihole/fanspeed.db
    fi
    sudo sed -i '/FANSPEED_CHART_DAYS/d' /etc/pihole/setupVars.conf
    sudo sed -i '/FANSPEEDDAYS/d' /etc/pihole/setupVars.conf
    echo "Removing all files from PiHole and returning to standard"
    cd "$piholedir"
    sudo git fetch
    sudo git reset --hard HEAD
    echo "Uninstall Complete"
else
    exit 0
fi
