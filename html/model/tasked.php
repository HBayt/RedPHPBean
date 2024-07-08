<?php 

// ___________________________________________________________________________________________________
//GET ALL ASSIGNED TASKS 
// ___________________________________________________________________________________________________
function getAllTaskeds() {
    $taskeds = R::findAll('tasked' , 'WHERE user_id IS NOT NULL ORDER BY title ASC'); // ASC | DESC
    return $taskeds;
}

// ___________________________________________________________________________________________________
//GET ALL ASSIGNED TASKS, USERS AND GROUPS 
// ___________________________________________________________________________________________________
function getTaskeds2() {
        $vacations = R::getAll("
        SELECT * FROM user 
        LEFT JOIN tasked ON user.id = tasked.user_id 
        LEFT JOIN task ON task.id = tasked.task_id 
        LEFT JOIN group_task ON task.id = group_task.task_id 
        WHERE tasked.user_id IS NOT NULL ORDER BY tasked.title ASC"); // ASC | DESC
        return $vacations;
}


function getTaskeds() {
    $vacations = R::getAll("
    SELECT * FROM tasked
    INNER JOIN user ON tasked.user_id = user.id 
    INNER JOIN group ON  user.group_id = group.id
    INNER JOIN group_task ON group.id = group_task.group_id    
    INNER JOIN task ON group_task.task_id = task.id 

    WHERE tasked.user_id IS NOT NULL ORDER BY tasked.title ASC"); // ASC | DESC
    return $vacations;
}



// ___________________________________________________________________________________________________
//GET ALL USER VACATIONS
// ___________________________________________________________________________________________________
function getTaskGroupByForeignkey($group_id) {
    $group  = R::findOne( 'group', 'id=?', [$group_id] ); 
    return $group; 
}


// ___________________________________________________________________________________________________
//GET ALL USER VACATIONS
// ___________________________________________________________________________________________________
