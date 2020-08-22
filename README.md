# linux-gpu-survey
Online GPU survey tool for Linux userbase

This tool consists of two parts

1. Server - receives information came from gpu-survey.sh and shows the statistics on a web page
2. Client - scans GPU vendor id and device id; and hash of machine-id then upload the information anonymously to web server. It does not collect any personal data, only the GPU vendor and device id; as well as the machine-id hash.

REQUIREMENTS
For Server
1. Web server with PHP and MySQL (latest version)

For Client
1. Linux with dbus installed
2. Network or internet connection

INSTALLATION
1. Upload the php scripts to a web server
2. Create database and import the dump file
3. Edit the config.php for database settings
4. Edit the gpu-survey.sh for server settings

TO CONDUCT SURVEY
1. Make gpu-survey.sh script executable but typing this command on terminal 
chmod +x ./gpu-survey.sh

2. Run the gpu-survey.sh script on terminal
3. Follow the instructions on screen
