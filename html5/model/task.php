<?php

// -----------------------------------------------
/**
 * Find all tasks
 * @return array of redbean objects
 */
// -----------------------------------------------
function getTasks() {
    return R::findAll( 'task' );
}

// ___________________________________________________________________________________________________
// ___________________________________________________________________________________________________

function pushKeyValuePair(&$array, $key, $value) {
    // Create an associative array with the new key-value pair
    $newElement = [$key => $value];
    // Use array_push to add the associative array to the original array
    array_push($array, $newElement);
}




/**
 * Attributes tasks to users between the given dates
 * @param DateTime object $from
 * @param DateTime object $to 
 */
function gennerateTasks($from, $to){

    // Deletes task who are set in the futur 
    // or not affected (H. BAYTAR )
    $tasked = R::findAll( 'tasked' );

    foreach ($tasked as $t) {

        // H. BAYTAR 
        if($t->title == null || $t->user_id == null || (new DateTime($t->start) >= $from) ){
            R::trash($t);
        }
    }

    // _________________________________________________
    // GET ALL TASKS WITH THEIR GROUP AND USERS
    // _________________________________________________

    $tasks = getAllTasksWithGroupsAndUsers(); 
    // var_dump($tasks); 






    // _________________________________________________
    // WHILE START_DATE < CURRENT_DATE < END_DATE 
    // _________________________________________________
    $objDateTime =  new DateTime($from->format('c')); // ISO 8601 date | Example returned values : 2004-02-12T15:19:21+00:00 
    $unique_tasks = $task_uniques ;  
    while($objDateTime <=  $to){

        // ______________________________________________________________
        // RECOVER TASK NAMES (UNIQUE VALUES ARRAY) FROM DB TASKS LIST
        // ______________________________________________________________
        $task_uniques = array();
        $j = 0; 
        foreach ($tasks as $task) {
            $task_name = $task['task_name']; 
            // echo "<br> size : ".$size; echo "<br><br>"; 
            // echo "<br> task : ".$task_name.", date to do : ". $task[]; 
            print_r($task); 
            echo "<br>"; 

            if(!in_array($task_name, $task_uniques) ){
                    $task_uniques += [$j => $task_name]; 
                    $j++;
                }
        }
        die(); 
        $task_uniques = array_unique($task_uniques, SORT_REGULAR);
        // print_r(array_unique($unique_tasks)); // die(); 
        // Loop through tasks array 
        echo "Line 80 <br>"; 
        foreach($task_uniques as $key => $element) {  echo $key . ": " . $element . "<br>";  } echo "<br>";  // die(); 





        //_______________________________________________________________________________________________________________________
        //_______________________________________________________________________________________________________________________
        //_______________________________________________________________________________________________________________________
        // echo "Line 98 <br>"; 
        // foreach($unique_tasks as $key => $element) { echo $key . ": " . $element . "<br>";  } die(); 

        $unique_tasks = $task_uniques ;  
        foreach ($tasks as $task) {

  
            $task_name = $task['task_name'];      
            if(!empty($task) && in_array($task_name, $unique_tasks) )
            {

                // FOREACH TASK GET Group Users          
                $group_id = $task['grouptask_groupId']; 
                $task_id = $task['id_task']; 

                //_______________________________________________________________________________________________________________________________________
                // OK 
                // echo "Line 108 <br>"; echo $task_name."<br>";
                // ______________________________________________________________________________________________________________________________________ 


                // GET CURRENT TASK WEEKDAYS 
                $weekdays_task = $task['weekdays_task'];     
                $task_weekdays = json_decode($weekdays_task);   


                // IF THIS DAY IS IN THE TASK WEEKDAYS ARRAY 
                // Ex. Wednesday | Friday, Tuesday, Monday, Thursday
                if (in_array($objDateTime->format('l'), $task_weekdays)) { 

                    // FOREACH TASK GET Group Users 
                    $users = getUsersByGroup($group_id, $task_id); // GET USER_LIST  
                    // echo "Line 123 <br>"; print_r($users);  echo " <br>"; die();   

                    /* 
                    // print_r($users);                     
                    echo  $task_name. "<br><br>"; 
                    // Loop through users array 
                    // foreach($users as $element) {  echo $element['name'] . "<br>"; }  die();  
                    */ 

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

                            // if(!empty($user_weekdays)) {
                            if(in_array($weekday, $user_weekdays)) {
                                // ADD USER TO AVAILIBLE LISTE 
                                $work_day = true; 
                            }else{
                                $work_day = false; 
                            }

                            // USER VACATIONS == false 
                            $vacations = getUserVacations($user_id); 
                            $no_vacation = true;

                            foreach($vacations as $vacation){
                                if(!empty($vacation->start) && !empty($vacation->end) ){
                                    $checkdate = (new DateTime($vacation->start)) < $objDateTime && (new DateTime($vacation->end)) > $objDateTime; // true 
                                    if($checkdate) { $no_vacation = false;}else{$no_vacation = true;}
                                }
                            }


                            if($work_day == true && $no_vacation == true) {
                               //  echo "<h1> hello work_day </h1>"; 

                                // ADD USER TO ARRAY     
                                // if(!in_array($user, $unique_users) ){$unique_users[] = $user['id'];}
                                // if(!in_array($user, $unique_users) ){$unique_users[] = $user;}
                                if(!in_array($user, $unique_users) ){
                                    $unique_users += [$i => $user]; 
                                    $i++;
                                }
                                   
                            }



                        }// FOREACH USERS AS USER 

                    }// USER NOT EMPTY 

                    // _______________________________________________________________________________________________________________
                    // _______________________________________________________________________________________________________________
                    // TODO TODO TODO 
                    // _______________________________________________________________________________________________________________
                    // _______________________________________________________________________________________________________________





                                    
                // DELETE TASK NAME FOR REDONDANCE
                // $key = array_search($task_name, $unique_tasks); // if (isset($key)) 
                if (in_array($task_name, $unique_tasks) && !empty($unique_users)) {// NOT EMPTY ARRAY $unique_users    

                        // foreach ($unique_users as $keyUser => $valueUser) { echo $keyUser . " => " . $valueUser['name'] . "<br>"; 
                        // print_r($valueUser); }  echo "Line 198 <br>";

                        // GET RANDOM USER                         
                        $random_key = array_rand($unique_users);
                        $val_randomUser = $unique_users[$random_key]; // VALUE 

                        $tasked = R::dispense( 'tasked' );
                        $tasked->title = $val_randomUser['name']; 
                        $tasked->start = $objDateTime;                        
                        $tasked->user_id =  $val_randomUser['user_id'];
                        $tasked->task_id = $task['id_task'];
                        $tasked_id = R::store($tasked);  


                    // $task_name = $task['task_name'];    
                    // unset($unique_tasks[$task_name]);
                    // $unique_tasks = array_diff($unique_tasks, [$task_name,]);
                    // print_r($unique_tasks); // echo "<br>"; 
                    // echo "Removed task :".$task_name."<br>"; echo "Stored : ".$tasked_id."<br>"; 
                } 
                      

                        // _______________________________________________________________________________________________________________________________________________________
                        // _______________________________________________________________________________________________________________________________________________________
                        // echo "user : ". $tasked->title."  , start : ". $tasked->start.", group :".$task["grouptask_id"]." , task : ". $tasked->task_id."<br> ";  echo "Line 198 <br>"; die(); 
                        // _______________________________________________________________________________________________________________________________________________________
                        // _______________________________________________________________________________________________________________________________________________________

                         
                   
                }// IF $objDateTime IN $weekdays 
                // IF this DAY in $weekdays OF TASK
                
    

                // var_dump($unique_users ); die(); 
                // print_r(array_unique($unique_tasks)); // die(); 
                // Loop through tasks array 
                // echo "Line 237 <br>"; foreach($unique_tasks as $key => $element) {  echo $key . ": " . $element . "<br>";  } //  die(); 



             
        
            }// TASK_NAME FOUND AND TASK NOT EMPTY         
        }// FOREACH TASK 
        // 
        // print_r($unique_tasks); // 
        // die();   
  

        // $unique_tasks = $task_uniques ; // die();   
        date_add($objDateTime, date_interval_create_from_date_string('1 days'));      




    } // WHILE()
    

} // END FUNCTION 



