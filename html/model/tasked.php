<?php 


function getAllTaskeds() {
    $taskeds = R::findAll('tasked' , 'WHERE user_id IS NOT NULL ORDER BY title ASC');
    return $taskeds;
}


function getTaskeds() {
        $vacations = R::getAll("SELECT * FROM user LEFT JOIN tasked ON user.id = tasked.user_id LEFT JOIN task ON task.id = tasked.task_id WHERE tasked.user_id IS NOT NULL ORDER BY tasked.title DESC");
        return $vacations;
    }

