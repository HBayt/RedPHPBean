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
<div class="container mt-5">

<!-- LINK HTTP (XAMPP/HTML/ADMIN/... --> 
<!-- LINK HTTP (XAMPP/HTML/MODEL/... --> 
<!-- LINK HTTP (XAMPP/HTML/VUE/... --> 
<!-- LINK HTTP (XAMPP/HTML/index.php --> 


<a href="http://localhost/html/admin/admin.php">http://localhost/html/admin/admin.php</a>
<br>
    <a href="admin/admin.php">admin/admin.php </a>
    <br>
    <a href="../html/admin/admin.php">../html/admin/admin.php</a>
    <br>
    <a href="admin.php">Login (Path Serveur LINUX)</a>
    <br>
    <br>

    <h2>Index</h2>

    <?php foreach ($task as $t) { ?>
        <div class="badge" style="background-color: <?php echo $t->color ?>;">
            <?php echo $t->name ?>
        </div>
    <?php } ?>

    <div id='calendar' class="mt-5"></div>
    
</div>
<?php
require 'vue/partials/footer.php';



