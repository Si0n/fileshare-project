CREATE TABLE `file` (
  `file_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT DEFAULT NULL,
  `filename` VARCHAR(255) NOT NULL,
  `filename_original` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `size` INT(11) NOT NULL,
  `updated_at` TIMESTAMP NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0 - disabled/uploaded(not visible in catalog), 1 - approved/show in catalog, 2 - disabled(not visible)',
  `password` BINARY(60) NULL,
  PRIMARY KEY (`file_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE `user` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(75) NOT NULL,
  `last_name` VARCHAR(75) NOT NULL,
  `email` VARCHAR(155) NOT NULL,
  `password` BINARY(60) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NOT NULL,
  `telephone` VARCHAR(55) NOT NULL,
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`), UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;