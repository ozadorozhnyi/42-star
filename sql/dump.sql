-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Час створення: Жов 16 2024 р., 21:34
-- Версія сервера: 8.3.0
-- Версія PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `plan42`
--

-- --------------------------------------------------------

--
-- Структура таблиці `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int UNSIGNED NOT NULL COMMENT 'pk',
  `parent_id` int UNSIGNED DEFAULT NULL COMMENT 'fk',
  `is_current` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `tariff_id` tinyint UNSIGNED NOT NULL COMMENT 'fk',
  `total_users` smallint UNSIGNED NOT NULL,
  `total_price` int UNSIGNED NOT NULL,
  `discount_rate` decimal(5,2) UNSIGNED NOT NULL,
  `payment_frequency` enum('monthly','annually') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `next_payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `parent_id`, `is_current`, `tariff_id`, `total_users`, `total_price`, `discount_rate`, `payment_frequency`, `next_payment_date`) VALUES
(1, NULL, 'yes', 1, 7, 2800, 0.00, 'monthly', '2024-10-20');

-- --------------------------------------------------------

--
-- Структура таблиці `tariffs`
--

CREATE TABLE `tariffs` (
  `id` tinyint UNSIGNED NOT NULL COMMENT 'pk',
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_per_month` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `tariffs`
--

INSERT INTO `tariffs` (`id`, `name`, `price_per_month`) VALUES
(1, 'Lite', 4),
(2, 'Starter', 6),
(3, 'Premium', 10);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`tariff_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Індекси таблиці `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'pk', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблиці `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'pk', AUTO_INCREMENT=4;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`tariff_id`) REFERENCES `tariffs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
