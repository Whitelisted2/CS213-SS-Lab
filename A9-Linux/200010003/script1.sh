#!/bin/bash

# Shell script to sort the file /etc/passwd in ascending order based on the 3rd column entries, as numbers
sort /etc/passwd -nt ":" -k3

