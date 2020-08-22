#!/bin/bash

TEST_WEBSITE=""
WEBSITE=""
SUBMIT_PATH="/submit.php"

do_survey(){

vcards=$(ls /sys/class/drm/card*/device/vendor | sed -e "s#\/device\/vendor##g" | xargs basename)

if [ -e /var/lib/dbus/machine-id ]; then
 mpath="/var/lib/dbus/machine-id"
elif [ -e /etc/machine-id ]; then
 mpath="/etc/machine-id"
else
 echo "machine-id not found. Unable to conduct survey"
 exit
fi

echo "Getting machine-id hash..." 
mhash=$(md5sum "$mpath" | cut -f 1 -d ' ')

for vcard in $vcards
do
	vid="$(cat /sys/class/drm/$vcard/device/vendor | cut -f 2 -d 'x' 2>/dev/null)"
	dvid="$(cat /sys/class/drm/$vcard/device/device | cut -f 2 -d 'x' 2>/dev/null)"
    
    echo "Submitting GPU information to ${WEBSITE} [$vid:$dvid]..."
    
    xURL="${WEBSITE}${SUBMIT_PATH}?vid=${vid}&devid=${dvid}&hash=$mhash"
    
    wget -q -O - "$xURL"
    
    if [ $? -eq 0 ]; then
     echo "Submission complete"
    fi
        
    sleep 1
  
done	

echo ""
echo "Task complete! Thanks for participating the survey."
	
}

echo "Checking for internet connection"
sleep 1
wget -q --spider "$WEBSITE"

if [ $? -eq 0 ]; then
    echo ""
else
    echo "Server test failed. Check network settings."
    exit
fi


while [ true ];
do

clear

echo -n "WELCOME TO LINUX GPU SURVEY

This is a survey for GPU/video cards used buy the linux community.
It will scan the vendor id and device id of the gpu installed on your computer and gets checksum of the machine-id
Then the data will send anonymously to $WEBSITE for statistics purpose. The checksum of the machine-id prevents duplicate entries

This script does not collect any personal information. Internet connection required

Continue [Y/N]: "

read RES

if [ "$RES" == "N" ] || [ "$RES" == "n" ]; then
 break
elif [ "$RES" == "Y" ] || [ "$RES" == "y" ]; then
 break
fi

done

if [ "$RES" == "Y" ] || [ "$RES" == "y" ]; then
 echo ""
 do_survey
fi
