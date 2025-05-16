CREATE TABLE IF NOT EXISTS `acc_nfe` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` INT UNSIGNED NULL,
  `items_json` TEXT NOT NULL,
  `xml` LONGTEXT NULL,
  `chave` VARCHAR(44) NULL,
  `protocolo` VARCHAR(50) NULL,
  `status` ENUM('pendente','enviado','autorizado','denegado') DEFAULT 'pendente',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;