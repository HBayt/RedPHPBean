

-- ALTER TABLE `tblName` ADD COLUMN `colName` INT(10) AFTER `firstCol`;
-- The AFTER clause defines the position where your new column will come. 
ALTER TABLE `tasked` ADD COLUMN `done_task` INT(11) AFTER `start`;
ALTER TABLE contacts ADD email VARCHAR(60);




-- To delete a single column:

ALTER TABLE '<table_name>' DROP [COLUMN] '<column_name>'; 
ALTER TABLE `table1` DROP `column1`;
ALTER TABLE `tasked` DROP `done_task`;

--- To delete multiple columns:
ALTER TABLE `table1`
DROP `column1`,
DROP `column2`,
DROP `column3`;

