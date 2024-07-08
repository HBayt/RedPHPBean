
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



                echo "Sample 1 <br>";     
                $datetime = new DateTime(); // Today, Now
                echo $datetime->format('m/d/Y g:i A')."<br><br>"; 

                echo "Sample 2<br>"; 
                $datetime = new DateTime('12/31/2019 12:00 PM'); // Defined date and time 
                echo $datetime->format('m/d/Y g:i A')."<br><br>"; 

                echo "Sample 3 <br>"; 
                $datetime = new DateTime();
                $datetime->setDate(2020, 5, 1);
                echo $datetime->format('m/d/Y g:i A')."<br><br>"; 

                echo "Sample 4 <br>"; 
                $datetime = new DateTime();
                $datetime->setDate(2020, 5, 1);
                $datetime->setTime(5, 30, 0);
                echo $datetime->format('m/d/Y g:i A')."<br><br>"; 

                echo "Sample 5 <br>"; 
                $datetime = new DateTime();
                echo $datetime->setDate(2020, 5, 1)
                    ->setTime(5, 30)
                    ->setTimezone(new DateTimeZone('America/New_York'))
                    ->format('m/d/Y g:i A')."<br><br>"; 

 
                echo "Sample 6 <br>"; 
                $datetime = new DateTime('06/08/2021');
                echo $datetime->format('F jS, Y')."<br><br>"; 


                echo "Sample 7 <br>"; 
                $datetime = new DateTime('06-08-2021');
                echo $datetime->format('F jS, Y')."<br><br>"; 

                echo "Sample 8 <br>"; 
                $ds = '06/08/2021';
                $datetime = new DateTime(str_replace('/', '-', $ds));
                echo $datetime->format('F jS, Y')."<br><br>"; 
                

                echo "Sample 9 <br>"; 
                $ds = '06/08/2021';
                $datetime = DateTime::createFromFormat('d/m/Y', $ds);
                echo $datetime->format('F jS, Y')."<br><br>";  
                
                
                echo "Sample 10 <br>"; 
                $datetime1 = new DateTime('01/01/2021 10:00 AM');
                $datetime2 = new DateTime('01/01/2021 09:00 AM');

                var_dump($datetime1 < $datetime2); // false
                echo "<br>"; 
                var_dump($datetime1 > $datetime2); // true
                echo "<br>"; 
                var_dump($datetime1 == $datetime2); // false
                echo "<br>"; 
                var_dump($datetime1 <=> $datetime2); // 1
                echo "<br>"; 




                ?>


<!--
    SELECT  `tasked`.id, DATE_FORMAT( `tasked`.`start`, '%Y-%m-%d'),  `tasked`.`title`
    FROM  `tasked` 
    WHERE DATE_FORMAT( `tasked`.`start`, '%Y-%m-%d') = CURDATE();


--> 



    </div>
</div>

</section>


