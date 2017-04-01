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