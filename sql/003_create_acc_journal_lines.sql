CREATE TABLE IF NOT EXISTS `acc_journal_lines` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `journal_entry_id` INT UNSIGNED NOT NULL,
  `coa_id` INT UNSIGNED NOT NULL,
  `debit` DECIMAL(15,2) DEFAULT 0.00,
  `credit` DECIMAL(15,2) DEFAULT 0.00,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_journal_entry` (`journal_entry_id`),
  KEY `idx_coa` (`coa_id`),
  CONSTRAINT `fk_journal_lines_entry` FOREIGN KEY (`journal_entry_id`) REFERENCES `acc_journal_entries`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_journal_lines_coa` FOREIGN KEY (`coa_id`) REFERENCES `acc_coa`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;