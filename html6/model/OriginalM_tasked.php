<?php 


function getAllTaskeds() {
    $taskeds = R::findAll('tasked' , 'WHERE user_id IS NOT NULL ORDER BY title ASC');
    return $taskeds;
}


function getTaskeds() {
        $vacations = R::getAll("SELECT * FROM user LEFT JOIN tasked ON user.id = tasked.user_id LEFT JOIN task ON task.id = tasked.task_id LEFT JOIN group_task ON task.id = group_task.task_id WHERE tasked.user_id IS NOT NULL ORDER BY tasked.title DESC");
        return $vacations;
}

function getTaskGroupByForeignkey($group_id) {
    $group  = R::findOne( 'group', 'id=?', [$group_id] ); 
    return $group; 
}





function getBetween($string, $start = "", $end = ""){
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return '';
    }


    /*
        // Sample use:
        echo getBetween("abc","a","c"); // returns: 'b'
        echo getBetween("hello","h","o"); // returns: 'ell'
        echo getBetween("World","a","r"); // returns: ''
    */ 
}



function tag_contents($string, $tag_open, $tag_close){

    $result = null; 
    foreach (explode($tag_open, $string) as $key => $value) {
        if(strpos($value, $tag_close) !== FALSE){
             $result[] = substr($value, 0, strpos($value, $tag_close));;
        }
    }
    return $result;
 }

 // 
 /* 

$string = "i love cute animals, like [animal]cat[/animal],
           [animal]dog[/animal] and [animal]panda[/animal]!!!";

echo "<pre>";
print_r(tag_contents($string , "[animal]" , "[/animal]"));
echo "</pre>";

//result
Array
(
    [0] => cat
    [1] => dog
    [2] => panda
)

 */ 