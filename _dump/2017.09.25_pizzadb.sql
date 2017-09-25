-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 25 2017 г., 07:04
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pizzadb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `user_surname` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_patronymic` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `operator_id` int(11) DEFAULT '0',
  `carrier_id` int(11) NOT NULL DEFAULT '0',
  `booking_status` int(11) NOT NULL,
  `booking_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `booking`
--

INSERT INTO `booking` (`booking_id`, `user_surname`, `user_name`, `user_patronymic`, `user_address`, `user_phone`, `operator_id`, `carrier_id`, `booking_status`, `booking_date`) VALUES
(1, 'Ефимов', 'Алексей', 'Павлович', 'Горький 51', 82415612, 0, 0, 1, '2017-09-25 07:02:00');

-- --------------------------------------------------------

--
-- Структура таблицы `booking_connect`
--

CREATE TABLE `booking_connect` (
  `booking_connect_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `booking_connect_cook_id` int(11) NOT NULL DEFAULT '0',
  `booking_connect_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `booking_connect`
--

INSERT INTO `booking_connect` (`booking_connect_id`, `booking_id`, `goods_id`, `booking_connect_cook_id`, `booking_connect_status`) VALUES
(1, 1, 5, 2, 2),
(2, 1, 5, 0, 1),
(3, 1, 4, 2, 2),
(4, 1, 4, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(255) NOT NULL,
  `goods_price` double NOT NULL,
  `goods_img` varchar(255) NOT NULL,
  `goods_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`goods_id`, `goods_name`, `goods_price`, `goods_img`, `goods_status`) VALUES
(4, 'Пепперони', 350, '1505998500_ce61db9628122e46600f7cf4e2a1a9d4.jpg', 1),
(5, 'Греческая', 405, '1505998631_79039ca01e0e2265b8e1e01d4d74dcc7.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `status`) VALUES
(1, 'admin', 'admin', 1),
(2, 'cook', 'cook', 4),
(3, 'operator', 'oper', 2),
(4, 'carrier', 'carrier', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Индексы таблицы `booking_connect`
--
ALTER TABLE `booking_connect`
  ADD PRIMARY KEY (`booking_connect_id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `booking_connect`
--
ALTER TABLE `booking_connect`
  MODIFY `booking_connect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `goods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
