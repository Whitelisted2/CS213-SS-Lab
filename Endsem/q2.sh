#!/bin/bash

# Program to print sum of squares of primes upto a given number
read -p "Enter a number: " n

is_prime() {     # argument would be some number. This function just checks if it is prime
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
  return $status # if number is prime, 1 is returned. Else, 0 is returned
}

sum=0
c=2
while [ $c -le $n ]
do
  is_prime $c
  stat=$?
  if [ $stat -eq 1 ]
  then
    sq=$(( $c*$c ))
    sum=$(( $sum+$sq ))
  fi
  c=$(( $c+1 ))
done

echo "Note: 1 is not a prime number"
echo -e "Sum of squares of primes upto $n is $sum \n"

