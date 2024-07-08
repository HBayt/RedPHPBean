<?php 


function getAllTaskeds() {
    $taskeds = R::findAll('tasked' , 'WHERE user_id IS NOT NULL ORDER BY title ASC'); // ASC | DESC
    return $taskeds;
}


function getTaskeds() {
        $vacations = R::getAll("SELECT * FROM user LEFT JOIN tasked ON user.id = tasked.user_id LEFT JOIN task ON task.id = tasked.task_id LEFT JOIN group_task ON task.id = group_task.task_id WHERE tasked.user_id IS NOT NULL ORDER BY tasked.title ASC"); // ASC | DESC
        return $vacations;
}

function getTaskGroupByForeignkey($group_id) {
    $group  = R::findOne( 'group', 'id=?', [$group_id] ); 
    return $group; 
}

