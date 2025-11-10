#!/bin/sh
logger "[FPTLS]:stopping fptls (if alive)..."
ps axf | grep fingerprintls | grep -v grep | grep -v $0 | awk '{print "kill " $1}' | sh
