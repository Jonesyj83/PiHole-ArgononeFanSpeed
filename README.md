# Buy me a coffee.

If you like my projects, you can buy me a coffee.

<a href="https://www.buymeacoffee.com/Jonesy" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/purple_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(176, 4, 242, 1) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(176, 4, 242, 1) !important;" ></a>


# PiHole Argonone Fan Speed

I have create this addon for PiHole to display Fan Speed changes and CPU Temp. I am just doing this to teach myself some programming. Everything is working on my end. If there is better ways of doing this please let me know. 

The Graph will update only on changes with fan speed or if no speed has change in 1 hour, it will update to current speed/temp.
Not a Programmer, just like to play around. If there is a better way of coding this, please let me know.

Will only work with DarkElvenAngel ArgononeD daemon [https://gitlab.com/DarkElvenAngel/argononed](https://gitlab.com/DarkElvenAngel/argononed)

## Updates
v2.0.2
Add Settings Page, can not Update/View all settings for Argononed

![screenshot](https://i.ibb.co/X2v2207/Screen-Shot-2021-02-17-at-9-03-15-pm.png)

![screenshot](https://i.ibb.co/fH9bfxc/Screen-Shot-2021-02-15-at-12-17-40-pm.png)

![screenshot](https://i.ibb.co/k2K2tyZ/Screen-Shot-2021-03-18-at-8-30-30-am.png)

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
