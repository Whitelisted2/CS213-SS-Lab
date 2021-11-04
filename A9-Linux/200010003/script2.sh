#!/bin/bash

#Program to cut usernames from the file /etc/passwd
cut /etc/passwd -d ":" -f1
