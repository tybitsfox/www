#!/bin/bash
# empty-array.sh

#  Thanks to Stephane Chazelas for the original example,
#+ and to Michael Zick for extending it.


# An empty array is not the same as an array with empty elements.

array0=( first second third )
array1=( '' )   # "array1" consists of one empty element.
array2=( )      # No elements . . . "array2" is empty.

echo
ListArray()
{
echo
echo "Elements in array0:  ${array0[@]}"
echo "Elements in array1:  ${array1[@]}"
echo "Elements in array2:  ${array2[@]}"
echo
echo "Length of first element in array0 = ${#array0}"
echo "Length of first element in array1 = ${#array1}"
echo "Length of first element in array2 = ${#array2}"
echo
echo "Number of elements in array0 = ${#array0[*]}"  # 3
echo "Number of elements in array1 = ${#array1[*]}"  # 1  (Surprise!)
echo "Number of elements in array2 = ${#array2[*]}"  # 0
}

# ===================================================================

ListArray

# Try extending those arrays.

# Adding an element to an array.
array0=( "${array0[@]}" "new1" )
array1=( "${array1[@]}" "new1" )
array2=( "${array2[@]}" "new1" )

ListArray

# or
array0[${#array0[*]}]="new2"
array1[${#array1[*]}]="new2"
array2[${#array2[*]}]="new2"

ListArray

# When extended as above; arrays are 'stacks'
# The above is the 'push'
# The stack 'height' is:
height=${#array2[@]}
echo
echo "Stack height for array2 = $height"

# The 'pop' is:
unset array2[${#array2[@]}-1]	#  Arrays are zero-based,
height=${#array2[@]}            #+ which means first element has index 0.
echo
echo "POP"
echo "New stack height for array2 = $height"

ListArray

# List only 2nd and 3rd elements of array0.
from=1		# Zero-based numbering.
to=2		#
array3=( ${array0[@]:1:2} )
echo
echo "Elements in array3:  ${array3[@]}"

# Works like a string (array of characters).
# Try some other "string" forms.

# Replacement:
array4=( ${array0[@]/second/2nd} )
echo
echo "Elements in array4:  ${array4[@]}"

# Replace all matching wildcarded string.
array5=( ${array0[@]//new?/old} )
echo
echo "Elements in array5:  ${array5[@]}"

# Just when you are getting the feel for this . . .
array6=( ${array0[@]#*new} )
echo # This one might surprise you.
echo "Elements in array6:  ${array6[@]}"

array7=( ${array0[@]#new1} )
echo # After array6 this should not be a surprise.
echo "Elements in array7:  ${array7[@]}"

# Which looks a lot like . . .
array8=( ${array0[@]/new1/} )
echo
echo "Elements in array8:  ${array8[@]}"

#  So what can one say about this?

#  The string operations are performed on
#+ each of the elements in var[@] in succession.
#  Therefore : Bash supports string vector operations
#+ if the result is a zero length string,
#+ that element disappears in the resulting assignment.

#  Question, are those strings hard or soft quotes?

zap='new*'
array9=( ${array0[@]/$zap/} )
echo
echo "Elements in array9:  ${array9[@]}"

# Just when you thought you where still in Kansas . . .
array10=( ${array0[@]#$zap} )
echo
echo "Elements in array10:  ${array10[@]}"

# Compare array7 with array10.
# Compare array8 with array9.

# Answer: must be soft quotes.

exit 0
