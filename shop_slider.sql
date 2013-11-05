-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 06 2013 г., 02:27
-- Версия сервера: 5.5.16
-- Версия PHP: 5.3.8

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
-- Структура таблицы `shop_slider`
--

CREATE TABLE IF NOT EXISTS `shop_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `theme` varchar(50) NOT NULL,
  `effect` varchar(50) NOT NULL,
  `slices` int(11) NOT NULL,
  `boxCols` int(11) NOT NULL,
  `boxRows` int(11) NOT NULL,
  `animSpeed` int(11) NOT NULL,
  `pauseTime` int(11) NOT NULL,
  `startSlide` int(11) NOT NULL,
  `directionNav` tinyint(1) NOT NULL,
  `controlNav` tinyint(1) NOT NULL,
  `controlNavThumbs` tinyint(1) NOT NULL,
  `pauseOnHover` tinyint(1) NOT NULL,
  `manualAdvance` tinyint(1) NOT NULL,
  `prevText` varchar(50) NOT NULL,
  `nextText` varchar(50) NOT NULL,
  `randomStart` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `shop_slider`
--

INSERT INTO `shop_slider` (`id`, `name`, `enabled`, `theme`, `effect`, `slices`, `boxCols`, `boxRows`, `animSpeed`, `pauseTime`, `startSlide`, `directionNav`, `controlNav`, `controlNavThumbs`, `pauseOnHover`, `manualAdvance`, `prevText`, `nextText`, `randomStart`) VALUES
(7, 'Новый слайдер', 1, 'default', 'random', 15, 8, 4, 500, 3000, 0, 1, 1, 1, 1, 0, 'Вперед', 'Назад', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
