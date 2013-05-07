-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 07 2013 г., 10:09
-- Версия сервера: 5.5.24-log
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `johari`
--

-- --------------------------------------------------------

--
-- Структура таблицы `features`
--

CREATE TABLE IF NOT EXISTS `features` (
  `feature_id` int(2) NOT NULL AUTO_INCREMENT,
  `feature` varchar(255) NOT NULL,
  PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Дамп данных таблицы `features`
--

INSERT INTO `features` (`feature_id`, `feature`) VALUES
(1, 'able'),
(2, 'accepting'),
(3, 'adaptable'),
(4, 'bold'),
(5, 'brave'),
(6, 'calm'),
(7, 'caring'),
(8, 'cheerful'),
(9, 'clever'),
(10, 'complex'),
(11, 'confident'),
(12, 'dependable'),
(13, 'dignified'),
(14, 'energetic'),
(15, 'extroverted'),
(16, 'friendly'),
(17, 'giving'),
(18, 'happy'),
(19, 'helpful'),
(20, 'idealistic'),
(21, 'independent'),
(22, 'ingenious'),
(23, 'intelligent'),
(24, 'introverted'),
(25, 'kind'),
(26, 'knowledgeable'),
(27, 'logical'),
(28, 'loving'),
(29, 'mature'),
(30, 'modest'),
(31, 'nervous'),
(32, 'observant'),
(33, 'organised'),
(34, 'patient'),
(35, 'powerful'),
(36, 'proud'),
(37, 'quiet'),
(38, 'reflective'),
(39, 'relaxed'),
(40, 'religious'),
(41, 'responsive'),
(42, 'searching'),
(43, 'self-assertive'),
(44, 'self-conscious'),
(45, 'sensible'),
(46, 'sentimental'),
(47, 'shy'),
(48, 'silly'),
(49, 'spontaneous'),
(50, 'sympathetic'),
(51, 'tense'),
(52, 'trustworthy'),
(53, 'warm'),
(54, 'wise'),
(55, 'witty');

-- --------------------------------------------------------

--
-- Структура таблицы `names`
--

CREATE TABLE IF NOT EXISTS `names` (
  `name_id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `names`
--

INSERT INTO `names` (`name_id`, `name`) VALUES
(16, 'Martin'),
(17, 'Joe'),
(18, 'John'),
(19, 'carlos'),
(20, 'lucas'),
(21, 'vasya'),
(22, 'Katya'),
(23, 'Bob'),
(24, 'fdfdsd'),
(25, 'Ivan'),
(26, 'Oleg');

-- --------------------------------------------------------

--
-- Структура таблицы `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
  `name` varchar(255) NOT NULL,
  `feature` int(2) NOT NULL,
  `voter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relationships`
--

INSERT INTO `relationships` (`name`, `feature`, `voter`) VALUES
('16', 41, '16'),
('16', 42, '16'),
('16', 43, '16'),
('16', 50, '16'),
('16', 51, '16'),
('16', 41, '17'),
('16', 42, '17'),
('16', 49, '17'),
('16', 50, '17'),
('16', 51, '17'),
('19', 20, '18'),
('19', 21, '18'),
('19', 22, '18'),
('19', 28, '18'),
('19', 29, '18'),
('19', 30, '18'),
('20', 18, '20'),
('20', 25, '20'),
('20', 33, '20'),
('20', 34, '20'),
('20', 35, '20'),
('20', 42, '20'),
('20', 20, '21'),
('20', 21, '21'),
('20', 29, '21'),
('20', 30, '21'),
('20', 31, '21'),
('20', 19, '22'),
('20', 27, '22'),
('20', 35, '22'),
('20', 43, '22'),
('20', 51, '22'),
('20', 19, '22'),
('20', 27, '22'),
('20', 28, '22'),
('20', 35, '22'),
('20', 36, '22'),
('20', 28, '22'),
('20', 35, '22'),
('20', 36, '22'),
('20', 42, '22'),
('20', 43, '22'),
('20', 34, '22'),
('20', 35, '22'),
('20', 42, '22'),
('20', 43, '22'),
('20', 50, '22'),
('20', 28, '23'),
('20', 29, '23'),
('20', 35, '23'),
('20', 36, '23'),
('20', 43, '23'),
('20', 37, '24'),
('20', 38, '24'),
('20', 45, '24'),
('20', 46, '24'),
('20', 52, '24'),
('25', 34, '25'),
('25', 35, '25'),
('25', 43, '25'),
('25', 44, '25'),
('25', 45, '25'),
('25', 35, '26'),
('25', 36, '26'),
('25', 44, '26'),
('25', 45, '26'),
('25', 52, '26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
