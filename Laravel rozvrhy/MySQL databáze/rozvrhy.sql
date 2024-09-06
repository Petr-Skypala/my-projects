-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 06. zář 2024, 11:48
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `rozvrhy`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `house_number` varchar(255) NOT NULL,
  `approx_number` varchar(255) NOT NULL,
  `carer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `city`, `house_number`, `approx_number`, `carer_id`, `client_id`, `created_at`, `updated_at`) VALUES
(5, 'Testovací první', 'Praha', '100', '5', 1, NULL, '2024-06-24 15:37:50', '2024-06-24 15:37:50'),
(6, 'Ulice k druhé', 'Praha', '100', '5', 2, NULL, '2024-06-24 15:38:11', '2024-06-24 15:38:11'),
(7, 'Třebešínská', 'Praha 10', '1054', '5', NULL, 1, '2024-07-02 09:29:07', '2024-07-02 09:29:07');

-- --------------------------------------------------------

--
-- Struktura tabulky `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `carers`
--

CREATE TABLE `carers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `weekly_hours` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `carers`
--

INSERT INTO `carers` (`id`, `first_name`, `last_name`, `weekly_hours`, `created_at`, `updated_at`) VALUES
(1, 'Anna', 'Nováková', 27, '2024-06-21 09:04:53', '2024-09-06 09:22:57'),
(2, 'Markéta', 'Nováková', 12, '2024-06-21 09:14:34', '2024-09-06 09:23:26'),
(3, 'Lucie', 'Nováková', 15, '2024-06-24 07:30:35', '2024-06-24 07:30:35'),
(4, 'Alena', 'Vomáčková', 8, '2024-09-06 09:27:24', '2024-09-06 09:27:24');

-- --------------------------------------------------------

--
-- Struktura tabulky `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Alena', 'Vomáčková', NULL, '2024-07-02 08:21:34', '2024-07-02 08:56:31'),
(2, 'Ladislav', 'Výborný', NULL, '2024-07-02 09:37:42', '2024-07-02 09:37:42'),
(3, 'Pan', 'Novák', 'test', '2024-07-02 09:38:40', '2024-07-02 09:38:51');

-- --------------------------------------------------------

--
-- Struktura tabulky `daytimes`
--

CREATE TABLE `daytimes` (
  `day` enum('Mon','Tue','Wed','Thu','Fri') NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `day_hours` int(11) NOT NULL,
  `carer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `daytimes`
--

INSERT INTO `daytimes` (`day`, `from`, `to`, `day_hours`, `carer_id`, `created_at`, `updated_at`, `order`) VALUES
('Mon', '10:00:00', '14:00:00', 4, 2, '2024-06-27 13:19:11', '2024-06-27 13:19:11', NULL),
('Tue', '10:00:00', '16:00:00', 6, 2, '2024-06-27 13:19:11', '2024-06-27 13:19:11', NULL),
('Wed', '08:00:00', '14:00:00', 6, 2, '2024-06-27 13:19:11', '2024-06-27 13:19:11', NULL),
('Thu', '08:00:00', '16:00:00', 4, 2, '2024-06-27 13:19:11', '2024-06-27 13:19:11', NULL),
('Fri', '08:00:00', '16:00:00', 4, 2, '2024-06-27 13:19:11', '2024-06-27 13:19:11', NULL),
('Mon', '08:00:00', '16:00:00', 6, 1, '2024-09-06 09:11:13', '2024-09-06 09:11:13', NULL),
('Tue', '08:00:00', '16:00:00', 8, 1, '2024-09-06 09:11:13', '2024-09-06 09:11:13', NULL),
('Wed', '08:00:00', '16:00:00', 8, 1, '2024-09-06 09:11:13', '2024-09-06 09:11:13', NULL),
('Thu', '08:00:00', '16:00:00', 8, 1, '2024-09-06 09:11:13', '2024-09-06 09:11:13', NULL),
('Fri', '08:00:00', '16:00:00', 8, 1, '2024-09-06 09:11:13', '2024-09-06 09:11:13', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` enum('Mon','Tue','Wed','Thu','Fri') NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `carer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `doctors`
--

INSERT INTO `doctors` (`id`, `day`, `from`, `to`, `carer_id`, `created_at`, `updated_at`, `order`) VALUES
(36, 'Wed', '09:00:00', '10:00:00', 1, '2024-07-01 11:31:48', '2024-07-01 11:31:48', NULL),
(39, 'Wed', '10:00:00', '12:00:00', 1, '2024-09-06 09:10:51', '2024-09-06 09:10:51', NULL),
(40, 'Mon', '08:00:00', '10:00:00', 1, '2024-09-06 09:11:02', '2024-09-06 09:11:02', NULL),
(41, 'Wed', '08:00:00', '10:00:00', 2, '2024-09-06 09:31:55', '2024-09-06 09:31:55', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_20_174928_create_carers_table', 2),
(7, '2024_06_24_115230_create_clients_table', 3),
(9, '2024_06_24_130125_create_addresses_table', 4),
(10, '2024_06_25_093444_create_daytimes_table', 5),
(11, '2024_06_25_213727_create_daytimes_table', 6),
(12, '2024_06_26_100701_create_doctors_table', 7),
(14, '2024_06_26_161657_create_doctors_table', 8),
(15, '2024_06_27_112531_create_daytimes_table', 9);

-- --------------------------------------------------------

--
-- Struktura tabulky `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('p.skypala@centrum.cz', '$2y$12$jbNtm8n0i24v5XAdX/HLE.qFdstkHOaFTCoyw/A1aKynDr/GbWLXS', '2024-09-05 08:34:11');

-- --------------------------------------------------------

--
-- Struktura tabulky `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('t0maXO8b2oEDBxD77Zk1GiFhg1xr8hBY8fcMm5Cd', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ1JhMzQ3MmdESHlCV3FpT0NlcDV2djRhWWpnMEVESEFQQXBqSGdSMiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY2xpZW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1725615968);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(2, 'admin', 'admin@example.com', NULL, '$2y$12$kACcxuX0oqsIyRyONRX9HejWu5MmwCQLwMRt/5i9F0iB5EEp7CBRa', NULL, '2024-09-05 06:59:23', '2024-09-05 06:59:23', 0);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_carer_id_foreign` (`carer_id`),
  ADD KEY `addresses_client_id_foreign` (`client_id`);

--
-- Indexy pro tabulku `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexy pro tabulku `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexy pro tabulku `carers`
--
ALTER TABLE `carers`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `daytimes`
--
ALTER TABLE `daytimes`
  ADD KEY `daytimes_carer_id_foreign` (`carer_id`);

--
-- Indexy pro tabulku `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_carer_id_foreign` (`carer_id`);

--
-- Indexy pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexy pro tabulku `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexy pro tabulku `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexy pro tabulku `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `carers`
--
ALTER TABLE `carers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pro tabulku `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_carer_id_foreign` FOREIGN KEY (`carer_id`) REFERENCES `carers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `addresses_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `daytimes`
--
ALTER TABLE `daytimes`
  ADD CONSTRAINT `daytimes_carer_id_foreign` FOREIGN KEY (`carer_id`) REFERENCES `carers` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_carer_id_foreign` FOREIGN KEY (`carer_id`) REFERENCES `carers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
