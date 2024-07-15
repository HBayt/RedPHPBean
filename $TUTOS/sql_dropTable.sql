-- --------------------------------------------------------

-- DROP TABLE IF EXISTS `tasked`  
DROP TABLE IF EXISTS tasked; 


--
-- CREATE TABLE  `tasked` 
--

CREATE TABLE `tasked` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- AUTO_INCREMENT for table `tasked`
--
ALTER TABLE `tasked`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19855; 


--
-- Constraints for table `tasked`
--
ALTER TABLE `tasked`
  ADD CONSTRAINT `c_fk_tasked_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_tasked_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL; 



-- --------------------------------------------------------
-- MYSQL 
-- -------------------------------------------------------- 

--- DELETE FROM tasked;
--- Delete: will delete all rows from your table. Next insert will take next auto increment id.

-- OR 
-- TRUNCATE tasked;
-- Truncate: will also delete the rows from your table but it will start from new row with 1. 

-- --------------------------------------------------------
-- REDBEANPHP 
-- -------------------------------------------------------- 

-- REDBEANPHP - WIPE() FUNCTION 
R::exec('SET FOREIGN_KEY_CHECKS = 0;'); -- SET FOREIGN KEY checks to 0.
R::wipe('tasked'); -- R::wipe('tablename');

---------
---------

-- RedBean is just an ORM tool (AFAIK) so if your back-end database is SQL based, you can simply do an SQL statement like: TRUNCATE TABLE yourTable;
-- To execute queries directly via RedBean USE The Adapter
-- The adapter is the class that communicates with the database for RedBean. This adapter makes it possible to execute queries to manipulate the database. To get an instance of this adapter use:
$adapter = $toolbox->getDatabaseAdapter();

-- REDBEANPHP - Executed with the RedBean Adapter
$adapter->exec('TRUNCATE TABLE <table_name>'); 
$adapter->exec('TRUNCATE TABLE tasked');


