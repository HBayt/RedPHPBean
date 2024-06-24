<section class="container mt-5">




<div class="container">
    <h2>Vacations</h2>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" style="float: right;">Create </button>
    <br><br>
    <hr>
    <br>
</div>

    <?php
        //session must be started before anything is echoed to the browser
        // if(session_status()===PHP_SESSION_NONE) session_start();

        //capture the message if it exists, or set $msg to null

        /* 

        if(!empty($_SESSION['message'])){
            $msg = $_SESSION['message'];
           
            unset($_SESSION['message']); //delete the message
        }else{$msg = null;}

        echo $msg; 

        */ 

    ?>


    <!-- TABLE VACATION  -->
    <table class="table">
         <!-- TABLE HEADE  -->
        <thead>
            <tr>
                <th scope="col">id (vacation)</th>
                <th scope="col">start (vacation)</th>
                <th scope="col">end (vacation)</th>
                <th scope="col">email (user)</th>
                <th scope="col">name (user) </th>
                <th scope="col"></th>
                <th scope="col"></th>

            </tr>
        </thead>
         <!-- TABLE BODY  -->
        <tbody>
   
            <?php 
                // var_dump($vacations ); 
                //  var_dump($vacation['id'] ) 
            ?>

            <?php foreach ( $vacations as $vacation ) { ?>
                <tr>
                <td> <?php  echo $vacation['id']?> </td>
                    <td> <?php echo (new DateTime($vacation['start']))->format("d.m.Y") ?></td>
                    <td> <?php echo (new DateTime($vacation['end']))->format("d.m.Y") ?> </td>
                    <td> <?php echo $vacation['email']  ?></td>
                    <td> <?php echo $vacation['name'] ?> </td>



                     <!-- FORM  -->
                    <form method="POST">
                        <!-- BUTTON DELETE  -->
                        <td><input type="hidden"  name="id_vacation"  value="<?php echo $vacation['id']?>">
                        <button type="submit" class="btn btn-secondary" value="delete_vacation" name="delete_vacation">Delete</button></td>
                        <!-- ACTION MODIFIER  -->
                        <td><?php require 'partials/modalVacation.php';?></td>              
                    </form>    
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <!-- Modal-CREATE -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a vacation</h5>
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