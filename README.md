# pi-hole-argonone

![Alt text](https://raw.githubusercontent.com/Jonesyj83/PiHole-ArgononeFanSpeed/main/images/Screen%20Shot%202021-01-21%20at%2010.46.24%20am.png "Title")

Just a simple addon to add argonone fan speed to Pi-hole Sidemenu

Not a Programming, just like to play around. If there is better ways of coding, please let me know.

Step-1: Install https://gitlab.com/DarkElvenAngel/argononed and remove argonone script

Step-2: sudo cp fanspeed.sh /usr/local/bin

Step-3: sudo chmod +x /usr/local/bin/fanspeed.sh
 
Step-4: sudo cp header.php /var/www/html/admin/scripts/pi-hole/php
  
Done!

To update pi-hole with "pihole -up"

Step-1: cd /var/www/html/admin

Step-2: sudo git fetch

Step-3: sudo git reset --hard HEAD

Step-4: pihole -up

Step-5: Redo main steps (Only once I have updated to latest Pi-hole

Currently working on Pi-hole v5.2.4 Web Interface v5.3.1 FTL v5.5.1


Things to do!

-Make fanspeed/temp setting display nicer

-Maybe make a graph to display fan speeds

-?????
