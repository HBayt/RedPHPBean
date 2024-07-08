<?php

// _____________________________________________________________________________________
// INSERT  an task INTO TABLE "task" (DATABASE)  
// _____________________________________________________________________________________
 function createTask ($name, $color, $weekdays, $group_ids) {
    $task = R::dispense( 'task' );
    $task->name = $name;
    $task->weekdays = json_encode($weekdays);
    $task->color = $color;
    foreach ($group_ids as $id) {
        $group = R::load('group', $id);
        $task->sharedGroupList[] = $group;
    }
    R::store($task);
}

// _____________________________________________________________________________________
// UPDATES an task FROM TABLE "task" (DATABASE)  
// _____________________________________________________________________________________
function updateTask ($id, $name, $color, $weekdays, $group_ids) {
    $task = R::load('task', $id);
    $task->name = $name;
    $task->weekdays = json_encode($weekdays);
    $task->color = $color;
    $tasks = R::find('group_task', 'task_id = ' . $id);
    foreach($tasks as $t) {
        R::trash($t);
    }
    foreach ($group_ids as $id) {
        $group = R::load('group', $id);
        $task->sharedGroupList[] = $group;
    }
    R::store($task);
}
// _____________________________________________________________________________________
// DELETE an task BY ITS ID (FROM THE "task" DATABASE TABLE) 

// _____________________________________________________________________________________
function deleteTask($id) {
    $task = R::load( 'task', $id ); 
    foreach($task->ownTaskedList as $tasked){
        R::trash($tasked);
    }
    R::trash($task);
}


// H. BAYTAR 

// _____________________________________________________________________________________
// GET ALL GROUP_TASK ROWS BY THE GIVEN TASK ID 
// _____________________________________________________________________________________
function getGroupTasksByTaskId($task_id) {
    $groupTasks = R::getAll("SELECT * FROM `group_task` WHERE `task_id` =?",[$task_id]); 
    return $groupTasks;
}


// ___________________________________________________________________________________________________
// Attributes tasks to users between the given dates ($from, $to)
// ___________________________________________________________________________________________________

