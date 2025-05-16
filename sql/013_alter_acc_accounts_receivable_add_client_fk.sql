ALTER TABLE `acc_accounts_receivable`
  CHANGE COLUMN `client` `client_id` INT(11) NOT NULL,
  ADD CONSTRAINT `fk_receivables_client`
    FOREIGN KEY (`client_id`)
    REFERENCES `tblclients`(`userid`)
    ON DELETE CASCADE;
