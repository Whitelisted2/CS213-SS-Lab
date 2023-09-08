#!/bin/bash

# Program to find if a year is leap year or not

read -p "Enter a year: " year

# If a year is divisible by 4, it is leap year
#   EXCEPT if it is divisible by 100
#     EXCEPT if it is divisible by 400

# So let's go in reverse order for a simpler program

rem400=$(( $year%400 ))
rem100=$(( $year%100 ))
rem4=$(( $year%4 ))

if [ $rem400 -eq 0 ]
then
  echo -e "$year is a leap year"
elif [ $rem100 -eq 0 ]
then
  echo -e "$year is not a leap year"
elif [ $rem4 -eq 0 ]
then
  echo -e "$year is a leap year"
else
  echo -e "$year is not a leap year"
fi



