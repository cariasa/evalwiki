USE iscwiki;

CREATE TABLE IF NOT EXISTS `iscwiki`.`main_pages` (
	`page_id` INT NOT NULL PRIMARY KEY,
	`course_name` VARCHAR(50) NOT NULL,
	`course_code` VARCHAR(50) NULL
);
