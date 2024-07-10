<?php 


// ___________________________________________________________________________________________________
//GET ALL ASSIGNED TASKS, USERS AND GROUPS 
// ___________________________________________________________________________________________________
function getTaskeds() {
    // $taskeds = R::findAll('tasked' , 'WHERE user_id IS NOT NULL ORDER BY title ASC'); // ASC | DESC
    $vacations = R::getAll("SELECT `tasked`.`id`, `tasked`.`start`, `tasked`.`done_task` AS tasked_done, `tasked`.`user_id` AS tasked_user, `tasked`.`task_id`, `user`.`name` AS user_name, email, `user`.`weekdays` AS user_weekdays, `group`.`name` AS group_name FROM `tasked` INNER JOIN `user` ON `tasked`.`user_id` = `user`.`id` INNER JOIN `group` ON  `user`.`group_id` = `group`.`id` WHERE `tasked`.`user_id` IS NOT NULL ORDER BY `tasked`.`id` ASC"); // ASC | DESC
    return $vacations;
}


// ___________________________________________________________________________________________________
//GET TASK NAME BY TASK ID GIVEN IN PARAMETER
// ___________________________________________________________________________________________________
function getTaskName($task_id) {
    $task  = R::findOne( 'task', 'id=?', [$task_id] ); 
    return $task; 
}
    
// ___________________________________________________________________________________________________
// DELETE TASKED BY TASKED_ID GIVEN IN PARAMETER
// ___________________________________________________________________________________________________
function deleteTasked($id) {
    $tasked = R::load( 'tasked', $id ); 
    R::trash( $tasked );
}




