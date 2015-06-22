-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2015 at 08:04 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tuto`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio_FR` text COLLATE utf8_unicode_ci,
  `bio_EN` text COLLATE utf8_unicode_ci,
  `website` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group` text COLLATE utf8_unicode_ci,
  `organization` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `firstName`, `lastName`, `bio_FR`, `bio_EN`, `website`, `type`, `group`, `organization`) VALUES
(5, 'TestPrenom', 'TestNom', '<p><br>\r\n Lorem ipsum Sed Excepteur mollit irure enim ullamco cillum culpa Excepteur incididunt adipisicing pariatur sed officia tempor tempor cupidatat aliqua ullamco amet amet amet velit in dolor labore est nulla ut occaecat tempor officia reprehenderit commodo exercitation est ut commodo adipisicing in fugiat anim id ea sunt aute culpa laboris qui quis qui occaecat irure dolore sunt minim do irure aute eu dolor incididunt fugiat tempor qui est labore est irure sed anim veniam dolor anim reprehenderit magna officia eu ad occaecat est laboris nulla eu labore consectetur culpa dolore dolore cillum dolore reprehenderit cillum ut culpa enim occaecat dolore cillum dolor mollit mollit consectetur et consectetur Duis mollit Duis labore cupidatat deserunt incididunt amet magna in proident non Ut in occaecat nisi tempor ea elit pariatur Ut qui non adipisicing pariatur enim tempor nulla Ut nisi laboris sed est aliqua ut do dolore commodo sed voluptate quis voluptate dolore amet sed officia irure laborum laborum Ut nisi incididunt adipisicing fugiat dolor tempor ut culpa nisi sit in esse proident id mollit occaecat voluptate cupidatat id nostrud aliqua ex dolor mollit non fugiat in consectetur consectetur ullamco esse enim ullamco sit elit ut in laboris dolore amet dolor dolore culpa consequat enim in anim sint laborum in ex consequat eu esse reprehenderit anim reprehenderit proident officia culpa elit et in velit eiusmod pariatur esse.<span rel="pastemarkerend" id="pastemarkerend99882"> </span></p>\r\n', '<p><br>\r\n Lorem ipsum Sed Excepteur mollit irure enim ullamco cillum culpa Excepteur incididunt adipisicing pariatur sed officia tempor tempor cupidatat aliqua ullamco amet amet amet velit in dolor labore est nulla ut occaecat tempor officia reprehenderit commodo exercitation est ut commodo adipisicing in fugiat anim id ea sunt aute culpa laboris qui quis qui occaecat irure dolore sunt minim do irure aute eu dolor incididunt fugiat tempor qui est labore est irure sed anim veniam dolor anim reprehenderit magna officia eu ad occaecat est laboris nulla eu labore consectetur culpa dolore dolore cillum dolore reprehenderit cillum ut culpa enim occaecat dolore cillum dolor mollit mollit consectetur et consectetur Duis mollit Duis labore cupidatat deserunt incididunt amet magna in proident non Ut in occaecat nisi tempor ea elit pariatur Ut qui non adipisicing pariatur enim tempor nulla Ut nisi laboris sed est aliqua ut do dolore commodo sed voluptate quis voluptate dolore amet sed officia irure laborum laborum Ut nisi incididunt adipisicing fugiat dolor tempor ut culpa nisi sit in esse proident id mollit occaecat voluptate cupidatat id nostrud aliqua ex dolor mollit non fugiat in consectetur consectetur ullamco esse enim ullamco sit elit ut in laboris dolore amet dolor dolore culpa consequat enim in anim sint laborum in ex consequat eu esse reprehenderit anim reprehenderit proident officia culpa elit et in velit eiusmod pariatur esse.<span rel="pastemarkerend" id="pastemarkerend99882"> </span></p>\r\n', 'http://www.test.fr', 'individual', NULL, 'ATI'),
(6, 'TestPrenom', 'TestNom2', '<p> Lorem ipsum Ut veniam aute qui nostrud tempor ex velit in laboris laboris aliqua quis labore dolor voluptate eu in culpa consectetur eu dolore aute non qui irure Ut Excepteur in esse fugiat magna in consequat magna cillum esse in ad do voluptate dolor sunt pariatur dolore nostrud ut non anim commodo et in quis in magna laborum in magna Excepteur officia fugiat qui non nulla Duis ad commodo aliqua dolore do ullamco aute in ad veniam id nisi irure ut veniam labore voluptate labore magna in aliqua fugiat labore consectetur magna aute velit ex dolore voluptate velit quis magna veniam enim laborum commodo nostrud id in magna quis officia nisi ad reprehenderit dolor aute eiusmod sed irure incididunt veniam eu commodo nulla dolor mollit dolor in fugiat aliqua in ea magna velit id laboris id fugiat in labore in aliqua amet deserunt commodo aliqua eiusmod nostrud consectetur cupidatat velit ex eu ad dolor qui dolor culpa dolore voluptate sit sint Ut deserunt sunt nostrud cillum.</p>\r\n', '\r\n<p>Lorem ipsum Ut veniam aute qui nostrud tempor ex velit in laboris laboris aliqua quis labore dolor voluptate eu in culpa consectetur eu dolore aute non qui irure Ut Excepteur in esse fugiat magna in consequat magna cillum esse in ad do voluptate dolor sunt pariatur dolore nostrud ut non anim commodo et in quis in magna laborum in magna Excepteur officia fugiat qui non nulla Duis ad commodo aliqua dolore do ullamco aute in ad veniam id nisi irure ut veniam labore voluptate labore magna in aliqua fugiat labore consectetur magna aute velit ex dolore voluptate velit quis magna veniam enim laborum commodo nostrud id in magna quis officia nisi ad reprehenderit dolor aute eiusmod sed irure incididunt veniam eu commodo nulla dolor mollit dolor in fugiat aliqua in ea magna velit id laboris id fugiat in labore in aliqua amet deserunt commodo aliqua eiusmod nostrud consectetur cupidatat velit ex eu ad dolor qui dolor culpa dolore voluptate sit sint Ut deserunt sunt nostrud cillum.<span rel="pastemarkerend" id="pastemarkerend21468">&nbsp;</span></p>\r\n', '', 'individual', NULL, 'ATI'),
(7, 'TestPrenom', 'TestNom2', '<p> Lorem ipsum Ut veniam aute qui nostrud tempor ex velit in laboris laboris aliqua quis labore dolor voluptate eu in culpa consectetur eu dolore aute non qui irure Ut Excepteur in esse fugiat magna in consequat magna cillum esse in ad do voluptate dolor sunt pariatur dolore nostrud ut non anim commodo et in quis in magna laborum in magna Excepteur officia fugiat qui non nulla Duis ad commodo aliqua dolore do ullamco aute in ad veniam id nisi irure ut veniam labore voluptate labore magna in aliqua fugiat labore consectetur magna aute velit ex dolore voluptate velit quis magna veniam enim laborum commodo nostrud id in magna quis officia nisi ad reprehenderit dolor aute eiusmod sed irure incididunt veniam eu commodo nulla dolor mollit dolor in fugiat aliqua in ea magna velit id laboris id fugiat in labore in aliqua amet deserunt commodo aliqua eiusmod nostrud consectetur cupidatat velit ex eu ad dolor qui dolor culpa dolore voluptate sit sint Ut deserunt sunt nostrud cillum.</p>\r\n', '<p>Lorem ipsum Ut veniam aute qui nostrud tempor ex velit in laboris laboris aliqua quis labore dolor voluptate eu in culpa consectetur eu dolore aute non qui irure Ut Excepteur in esse fugiat magna in consequat magna cillum esse in ad do voluptate dolor sunt pariatur dolore nostrud ut non anim commodo et in quis in magna laborum in magna Excepteur officia fugiat qui non nulla Duis ad commodo aliqua dolore do ullamco aute in ad veniam id nisi irure ut veniam labore voluptate labore magna in aliqua fugiat labore consectetur magna aute velit ex dolore voluptate velit quis magna veniam enim laborum commodo nostrud id in magna quis officia nisi ad reprehenderit dolor aute eiusmod sed irure incididunt veniam eu commodo nulla dolor mollit dolor in fugiat aliqua in ea magna velit id laboris id fugiat in labore in aliqua amet deserunt commodo aliqua eiusmod nostrud consectetur cupidatat velit ex eu ad dolor qui dolor culpa dolore voluptate sit sint Ut deserunt sunt nostrud cillum.<span rel="pastemarkerend" id="pastemarkerend21468"> </span></p>\r\n', '', 'individual', NULL, 'ATI');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
