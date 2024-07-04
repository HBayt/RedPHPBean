<?php 
session_start();

if($_SESSION["login"]) {



    // ________________________________________________________________
    // REQUIRE & INCLUDE 
    // ________________________________________________________________
    require '../config.php';
    include '../utils/connectdb.php';
    require '../model/task.php';



    // ________________________________________________________________
    // TASK GENERATOR 
    // ________________________________________________________________

    if(isset($_POST['from'])) {

        $from = new DateTime($_POST['from']);
        $to = new DateTime($_POST['from']);

        // date_add($to, date_interval_create_from_date_string('1 month')); // GENERATOR for 1 month (32 days)
        date_add($to, date_interval_create_from_date_string('31 days')); // GENERATOR for 40 days 
        gennerateTasks($from, $to);
    } 
        

    
    header('Location: ' . $_SERVER['HTTP_REFERER']); 



        // ["noLoad":protected]=> bool(false) ["all":protected]=> bool(false) ["castProperty":protected]=> NULL } }
        // Warning: Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\html\model\task.php:157) in C:\xampp\htdocs\html\admin\generateTasks.php on line 29
    } else {
        header("Location: /html/admin/");
    } 