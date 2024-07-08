<section class="container mt-5">

<?php  
    // var_dump($taskeds) ; 
?> 


<div class="container">
<h2>Completed tasks</h2>
    <!-- ------------------------------------------------- -->  
    <!-- Link to a Modal window to create a new Tasked -->  
    <!-- ------------------------------------------------- -->   
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTaskedModal" style="float: right;">Create </button>
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
            <th scope="col">Done(?)</th>
            <th scope="col">Group</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
        <!-- TABLE BODY  -->
    <tbody>
        <?php foreach ( $taskeds as $tasked ) { ?>
            <tr>
                <td>aa  <?php  echo $tasked['id']?> </td>   <!-- id (tasked) -->
                <td> <?php echo (new DateTime($tasked['start']))->format("d.m.Y") ?></td><!-- start date (tasked) -->
                <td> <?php 
                    // print_r(array_keys($tasked));
                    // print_r(array_values($tasked));      
                    // <?php print_r(array_keys($tasked)); echo "<br>"; print_r(array_values($tasked));                
                     echo $tasked['name']; ?> 
            </td><!-- weekdays (of task)-->
            <td><?php 
                    $datas = json_decode($tasked['weekdays'], TRUE);        
                    foreach ($datas as $result) { echo $result."<br>"; }
                ?> 
            </td>
                <td><?php echo $tasked['title']?> </td><!-- title (tasked user)-->
                <td><?php echo $tasked['done_task']?></td><!-- task_done(s) -->
                <td><?php $group = getTaskGroupByForeignkey($tasked['group_id']); echo $group['name']; ?> </td><!-- groupe (task/user)-->

                    <!-- FORM  -->
                <form method="POST">
                    <!-- -------------- -->
                    <!-- BUTTON DELETE  -->
                    <!-- -------------- -->
                    <td>
                        <input type="hidden"  name="id_tasked"  value="<?php echo $tasked['id']?>">
                        <input type="hidden"  name="id_user"  value="<?php echo $tasked['user_id']?>">
                        <input type="hidden"  name="id_task"  value="<?php echo $tasked['task_id']?>">

                        <button type="submit" class="btn btn-secondary" value="delete_tasked" name="delete_tasked">Delete</button>
                    </td>

                    <!-- -------------- -->
                    <!-- ACTION UPDATE  -->
                    <!-- -------------- -->
                    <td><?php require 'partials/modalUpdateVacation.php';?></td>              
                </form>    
            </tr>
        <?php } ?>
    </tbody>
    </table>

    <!-- -------------- -->
    <!-- Modal-CREATE -->
    <!-- -------------- -->
    <div class="modal fade" id="createTaskedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a tasked (task/user)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>start</label>
                            <input type="date" class="form-control" id="start" name="start" value="" placeholder="start ...">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>end</label>
                            <input type="date" class="form-control" id="end" name="end" value="" placeholder="end ...">
                        </div>
                    </div> 
                    <div class="modal-body">
                        <div class="form-group">
                            <label>User email</label>
                            <input type="text" class="form-control" id="mail" name="mail" value="" placeholder="user email ...">
                        </div>
                    </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  name="create_vacation" class="btn btn-primary">Create</button>
                    </div>   


                </form>
            </div>
        </div>
    </div> <!-- End .Modal-Create -->








    
</section>