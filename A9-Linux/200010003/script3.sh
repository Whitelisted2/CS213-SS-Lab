#!/bin/bash

# Shell script to:
# a) List names that are 5 letters long and begin with Y
# b) Print records from line 6 to line 12
# c) Replace name Ankit with Ashish

# Listing names that are 5 letters long and starts with Y
echo -e "a) To list names that are 5 letters long and begin with Y"
grep -E "Y[A-Za-z]{4}[ |]" data.txt
echo -e "If just names are required, then using piping: "
grep -E "Y[A-Za-z]{4}[ |]" data.txt | cut -d "|" -f2

echo -e "\n"
echo -e "b) To print records from line 6 to line 12 (including line 12, it's 7 records)"
sed -n 6,12p data.txt

echo -e "\n"
echo -e "c) To Replace name Ankit with Ashish"
sed -e "s/Ankit/Ashish/g" data.txt

