#!/bin/bash
echo "############################################"
echo "PiHole Argonone Fan Hat Monitor installation"
echo "############################################"
if ! [ -x "$(command -v argonone-cli)" ]; then
    echo 'Error: Argononed is not installed. Install from https://gitlab.com/DarkElvenAngel/argononed' >&2
    exit
fi
if ! [ -x "$(command -v pihole)" ]; then
    echo "Error: PiHole is not installed. Aborting!" >&2
    exit
fi
read -p "Are you sure you want to install PiHole Argonone Fan Hat Monitor? " prompt
if [[ $prompt == "y" || $prompt == "Y" || $prompt == "yes" || $prompt == "Yes" ]]
    then
        defaultpiholedir=/var/www/html/admin
        read -p "Where is your Pi-Hole Admin folder? (Default = $defaultpiholedir)" piholedir
        piholedir=${piholedir:=$defaultpiholedir}

        if [ ! -d "$piholedir" ]; then
            echo "Directory $piholedir does not exist!! Aborting!"
            exit
        fi

        echo "Cloning Git dir"
        if [ -d "./PiHole-ArgononeFanSpeed" ]; then
            sudo rm -r ./PiHole-ArgononeFanSpeed
        fi
        git clone https://github.com/Jonesyj83/PiHole-ArgononeFanSpeed.git
        echo "Moving files into PiHole directory"
        sudo cp "PiHole-ArgononeFanSpeed/fanspeed/fanspeed.js" "$piholedir/scripts/pi-hole/js/"
        sudo cp "PiHole-ArgononeFanSpeed/fanspeed/fanspeedresults.js" "$piholedir/scripts/pi-hole/js/"
        sudo cp -r "PiHole-ArgononeFanSpeed/fanspeed" "$piholedir/scripts/pi-hole"
        sudo cp "PiHole-ArgononeFanSpeed/fanspeed.php" "$piholedir"
        sudo cp "PiHole-ArgononeFanSpeed/api_fanspeed.php" "$piholedir"
        sudo cp "PiHole-ArgononeFanSpeed/fansettings.js" "$piholedir/scripts/pi-hole/js/"
        sudo cp "PiHole-ArgononeFanSpeed/settings.php" "$piholedir/scripts/pi-hole/fanspeed/"
        sudo cp "PiHole-ArgononeFanSpeed/savesettings.php" "$piholedir/scripts/pi-hole/fanspeed/"
        read -p "Do you wish to use a NEW database file? " dbfile
        if [[ $dbfile == "y" || $dbfile == "Y" || $dbfile == "yes" || $dbfile == "Yes" ]]; then
            sudo cp "$piholedir/scripts/pi-hole/fanspeed/fanspeed.db" "/etc/pihole/"
            sudo chown pihole:pihole /etc/pihole/fanspeed.db
            sudo chmod 664 /etc/pihole/fanspeed.db
        fi
        echo "Adding config settings"
        echo "Editing PiHole files to accept changes"
        sudo sed -i $'/topItems/{irequire("scripts/pi-hole/fanspeed/FTL_fanspeed.php");\n:a;n;ba}' "$piholedir/api_FTL.php"
        sudo sed -i '/settings.js/a <script src="scripts/pi-hole/js/fansettings.js?v=<?=$cacheVer?>"></script>' "$piholedir/settings.php"
        
        sudo sed -i '
        /<h3 class="box-title">Teleporter/{
        n 
        n
        n
        n
        n
        n
        n
        n
        n
        a\ <?php include("scripts/pi-hole/fanspeed/settings.php"); ?>
        }' "$piholedir/settings.php"
        
        sudo sed -i '
        /aria-controls="teleporter"/{
        n 
        a\ \t\t<li role="presentation"<?php if($tab === "fanspeed"){ ?> class="active"<?php } ?>> \n \t\t\t<a href="#fanspeed" aria-controls="fanspeed" aria-expanded="<?php echo $tab === "fanspeed" ? "true" : "false"; ?>" role="tab" data-toggle="tab">Fanspeed</a> \n\t\t</li>
        }' "$piholedir/settings.php"
        sudo sed -i 's/"privacy", "teleporter"/&, "fanspeed"/' "$piholedir/settings.php"
        sudo sed -i '/if($auth){ ?>/a <?php include "./scripts/pi-hole/fanspeed/index_fanspeed.php"; ?>' "$piholedir/index.php"
        sudo sed -i '/index.js/a <script src="scripts/pi-hole/js/fanspeed.js"></script>\n' "$piholedir/index.php"
        sudo sed -i $'/db_lists.php/{i\t<?php include "./scripts/pi-hole/fanspeed/header_fanspeed.php"; ?>\n:a;n;ba}' "$piholedir/scripts/pi-hole/php/header.php"
        sudo sed -i $'/piholeFTLConfig/{i$dbFanSpeed ="/etc/pihole/fanspeed.db";\n:a;n;ba}' "$piholedir/settings.php"
        sudo sed -i '/Other API functions/a require("api_fanspeed.php");\n' "$piholedir/api.php"
        sudo sed -i -e '$a input {\ncolor:#556068;\nbackground-color:#32393e;\ncursor:pointer;\noutline:none;\nborder:none;\n}\ninput:hover,\ninput:focus{\ncolor: #fff;\nbackground-color:#22272a;\noutline:none;\nborder:none;\n}' "$piholedir/style/themes/default-dark.css"
        sudo sed -i -e '$a input {\ncolor:#4b646f;\nbackground-color:#fff;\ncursor:pointer;\noutline:none;\nborder:none;\n}\ninput:hover,\ninput:focus{\ncolor: #fff;\nbackground-color:#1e282c;\noutline:none;\nborder:none;\n}' "$piholedir/style/themes/default-light.css"
        sudo sed -i -e '$a input[type=number]::-webkit-inner-spin-button, \ninput[type=number]::-webkit-outer-spin-button { \n-webkit-appearance: none; \n-moz-appearance: none; \nappearance: none; \nmargin: 0; \n}' "$piholedir/style/pi-hole.css"
        sudo sed -i '/$success = "";/a require($_SERVER["DOCUMENT_ROOT"]."/admin/scripts/pi-hole/fanspeed/savesettings.php");\n' "$piholedir/scripts/pi-hole/php/savesettings.php"
        echo "Adding crontab"
        sudo crontab -l > crontab.tmp
        echo "* *  *  *  * $piholedir/scripts/pi-hole/fanspeed/fanspeed.sh" >> crontab.tmp
        sudo crontab crontab.tmp
        sudo rm crontab.tmp
        echo "Cleaning up"
        sudo rm -r ./PiHole-ArgononeFanSpeed

        echo "#####################################################################"
        echo "Installation complete. Refresh your Pihole admin page to see changes."
        echo "Data may take a few minutes to show up"
        echo "#####################################################################"
else
    exit 0
fi
