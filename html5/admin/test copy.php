<?php
session_start();

if($_SESSION["login"]) {
require '../config.php';
require 'vue/partials/header.php';
include '../utils/connectdb.php';
require '../model/task.php';
require 'vue/partials/nav.php';

$tasks = getTasks();

?>



<!-- ------------------------------------------------- -->    
<!-- Page title & Button Create (Insert into db.table ) -->     
<!-- ------------------------------------------------- -->     
 
<section class="container mt-5">
    <div class="container">
        <!-- Title -->    
        <h2>Index</h2>
        
        <br>
        <hr>
        <br>

        <!-- ------------------------------------------------- -->    
        <!-- Button to open Modal Window -->     
        <!-- ------------------------------------------------- --> 



        <?php
            $date=date_create("2013-03-15");
            date_add($date,date_interval_create_from_date_string("40 days"));
            echo "<h1> Date: ".date_format($date,"Y-m-d")."</h1>";
            echo "<br><br>";
        ?> 


<?php 
    $tasks = getAllTasksWithGroupsAndUsers(); 
 

    foreach($tasks as $task){   
       // var_dump($task);
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



        /* 

        $task_name = $task['name_task'];         
        echo " Task name : ".$task_name." ";
        echo "<br>";


        Name : Cafeterias
        Name : Staubsauger / Aspirateur INF
        Name : Müll / Déchets INF
        Name : Cafeterias
        Name : Müll / Déchets MDE
        Name : Staubsauger / Aspirateur MDE
        Name : Cafeterias
        Name : Müll, Shredder, Altpapier / Déchets, Déchiqueteuse, Vieux papier VER
        Name : Staubsauger / Aspirateur VER 
        */ 

        // FOREACH TASK GET Group Users 
        $group_id = $task['id_group']; 
        $users = getUsersByGroup($group_id); 


        // GET TASKS WEEKDAYS 
        $weekdays_task = $task['weekdays_task'];     
        $task_weekdays = json_decode($weekdays_task);   
        // print_r($task_weekdays); // Print ARRAY 

        // 
        echo " Task days : <br>";
        foreach($task_weekdays as $day_task){
            echo $day_task."<br>";
            /* 
            Task days :
            Monday
            Tuesday
            Wednesday
            Thursday
            Friday
            */ 

        }


        // var_dump($users ); 
        foreach($users as $user){
            echo "<br>";
            $user_name = $user['name'];   
            echo " User name : ".$user_name." ";
            echo "<br>";

            $weekdays_user =  $user['weekdays'];   
            $user_weekdays = json_decode($weekdays_user);   
            print_r($user_weekdays); 
            echo "<br>";
            echo " User work day(s) : <br>";
            foreach($user_weekdays as $day_user){
                echo $day_user." ";
                echo "<br>";
    
            }


            // var_dump(); 


            /* 

            // ___________________________________________________
            $task_name = $task['name_task'];         
            $name_group = $task['name_group'];         
            echo " Group name : ".$name_group. "<br> Task name : ".$task_name." ";;
            echo "<br><br>";


            echo "<br>";
            $user_name = $user['name'];   
            echo " User name : ".$user_name." ";
            echo "<br>";

            // ___________________________________________________


            Task name : Cafeterias
            Group name : MediaDesign 

            User name : Alex Salesse
            User name : Noé Serravezza
            User name : Nicolas Savoy
            User name : Keenan Thurnes
            User name : Rafael Marques
            User name : Gabriel Fasel
            User name : Lionel Hofer
            User name : Diogo Da Silva
            User name : Gabriel Duarte
            User name : Sam Mpendubundi
            User name : Bruno Zucchetti
            User name : Cindy Dos Santos
            User name : Killian Vallat
            User name : Immanuel Studer
            User name : Jessy Jacot 
            ------------------------------------------------
            Task name : Cafeterias
            Group name : Verwaltung

            User name : Julian Schwaar
            User name : Livio Vogt
            User name : Darlyn Hernandez
            User name : Mara Meier
            User name : Lisa Blumenthal
            User name : Aaron Soltermann
            User name : Ariana Grzyb
            User name : Gracia Kamwanya Kamunga
            User name : Leonora Trena
            User name : Pereira Jessica
            ------------------------------------------------
            Task name : Staubsauger / Aspirateur VER
            Group name : Verwaltung

            User name : Julian Schwaar
            User name : Livio Vogt
            User name : Darlyn Hernandez
            User name : Mara Meier
            User name : Lisa Blumenthal
            User name : Aaron Soltermann
            User name : Ariana Grzyb
            User name : Gracia Kamwanya Kamunga
            User name : Leonora Trena
            User name : Pereira Jessica 
            ------------------------------------------------

            */ 


            // Verifier disponibilité de USER 
            // VACATION & WEEKDAYS 

        }

        echo "<br><br>";

    }
?> 






</div>
</div>

</section>



<?php
}
require 'vue/partials/footer.php';


