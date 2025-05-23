CREATE TABLE IF NOT EXISTS `acc_tax_guides` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `type` ENUM('DARF','GPS','GNRE','DAS','DIRF') NOT NULL,
  `competencia` DATE NOT NULL,
  `company_id` INT UNSIGNED NOT NULL,
  `tax_value` DECIMAL(15,2) NOT NULL,
  `bank_code` CHAR(3) NOT NULL DEFAULT '010',
  `generated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `file_path` VARCHAR(255) NULL,
  `status` ENUM('pendente','enviado') DEFAULT 'pendente',
  `sent_at` DATETIME NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;