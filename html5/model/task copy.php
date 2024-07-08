<?php
// -----------------------------------------------
/**
 * Create an task
 * @param string $name of the task  
 * @param string $color of the task
 * @param array $weekdays on which the task should complete must be an array
 * @param integer $group_ids
 */
// -----------------------------------------------
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

// -----------------------------------------------
/**
 * updates an task
 * @param integer $id of the task  
 * @param string $name of the task  
 * @param string $color of the task
 * @param array $weekdays on which the task should complete must be an array
 * @param integer $group_ids
 */
// -----------------------------------------------
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

// -----------------------------------------------
/**
 * deletes an task
 * @param integer $id of the task
 */
// -----------------------------------------------
function deleteTask($id) {
    $task = R::load( 'task', $id ); 
    foreach($task->ownTaskedList as $tasked){
        R::trash($tasked);
    }
    R::trash($task);
}


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
/**
 * Attributes tasks to users between the given dates
 * @param DateTime object $from
 * @param DateTime object $to 
 */
function gennerateTasks($from, $to){

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

    /* 
    <?php 
        $date = new \DateTime('NOW');
        $formatedDate_1 = $date->format('l'); // Jour de la semaine en anglais, ex. Tuesday
        $formatedDate_2 = $date->format('c');// Date, ex. 2024-06-25T14:56:43+02:00

        echo "<h1>".$formatedDate_1."<h1>"; 
        echo "<h1>".$formatedDate_2."<h1>"; 
    ?> 
    */ 
    
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


function gennerateTasks1($from, $to){


    // Get USERS in a ARRAY 
    $users = R::findAll('user'); 

    // Get TASKS in a ARRAY 
    $tasks = R::findAll( 'task' );


    // Get TASKED in a ARRAY 
    $taskeds = R::findAll( 'tasked' );   
    

    // Deletes TASKEDS 
    R::wipe('tasked'); // R::wipe('tablename'); 


    // FROM FIRSTT DAY TO LAST DAY (FROM 1. OF THE MONTH TO 31 DAYS) 
    $objDateTime =  new DateTime($from->format('c')); // ISO 8601 date | Example returned values : 2004-02-12T15:19:21+00:00 
    while($objDateTime <=  $to){



        // FOR EACH TASK 
        // GET WEEKDAY OF THE TASK (ARRAY) TO BE GENERATE         
        foreach($tasks as $task) {

            // TASK WEEKDAY ARRAY 
            $weekdays = json_decode($task->weekdays);

            // IF THIS DAY IS IN THE TASK WEEKDAYS ARRAY
            if (in_array($objDateTime->format('l'), $weekdays)) {

                // FOR EACH USER 
                // LOOK FOR USER WHO WORKS THIS DAY AND HAS NO VACACTIONS 
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




    // Reset OF TABLE TASKED -> FALSE TO DO -> TO CREATE NEW TASKEDS 



    // echo "<h1> TASKEDS </h1>" ; 
    // var_dump($taskeds); 



    


}



/* 
< ?php
    $date = date_create('2019-01-01');
    date_add($date, date_interval_create_from_date_string('1 year 35 days'));
    echo date_format($date, 'Y-m-d');
?> 

*/ 







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
        $weekdays = json_decode($user->weekdays);
        if($weekdays) {
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


