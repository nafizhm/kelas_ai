CREATE DATABASE IF NOT EXISTS `kelas_aplikasi` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `kelas_aplikasi`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(120) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL DEFAULT 'staff',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`), UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `pendaftar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(120) NOT NULL,
  `wa` varchar(25) NOT NULL,
  `email` varchar(120) NOT NULL,
  `profesi` varchar(80) NOT NULL,
  `ide` text NOT NULL,
  `intent` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`), KEY `pendaftar_email_index` (`email`), KEY `pendaftar_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`nama`,`username`,`password`,`role`,`is_active`)
SELECT 'Administrator','admin','$2y$10$4rAOoaWIWT/Tgd8aPeVbZelvbWwRV01SvEXBdWwHIsJtpPIPWU8fC','admin',1
WHERE NOT EXISTS (SELECT 1 FROM `users` WHERE `username`='admin');
