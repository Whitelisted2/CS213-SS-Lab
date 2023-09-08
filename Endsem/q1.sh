#!/bin/bash

#Program to return total size of all .png files in a directory

echo "In bytes: "
echo $(du -cb *.png | tail -n 1 )| cut -d " " -f1

echo "In readable units: "
echo $(du -ch *.png | tail -n 1 )| cut -d " " -f1
