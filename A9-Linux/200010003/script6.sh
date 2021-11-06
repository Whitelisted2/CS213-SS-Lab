#!/bin/bash

# Shell script for a Menu-Driven Calculator

result=0
status=1
read -p "Enter first number (a): " a
read -p "Enter second number (b): " b
while (( $status == 1 ))
do
  echo -e "\nPick an operation to perform on the entered numbers $a and $b "
  echo "1: Addition (a+b) "
  echo "2: Subtraction (a-b) "
  echo "3: Multiplication (a*b) "
  echo "4: Division (a/b) "
  echo "5: exit"
  read -p "Enter your choice: " choice
  case $choice in
    1)
      result=$(( $a+$b ))
      echo "The sum $a + $b is $result "
      ;;
    2)
      result=$(( $a-$b ))
      echo "The difference $a - $b is $result "
      ;;
    3)
      result=$(( $a*$b ))
      echo "The product $a * $b is $result "
      ;;
    4)
      result=$(( $a/$b ))
      echo "The quotient of $a / $b is $result "
      ;;
    5)
      exit
      ;;
    *)
      echo "Invalid choice."
      ;;
  esac

  read -p "Continue? (1 for yes/0 for no) " s
  if [[ $s -eq 1 ]]; then
    continue
  else
    status=0
    break
  fi
done
exit 0
