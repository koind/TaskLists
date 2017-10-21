-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 21 2017 г., 11:09
-- Версия сервера: 10.0.32-MariaDB-0+deb8u1
-- Версия PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `krosava_15`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `name` varchar(160) NOT NULL,
  `email` varchar(120) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(150) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `email`, `text`, `img`, `status`) VALUES
(57, 'Иван Иванов', 'ivanichh@mail.ru', 'купить зонтик, еще куптить зонтик', '/App/layouts/upload/8899236897f3aeab58257fbfa148567f.jpg', 1),
(29, 'Семенов Николай', 'nik.c@mail.ru', 'Купить акустическую гитару. Поменять струны. ', '/App/layouts/upload/2fc1a139077bcdafc1987a7b36119025.jpg', 0),
(58, 'Петров Иван', 'testuser@mail.ru', 'Купить Audi S8.', '/App/layouts/upload/a92012e9bd2e198b79e6f72bfb5ceed2.jpg', 1),
(55, 'Комар Анна Сергеевна', 'anna@i.ua', 'Проверка', '/App/layouts/upload/19346cc02f1e73da9f68dfbca5e12e20.jpg', 0),
(52, 'Смирнова Елена', 'elena.c@mail.ru', 'Купить автомобиль mercedes benz e class 2014!', '/App/layouts/upload/cef6994c2eb7909e76163cf9fed61836.jpg', 1),
(53, 'Вавилова Анна', 'anna@mail.ru', 'Купить коттедж в Манхеттене.', '/App/layouts/upload/f6c087aae8d01522e605677476b131e1.jpg', 0),
(54, 'Андреев Максим Сергеевич', 'maks@mail.ru', 'Купить новый Toyota Land Cruiser 200. ', '/App/layouts/upload/1be6d1e1734b13af5094208984b247d8.jpg', 0),
(26, 'Иванов Андрей', 'ivanov.a@mail.ru', 'Купить автомобильный холодильник. Установить и настроить. Проверить гарантийный талон. ', '/App/layouts/upload/6ba7a6d665a9cccbb2d5d10e8c3718f2.jpg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(225) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `isAdmin`) VALUES
(1, 'admin@admin.ru', 'admin', '$2y$10$OAk.Q0ixHVvtRovPKnN5ROYCND5A4QDaOEhuagtKsUpJX1r2BO.Ly', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
