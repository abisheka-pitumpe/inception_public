#!/bin/sh
logger "[FPTLS]:starting fptls ..."
nohup /home/centos/fpt/fingerprintls -i eth0 -j /var/log/httpd/capturefp.json -f /dev/null >/dev/null 2>&1 &
