#!/bin/bash
read -p "Are you sure you want to uninstall PiHole Argonone Fan Hat Monitor? " prompt
if [[ $prompt == "y" || $prompt == "Y" || $prompt == "yes" || $prompt == "Yes" ]]
then
    echo "############################################"
    echo "Uninstalling PiHole Argonone Fan Hat Monitor"
    echo "############################################"
    echo "Removing Crontab"
    sudo crontab -l | sudo grep -v '/var/www/html/admin/scripts/pi-hole/fanspeed/fanspeed.sh' | sudo crontab -
    echo "Removing Files and config"
    sudo rm -r /var/www/html/admin/scripts/pi-hole/fanspeed
    sudo rm /var/www/html/admin/fanspeed.php
    sudo rm /var/www/html/admin/api_fanspeed.php
    sudo rm /etc/pihole/fanspeed.db
    sudo sed -i '/FANSPEED_CHART_DAYS/d' /etc/pihole/setupVars.conf
    sudo sed -i '/FANSPEEDDAYS/d' /etc/pihole/setupVars.conf
    echo "Removing all files from PiHole and returning to standard"
    cd /var/www/html/admin
    sudo git fetch
    sudo git reset --hard HEAD
    echo "Uninstall Complete"
else
    exit 0
fi
