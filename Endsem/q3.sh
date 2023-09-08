#!/bin/bash

# Program to print number of odd and even Fibonacci numbers upto some number N

read -p "Enter a number: " n

num1=0
num2=1

even=0
odd=0

for (( i=0; num1<=n; i++ ))
do
  check=$(( $num1%2 ))
  if [ $check -eq 1 ]
  then
    odd=$(( $odd+1 ))
  else
    even=$(( $even+1 ))
  fi
  num3=$(( $num1+$num2 ))
  num1=$num2
  num2=$num3
done

if [ $n -eq 1 ]
then
  echo "1 will be considered as the second one that appears in the series"
fi

echo -e "Number of odd Fibonacci numbers upto (<=) $n is $odd"
echo -e "Number of even Fibonacci numbers upto (<=) $n is $even"




