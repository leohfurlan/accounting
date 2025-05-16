CREATE TABLE IF NOT EXISTS `acc_journal_entries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `client_id` INT(11)    NULL,
  `project_id` INT(11)   NULL,
  `created_at` DATETIME  DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_client` (`client_id`),
  KEY `idx_project` (`project_id`),
  CONSTRAINT `fk_journals_client`
    FOREIGN KEY (`client_id`)
    REFERENCES `tblclients`(`userid`)
    ON DELETE SET NULL,
  CONSTRAINT `fk_journals_project`
    FOREIGN KEY (`project_id`)
    REFERENCES `tblprojects`(`id`)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
