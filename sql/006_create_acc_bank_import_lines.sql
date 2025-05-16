CREATE TABLE IF NOT EXISTS `acc_bank_import_lines` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `import_id` INT UNSIGNED NOT NULL,
  `date` DATE NOT NULL,
  `description` VARCHAR(255),
  `amount` DECIMAL(15,2) NOT NULL,
  `matched` TINYINT(1) DEFAULT 0,
  `journal_line_id` INT UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_import` (`import_id`),
  CONSTRAINT `fk_bank_imports_import` FOREIGN KEY (`import_id`) REFERENCES `acc_bank_imports`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;