function gennerateTasks($from, $to){

    // RESET TABLE "Tasked" (REMOVE ALL OCCURENCES)
    $tasked = R::findAll( 'tasked' ); 
    foreach ($tasked as $t) {
        R::trash($t); 
    }

    // RESET AUTO INCREMENT PRIMYARY KEY VALUE 
    R::exec( "ALTER TABLE `tasked` AUTO_INCREMENT=1" );  

 
    // _________________________________________________
    // GET ALL TASKS WITH THEIR GROUP AND USERS
    // _________________________________________________

    // $tasks = getAllTasksWithGroupsAndUsers(); 
    $tasks = getTasks() ; 
    // var_dump($tasks); 

    foreach ($tasks as $task) {
        $task_name = $task['name']; 
        $task_weekdays = $task['weekdays']; 
        // echo "<br><br>"; 
        // print_r($task); echo "<br>"; 
    }

    // _________________________________________________
    // WHILE START_DATE < CURRENT_DATE < END_DATE 
    // _________________________________________________
    $objDateTime =  new DateTime($from->format('c')); // ISO 8601 date | Example returned values : 2004-02-12T15:19:21+00:00 
    while($objDateTime <=  $to){

        // FOR ALL TASKS IN THE DATABSE "TASK" TABLE 
        $auto_increment_value = 1; 
        foreach ($tasks as $task) {
            // GET TASK NAME 
            $task_name = $task['name'];     
            
            // IF TASK EXISTT 
            if(!empty($task)){ 

                // GET TASK ID 
                $task_id = $task['id']; 
                // GET GROUP OF TASK (RANDOM ) 
                $group_tasks = getGroupTasksByTaskId($task_id); 

                // GET RANDOM GROUP_ID    
                if (!empty($group_tasks)) {

                    $random_groupkey = array_rand($group_tasks); // RADOM KEY 
                    $val_randomGroupTask = $group_tasks[$random_groupkey]; // VALUE OF RADOM KEY 
                    $group_id = $val_randomGroupTask['group_id']; 
                    // echo "<h1> ".$group_id."</h1>"; 
                    // print_r($val_randomGroupTask); 
                    // die() ;                     
                }

                // GET CURRENT TASK WEEKDAYS 
                $weekdays_task = $task['weekdays'];     
                $task_weekdays = json_decode($weekdays_task);   

                // IF CURRENT_ DAY IS IN THE "TASK WEEKDAYS" ARRAY 
                // Ex. Wednesday | Friday, Tuesday, Monday, Thursday
                if (in_array($objDateTime->format('l'), $task_weekdays)) { 

                    // FOREACH TASK GET Group Users 
                    $users = getUsersByGroup($group_id, $task_id); // GET USER_LIST  
                    // echo "Line 123 <br>"; print_r($users);  echo " <br>"; die();   

                    // ____________________________________________
                    // USERS PROCESSING/TREATMENT 
                    // ____________________________________________
                    $unique_users = array();
                    $i = 0; 
                    if(!empty($users)) 
                    {
                        $weekday = $objDateTime->format('l'); 
                        foreach ($users as $user) {
                            $user_id = $user['user_id']; 

                            // USER WEEKDAYS SHOULD BE TRUE  
                            $user_weekdays = json_decode($user['weekdays']);   
                            $work_day = false; 


                            // IF "TASK_DAY" IN "USER_WEEKDAYS"
                            if(in_array($weekday, $user_weekdays)) {
                                // ADD USER TO AVAILIBLE LISTE 
                                $work_day = true; 
                            }else{
                                $work_day = false; // INCOMPATIBLE USER
                            }

                            // USER VACATIONS == false 
                            $vacations = getUserVacations($user_id); 
                            $no_vacation = true;

                            // FOR EACH USER VACTION 
                            foreach($vacations as $vacation){
                                // IF VACATION IS EXIST 
                                if(!empty($vacation->start) && !empty($vacation->end) ){
                                    // CHECK IF TODAY ARE COMPATIBLE WITH VACATION_DAYS 
                                    $checkdate = (new DateTime($vacation->start)) < $objDateTime && (new DateTime($vacation->end)) > $objDateTime; // true 
                                    if($checkdate) { 
                                        $no_vacation = false; // USER IS COMPATIBLE 
                                    }else{
                                        $no_vacation = true; // INCOMPATIBLE USER
                                    } 
                                }
                            }
                            // CHECK 
                            // IF TODAY IS USER WORK DAY && IF USER DOES NOT HAS LEAVE/HOLIDAY (VACATION) 
                            if($work_day == true && $no_vacation == true) {
                                // ADD USER TO ARRAY     
                                if(!in_array($user, $unique_users) ){
                                    $unique_users += [$i => $user]; 
                                    $i++;
                                }                                
                            }
                        }// FOREACH USERS AS USER 
                    }// USER NOT EMPTY                 

                    // INSERT INTO TABLE TASKED (DATABASE)
                    // ASSIGN USER TO TASK 
                    if (!empty($unique_users)) {

                            // GET RANDOM USER                         
                            $random_key = array_rand($unique_users);
                            $val_randomUser = $unique_users[$random_key]; // VALUE 

                            // CREATE TASKED    
                            $tasked = R::dispense( 'tasked' );

 
                            $tasked->title = $val_randomUser['name']; 
                            $tasked->start = $objDateTime;                        
                            $tasked->user_id =  $val_randomUser['user_id'];
                            $tasked->task_id = $task['id'];
                           
                            // INSERT TASKED INTO DATABASE 
                            R::store($tasked);  

                    } // IF NOT EMPTY "UNIQUE" USERS ARRAY 
                   
                }// IF $objDateTime IN $weekdays 
                // IF this DAY in $weekdays OF TASK

                // var_dump($unique_users ); die(); 
                // print_r(array_unique($unique_tasks)); // die(); 
                // Loop through tasks array 
                // echo "Line 237 <br>"; foreach($unique_tasks as $key => $element) {  echo $key . ": " . $element . "<br>";  } //  die(); 
                 
            }// TASK NOT EMPTY         
        }// FOREACH TASK 
        date_add($objDateTime, date_interval_create_from_date_string('1 days'));      
    } // WHILE()
} // END FUNCTION 

// ___________________________________________________________________________________________________
//GET ALL USER VACATIONS
// ___________________________________________________________________________________________________
function getUserVacations($user_id){
    $user = R::getAll("SELECT * FROM vacation  WHERE user_id = ?",  [$user_id, ]);
    return $user; 
}

// ___________________________________________________________________________________________________
// GET ALL USERS BY THE GIVEN GROUP ID AND TASK ID
// ___________________________________________________________________________________________________
function getUsersByGroup($group_id, $task_id){
    $group = R::getAll("SELECT `user`.`id` AS user_id, `name`, `email`, `done_task`, `user`.`group_id` AS user_groupId, `weekdays`, `group_task`.`id` AS groupTask_id, `group_task`.group_id AS groupTask_groupId, `group_task`.`task_id` AS groupTask_taskId FROM user INNER JOIN  `group_task` ON `group_task`.`group_id` =  `user`.`group_id` WHERE `user`.`group_id`= ? AND   `group_task`.`task_id` = ?",  [$group_id,  $task_id,]);
    // WHERE `user`.`group_id` LIKE 4 AND  `group_task`.`task_id`  LIKE 16;
    return $group; 
}



// _____________________________________________________________________________________
// FIND ALL TASKS AND RETURN AN ARRAY OF REDBEANPHP OBJECTS 
// _____________________________________________________________________________________
function getTasks() {
    return R::findAll( 'task' );
}

// ___________________________________________________________________________________________________
// RETURN AN AVAILABLE USER 
// TAKES A LIST OF USERS AND THE DAY (OF THE TASK) AS PARAMETERS 
// ___________________________________________________________________________________________________
function getAvailableUser($users, $weekday) {
    $AvailableUser = [];
    foreach ($users as $user) {
        if(! empty($user->weekdays)){
            $weekdays = json_decode($user->weekdays);
        }
      
        //  if(! empty($weekdays)) {
        if(! empty($weekdays)) {
            if(in_array($weekday, $weekdays)) {
                $AvailableUser[] = $user;
            }
        }
    }
    return $AvailableUser;
}

