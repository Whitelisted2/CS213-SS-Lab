#!/bin/bash

# Declaring an array of size 7
declare -a test_array=('a1' 'a2' 'a3' 'a4' 'a5' 'a6' 'a7')

# Print total number of elements
echo -e "Total number of elements in array: ${#test_array[@]} \n"

# Print all the elements
echo -e "The elements are: ${test_array[@]} \n"

# Print 5th element
echo -e "Fifth element of array is: ${test_array[4]} \n"

# Extract 3 elements starting from INDEX 2
echo -e "Three elements starting from INDEX 2 are: ${test_array[@]:2:3} \n"

# Replace 3rd element with 'Debian' and display
test_array[2]='Debian'
echo -e "Array after replacing 3rd element with Debian: ${test_array[@]} \n"

# Append a new element at the end of the array
echo -e "Appending new element a8 to the array... \n"
test_array=(${test_array[@]} "a8")
echo -e "Elements of array after appending: ${test_array[@]} \n"
