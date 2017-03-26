CREATE TABLE `file` (
  `file_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT DEFAULT NULL,
  `name` VARCHAR(155) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `path` VARCHAR(255) NOT NULL,
  `date_upload` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` TIMESTAMP NOT NULL DEFAULT '0000-00-00' ON UPDATE CURRENT_TIMESTAMP,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0 - disabled/uploaded(not visible in catalog), 1 - approved/show in catalog, 2 - disabled(not visible)',
  PRIMARY KEY (`file_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;