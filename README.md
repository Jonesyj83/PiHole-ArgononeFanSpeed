# PiHole Argonone Fan Speed

I have create this addon for PiHole to display Fan Speed changes and CPU Temp. I am just doing this to teach myself some programming. Everything is working on my end. If there is better ways of doing this please let me know. 

The Graph will update only on changes with fan speed or if no speed has change in 1 hour, it will update to current speed/temp.
Not a Programmer, just like to play around. If there is a better way of coding this, please let me know.

Will only work with DarkElvenAngel ArgononeD daemon [https://gitlab.com/DarkElvenAngel/argononed](https://gitlab.com/DarkElvenAngel/argononed)

![screenshot](https://i.ibb.co/9r3NFR6/Screen-Shot-2021-02-15-at-12-16-14-pm.png)

![screenshot](https://i.ibb.co/fH9bfxc/Screen-Shot-2021-02-15-at-12-17-40-pm.png)

## Installation

This installation script should work with any modified PiHole Installations you have.
make sure [https://gitlab.com/DarkElvenAngel/argononed](https://gitlab.com/DarkElvenAngel/argononed) is installed and not the standard script
```bash
wget https://raw.githubusercontent.com/Jonesyj83/PiHole-ArgononeFanSpeed/main/install.sh
chmod +x install.sh
bash install.sh
```

## Update
This updates PiHole-ArgononeFanSpeed and PiHole to the latest versions
```bash
wget https://raw.githubusercontent.com/Jonesyj83/PiHole-ArgononeFanSpeed/main/update.sh
chmod +x update.sh
bash update.sh
```

## Uninstall

```bash
wget https://raw.githubusercontent.com/Jonesyj83/PiHole-ArgononeFanSpeed/main/uninstall.sh
chmod +x uninstall.sh
bash uninstall.sh
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://raw.githubusercontent.com/Jonesyj83/PiHole-ArgononeFanSpeed/v2.0.1/LICENSE)

## Curent working PiHole version
Pi-hole v5.2.4 Web Interface v5.4 FTL v5.7