// ___________________________________________________________________________________________________
// RETURN AN USER WITHOUT VACATION 
// TAKES A LIST OF USERS AND THE DAY (OF THE TASK) AS PARAMETERS 
// ___________________________________________________________________________________________________
function getUserWithoutVacation ($users, $date) {
    $AvailableUser = [];
    for($i = 0; $i < count($users); $i++){

        $add = true;
        foreach($users[$i]->ownVacationList as $vacation){
            $checkdate = (new DateTime($vacation->start)) < $date && (new DateTime($vacation->end)) > $date; // true OR false 
            // vacation == true 
            if($checkdate) { $add = false;}
        }
        // $add == true 
        if($add) {
            $AvailableUser[] = $users[$i];
        }
    }
    return $AvailableUser ;
}

// ___________________________________________________________________________________________________
// CHANGES THE CURRENT HOLDER/USER OF A TASK 
// TAKES THE ASSIGNEMENT "ID" TO BE CHANGED AS PARAMETERS 
// ___________________________________________________________________________________________________
function randomPersonForTask ($tasked_id) {
    $tasked = R::load('tasked', $tasked_id);
    $users = [];
    foreach ($tasked->task->sharedGroup as $group) {
        $users = array_merge($users, $group->ownUserList);
    }
    $users = getAvailableUser($users, (new DateTime($tasked->date))->format('l'));
    $users = getUserWithoutVacation($users, $tasked->date);

	$random_userkey = array_rand($users); // RADOM KEY 
	$val_randomUser = $users[$random_userkey]; // VALUE OF RADOM KEY 
    $user = $val_randomUser; 
    $tasked->title = $user->name; 
    $tasked->user =  $user;
    R::store($tasked);
    return $tasked;
}

// ___________________________________________________________________________________________________
// CHANGES THE CURRENT HOLDER/USER OF A TASK 
// TAKES THE ASSIGNEMENT "ID" TO BE CHANGED AND THE NEW USER AS PARAMETERS 
// ___________________________________________________________________________________________________
function changePersonForTask ($tasked_id, $user) {
    $tasked = R::load('tasked', $tasked_id);
    $user = R::load('user', $user);
    $tasked->title = $user->name; 
    $tasked->user =  $user;
    R::store($tasked);
    return $tasked;
}

// ___________________________________________________________________________________________________
// FORMAT THE TASKEDS TO BE DISPLAY IN FULL CALLENDAR  
// ALL TASKEDS WILL BE DISPLAY WITH AN URL TO MANAGE THE SICK SITUATION (WITH INVALID SITUATION) 
// RETURN ALL ASSIGNED TASKS (REDBEANPHP OBJECTS) 
// ___________________________________________________________________________________________________
function getTaskedAdmin() {
    $taskeds = R::findAll( 'tasked' );
    $array = [];

    foreach ($taskeds as $tasked) {

        $group_name = $tasked->user->group->name;
        $task['group_label'] = substr($group_name, 0, 3);
        $task['title'] = $tasked->title." ".strtoupper($task['group_label']);
        // $task['title'] = $tasked->title;        

        $task['start'] = $tasked->start;
        $task['backgroundColor'] = $tasked->task->color;
        $task['borderColor'] = $tasked->task->color;
        $task['allDay'] = true;
        $task['url'] = '/html/admin/sick.php?tasked_id=' . $tasked->id; 

        $array[] = $task;
    }
    return $array;
}

// ___________________________________________________________________________________________________
// FORMAT THE TASKEDS TO BE DISPLAY FOR EVERYONE (WITHOUT URL TO MANAGE SICK SITUATION)
// RETURN ALL ASSIGNED TASKS (REDBEANPHP OBJECTS) 
// ___________________________________________________________________________________________________
function getTasked() {
    $taskeds = R::findAll( 'tasked' );
    $array = [];

    foreach ($taskeds as $tasked) {

        $task['start'] = $tasked->start;
        $task['backgroundColor'] = $tasked->task->color;
        $task['borderColor'] = $tasked->task->color;
        $task['allDay'] = true;

        $group_name = $tasked->user->group->name;
        $task['group_label'] = substr($group_name, 0, 3);
        $task['title'] = $tasked->title." ".strtoupper($task['group_label']);
        // $task['title'] = $tasked->title;

        $array[] = $task;
    }
    return $array;
}



// ___________________________________________________________________________________________________
// // USED IN FILe ModalTask (Button Update in http://localhost/html/admin/task.php)
// TO DISPLAY HTML CHECKED LIST 
// ___________________________________________________________________________________________________

function checkRelation ($group, $groupList){
    $result = false;

    foreach ($groupList as $g) {
        if($group->id == $g->id) {
            $result = true;
        }
    }

    return $result;
}


