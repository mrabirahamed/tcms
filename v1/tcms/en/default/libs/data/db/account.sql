--
-- Table structure for table `{DB_PREFIX}Users`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}users` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`f_name` VARCHAR(60) NULL DEFAULT NULL,
	`l_name` VARCHAR(20) NULL DEFAULT NULL,
	`email` VARCHAR(60) NULL DEFAULT 'username@provider.company',
	`password` VARCHAR(50) NOT NULL,
	`username` VARCHAR(20) NOT NULL,
	`activity` ENUM('active','Inactive') NOT NULL,
	`role` INT(11) NOT NULL,
	`status` TINYINT(20) NOT NULL,
	`r_date` DATETIME NULL DEFAULT NULL,
	`code` INT(40) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `code` (`code`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

--
-- Table structure for table `{DB_PREFIX}Users_Info`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}users_details` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`dob` VARCHAR(20) NULL DEFAULT '00/00/0000',
	`gender` VARCHAR(10) NULL DEFAULT NULL,
	`profession` VARCHAR(40) NULL DEFAULT NULL,
	`pro_pic` VARCHAR(60) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `dob` (`dob`, `gender`, `profession`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

