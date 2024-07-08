<?php
    require 'config.php';
    require 'vue/partials/header.php';
    require 'utils/connectdb.php';
    require 'model/task.php';

    $task = getTasks();
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: <?php echo json_encode(getTasked()) ?>
    });
        calendar.render();
    });
</script>



<!-- ------------------------------------------------- -->    
<!-- Page title & Button Create (Insert into db.table ) -->     
<!-- ------------------------------------------------- -->     
 
<section class="container mt-5">
    <div class="container">
    
        <table class="table">
            <tr> 
                <td>
                    <!-- Title -->    
                    <h2>Index</h2>                                 
                </td>            
                <td> 
                    <div style="text-align: right;">
                        <!-- BOUTON Login --> 
                        <a href="admin/admin.php">Login </a>
                        <br>
                        <a href="../html/admin/admin.php">Login (2)</a>
                        <br>  
                        <br> 
                    </div>
                </td> 
            </tr>
        </table> 
        <br> 
        
        <?php foreach ($task as $t) { ?>
            <div class="badge" style="background-color: <?php echo $t->color ?>;">
                <?php echo $t->name ?>
            </div>
        <?php } ?>

        <br> 
        <div id='calendar' class="mt-5"></div>
    
</div>
<?php
require 'vue/partials/footer.php';
