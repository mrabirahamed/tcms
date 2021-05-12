--  --------------------------------------------------------------------------
-- Table structure for table `{DB_PREFIX}Users`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}users`
(
    `id`       INT(10)                    NOT NULL AUTO_INCREMENT,
    `f_name`   VARCHAR(60)                NULL     DEFAULT NULL,
    `l_name`   VARCHAR(20)                NULL     DEFAULT NULL,
    `email`    VARCHAR(60)                NULL     DEFAULT 'username@provider.company',
    `password` VARCHAR(50)                NOT NULL,
    `username` VARCHAR(20)                NOT NULL,
    `activity` enum ('active','inactive') NOT NULL DEFAULT 'inactive',
    `role`     INT(11)                    NOT NULL,
    `status`   TINYINT(20)                NOT NULL,
    `r_date`   VARCHAR(60)                NULL     DEFAULT NULL,
    `code`     INT(40) UNSIGNED           NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `code` (`code`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
--  ------------------------------------------------------------------------

--
-- Table structure for table `{DB_PREFIX}Users_Info`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}users_details`
(
    `id`         INT(10)                NOT NULL AUTO_INCREMENT,
    `dob`        VARCHAR(20)            NULL DEFAULT 'dd/mm/yyyy',
    `gender`     enum ('male','female') NOT NULL,
    `profession` VARCHAR(40)            NULL DEFAULT NULL,
    `pro_pic`    INT(11)                NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `dob` (`dob`, `gender`, `profession`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;

--
-- ------------------------------------------------------------
--
-- Table structure for table `{DB_PREFIX}users_profiles_photos`
--

CREATE TABLE IF NOT EXISTS `{DB_PREFIX}users_profiles_photos`
(
    `id`   INT(10)      NOT NULL AUTO_INCREMENT,
    `user` INT(11)      NULL NULL,
    `name` VARCHAR(200) NOT NULL,
    `mime` VARCHAR(20)  NULL DEFAULT NULL,
    `size` INT(11)      NULL NULL,
    `data` LONGBLOB,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4;