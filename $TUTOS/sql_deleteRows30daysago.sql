-- DROP TABLE IF EXISTS table_name; 
DELETE FROM archive WHERE MONTH(created_date) < MONTH(NOW)) AND YEAR(created_date)<=YEAR(NOW()); 


DELETE FROM archive
WHERE STR_TO_DATE(SUBSTR(created_date, 0, 25), '%a, %d %b %Y %H:%i:%S') < DATE_SUB(NOW(), INTERVAL 30 DAY); 



delete from archive
    where str_to_date(substr(created_date, 6), '%d %b %Y') > :days;



CREATE TABLE EMPLOYEE (name VARCHAR(20), age VARCHAR(20),
 GENDER(20), birth DATE, Department VARCHAR(50) );

DELETE FROM Employee where birth < '2001-01-04'



   LOOP
      DELETE FROM tbl
         WHERE ts < DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)
         ORDER BY ts   -- to use the index, and to make it deterministic
         LIMIT 1000
   UNTIL no rows deleted