<section class="container mt-5">

<?php  
    // var_dump($taskeds) ; 
?> 


<div class="container">
<h2>Completed tasks</h2>
    <br><br>
    <hr>
    <br>
</div>


<!-- ------------------------------------------------- -->  
<!-- TASKEDS LIST FROM MYSQL DB --> 
<!-- ------------------------------------------------- -->  
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id (tasked)</th>
            <th scope="col">Task start</th>
            <th scope="col">Task name</th>
            <th scope="col">Task weekdays</th>
            <th scope="col">Completed user</th>
            <th scope="col">Group</th>
            <th scope="col"></th>

        </tr>
    </thead>
        <!-- TABLE BODY  -->
    <tbody>
        <?php foreach ( $taskeds as $tasked ) { ?>
            <tr>
                <td><?php  echo $tasked['id']?> </td>   <!-- id (tasked) -->
                <td> <?php echo (new DateTime($tasked['start']))->format("d.m.Y") ?></td><!-- start date (tasked) -->
                <td> <?php                     
                        $task = getTaskName($tasked['task_id']); 
                        $task_name = $task["name"];
                        echo $task_name ;                        
                     ?> 
            </td>
            <td><!-- weekdays (of task)-->
                <?php 
                    $datas = json_decode($task['weekdays'], TRUE);        
                    foreach ($datas as $result) { echo $result."<br>"; }
                ?> 
            </td>
                <td><?php echo $tasked['user_name']?> </td><!-- title (tasked user)-->

                <!-- 
                    task_done(s) 
                    <td>< ?php echo $tasked['tasked_done']?></td>               
                -->
                <td><?php echo $tasked['group_name']?> 
                
            
            </td><!-- groupe (task/user)-->

                    <!-- FORM  -->
                <form method="POST">
                    <!-- -------------- -->
                    <!-- BUTTON DELETE  -->
                    <!-- -------------- -->
                    <td>
                        <input type="hidden"  name="id_tasked"  value="<?php echo $tasked['id']?>">
                        <button type="submit" class="btn btn-secondary" value="delete_tasked" name="delete_tasked">Delete</button>
                    </td>           
                </form>    
            </tr>
        <?php } ?>
    </tbody>
    </table>
   
</section> 

