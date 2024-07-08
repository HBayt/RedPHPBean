<!-- Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal"  name="update_vacation" 
    data-target="#updateModal-<?php echo $vacation['id']?>">
    Update
</button>

<!-- Modal -->
<div class="modal fade" id="updateModal-<?php echo $vacation['id'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update vacation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- FORM -->
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" id="id_vacation" name="id_vacation" value="<?php echo$vacation['id']?>">

                    <!--FORM.INPUT (VACATION START) -->
                    <div class="form-group">
                        <label for="start">Start date</label>
                        <input type="text" class="form-control" id="start" name="start"
                            value="<?php echo (new DateTime($vacation['start']))->format("d.m.Y") ?>"
                            placeholder="Start date">
                    </div>

                    <!--FORM.INPUT (VACATION END ) -->
                    <div class="form-group">
                        <label for="end">End date</label>
                        <input type="text" class="form-control" id="end" name="end"
                            value="<?php echo (new DateTime($vacation['end']))->format("d.m.Y") ?>"
                            placeholder="End date">
                    </div>


                    <!--FORM.INPUT (VACATION User name ) 
                    <div class="form-group">
                        <label for="name">User name</label>
                        <input type="text" class="form-control" id="user_name" name="user_name"
                            value="< ?php echo$vacation['name'] ?>"
                            placeholder="user_name">
                    </div>                    
                    -->


                    <!--FORM.INPUT (VACATION User email ) -->
                    <div class="form-group">
                        <label for="email">User e-mail</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="<?php echo$vacation['email'] ?>"
                            placeholder="email">
                    </div>


                    <input type="hidden" id="user_id" name="user_id" value="<?php echo$vacation['user_id']?>">


                </div>


                <!-- BUTTONS (Close / Save changes) -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="save_changes" class="btn btn-primary">Save changes</button>
                </div>
            </form> <!-- END .FORM -->

        </div>
    </div>
</div>


<?php 
// var_dump($vacation['id'] ) 
// var_dump($vacation['start'] ) 
// var_dump($vacation['end'] ) 
// var_dump($vacation['name'] ) 
// var_dump($vacation['email'] ) 
// var_dump($vacation['user_id'] ) 

?>