#!/bin/bash

# To find sum of first n prime numbers
read -p "Enter a value of n: " n

is_prime() {
  i=$1
  status=1       # 0 is composite, 1 is prime
  factor=2
  while [ $factor -lt $i ]
  do
    rem=$(( $i % $factor ))
    if [ $rem -eq 0 ]
    then
      status=0
      break
    fi
    factor=$(( $factor+1 ))
  done
  return $status
}

sum=0
num_p=0
temp=2
while [ $num_p -ne $n ]
do
  is_prime $temp
  is_p=$?
  if [ $is_p -eq 1 ]
  then
    num_p=$(( $num_p+1 ))
    sum=$(( $sum+$temp ))
  fi
  temp=$(( $temp+1 ))
done

echo -e "Sum of first $n prime numbers is $sum \n "
