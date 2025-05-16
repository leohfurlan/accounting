CREATE TABLE IF NOT EXISTS `acc_accounts_receivable` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `client` VARCHAR(255) NOT NULL,
  `document_number` VARCHAR(50),
  `issue_date` DATE NOT NULL,
  `due_date` DATE NOT NULL,
  `amount` DECIMAL(15,2) NOT NULL,
  `status` ENUM('Pendente','Recebido','Vencido') DEFAULT 'Pendente',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;