-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 06. zář 2024, 16:56
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
-- Databáze: `new_schedule`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `street` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `indicative` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `number`, `indicative`, `city`, `person_id`) VALUES
(3, 'Konvalinková', '52', '5', 'Praha', 1),
(4, 'Bezová', '358', '20', 'Praha', 2),
(5, 'Jahodová', '567', '20', 'Praha', 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `carers`
--

CREATE TABLE `carers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `week_hours` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `carers`
--

INSERT INTO `carers` (`id`, `first_name`, `last_name`, `week_hours`) VALUES
(1, 'Lucie', 'Nováková', 20),
(2, 'Jana', 'Tůmová', 20),
(3, 'Lenka', 'Brzobohatá', 30);

-- --------------------------------------------------------

--
-- Struktura tabulky `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `day` enum('Pondělí','Úterý','Středa','Čtvrtek','Pátek') NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `carer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `doctors`
--

INSERT INTO `doctors` (`id`, `day`, `time_from`, `time_to`, `carer_id`) VALUES
(16, 'Středa', '08:00:00', '12:00:00', 1),
(17, 'Úterý', '08:00:00', '10:00:00', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `travel_times`
--

CREATE TABLE `travel_times` (
  `id` int(11) NOT NULL,
  `place_A` int(11) NOT NULL,
  `address_A` varchar(255) NOT NULL,
  `place_B` int(11) NOT NULL,
  `address_B` varchar(255) NOT NULL,
  `travel_time` int(5) NOT NULL,
  `time_search` time NOT NULL DEFAULT '10:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `travel_times`
--

INSERT INTO `travel_times` (`id`, `place_A`, `address_A`, `place_B`, `address_B`, `travel_time`, `time_search`) VALUES
(2, 3, 'Konvalinková 52/5, Praha', 3, 'Konvalinková 52/5, Praha', 0, '10:00:00'),
(3, 4, 'Bezová 358/20, Praha', 3, 'Konvalinková 52/5, Praha', 0, '10:00:00'),
(4, 5, 'Jahodová 567/20, Praha', 3, 'Konvalinková 52/5, Praha', 0, '10:00:00'),
(5, 5, 'Jahodová 567/20, Praha', 4, 'Bezová 358/20, Praha', 0, '10:00:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Pečovatel/ka','Koordinátor/ka','admin','') NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$12$OAhG5QJkmmd/N8L6n6wz6.CeD6NiWDT93JoOlgOV9r4uvKl4//rL2', 'admin', 'admin@example.com', '2024-08-28 09:27:16'),
(2, 'jana.haldova', '$2y$12$CYIdGeWZuHRmNeVYMJJZou.MfkEkj2xyNkH0Nz60ajhEvoBBq6UfS', 'Koordinátor/ka', 'admin@example.com', '2024-08-28 15:00:12'),
(4, 'Pečovatelka', '$2y$12$o3dA6WcbxZd5/ENSb3vZFOtwf7rS/J8ffYjWBk3utccW9WMODYN/G', 'Pečovatel/ka', 'admin@example.com', '2024-08-28 15:08:41');

-- --------------------------------------------------------

--
-- Struktura tabulky `work_hours`
--

CREATE TABLE `work_hours` (
  `id` int(11) NOT NULL,
  `day` enum('Pondělí','Úterý','Středa','Čtvrtek','Pátek') NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `day_hours` int(3) NOT NULL,
  `carer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `work_hours`
--

INSERT INTO `work_hours` (`id`, `day`, `time_from`, `time_to`, `day_hours`, `carer_id`) VALUES
(1, 'Pondělí', '08:00:00', '14:00:00', 6, 1),
(2, 'Úterý', '08:00:00', '14:00:00', 6, 1),
(3, 'Středa', '08:00:00', '16:00:00', 8, 1),
(4, 'Čtvrtek', '10:00:00', '14:00:00', 6, 1),
(5, 'Pátek', '12:00:00', '16:00:00', 4, 1),
(6, 'Pondělí', '08:00:00', '10:00:00', 2, 2),
(7, 'Úterý', '08:00:00', '16:00:00', 8, 2),
(8, 'Středa', '10:00:00', '16:00:00', 6, 2),
(9, 'Čtvrtek', '12:00:00', '16:00:00', 4, 2),
(10, 'Pátek', '12:00:00', '16:00:00', 4, 2);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `carers`
--
ALTER TABLE `carers`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carer_id` (`carer_id`);

--
-- Indexy pro tabulku `travel_times`
--
ALTER TABLE `travel_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_A` (`place_A`),
  ADD KEY `place_B` (`place_B`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `work_hours`
--
ALTER TABLE `work_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carer_id` (`carer_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `carers`
--
ALTER TABLE `carers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pro tabulku `travel_times`
--
ALTER TABLE `travel_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `work_hours`
--
ALTER TABLE `work_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`carer_id`) REFERENCES `carers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `travel_times`
--
ALTER TABLE `travel_times`
  ADD CONSTRAINT `travel_times_ibfk_1` FOREIGN KEY (`place_A`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `travel_times_ibfk_2` FOREIGN KEY (`place_B`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `work_hours`
--
ALTER TABLE `work_hours`
  ADD CONSTRAINT `work_hours_ibfk_1` FOREIGN KEY (`carer_id`) REFERENCES `carers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
