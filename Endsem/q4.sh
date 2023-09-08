#!/bin/bash

# Program to check if a given string is a palindrome or not
read -p "Enter some string: " str
revstr=$(echo $str | rev )

if [ "$revstr" = "$str" ]
then
  echo -e "$str is a palindrome"
else
  echo -e "$str is not a palindrome"
fi
