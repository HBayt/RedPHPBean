<!-- ------------------------------------------------- -->    
<!-- Page title & Button Create (Insert into db.table ) -->     
<!-- ------------------------------------------------- -->      
<div class="container">
    <h2>Groups</h2>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createGroupModal" style="float: right;">Create </button>

</div>

<!-- ------------------------------------------------- -->    
<!-- Group list from MySQL DB  -->     
<!-- ------------------------------------------------- -->    
<div class="container mt-5">
  <table class="table">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <?php foreach( $group as $g ) {?>
            <tr>
            <td><?php echo $g->name ?></td>
            <td>

            <!-- ------------------------------------------------- -->    
            <!-- Delete Button  -->     
            <!-- ------------------------------------------------- -->    
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deleteModal<?php echo $g->id ?>">
                Delete
            </button>

            <!-- ------------------------------------------------- -->    
            <!-- Modal for Delete action (CRUD) -->     
            <!-- ------------------------------------------------- -->    
            <div class="modal fade" id="deleteModal<?php echo $g->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form method="POST">
                                <input type="hidden"  name="id" value="<?php echo $g->id ?>">
                                <input type="hidden"  name="method"  value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            </td>
            <td><a href="/html/admin/user.php?group_id=<?php echo $g->id ?>"><button type="button" class="btn btn-primary">Users</button></a></td>
            </tr>
            
        <?php } ?>
    </table>


    <!-- ------------------------------------------------- -->    
    <!-- Modal container -->     
    <!-- ------------------------------------------------- -->    
    <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>libelé (name)</label>
                        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>