#!/bin/bash

start=$(date +"%Y-%m-%d %H:%M:%S")
newdate=$(date -d '59 minutes ago' +"%Y-%m-%d %H:%M:%S")
runfanspeed="argonone-cli --decode"

function argononeddead(){
    sqlite3 /etc/pihole/fanspeed.db "insert into fanspeed values (NULL, '${start}', 'Argononed Not running', 0);"
    exit
}


if [[ -z $(eval "$runfanspeed") ]]; then
    echo "Not Working";
    argononeddead
else
    lastfanspeed=$(sqlite3 /etc/pihole/fanspeed.db "SELECT fanspeed FROM fanspeed ORDER BY id DESC LIMIT 1")
    chktime=$(sqlite3 /etc/pihole/fanspeed.db "SELECT start_time FROM fanspeed ORDER BY id DESC LIMIT 1")
    echo "Working";
    start=$(date +"%Y-%m-%d %H:%M:%S")
    fanspeed=$(( 16#$(xxd  -l 1 /dev/shm/argonone | cut -d " " -f2 ) ))
    temp=$(( 16#$(xxd -s1 -l 1 /dev/shm/argonone | cut -d " " -f2 ) ))
    if [[ "$lastfanspeed" -ne "$fanspeed" ]]; then
        echo "added";
        sqlite3 /etc/pihole/fanspeed.db "insert into fanspeed values (NULL, '${start}', '${fanspeed}', '${temp}');"
    else 
        if [[ "$chktime" < "$newdate" ]]; then
           echo "old date added";
           sqlite3 /etc/pihole/fanspeed.db "insert into fanspeed values (NULL, '${start}', '${fanspeed}', '${temp}');"
        fi
    fi
fi
