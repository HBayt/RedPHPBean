<?php

// ____________________________________________
// SOME FUNCTIONS FOR ARRAYS 
// ____________________________________________
/* 
array_keys() - Return all the keys or a subset of the keys of an array
array_values() - Return all the values of an array
array_key_exists() - Checks if the given key or index exists in the array
in_array() - Checks if a value exists in an array


array_combine() - Creates an array by using one array for keys and another for its values
array_search() - Searches the array for a given value and returns the first corresponding key if successful
*/ 

?>



<?php

// ____________________________________________
// Array KEYS 
// ____________________________________________
/* 
echo "<br>"; 
$array = array(0 => 100, "color" => "red");
print_r(array_keys($array));
echo "<br>"; 
$array = array("blue", "red", "green", "blue", "blue");
print_r(array_keys($array, "blue"));
echo "<br>"; 
$array = array("color" => array("blue", "red", "green"),
               "size"  => array("small", "medium", "large"));
echo "<br>"; 
print_r(array_keys($array));
echo "<br>"; 

*/ 
?>



<?php
// ____________________________________________
// Array VALUES 
// ____________________________________________
/* 
$array = array("size" => "XL", "color" => "gold");
print_r(array_values($array));


<?php
$a = array(
 3 => 11,
 1 => 22,
 2 => 33,
);
$a[0] = 44;

print_r( array_values( $a ));
==>
Array(
  [0] => 11
  [1] => 22
  [2] => 33
  [3] => 44
)


var_dump(array_value_recursive('gold', $array)); // null
var_dump(array_value_recursive('baz', $array)); // string(3) "baz"


?>



*/ 
?>



<?php

// ____________________________________________
// SEARCH ELEMENT KEY
// ____________________________________________
/* 
$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');

$key = array_search('green', $array); // $key = 2;
$key = array_search('red', $array);   // $key = 1;
*/ 

/* 
$arr = [
    'foo'    => 'bar',
    'abc'    => 'def',
    'bool'   => true,
    'target' => 'xyz'
];

var_dump( array_search( 'xyz', $arr ) ); //bool
var_dump( array_search( 'xyz', $arr, true ) ); //target
*/ 



?>
