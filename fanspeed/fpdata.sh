#!/bin/bash
fspdata=$(sqlite3 /etc/pihole/fanspeed.db "SELECT * FROM fanspeed ORDER BY id DESC LIMIT 1")

echo "$fspdata"
