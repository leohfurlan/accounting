ALTER TABLE `acc_accounts_payable`
  ADD COLUMN `project_id` INT(11) NULL AFTER `supplier`,
  ADD CONSTRAINT `fk_payables_project`
    FOREIGN KEY (`project_id`)
    REFERENCES `tblprojects`(`id`)
    ON DELETE SET NULL;
