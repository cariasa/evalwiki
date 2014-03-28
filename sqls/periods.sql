USE iscwiki;

CREATE TABLE IF NOT EXISTS `iscwiki`.`periods` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`semester` INT(1) NOT NULL,
	`period`INT(1) NOT NULL,
	`year` YEAR NOT NULL,
	`start_date` DATE NOT NULL,
	`end_date` DATE NOT NULL,
	UNIQUE INDEX `PSA` (`semester` ASC, `period` ASC, `year` ASC)
);
