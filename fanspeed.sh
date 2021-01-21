#!/bin/bash
fanspeed=$(eval "argonone-cli --decode | grep Status") 
fspeed="${fanspeed##* }"
echo "$fspeed"
fspeed1=$(eval "argonone-cli --decode | grep Speeds")
fsd1=$(echo "$fspeed1" | cut -d " " -f5)
fsd2=$(echo "$fspeed1" | cut -d " " -f6)
fsd3=$(echo "$fspeed1" | cut -d " " -f7)
echo "$fsd1"
echo "$fsd2"
echo "$fsd3"
fset=$(eval "argonone-cli --decode | grep Temps")
fset1=$(echo "$fset" | cut -d " " -f5)
fset2=$(echo "$fset" | cut -d " " -f6)
fset3=$(echo "$fset" | cut -d " " -f7)
echo "$fset1"
echo "$fset2"
echo "$fset3"
