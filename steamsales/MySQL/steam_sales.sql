-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 03. říj 2024, 10:35
-- Verze serveru: 10.4.27-MariaDB
-- Verze PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `steam_sales`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `starts` date NOT NULL,
  `ends` date NOT NULL,
  `color` char(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sale`
--

INSERT INTO `sale` (`id`, `name`, `starts`, `ends`, `color`, `user_id`, `created_at`) VALUES
(1, 'Festival Open World', '2024-04-15', '2024-04-30', '#77cc0f', 1, '2024-09-30 13:13:14'),
(3, 'Lunar New Year Sale', '2024-01-01', '2024-01-08', '#97c7f2', 2, '2024-09-30 14:06:45'),
(4, 'Steam Summer Sale', '2025-06-15', '2025-06-30', '#f6f948', 1, '2024-09-30 15:03:12'),
(5, 'Steam Summer Sale', '2024-06-15', '2024-06-30', '#f9e353', 1, '2024-09-30 15:16:03'),
(6, 'Festival Platformer', '2025-05-01', '2025-05-15', '#e15323', 1, '2024-09-30 15:20:48'),
(7, 'Festival Platformer', '2026-05-01', '2026-05-01', '#d12715', 1, '2024-09-30 15:22:14'),
(8, 'Steam Halloween Sale', '2025-10-28', '2025-11-05', '#f89c1b', 1, '2024-10-01 07:06:03'),
(9, 'Steam Autumn Sale', '2024-11-25', '2024-12-02', '#dc6138', 2, '2024-10-01 07:40:08'),
(10, 'Steam Autumn Sale', '2025-11-25', '2025-12-02', '#d56f1a', 1, '2024-10-01 09:26:53'),
(11, 'Christmas Steam Sale', '2025-12-20', '2026-01-05', '#3c8ed7', 1, '2024-10-01 09:45:12'),
(12, 'Festival Open World', '2025-04-15', '2025-04-30', '#32f924', 1, '2024-10-01 09:47:38'),
(13, 'Steam Halloween Sale 24', '2024-10-28', '2024-11-05', '#d7973c', 2, '2024-10-01 09:50:15'),
(14, 'Christmas Steam Sale', '2024-12-20', '2025-01-05', '#3c8ed7', 1, '2024-10-01 10:03:48'),
(15, 'Festival tahových RPG', '2024-09-15', '2024-10-02', '#135086', 2, '2024-10-02 09:06:34'),
(16, 'Lunar New Year Sale', '2025-01-01', '2025-01-07', '#88beec', 1, '2024-10-02 09:12:05');

-- --------------------------------------------------------

--
-- Struktura tabulky `sale_tag`
--

CREATE TABLE `sale_tag` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `sale_tag`
--

INSERT INTO `sale_tag` (`id`, `sale_id`, `tag_id`) VALUES
(59, 16, 1),
(60, 16, 2),
(61, 16, 3),
(62, 16, 4),
(63, 16, 5),
(64, 5, 2),
(65, 5, 3),
(66, 5, 4),
(67, 4, 1),
(68, 4, 3),
(69, 4, 4),
(74, 8, 1),
(75, 8, 2),
(76, 8, 3),
(77, 8, 4),
(83, 10, 3),
(84, 10, 4),
(85, 10, 5),
(86, 14, 1),
(87, 14, 2),
(88, 14, 3),
(89, 14, 4),
(90, 14, 5),
(91, 11, 1),
(92, 11, 2),
(93, 11, 3),
(94, 11, 4),
(95, 11, 5),
(96, 1, 3),
(97, 12, 3),
(98, 6, 4),
(100, 7, 4),
(101, 13, 1),
(102, 13, 2),
(103, 13, 3),
(104, 13, 4),
(121, 15, 1),
(122, 15, 2),
(123, 9, 1),
(124, 9, 2),
(125, 9, 3),
(154, 3, 1),
(155, 3, 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'RPG'),
(2, 'Survival'),
(3, 'Open World'),
(4, 'Platformer'),
(5, '3D Střílečka');

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','','') NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `password`, `role`, `active`) VALUES
(1, 'Petr', 'Skýpala', 'petr.skypala', '$2y$12$ZXs5iFQ8wBgImKkGcmc6v.3WCgIeIazOCyFgdKM8N98xKhnJdX9JS', 'user', 1),
(2, 'admin', 'admin', 'admin', '$2y$12$t6DFU/FeuJ4wV6/nA3KroOATsI7cVgi8bluH0.ueYfRotvoHol30K', 'admin', 1),
(3, 'admin', 'test', 'admintest', '$2y$12$6IojVDmhc1L7JDpyulVLZOEL9GejSGeESM.vrBruaupDOhejKGx1K', 'admin', 0),
(4, 'Jan', 'Novák', 'jan.novak', '$2y$12$8Iq4cHd81xbu/s8Fw71cx.Lh2fLMiXAokDqePQ3ZgQCRMqth1mnWy', 'user', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexy pro tabulku `sale_tag`
--
ALTER TABLE `sale_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexy pro tabulku `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pro tabulku `sale_tag`
--
ALTER TABLE `sale_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT pro tabulku `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `sale_tag`
--
ALTER TABLE `sale_tag`
  ADD CONSTRAINT `sale_tag_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
