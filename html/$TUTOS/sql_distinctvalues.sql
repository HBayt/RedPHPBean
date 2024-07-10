SELECT DISTINCT a.foo,a.bar 
FROM table a
LEFT JOIN table b ON a.foo=b.bar and a.bar=b.foo
WHERE b.foo IS NULL AND b.bar IS NULL 

/* 
Output :

foo bar
--- ---
d   a


*/ 
-- __________________________________________________________________

select distinct
    least(foo, bar) as value1
  , greatest(foo, bar) as value2
from table

-- __________________________________________________________________

SELECT foo,bar FROM my_table GROUP BY foo,bar
-- __________________________________________________________________

SELECT DISTINCT t1.foo, t1.bar
  FROM `table` t1
    LEFT JOIN `table` t2
      ON t1.foo=t2.bar AND t1.bar=t2.foo 
  WHERE t2.foo IS NULL OR t1.foo <= t1.bar; 
-- __________________________________________________________________

   SELECT 
       foo, bar
   FROM tableX
   WHERE foo <= bar
 UNION 
   SELECT 
       bar, foo
   FROM tableX
   WHERE bar < foo


  -- __________________________________________________________________

SELECT DISTINCT foo, bar FROM table WHERE
CONCAT(',',foo,bar,) NOT IN ( SELECT CONCAT(',',bar,foo) FROM table )


-- __________________________________________________________________
SELECT DISTINCT
LEAST(sub.foo, sub.bar) as value_1
, GREATEST(sub.foo, sub.bar) as value_2

FROM
(SELECT
a.foo
,a.bar
FROM
table a
JOIN
table b
on a.foo = b.bar
and a.bar = b.foo) sub

-- __________________________________________________________________

select distinct foo, bar from table where (foo, bar) not in (select bar, foo from table); 


