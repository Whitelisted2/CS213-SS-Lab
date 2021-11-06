#!/bin/bash

#Shell script to add elements of an array using a function
function add_ele() {
  arr=$1[@]
  array=("${!arr}")
  sum=0
  for i in "${array[@]}"
  do
    sum=$(( $sum+$i ))
  done
  echo -n "Sum of elements of array ("
  for i in "${array[@]}"
  do
    echo -n "$i "
  done
  echo -n ") is: $sum"
}

array1=(1 2 3)
array2=(4 5 6)

add_ele array1
echo -e "\n"
add_ele array2
echo -e "\n"