function getUserVacations($user_id){
    $user = R::getAll("SELECT * FROM vacation  WHERE user_id = ?",  [$user_id, ]);
    return $user; 
}


function getUsersByGroup($group_id, $task_id){
    $group = R::getAll("SELECT `user`.`id` AS user_id, 
						`name`, 
                        `email`, 
                        `done_task`, 
                        `user`.`group_id` AS user_groupId,  
                        `weekdays`, 
                        `group_task`.`id` AS groupTask_id, 
                        `group_task`.group_id AS groupTask_groupId, 
                        `group_task`.`task_id` AS groupTask_taskId 
                        FROM user  
                        INNER JOIN  `group_task` ON `group_task`.`group_id` =  `user`.`group_id`
                        WHERE `user`.`group_id`= ? AND   `group_task`.`task_id` = ?",  [$group_id,  $task_id,]);
    // WHERE `user`.`group_id` LIKE 4 AND  `group_task`.`task_id`  LIKE 16;
    return $group; 
}


function getAllTasksWithGroupsAndUsers(){
    // echo "<h1> Tasks </h1>"; 

    /* 

    $tasks = R::getAll("SELECT `task`.id AS id_task, `task`.`name` AS name_task , `task`.`weekdays` AS weekdays_task, `task`.`color` AS color_task, `group_task`.`id` AS id_grouptask, `group_task`.`group_id` AS group_grouptask, `group_task`.`task_id` as  task_grouptask, `group`.`id` AS id_group,  `group`.`name` AS name_group
                        FROM `task` 
                        INNER JOIN  `group_task` ON `task`.`id` =  `group_task`.`task_id`
                        INNER JOIN  `group` ON `group_task`.`group_id` =  `group`.`id` 
                        WHERE `group_task`.`id` > 1");

    */ 
    $tasks = R::getAll("SELECT `task`.id AS id_task, `task`.`name` AS task_name , `task`.`weekdays` AS weekdays_task, `task`.`color` AS color_task, 
                                `group_task`.`id` AS grouptask_id, `group_task`.`group_id` AS grouptask_groupId, `group_task`.`task_id` as  grouptask_taskId
                        FROM `task` 
                        INNER JOIN  `group_task` ON `task`.`id` =  `group_task`.`task_id`
                        WHERE `group_task`.`id` > 1");
                        /* 

                        array(9) {
                            [
                                "id_task"
                            ]=> string(2) "16"[
                                "name_task"
                            ]=> string(10) "Cafeterias"[
                                "weekdays_task"
                            ]=> string(52) "["Monday","Tuesday","Wednesday","Thursday","Friday"]"[
                                "color_task"
                            ]=> string(9) "#1015e3ff"[
                                "id_grouptask"
                            ]=> string(3) "120"[
                                "group_grouptask"
                            ]=> string(1) "4"[
                                "task_grouptask"
                            ]=> string(2) "16"[
                                "id_group"
                            ]=> string(1) "4"[
                                "name_group"
                            ]=> string(10) "Informatik"
                        }

                        */ 
    return $tasks; 
} 


function getTaskByName($element){
    $task = R::getOne("SELECT `task`.id AS id_task, `task`.`name` AS task_name , `task`.`weekdays` AS weekdays_task, `task`.`color` AS color_task, 
    `group_task`.`id` AS grouptask_id, `group_task`.`group_id` AS grouptask_groupId, `group_task`.`task_id` as  grouptask_taskId
    FROM `task` 
    INNER JOIN  `group_task` ON `task`.`id` =  `group_task`.`task_id`
    WHERE `task`.`name` =?",[$element]); 

    // $books  = R::find( 'book', ' rating < :rating ', [ ':rating' => 2 ] );
/* 

array(9) {
[
    "id_task"
]=> string(2) "16"[
    "name_task"
]=> string(10) "Cafeterias"[
    "weekdays_task"
]=> string(52) "["Monday","Tuesday","Wednesday","Thursday","Friday"]"[
    "color_task"
]=> string(9) "#1015e3ff"[
    "id_grouptask"
]=> string(3) "120"[
    "group_grouptask"
]=> string(1) "4"[
    "task_grouptask"
]=> string(2) "16"[
    "id_group"
]=> string(1) "4"[
    "name_group"
]=> string(10) "Informatik"
}

*/ 
return $task; 

}

// ___________________________________________________________________________________________________
// ___________________________________________________________________________________________________

// -----------------------------------------------
// GENERATE TASKS ORIGINAL 
// -----------------------------------------------

function ORIGINAL_gennerateTasks($from, $to){

    $user = R::findAll('user');

    // RESET USER DONE TASK CONFIGURATION TO 0 (ZERO)
    foreach($user as $u){
        $u->doneTask = 0;
        R::store($u);
    }
    
    // Deletes task who are set in the futur or not affected 
    $tasked = R::findAll( 'tasked' );

    foreach ($tasked as $t) {

        /*
            To check whether it is null or not, isset() is enough; 
            For checking whether it is empty or not, you better trim() the string as it removes spaces and spaces are counted as character; 
            If you check emptiness with empty() function.
        */ 

        // H. BAYTAR 
        if($t->title == null || $t->user_id == null || (new DateTime($t->start) >= $from) ){
            R::trash($t);
        }
    }

    
    $tasks = R::findAll( 'task' );


    $objDateTime =  new DateTime($from->format('c')); // ISO 8601 date | Example returned values : 2004-02-12T15:19:21+00:00 


    while($objDateTime <=  $to){

        foreach($tasks as $task) {

            // TASK WEEKDAY ARRAY 
            $weekdays = json_decode($task->weekdays);

            // IF THIS DAY IS IN THE TASK WEEKDAYS ARRAY
            if (in_array($objDateTime->format('l'), $weekdays)) {

                $users = [];



                foreach ($task->sharedGroup as $group) {
                    $users = array_merge($users, $group->ownUserList);
                }


                if($users != []) {

                    // VERIFY IF USER WORK DAY AND VACATION DAYS ARE OK 
                    $availableUser = getAvailableUser($users, $objDateTime->format('l')); 
                    $availableUser = getUserWithoutVacation($availableUser, $objDateTime);

                    // IF USER NOT FREE THIS DAY  
                    if($availableUser != []) {

                        // ______- todo todo 
                        // ______- todo todo 
                        $userLeast = getUserWithLeastTask($availableUser);
                        // ______- todo todo 
                        // ______- todo todo 



                        // GENERATE TASKED 
                        $tasked = R::dispense( 'tasked' ); // To create a new bean (of type 'tasked')  

                        // ADD PROPERTIES NOW
                        $tasked->title = $userLeast->name; 
                        $tasked->user =  $userLeast;
                        $tasked->start = $objDateTime; 
                        $tasked->task = $task;

                        // NOW STORE THE BEAN IN THE DATABASE 
                        R::store($tasked);

                    }
                }
            }
        }
        date_add($objDateTime, date_interval_create_from_date_string('1 days'));
    } 
}







// ___________________________________________________________________________________________________
// ___________________________________________________________________________________________________

// -----------------------------------------------
// No idea what this is about but why not 
// -----------------------------------------------

function checkRelation ($group, $groupList){
    $result = false;

    foreach ($groupList as $g) {
        if($group->id == $g->id) {
            $result = true;
        }
    }

    return $result;
}


// -----------------------------------------------
// -----------------------------------------------
// -----------------------------------------------
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


// -----------------------------------------------
// -----------------------------------------------
// -----------------------------------------------
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
// ___________________________________________________________________________________________________
/**
 * Searches users who have done the least task 
 * @param $user array of redbean objects list of users to check
 * @return $user array of redbean objects
 */
function getUserWithLeastTask($user) {
    $least = 1000000000;
    $usersOutput = [];
    foreach ($user as $u) {
        if($least > $u->doneTask) {
            $least = $u->doneTask;
        }
    }
    foreach ($user as $u) {
        if ($u->doneTask == $least) {
            $usersOutput[] = $u;
        }
    }
    
    $usersOutput[0]->doneTask += 1;
    R::store($usersOutput[0]);
    return $usersOutput[0];
}

// -----------------------------------------------
/**
 * changes the current holder of a task 
 * @param integer $tasked_id 
 */
// -----------------------------------------------
function randomPersonForTask ($tasked_id) {
    $tasked = R::load('tasked', $tasked_id);
    $users = [];
    foreach ($tasked->task->sharedGroup as $group) {
        $users = array_merge($users, $group->ownUserList);
    }
    $users = getAvailableUser($users, (new DateTime($tasked->date))->format('l'));
    $users = getUserWithoutVacation($users, $tasked->date);


    // ______- todo todo 
    // ______- todo todo 
    $user = getUserWithLeastTask($users);
    // ______- todo todo 
    // ______- todo todo 

    
    $tasked->title = $user->name; 
    $tasked->user =  $user;
    R::store($tasked);
    return $tasked;
}

// -----------------------------------------------
/**
 * changes the current holder of a task for the given $user
 * @param integer $tasked_id 
 * @param integer $user 
 */
// -----------------------------------------------
function changePersonForTask ($tasked_id, $user) {
    $tasked = R::load('tasked', $tasked_id);
    $user = R::load('user', $user);
    $tasked->title = $user->name; 
    $tasked->user =  $user;
    R::store($tasked);
    return $tasked;
}



// ___________________________________________________________________________________________________
// ___________________________________________________________________________________________________

// -----------------------------------------------
/**
 * Formats the tasked task to be display in full callenndar
 * @return 
 */
// -----------------------------------------------
function getTaskedAdmin_Original() {
    $taskeds = R::findAll( 'tasked' );
    $array = [];

    foreach ($taskeds as $tasked) {
        $task['title'] = $tasked->title;
        $task['start'] = $tasked->start;
        $task['backgroundColor'] = $tasked->task->color;
        $task['borderColor'] = $tasked->task->color;
        $task['allDay'] = true;
        $task['url'] = '/html/admin/sick.php?tasked_id=' . $tasked->id;
        $array[] = $task;
    }
    return $array;
}


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

// -----------------------------------------------
/**
 * Formats the tasked task to be display in full callenndar
 * @return 
 */
// -----------------------------------------------
function getTasked_Original() {
    $taskeds = R::findAll( 'tasked' );
    $array = [];

    foreach ($taskeds as $tasked) {
        $task['title'] = $tasked->title;
        $task['start'] = $tasked->start;
        $task['backgroundColor'] = $tasked->task->color;
        $task['borderColor'] = $tasked->task->color;
        $task['allDay'] = true;

        $array[] = $task;
    }
    return $array;
}


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


