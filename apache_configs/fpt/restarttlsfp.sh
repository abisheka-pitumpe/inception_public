#!/bin/sh
#stop it
logger "[FPTLS]:stopping fptls (if alive)..."
ps axf | grep fingerprintls | grep -v grep | grep -v $0 | awk '{print "kill " $1}' | sh
#then start it, that simple
logger "[FPTLS]:starting fptls ..."
nohup /home/centos/fpt/fingerprintls -i eth0 -j /var/log/httpd/capturefp.json -f /dev/null  >/dev/null 2>&1 &
