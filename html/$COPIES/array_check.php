Using empty() Function



<?php // Using empty() Function
// __________________________________________________________________________________________________________
// Declare an array and initialize it $non_empty_array = array('URL' => 'https://www.geeksforgeeks.org/'); 
// This function determines whether a given variable is empty. This function does not return a warning if a variable does not exist.
// __________________________________________________________________________________________________________

// Declare an empty array 
$empty_array = array(); 

// Condition to check array is empty or not 
if(!empty($non_empty_array)) 
    echo "Given Array is not empty <br>"; 

if(empty($empty_array)) 
    echo "Given Array is empty"; 


// Output
// Given Array is empty 

?>     


<?php // Using count() Function
// __________________________________________________________________________________________________________
// This function counts all the elements in an array. If number of elements in array is zero, then it will display empty array.
// __________________________________________________________________________________________________________

// Declare an empty array 
$empty_array = array(); 

// Function to count array 
// element and use condition 
if(count($empty_array) == 0) 
    echo "Array is empty"; 
else
    echo "Array is non- empty"; 

// Output
// Given Array is empty 
?> 



<?php // Using sizeof() function
// __________________________________________________________________________________________________________
// This method check the size of array. If the size of array is zero then array is empty otherwise array is not empty.
// __________________________________________________________________________________________________________

// Declare an empty array 
$empty_array = array(); 

// Use array index to check 
// array is empty or not 
if( sizeof($empty_array) == 0 ) 
    echo "Empty Array"; 
else
    echo "Non-Empty Array"; 

// Output
// Empty Array
?> 



<?php // Using not (!) operator
// __________________________________________________________________________________________________________
// In this method, we are checking whether the given array is empty or not by using not operator. 
// __________________________________________________________________________________________________________

// Declare an empty array 
$empty_array = array(); 

// Use array index to check 
// array is empty or not 
if( ! $empty_array) 
    echo "Empty Array"; 
else
    echo "Non-Empty Array"; 

// Output
// Empty Array 
?> 



<?php // Using array_key_exists() Function
// __________________________________________________________________________________________________________
// This method involves checking if the array has any keys, indicating that it contains elements. If the array has no keys, it is empty. 
// __________________________________________________________________________________________________________ 
function isArrayEmpty($array) {
    return !array_key_exists(0, $array) && count($array) === 0;
}

// Example usage
$array1 = [];
$array2 = ['PHP', 'Java', 'Python'];

echo isArrayEmpty($array1) ? 'Array is empty' : 'Array is not empty';
// Output: Array is empty

echo "\n";

echo isArrayEmpty($array2) ? 'Array is empty' : 'Array is not empty';
// Output: Array is not empty 

// Output
// Array is empty
// Array is not empty

?>
