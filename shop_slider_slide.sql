-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 05 2013 г., 18:58
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mir-bruk`
--

-- --------------------------------------------------------

--
-- Структура таблицы `shop_slider_slide`
--

CREATE TABLE IF NOT EXISTS `shop_slider_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slider_id` (`slider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `shop_slider_slide`
--

INSERT INTO `shop_slider_slide` (`id`, `slider_id`, `title`, `link`, `img`) VALUES
(21, 1, 'Заголовок', 'http://mir-bruk/13/', '6gXglg41Je.jpg'),
(22, 1, 'Заголовок 2', 'http://mir-bruk/7/', 'ti5cUuGF8t.jpg'),
(23, 1, 'аыва', 'аываыва', 'SGufXt9jxp.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
