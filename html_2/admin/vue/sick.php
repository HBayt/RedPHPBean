<!--  ------------------------------- --> 
<!--  Change affected user for a task --> 
<!--  ------------------------------- --> 
<section class="container mt-5">


<div class="container">
	<!--  Title --> 


    <!-- ------------------------------------------------- -->    
    <!-- Page title & Button Create (Insert into db.table ) -->     
    <!-- ------------------------------------------------- -->      
    <h2>Change user for the task</h2>
  
    <!--  Button to change random the task user --> 
        <form method="POST">
            <input type="hidden" name="tasked_id" value="<?php echo $_GET['tasked_id'] ?>">
            <input class="btn btn-primary" type="submit" value="Change for random user" style="float: right;"/>
        </form>
		
    </div>

	
	<!-- Table HTML --> 
    <table class="table">
	
        <thead>
            <tr>
            <th scope="col">First and lastname</th>
            <th scope="col"></th>
            </tr>
        </thead>
		
		<!--  Display User --> 
        <?php foreach( $user as $u ) {?>
            <tr>
            <td><?php echo $u->name ?></td>
            <td><form method="POST">
                <input type="hidden"  name="id_user" value="<?php echo $u->id ?>">
                <button type="submit" class="btn btn-secondary">Choose </button>
            </form></td>
            </tr>

        <?php } ?><!-- end .foreach() LOOP --> 
    </table>
	
	




</section>