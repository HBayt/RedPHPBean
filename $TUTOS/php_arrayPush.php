<?php 
// https://www.geeksforgeeks.org/how-to-push-both-key-and-value-into-php-array/ 


/*
Approach 1: Using Square Bracket [] Syntax
A value can be directly assigned to a specific key by using the square bracket syntax.

*/ 
?> 
<?php 

// Example 
    
    $myArray = [ 
        "1" => "GeeksforGeeks", 
        "2" => "GFG", 
        "3" => "Learn, Practice, and Excel", 
    ]; 
    
    $myArray["4"] = "PHP"; 
    
    foreach ($myArray as $keyName => $valueName) { 
        echo $keyName . " => " . $valueName . "\n"; 
    } 
    
?>

<?php 
    /*
    Output

    1 => GeeksforGeeks
    2 => GFG
    3 => Learn, Practice, and Excel
    4 => PHP

    */ 
?> 
<?php 
    //_____________________________________________________________________________________________________________
?> 


<?php 
/*
Approach 2: Using array_merge() Function

The array_merge() function merges two arrays being passed as arguments. The first argument of the array_push() function is the original array and subsequent argument is the key and the value to be added to the array in the form of an array as well.
Note: Keep in mind that this method will re-number numeric keys, if any (keys will start from 0, 1, 2…).

*/ 
?> 
<?php 

$myArray = [ 
    "One" => "GeeksforGeeks", 
    "Two" => "GFG", 
    "Three" => "Learn, Practice, and Excel", 
]; 

$myArray = array_merge($myArray, ["Four" => "PHP"]); 

foreach ($myArray as $keyName => $valueName) { 
    echo $keyName . " => " . $valueName . "\n"; 
} 

?>

<?php 
    /*
    Output

    One => GeeksforGeeks
    Two => GFG
    Three => Learn, Practice, and Excel
    Four => PHP
    */ 
?> 
<?php 
    //_____________________________________________________________________________________________________________
?> 

<?php 
/*
Approach 3: Using += Operator

The += operator can be used to append a key-value pair to the end of the array.

*/ 
?> 
<?php 

$myArray = [ 
    "1" => "GeeksforGeeks", 
    "2" => "GFG", 
    "3" => "Learn, Practice, and Excel", 
]; 

$myArray += ["4" => "PHP"]; 

foreach ($myArray as $keyName => $valueName) { 
    echo $keyName . " => " . $valueName . "\n"; 
} 

?>

<?php 
    /*
    Output

    1 => GeeksforGeeks
    2 => GFG
    3 => Learn, Practice, and Excel
    4 => PHP

    */ 
?> 
<?php 
    //_____________________________________________________________________________________________________________
?>

<?php 
/*
Approach 4: Using the array_combine Function

The array_combine function in PHP creates an associative array by combining two arrays: one for keys and one for values. 
Each element in the first array is used as a key, and the corresponding element in the second array becomes the value.

*/ 
?> 
<?php
    // Define arrays for keys and values
    $keys = ['name', 'age', 'city'];
    $values = ['Alice', 25, 'New York'];

    // Combine the two arrays into an associative array
    $associativeArray = array_combine($keys, $values);

    // Print the resulting array
    print_r($associativeArray);
?>


<?php 
    /*
    Output

    Array
    (
        [name] => Alice
        [age] => 25
        [city] => New York
    )

    */ 
?> 
<?php 
    //_____________________________________________________________________________________________________________
?>

<?php 
/*
Approach 5: Using array_replace()

In the array_replace() approach, you merge an existing array with a new array containing the key-value pair. 
This function replaces elements in the original array with elements from the new array. It adds the key-value pair if the key doesn’t exist.
*/ 
?> 
<?php
    $array = [];
    $key = 'fruit';
    $value = 'apple';

    $array = array_replace($array, [$key => $value]);

    print_r($array); // Output: Array ( [fruit] => apple )
?>


<?php 
    /*
    Output

    Array
    (
        [fruit] => apple
    )

    */ 
?> 
<?php 
    //_____________________________________________________________________________________________________________
?>
<?php 
/*
Approach 6: Using array_push() with Reference

This method involves using the array_push() function to add an associative array (containing the new key-value pair) to the original array. 
The array_push() function can add one or more elements to the end of an array.

Example: In this example, the pushKeyValuePair function takes the original array by reference, along with the key and value to be added. 
It creates an associative array containing the new key-value pair and then uses array_push() to add this associative array to the original array. 
*/ 
?> 
<?php
    function pushKeyValuePair(&$array, $key, $value) {
        // Create an associative array with the new key-value pair
        $newElement = [$key => $value];
        // Use array_push to add the associative array to the original array
        array_push($array, $newElement);
    }

    // Example usage
    $array = ['a' => 1, 'b' => 2, 'c' => 3];
    $key = 'd';
    $value = 4;

    pushKeyValuePair($array, $key, $value);
    print_r($array);

?>



<?php 
    /*
    Output

    Array
    (
        [a] => 1
        [b] => 2
        => 3
        [0] => Array
            (
                [d] => 4
            )

    )

    */ 
?> 
<?php 
    //_____________________________________________________________________________________________________________
?>


<?php 
/*
Approach 7: Using array_splice()

The array_splice() function can be used to insert a new key-value pair into an array at a specific position. 
By specifying the position as the end of the array, this function can effectively add the new pair to the array.

*/ 
?> 
<?php
    // Initialize the array
    $array = ['a' => 1, 'b' => 2];

    // Prepare the new key-value pair
    $new_key_value = ['c' => 3];

    // Convert the associative array to an indexed array for splicing
    $keys = array_keys($array);
    $values = array_values($array);

    // Append the new key-value pair
    array_splice($keys, count($keys), 0, array_keys($new_key_value));
    array_splice($values, count($values), 0, array_values($new_key_value));

    // Combine the keys and values back into an associative array
    $array = array_combine($keys, $values);

    print_r($array);

?>


<?php 
    /*
    Output

    Array
    (
        [a] => 1
        [b] => 2
        => 3
    )

    */ 
?> 
<?php 
    //_____________________________________________________________________________________________________________