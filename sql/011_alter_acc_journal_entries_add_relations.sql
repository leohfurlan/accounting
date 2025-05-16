ALTER TABLE `acc_journal_entries`
  ADD COLUMN `client_id`  INT(11)    NULL AFTER `description`,
  ADD COLUMN `project_id` INT(11)    NULL AFTER `client_id`,
  ADD CONSTRAINT `fk_journals_client`
    FOREIGN KEY (`client_id`)
    REFERENCES `tblclients`(`userid`)
    ON DELETE SET NULL,
  ADD CONSTRAINT `fk_journals_project`
    FOREIGN KEY (`project_id`)
    REFERENCES `tblprojects`(`id`)
    ON DELETE SET NULL;
