<?php 
    // https://www.geeksforgeeks.org/php-foreach-loop/ 
    
    //_____________________________________________________________________________________________________________
?>

<?php 
// Syntax:

foreach( $array as $element ) {
    // PHP Code to be executed
}

// or

foreach( $array as $key => $element) {
    // PHP Code to be executed
}

?>  
<?php
$colors = array("Red", "Green", "Blue", "Yellow", "Orange");
 
// Loop through colors array
foreach($colors as $value){
    echo $value . "<br>";
}
?>

<?php 
    //_____________________________________________________________________________________________________________
?>

<?php 
/*
    Program 1: PHP program to print the array elements using foreach loop.
*/ 
?> 
<?php 

// Declare an array 
$arr = array("green", "blue", "pink", "white"); 

// Loop through the array elements 
foreach ($arr as $element) { 
	echo "$element "; 
} 

?> 


<?php 
    /*
    Output

    green blue pink white

    */ 
?> 
<?php 
    //_____________________________________________________________________________________________________________
?>
<?php 
/*
    Program 1: PHP program to print the array elements using foreach loop.
*/ 
?> 
<?php 
    $employee = array( 
        "name" => "Robert", 
        "email" => "robert112233@mail.com", 
        "age" => 18, 
        "gender" => "male"

    ); 

    // Loop through employee array 
    foreach($employee as $key => $element) { 
        echo $key . ": " . $element . "<br>"; 
    } 

?> 


<?php 
    /*
    Output

    name: Robert
    email: robert112233@mail.com
    age: 18
    gender: male

    */ 
?> 