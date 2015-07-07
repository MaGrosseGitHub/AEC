-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2015 at 01:38 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
  `slug` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `firstName`, `lastName`, `bio_FR`, `bio_EN`, `website`, `type`, `group`, `organization`, `slug`) VALUES
(5, 'TestPrenom', 'TestNom', '<p><br>\r\n Lorem ipsum Sed Excepteur mollit irure enim ullamco cillum culpa Excepteur incididunt adipisicing pariatur sed officia tempor tempor cupidatat aliqua ullamco amet amet amet velit in dolor labore est nulla ut occaecat tempor officia reprehenderit commodo exercitation est ut commodo adipisicing in fugiat anim id ea sunt aute culpa laboris qui quis qui occaecat irure dolore sunt minim do irure aute eu dolor incididunt fugiat tempor qui est labore est irure sed anim veniam dolor anim reprehenderit magna officia eu ad occaecat est laboris nulla eu labore consectetur culpa dolore dolore cillum dolore reprehenderit cillum ut culpa enim occaecat dolore cillum dolor mollit mollit consectetur et consectetur Duis mollit Duis labore cupidatat deserunt incididunt amet magna in proident non Ut in occaecat nisi tempor ea elit pariatur Ut qui non adipisicing pariatur enim tempor nulla Ut nisi laboris sed est aliqua ut do dolore commodo sed voluptate quis voluptate dolore amet sed officia irure laborum laborum Ut nisi incididunt adipisicing fugiat dolor tempor ut culpa nisi sit in esse proident id mollit occaecat voluptate cupidatat id nostrud aliqua ex dolor mollit non fugiat in consectetur consectetur ullamco esse enim ullamco sit elit ut in laboris dolore amet dolor dolore culpa consequat enim in anim sint laborum in ex consequat eu esse reprehenderit anim reprehenderit proident officia culpa elit et in velit eiusmod pariatur esse.<span rel="pastemarkerend" id="pastemarkerend99882"> </span></p>\r\n', '<p><br>\r\n Lorem ipsum Sed Excepteur mollit irure enim ullamco cillum culpa Excepteur incididunt adipisicing pariatur sed officia tempor tempor cupidatat aliqua ullamco amet amet amet velit in dolor labore est nulla ut occaecat tempor officia reprehenderit commodo exercitation est ut commodo adipisicing in fugiat anim id ea sunt aute culpa laboris qui quis qui occaecat irure dolore sunt minim do irure aute eu dolor incididunt fugiat tempor qui est labore est irure sed anim veniam dolor anim reprehenderit magna officia eu ad occaecat est laboris nulla eu labore consectetur culpa dolore dolore cillum dolore reprehenderit cillum ut culpa enim occaecat dolore cillum dolor mollit mollit consectetur et consectetur Duis mollit Duis labore cupidatat deserunt incididunt amet magna in proident non Ut in occaecat nisi tempor ea elit pariatur Ut qui non adipisicing pariatur enim tempor nulla Ut nisi laboris sed est aliqua ut do dolore commodo sed voluptate quis voluptate dolore amet sed officia irure laborum laborum Ut nisi incididunt adipisicing fugiat dolor tempor ut culpa nisi sit in esse proident id mollit occaecat voluptate cupidatat id nostrud aliqua ex dolor mollit non fugiat in consectetur consectetur ullamco esse enim ullamco sit elit ut in laboris dolore amet dolor dolore culpa consequat enim in anim sint laborum in ex consequat eu esse reprehenderit anim reprehenderit proident officia culpa elit et in velit eiusmod pariatur esse.<span rel="pastemarkerend" id="pastemarkerend99882"> </span></p>\r\n', 'http://www.test.fr', 'individual', NULL, 'ATI', 'testprenomtestnom'),
(6, 'TestPrenom', 'TestNom2', '<p> Lorem ipsum Ut veniam aute qui nostrud tempor ex velit in laboris laboris aliqua quis labore dolor voluptate eu in culpa consectetur eu dolore aute non qui irure Ut Excepteur in esse fugiat magna in consequat magna cillum esse in ad do voluptate dolor sunt pariatur dolore nostrud ut non anim commodo et in quis in magna laborum in magna Excepteur officia fugiat qui non nulla Duis ad commodo aliqua dolore do ullamco aute in ad veniam id nisi irure ut veniam labore voluptate labore magna in aliqua fugiat labore consectetur magna aute velit ex dolore voluptate velit quis magna veniam enim laborum commodo nostrud id in magna quis officia nisi ad reprehenderit dolor aute eiusmod sed irure incididunt veniam eu commodo nulla dolor mollit dolor in fugiat aliqua in ea magna velit id laboris id fugiat in labore in aliqua amet deserunt commodo aliqua eiusmod nostrud consectetur cupidatat velit ex eu ad dolor qui dolor culpa dolore voluptate sit sint Ut deserunt sunt nostrud cillum.</p>\r\n', '\r\n<p>Lorem ipsum Ut veniam aute qui nostrud tempor ex velit in laboris laboris aliqua quis labore dolor voluptate eu in culpa consectetur eu dolore aute non qui irure Ut Excepteur in esse fugiat magna in consequat magna cillum esse in ad do voluptate dolor sunt pariatur dolore nostrud ut non anim commodo et in quis in magna laborum in magna Excepteur officia fugiat qui non nulla Duis ad commodo aliqua dolore do ullamco aute in ad veniam id nisi irure ut veniam labore voluptate labore magna in aliqua fugiat labore consectetur magna aute velit ex dolore voluptate velit quis magna veniam enim laborum commodo nostrud id in magna quis officia nisi ad reprehenderit dolor aute eiusmod sed irure incididunt veniam eu commodo nulla dolor mollit dolor in fugiat aliqua in ea magna velit id laboris id fugiat in labore in aliqua amet deserunt commodo aliqua eiusmod nostrud consectetur cupidatat velit ex eu ad dolor qui dolor culpa dolore voluptate sit sint Ut deserunt sunt nostrud cillum.<span rel="pastemarkerend" id="pastemarkerend21468">&nbsp;</span></p>\r\n', '', 'individual', NULL, 'ati', 'testprenomtestnom2'),
(7, 'TestPrenom', 'TestNom2', '<p> Lorem ipsum Ut veniam aute qui nostrud tempor ex velit in laboris laboris aliqua quis labore dolor voluptate eu in culpa consectetur eu dolore aute non qui irure Ut Excepteur in esse fugiat magna in consequat magna cillum esse in ad do voluptate dolor sunt pariatur dolore nostrud ut non anim commodo et in quis in magna laborum in magna Excepteur officia fugiat qui non nulla Duis ad commodo aliqua dolore do ullamco aute in ad veniam id nisi irure ut veniam labore voluptate labore magna in aliqua fugiat labore consectetur magna aute velit ex dolore voluptate velit quis magna veniam enim laborum commodo nostrud id in magna quis officia nisi ad reprehenderit dolor aute eiusmod sed irure incididunt veniam eu commodo nulla dolor mollit dolor in fugiat aliqua in ea magna velit id laboris id fugiat in labore in aliqua amet deserunt commodo aliqua eiusmod nostrud consectetur cupidatat velit ex eu ad dolor qui dolor culpa dolore voluptate sit sint Ut deserunt sunt nostrud cillum.</p>\r\n', '<p>Lorem ipsum Ut veniam aute qui nostrud tempor ex velit in laboris laboris aliqua quis labore dolor voluptate eu in culpa consectetur eu dolore aute non qui irure Ut Excepteur in esse fugiat magna in consequat magna cillum esse in ad do voluptate dolor sunt pariatur dolore nostrud ut non anim commodo et in quis in magna laborum in magna Excepteur officia fugiat qui non nulla Duis ad commodo aliqua dolore do ullamco aute in ad veniam id nisi irure ut veniam labore voluptate labore magna in aliqua fugiat labore consectetur magna aute velit ex dolore voluptate velit quis magna veniam enim laborum commodo nostrud id in magna quis officia nisi ad reprehenderit dolor aute eiusmod sed irure incididunt veniam eu commodo nulla dolor mollit dolor in fugiat aliqua in ea magna velit id laboris id fugiat in labore in aliqua amet deserunt commodo aliqua eiusmod nostrud consectetur cupidatat velit ex eu ad dolor qui dolor culpa dolore voluptate sit sint Ut deserunt sunt nostrud cillum.<span rel="pastemarkerend" id="pastemarkerend21468"> </span></p>\r\n', '', 'individual', NULL, 'other', 'testprenomtestnom2'),
(8, 'LABEX', 'LABEX', '<p>Lorem ipsum Quis incididunt sed et quis ut incididunt nulla occaecat do sunt adipisicing exercitation cupidatat et laboris dolor est incididunt aliqua non amet occaecat dolore adipisicing nostrud mollit fugiat in Duis do irure culpa ut in eiusmod elit in in nulla sit quis consequat in Ut eu Ut Duis irure et magna ut fugiat id proident dolore incididunt dolore et officia officia amet consectetur minim sunt eiusmod consectetur reprehenderit in exercitation nisi aute pariatur dolore velit et in dolor incididunt consequat fugiat labore veniam aliqua eu sunt Excepteur aliquip reprehenderit do voluptate minim irure minim ullamco non aute ullamco adipisicing veniam anim ut fugiat quis laboris ullamco et voluptate laborum pariatur Duis non pariatur dolore esse labore est esse laborum minim id amet fugiat elit eiusmod incididunt ea in sunt Ut sunt Duis enim cillum exercitation eu eiusmod aliqua consequat aliqua nostrud Duis sunt esse cupidatat sed voluptate officia non do deserunt quis et sint sed dolor laboris pariatur consectetur ea in aliqua voluptate culpa ut ut in dolor nostrud nulla in aute est aute aliquip aliquip.</p>\r\n', '<p>Lorem ipsum Quis incididunt sed et quis ut incididunt nulla occaecat do sunt adipisicing exercitation cupidatat et laboris dolor est incididunt aliqua non amet occaecat dolore adipisicing nostrud mollit fugiat in Duis do irure culpa ut in eiusmod elit in in nulla sit quis consequat in Ut eu Ut Duis irure et magna ut fugiat id proident dolore incididunt dolore et officia officia amet consectetur minim sunt eiusmod consectetur reprehenderit in exercitation nisi aute pariatur dolore velit et in dolor incididunt consequat fugiat labore veniam aliqua eu sunt Excepteur aliquip reprehenderit do voluptate minim irure minim ullamco non aute ullamco adipisicing veniam anim ut fugiat quis laboris ullamco et voluptate laborum pariatur Duis non pariatur dolore esse labore est esse laborum minim id amet fugiat elit eiusmod incididunt ea in sunt Ut sunt Duis enim cillum exercitation eu eiusmod aliqua consequat aliqua nostrud Duis sunt esse cupidatat sed voluptate officia non do deserunt quis et sint sed dolor laboris pariatur consectetur ea in aliqua voluptate culpa ut ut in dolor nostrud nulla in aute est aute aliquip aliquip.<span rel="pastemarkerend" id="pastemarkerend10206"> </span></p>\r\n', 'http://www.test.fr', 'organization', NULL, NULL, 'labexlabex'),
(9, 'dfh', 'dfhhbj', '\r\n<p>Lorem ipsum Quis incididunt sed et quis ut incididunt nulla occaecat do sunt adipisicing exercitation cupidatat et laboris dolor est incididunt aliqua non amet occaecat dolore adipisicing nostrud mollit fugiat in Duis do irure culpa ut in eiusmod elit in in nulla sit quis consequat in Ut eu Ut Duis irure et magna ut fugiat id proident dolore incididunt dolore et officia officia amet consectetur minim sunt eiusmod consectetur reprehenderit in exercitation nisi aute pariatur dolore velit et in dolor incididunt consequat fugiat labore veniam aliqua eu sunt Excepteur aliquip reprehenderit do voluptate minim irure minim ullamco non aute ullamco adipisicing veniam anim ut fugiat quis laboris ullamco et voluptate laborum pariatur Duis non pariatur dolore esse labore est esse laborum minim id amet fugiat elit eiusmod incididunt ea in sunt Ut sunt Duis enim cillum exercitation eu eiusmod aliqua consequat aliqua nostrud Duis sunt esse cupidatat sed voluptate officia non do deserunt quis et sint sed dolor laboris pariatur consectetur ea in aliqua voluptate culpa ut ut in dolor nostrud nulla in aute est aute aliquip aliquip.<span rel="pastemarkerend" id="pastemarkerend74889">&nbsp;</span></p>\r\n', '\r\n<p>Lorem ipsum Quis incididunt sed et quis ut incididunt nulla occaecat do sunt adipisicing exercitation cupidatat et laboris dolor est incididunt aliqua non amet occaecat dolore adipisicing nostrud mollit fugiat in Duis do irure culpa ut in eiusmod elit in in nulla sit quis consequat in Ut eu Ut Duis irure et magna ut fugiat id proident dolore incididunt dolore et officia officia amet consectetur minim sunt eiusmod consectetur reprehenderit in exercitation nisi aute pariatur dolore velit et in dolor incididunt consequat fugiat labore veniam aliqua eu sunt Excepteur aliquip reprehenderit do voluptate minim irure minim ullamco non aute ullamco adipisicing veniam anim ut fugiat quis laboris ullamco et voluptate laborum pariatur Duis non pariatur dolore esse labore est esse laborum minim id amet fugiat elit eiusmod incididunt ea in sunt Ut sunt Duis enim cillum exercitation eu eiusmod aliqua consequat aliqua nostrud Duis sunt esse cupidatat sed voluptate officia non do deserunt quis et sint sed dolor laboris pariatur consectetur ea in aliqua voluptate culpa ut ut in dolor nostrud nulla in aute est aute aliquip aliquip.<span rel="pastemarkerend" id="pastemarkerend77524">&nbsp;</span></p>\r\n', 'http://www.gameinformer.com', 'individual', NULL, 'labex', 'dfhdfhhbj'),
(10, 'Other', 'Other', '\r\n<p>other</p>\r\n', '\r\n<p>other</p>\r\n', 'http://www.localhost.fr/', 'organization', NULL, NULL, 'otherother'),
(11, 'ATI', 'ATI', '\r\n<p>Lorem ipsum Cupidatat reprehenderit amet dolore sed ea eiusmod in aliqua pariatur velit Ut quis non in voluptate veniam ad veniam Ut Duis elit consectetur esse Ut laborum Excepteur consequat veniam minim ullamco culpa aute nostrud Ut incididunt magna dolor veniam velit consectetur dolore sit laborum in sed consectetur incididunt velit enim veniam minim do nulla in proident in ut id commodo pariatur ullamco in sit proident nisi irure nulla aliquip ad labore non minim ullamco irure id cillum veniam Excepteur reprehenderit in mollit velit eiusmod anim eiusmod commodo amet non est ut Ut sint fugiat ex proident culpa laboris nostrud enim ut incididunt sed in id mollit culpa est laboris adipisicing id aute anim irure ut irure do in esse proident minim exercitation in elit eiusmod nisi reprehenderit eu commodo sunt dolore do in magna ea labore quis culpa esse proident fugiat dolore amet sit aliqua culpa anim eiusmod anim tempor est officia mollit esse anim quis minim ullamco in reprehenderit in nulla officia dolor sint deserunt nulla est consectetur Duis officia cillum dolore ut in non irure est sit consectetur sed cupidatat ea do aliqua deserunt incididunt ex irure quis aliqua dolor in deserunt sint deserunt proident nulla adipisicing quis in voluptate culpa minim eiusmod.<br>\r\n<span rel="pastemarkerend" id="pastemarkerend83955">&nbsp;</span><br>\r\n</p>\r\n', '\r\n<p>Lorem ipsum Cupidatat reprehenderit amet dolore sed ea eiusmod in aliqua pariatur velit Ut quis non in voluptate veniam ad veniam Ut Duis elit consectetur esse Ut laborum Excepteur consequat veniam minim ullamco culpa aute nostrud Ut incididunt magna dolor veniam velit consectetur dolore sit laborum in sed consectetur incididunt velit enim veniam minim do nulla in proident in ut id commodo pariatur ullamco in sit proident nisi irure nulla aliquip ad labore non minim ullamco irure id cillum veniam Excepteur reprehenderit in mollit velit eiusmod anim eiusmod commodo amet non est ut Ut sint fugiat ex proident culpa laboris nostrud enim ut incididunt sed in id mollit culpa est laboris adipisicing id aute anim irure ut irure do in esse proident minim exercitation in elit eiusmod nisi reprehenderit eu commodo sunt dolore do in magna ea labore quis culpa esse proident fugiat dolore amet sit aliqua culpa anim eiusmod anim tempor est officia mollit esse anim quis minim ullamco in reprehenderit in nulla officia dolor sint deserunt nulla est consectetur Duis officia cillum dolore ut in non irure est sit consectetur sed cupidatat ea do aliqua deserunt incididunt ex irure quis aliqua dolor in deserunt sint deserunt proident nulla adipisicing quis in voluptate culpa minim eiusmod.<br>\r\n<span rel="pastemarkerend" id="pastemarkerend45286">&nbsp;</span><br>\r\n</p>\r\n', 'http://www.test.fr', 'organization', NULL, NULL, 'atiati');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'Parapente', 'parapente'),
(2, 'Parachute', 'parachute'),
(3, 'Aviation', 'aviation');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auteur` varchar(255) CHARACTER SET utf8 NOT NULL,
  `titre` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `fromDate` int(20) NOT NULL,
  `toDate` int(20) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `slug`, `auteur`, `titre`, `description`, `fromDate`, `toDate`, `type`, `location`) VALUES
(1, '', 'test', 'test', 'test', 1377993600, 1378166400, 'aviation', ''),
(2, '', 'user2', 'titre', 'description', 1378080000, 1378512000, 'parapente', ''),
(3, '', 'u3', 'titre3', 'desc3', 1378684800, 1378684800, 'parapente', ''),
(4, '', 'user2', 'test56', 'fygn,l;mpmkhomhn', 1379203200, 1379721600, 'parachute', ''),
(5, '', 'user2', 'test des mois', '<p>lorem ipsum</p>', 1380240000, 1381276800, 'parapente', ''),
(6, '', 'user2', 'test des mois 2', '<p>lorem ipsum</p>', 1380412800, 1381536000, 'aviation', ''),
(7, 'test-des-annees', 'user2', 'test des années', '<p><span style="text-decoration: underline;"><em><strong>Lorem ipsum dolor amet</strong></em></span></p>', 1410480000, 1411171200, 'parapente', ''),
(8, 'test-des-annees-et-des-mois', 'admin', 'test des années et des mois', '<p><span style="text-decoration: underline;"><em><strong>lorem</strong></em></span></p>', 1388102400, 1389139200, 'aviation', ''),
(9, 'test-des-annees-et-des-mois-2', 'test', 'test des années et des mois 2', '<p>lorem ipsum encore</p>', 1388361600, 1388707200, 'parapente', ''),
(10, '', 'user2', 'test des inputs', '<p>lorem test</p>', 1379721600, 1380153600, 'parachute', ''),
(13, '', 'user2', 'test des inputs 2', '<p>rytuyiuhojkl</p>', 1379721600, 1379721600, 'parachute', ''),
(14, '', 'user2', 'test des inputs 3', '<p>dsfhnukulgjfgbrshnby</p>', 1380326400, 1380412800, 'aviation', ''),
(15, 'test-multiples-evens-sur-deux-ans', 'test', 'test multiples evens, sur deux ans', '<p>lorem ipsum</p>', 1388188800, 1388793600, 'parachute', ''),
(16, 'test-multiples-evens-sur-deux-ans-2', 'admin', 'test multiples evens, sur deux ans 2', '<p><span style="text-decoration: underline;"><strong>dfjtyjhrhtrbrhrt</strong></span></p>', 1386288000, 1390521600, 'aviation', ''),
(17, '', 'user2', 'test aviation', '\r\n<p>fhtyyt</p>\r\n', 1379721600, 1379721600, 'aviation', ''),
(18, 'test-des-changement', 'user2', 'test des changement', '<p>lerem ipusm</p>\r\n', 1387497600, 1388188800, 'parachute', ''),
(19, 'test-2014', 'admin', 'test 2014', '\r\n<p>sdhftykyufk</p>\r\n', 1396310400, 1397088000, 'parachute', ''),
(20, 'test-laurent', 'admin', 'test Laurent', '<p>testeestestee</p>\r\n', 1411516800, 1411516800, 'parapente', ''),
(21, 'test-2', 'test', 'test 2', '\r\n<p>ezhrrtuherg</p>\r\n', 1411689600, 1413417600, 'aviation', '');

-- --------------------------------------------------------

--
-- Table structure for table `mapinfos`
--

CREATE TABLE IF NOT EXISTS `mapinfos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `maps_id` int(3) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `adresse` varchar(500) NOT NULL,
  `department_name` varchar(500) NOT NULL,
  `department_num` int(3) NOT NULL,
  `region` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mapinfos`
--

INSERT INTO `mapinfos` (`id`, `maps_id`, `lat`, `lng`, `adresse`, `department_name`, `department_num`, `region`) VALUES
(1, 1, 48.9407429, 2.3557018999999855, '5 rue auguste poullain 93200 saint-denis', 'seine-saint-denis', 93, 'Île-de-France'),
(2, 2, 48.93860052944034, 2.354886508459458, '4 Boulevard Carnot, 93200 Saint-Denis, France', 'seine-saint-denis', 93, 'Île-de-France'),
(3, 3, 48.916563, 2.359468099999958, '5 Rue Paul Lafargue, 93210 Saint-Denis, France', 'seine-saint-denis', 93, 'Île-de-France'),
(4, 4, 48.9287629, 2.2728700999999774, '5 Allée des zinnias 92600 asnieres sur seine', 'hauts-de-seine', 92, 'Île-de-France'),
(5, 5, 48.9455196, 2.363317400000028, '2 Rue de la Liberté, 93200 Saint-Denis', 'seine-saint-denis', 93, 'Île-de-France'),
(6, 6, 43.6104125, 1.4528680999999324, '31 Rue Bertrand de Born, 31000 Toulouse', 'toulouse', 31, 'Midi Pyrénées');

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE IF NOT EXISTS `maps` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_event` int(3) NOT NULL,
  `type` varchar(255) NOT NULL,
  `club` varchar(500) NOT NULL,
  `event` varchar(255) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `mapInfo` text NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `maps`
--

INSERT INTO `maps` (`id`, `id_event`, `type`, `club`, `event`, `title`, `content`, `mapInfo`, `date`) VALUES
(1, 1, 'parapente', 'club1', 'site', 'test de titre', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', '{"latlng":{"lat":48.9407429,"lng":2.3557019},"adresse":"5 rue auguste poullain 93200 saint-denis","departement":{"name":"seine-saint-denis","num":"93"},"region":"\\u00cele-de-France"}', 1385748639),
(2, 16, 'parapente', 'club5', 'event', 'titre1', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', '{"latlng":{"lat":48.93860052944,"lng":2.3548865084595},"adresse":"4 Boulevard Carnot, 93200 Saint-Denis, France","departement":{"name":"seine-saint-denis","num":"93"},"region":"\\u00cele-de-France"}', 1385748639),
(3, 1, 'parachute', 'club1', 'club', 'titre pour club', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', '{"latlng":{"lat":48.916563,"lng":2.3594681},"adresse":"5 Rue Paul Lafargue, 93210 Saint-Denis, France","departement":{"name":"seine-saint-denis","num":"93"},"region":"\\u00cele-de-France"}', 1385748639),
(4, 2, 'parachute', 'clubTest', 'club', 'lorem ipsum', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', '{"latlng":{"lat":48.9287629,"lng":2.2728701},"adresse":"5 All\\u00e9e des zinnias 92600 asnieres sur seine","departement":{"name":"hauts-de-seine","num":"92"},"region":"\\u00cele-de-France"}', 1385748639),
(5, 2, 'aviation', 'club5', 'site', 'test', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', '{"latlng":{"lat":48.9455196,"lng":2.3633174},"adresse":"2 Rue de la Libert\\u00e9, 93200 Saint-Denis","departement":{"name":"seine-saint-denis","num":"93"},"region":"\\u00cele-de-France"}', 1385748639),
(6, 3, 'aviation', 'club5', 'site', 'titre aviation', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', '{"latlng":{"lat":43.6104125,"lng":1.4528680999999},"adresse":"31 Rue Bertrand de Born, 31000 Toulouse","departement":{"name":"toulouse","num":"31"},"region":"Midi Pyr\\u00e9n\\u00e9es"}', 1385748639);

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `album` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `eventType` varchar(255) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_medias_posts` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=299 ;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `name`, `file`, `post_id`, `type`, `album`, `user`, `eventType`, `date`) VALUES
(10, 'if-ifttt-com-then-1066.jpg', '2011-09/if-ifttt-com-then-1066.jpg', 9, 'img', '', 'admin', 'parachute', 1385748639),
(7, '1password-votre-coffre-fort-virtuel-1070.jpg', '2011-09/1password-votre-coffre-fort-virtuel-1070.jpg', 19, 'img', '', 'admin', 'parachute', 1385748639),
(9, 'cetait-mieux-pas-mieux-avant-1063.jpg', '2011-09/cetait-mieux-pas-mieux-avant-1063.jpg', 17, 'img', '', 'admin', 'parachute', 1385748639),
(11, 'ME - Mako.jpg', '2013-08/ME - Mako.jpg', 17, 'img', '', 'admin', 'parachute', 1385748639),
(219, 'bLSn0Bqd2Ful3Hy7fOs41386240237.jpg', 'galerie/club1/bLSn0Bqd2Ful3Hy7fOs41386240237.jpg', NULL, 'img', '', 'admin', 'aviation', 1385748639),
(192, 'U8rdySCJLHlFbDj3apeq1382077568.jpg', 'galerie/club1/U8rdySCJLHlFbDj3apeq1382077568.jpg', NULL, 'img', 'test', 'admin', 'parachute', 1385748740),
(193, 'koJTeCEDA8lqdXHFm5PQ1382077588.jpg', 'galerie/club1/koJTeCEDA8lqdXHFm5PQ1382077588.jpg', NULL, 'img', '2emeAlbum', 'admin', 'parapente', 1385748639),
(216, '1xeiqHY36GtmloMwJUAB1382283880.jpg', 'galerie/club1/1xeiqHY36GtmloMwJUAB1382283880.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748839),
(194, 'pVGuszfTqd7QwHFZMUb91382077589.jpg', 'galerie/club1/pVGuszfTqd7QwHFZMUb91382077589.jpg', NULL, 'img', 'AlbumTest', 'admin', 'parachute', 1385748639),
(190, '2fRJSqVbo1CFdn60wyjE1382077550.jpg', 'galerie/club1/2fRJSqVbo1CFdn60wyjE1382077550.jpg', NULL, 'img', 'AlbumTest', 'admin', 'parachute', 1385748839),
(191, 'EBRFQXZWrNM7LTs51PiC1382077561.jpg', 'galerie/club1/EBRFQXZWrNM7LTs51PiC1382077561.jpg', NULL, 'img', 'AlbumTest', 'admin', 'parachute', 1385748639),
(212, 'AlbumTest', NULL, NULL, 'album', 'galerie/club1/pVGuszfTqd7QwHFZMUb91382077589.jpg,galerie/club1/EBRFQXZWrNM7LTs51PiC1382077561.jpg,galerie/club1/86lkL2XpxamJTiBH5ctu1382077614.jpg,galerie/club1/2fRJSqVbo1CFdn60wyjE1382077550.jpg,galerie/club1/muVFlBbdq17a8YDeMWPw1382077589.jpg,galerie/club1/605NGnKhmAyYHCskOiW71382302042.jpg,galerie/club1/605NGnKhmAyYHCskOiW71382302042.jpg,galerie/club1/605NGnKhmAyYHCskOiW71382302042.jpg,[jhaNkHRF8pM+youtube]', 'admin', 'parachute', 1385748639),
(296, 'ZXvzp3BhyjiQ4blxAkTs1391300004.jpg', 'galerie/admin/ZXvzp3BhyjiQ4blxAkTs1391300004.jpg', NULL, 'img', '', 'admin', 'parachute', 1359748639),
(213, '2emeAlbum', NULL, NULL, 'album', '[jhaNkHRF8pM+youtube+galerie/admin/46zlVyu7eH2Evq5QKtpD1386530731.jpg],galerie/club1/koJTeCEDA8lqdXHFm5PQ1382077588.jpg,galerie/club1/1EBdak4KfbGlUH0IQRTA1382077590.jpg', 'test', 'parapente', 1385748939),
(195, 'muVFlBbdq17a8YDeMWPw1382077589.jpg', 'galerie/club1/muVFlBbdq17a8YDeMWPw1382077589.jpg', NULL, 'img', 'AlbumTest', 'admin', 'parachute', 1385748639),
(215, 'AAlbum', NULL, NULL, 'album', '', 'admin', 'parachute', 1385748639),
(196, '8AlVREBNk3MnSZJKfuq61382077589.jpg', 'galerie/club1/8AlVREBNk3MnSZJKfuq61382077589.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(214, 'AutreAlbum', NULL, NULL, 'album', '', 'admin', 'parachute', 1385748639),
(197, '1EBdak4KfbGlUH0IQRTA1382077590.jpg', 'galerie/club1/1EBdak4KfbGlUH0IQRTA1382077590.jpg', NULL, 'img', '2emeAlbum', 'admin', 'parapente', 1385748639),
(198, '86lkL2XpxamJTiBH5ctu1382077614.jpg', 'galerie/club1/86lkL2XpxamJTiBH5ctu1382077614.jpg', NULL, 'img', 'AlbumTest', 'admin', 'parachute', 1385748639),
(217, '605NGnKhmAyYHCskOiW71382302042.jpg', 'galerie/club1/605NGnKhmAyYHCskOiW71382302042.jpg', NULL, 'img', 'AlbumTest', 'admin', 'parachute', 1385748639),
(218, 'qFKbxEyM1TpLBmSNcswU1382302710.jpg', 'galerie/club1/qFKbxEyM1TpLBmSNcswU1382302710.jpg', NULL, 'img', '', 'admin', 'aviation', 1385748639),
(220, 'PL5WyUeOu4t7iApIxoRq1386252230.jpg', 'galerie/club1/PL5WyUeOu4t7iApIxoRq1386252230.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(221, 'kPaJ4AnTcGlEtRZiuNrd1386252231.jpg', 'galerie/club1/kPaJ4AnTcGlEtRZiuNrd1386252231.jpg', NULL, 'img', '', 'admin', 'aviation', 1385748639),
(222, 'nIhDgOTW6j3pVzoBaXPS1386252231.jpg', 'galerie/club1/nIhDgOTW6j3pVzoBaXPS1386252231.jpg', NULL, 'img', '', 'admin', 'parachute', 1385848639),
(223, 'rc4Vxqu1IJNyTjOMZL7G1386252232.jpg', 'galerie/club1/rc4Vxqu1IJNyTjOMZL7G1386252232.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(224, 'ZJ31GpwHgblFECU9moeT1386252233.jpg', 'galerie/club1/ZJ31GpwHgblFECU9moeT1386252233.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(225, 'krY37MojS8X4lJFg6P0L1386252234.jpg', 'galerie/club1/krY37MojS8X4lJFg6P0L1386252234.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(226, 'bDCGS3oXI2s5icMv1lq91386252235.jpg', 'galerie/club1/bDCGS3oXI2s5icMv1lq91386252235.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(227, 'CYuDZNHF2oz5pG08rWKa1386252235.jpg', 'galerie/club1/CYuDZNHF2oz5pG08rWKa1386252235.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(228, 'pUtJSKuC1rcvOgkoB70R1386252235.jpg', 'galerie/club1/pUtJSKuC1rcvOgkoB70R1386252235.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(229, 'gpN2EXuC4TD3obJ1fert1386252236.jpg', 'galerie/club1/gpN2EXuC4TD3obJ1fert1386252236.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(230, 'ob5A0xszi6JdSMFjqYLH1386252236.jpg', 'galerie/club1/ob5A0xszi6JdSMFjqYLH1386252236.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(231, 'HfPnVdZgBlIXvLhKJyAc1386252237.jpg', 'galerie/club1/HfPnVdZgBlIXvLhKJyAc1386252237.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(232, 'L2AXFlvONmRbU5ugG64w1386252237.jpg', 'galerie/club1/L2AXFlvONmRbU5ugG64w1386252237.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(233, 'dH8wi5YgrL0q3mspzN2K1386252238.jpg', 'galerie/club1/dH8wi5YgrL0q3mspzN2K1386252238.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(234, 'eLXlKjoR6SBbNMivV1mF1386252239.jpg', 'galerie/club1/eLXlKjoR6SBbNMivV1mF1386252239.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(235, 'Xr5wIG8EagzoZj1vUc4B1386252240.jpg', 'galerie/club1/Xr5wIG8EagzoZj1vUc4B1386252240.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(236, 'voAFEIhZu0WYXsyePwmk1386252241.jpg', 'galerie/club1/voAFEIhZu0WYXsyePwmk1386252241.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(237, '3B7i8aIEZxtLlTbSpUN11386252241.jpg', 'galerie/club1/3B7i8aIEZxtLlTbSpUN11386252241.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(238, 'eHyZzodC5t86qOxl1AbR1386252242.jpg', 'galerie/club1/eHyZzodC5t86qOxl1AbR1386252242.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(239, 'tuO4HQolD6q5S8UhFJAy1386252243.jpg', 'galerie/club1/tuO4HQolD6q5S8UhFJAy1386252243.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(240, 'RN0F6LJgzwpSaIPMmUQA1386252244.jpg', 'galerie/club1/RN0F6LJgzwpSaIPMmUQA1386252244.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(241, 'RZkvQ0SBVcEdtmDgbIfo1386252245.jpg', 'galerie/club1/RZkvQ0SBVcEdtmDgbIfo1386252245.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(242, 'iKQqPBXYtLh36JkFy12D1386252246.jpg', 'galerie/club1/iKQqPBXYtLh36JkFy12D1386252246.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(243, '9gaMjxbeYRTqLH4JXwzp1386252247.jpg', 'galerie/club1/9gaMjxbeYRTqLH4JXwzp1386252247.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(244, '78tkKdZl61bxngPFi3Hf1386252247.jpg', 'galerie/club1/78tkKdZl61bxngPFi3Hf1386252247.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(245, 'kVujLJIcW3R8wpbC6Zfm1386252248.jpg', 'galerie/club1/kVujLJIcW3R8wpbC6Zfm1386252248.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(246, 'uICtTxVEJB06maQgXoyh1386252339.jpg', 'galerie/club1/uICtTxVEJB06maQgXoyh1386252339.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(247, 'ZbuGzQdqBLDFo1se69pt1386252340.jpg', 'galerie/club1/ZbuGzQdqBLDFo1se69pt1386252340.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(248, 'qeFfo8pclYAGzTtL1Wym1386252341.jpg', 'galerie/club1/qeFfo8pclYAGzTtL1Wym1386252341.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(249, 'ebuwL8pEK4UXgAZc0lsG1386252345.jpg', 'galerie/club1/ebuwL8pEK4UXgAZc0lsG1386252345.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(250, 'U4CRkANtYQwKarVcZEOT1386252345.jpg', 'galerie/club1/U4CRkANtYQwKarVcZEOT1386252345.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(251, 'zmpAtMTByVEDLeZaGWg91386252346.jpg', 'galerie/club1/zmpAtMTByVEDLeZaGWg91386252346.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(252, 'nsYlXa7ACIxZyNiGQd3o1386252346.jpg', 'galerie/club1/nsYlXa7ACIxZyNiGQd3o1386252346.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(253, 'YMcZL0Fkq73lO9CefUwb1386252347.jpg', 'galerie/club1/YMcZL0Fkq73lO9CefUwb1386252347.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(254, 'SDxdMYwTie5VsCGcOF4m1386252348.jpg', 'galerie/club1/SDxdMYwTie5VsCGcOF4m1386252348.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(255, 'rgURcqjm278DEox1LMau1386252348.jpg', 'galerie/club1/rgURcqjm278DEox1LMau1386252348.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(256, 's1aQTpFJKc4lg2mYAIqd1386252348.jpg', 'galerie/club1/s1aQTpFJKc4lg2mYAIqd1386252348.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(257, 'rnRgxBzd3LWktKyjDIU81386252348.jpg', 'galerie/club1/rnRgxBzd3LWktKyjDIU81386252348.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(258, 'ahKsL2wgMSHOIUmZuVvx1386252349.jpg', 'galerie/club1/ahKsL2wgMSHOIUmZuVvx1386252349.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(259, 'eJYuUrhvTHmIVOPbzXZQ1386252350.jpg', 'galerie/club1/eJYuUrhvTHmIVOPbzXZQ1386252350.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(260, '59lLvHIUVSFMzWdhEoQ11386252350.jpg', 'galerie/club1/59lLvHIUVSFMzWdhEoQ11386252350.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(261, 'vFsSxdra8OcQm2ZBntwE1386252350.jpg', 'galerie/club1/vFsSxdra8OcQm2ZBntwE1386252350.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(262, 'IKj14yb3Eme5RdlXqDow1386252351.jpg', 'galerie/club1/IKj14yb3Eme5RdlXqDow1386252351.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(263, 'wFHpBsehqE9Xr7xSPyIG1386252351.jpg', 'galerie/club1/wFHpBsehqE9Xr7xSPyIG1386252351.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(264, 'D3C7jdZiHfXKPE94IWG81386252352.jpg', 'galerie/club1/D3C7jdZiHfXKPE94IWG81386252352.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(265, '0vDIqhnaUeBzJ7kHVNlF1386252352.jpg', 'galerie/club1/0vDIqhnaUeBzJ7kHVNlF1386252352.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(266, 'yf8j4qg2rVSPTDb7d5oL1386252352.jpg', 'galerie/club1/yf8j4qg2rVSPTDb7d5oL1386252352.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(267, 'ap1sGW9HS0wNmELruJFC1386252353.jpg', 'galerie/club1/ap1sGW9HS0wNmELruJFC1386252353.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(268, 'ErPsm2cOWG36MpARjug11386252354.jpg', 'galerie/club1/ErPsm2cOWG36MpARjug11386252354.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(269, 'M8u54dEpaCvWqAe6nDhB1386252354.jpg', 'galerie/club1/M8u54dEpaCvWqAe6nDhB1386252354.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(270, 'c0By1NluMmJ85EHIW6721386252354.jpg', 'galerie/club1/c0By1NluMmJ85EHIW6721386252354.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(271, '1nDBaxEist6WM4ylgR5p1386252355.jpg', 'galerie/club1/1nDBaxEist6WM4ylgR5p1386252355.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(272, 'Jim6UtyuQZnD7F0SsAaW1386252356.jpg', 'galerie/club1/Jim6UtyuQZnD7F0SsAaW1386252356.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(273, 'kPypmCIhTuf47Yct6sjZ1386252356.jpg', 'galerie/club1/kPypmCIhTuf47Yct6sjZ1386252356.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(274, '0CEk8eQyYgGOJDPuLRF11386252356.jpg', 'galerie/club1/0CEk8eQyYgGOJDPuLRF11386252356.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(275, 'f5CYSN9W0dXUpnm4BIhz1386252356.jpg', 'galerie/club1/f5CYSN9W0dXUpnm4BIhz1386252356.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(276, 'D6fuX93ZKG5WehFHNTg01386252357.jpg', 'galerie/club1/D6fuX93ZKG5WehFHNTg01386252357.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(277, 'bA6kEtYHlinjq5Wy0oZI1386252357.jpg', 'galerie/club1/bA6kEtYHlinjq5Wy0oZI1386252357.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(278, 'kHsaqx0ROhGAySoKVLpc1386252357.jpg', 'galerie/club1/kHsaqx0ROhGAySoKVLpc1386252357.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(279, 'mrZTusUnHM5pbg6a4qDi1386252358.jpg', 'galerie/club1/mrZTusUnHM5pbg6a4qDi1386252358.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(280, '01xgfjQiWZHlqA9Vte4w1386252358.jpg', 'galerie/club1/01xgfjQiWZHlqA9Vte4w1386252358.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(281, 'WfrSmPRBKhi9np64qyMV1386252358.jpg', 'galerie/club1/WfrSmPRBKhi9np64qyMV1386252358.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(282, 'xWQMwrjP6fcG0SNoh3yl1386252359.jpg', 'galerie/club1/xWQMwrjP6fcG0SNoh3yl1386252359.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(283, '2Lf8ybIm4oeJsWazFYtN1386252359.jpg', 'galerie/club1/2Lf8ybIm4oeJsWazFYtN1386252359.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(284, 'Du84Fa0WG5mjONK2zHgX1386252360.jpg', 'galerie/club1/Du84Fa0WG5mjONK2zHgX1386252360.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(285, '8UWoCAnj9ilwQtxTksbe1386252360.jpg', 'galerie/club1/8UWoCAnj9ilwQtxTksbe1386252360.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(286, 'efHEn7bs548NPhiLra6X1386252362.jpg', 'galerie/club1/efHEn7bs548NPhiLra6X1386252362.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(287, 'p8eJqdaPfXu6sryTxWRH1386252363.jpg', 'galerie/club1/p8eJqdaPfXu6sryTxWRH1386252363.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(291, NULL, NULL, NULL, NULL, 'galerie/admin/t3UPVaRD8pJezZcwQ0xn1386530766.jpg', 'admin', 'parachute', 1385748639),
(290, '46zlVyu7eH2Evq5QKtpD1386530731.jpg', 'galerie/admin/46zlVyu7eH2Evq5QKtpD1386530731.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(292, 'AfUKk3l6jWI8J1agNFZV1386555743.jpg', 'galerie/admin/AfUKk3l6jWI8J1agNFZV1386555743.jpg', NULL, 'img', '', 'admin', 'parachute', 1385748639),
(293, 'jhaNkHRF8pM,galerie/admin/46zlVyu7eH2Evq5QKtpD1386530731.jpg', 'youtube', NULL, 'video', '', 'admin', 'parachute', 1389748639),
(294, '43986997', 'vimeo', NULL, 'video', '', 'admin', 'parachute', 1389748639),
(295, 'x1a84np', 'dailymotion', NULL, 'video', '', 'admin', 'parachute', 1389748639),
(297, 'yK9eL5qIw63rGCH8zxTU1434914397.jpg', 'galerie/admin/yK9eL5qIw63rGCH8zxTU1434914397.jpg', NULL, 'img', '', 'admin', '', 0),
(298, 'n7bHWd12DgLvOcAruQCB1434914402.jpg', 'galerie/admin/n7bHWd12DgLvOcAruQCB1434914402.jpg', NULL, 'img', '', 'admin', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `participates`
--

CREATE TABLE IF NOT EXISTS `participates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_event` int(5) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `participates`
--

INSERT INTO `participates` (`id`, `id_event`, `nom`, `prenom`, `email`, `tel`) VALUES
(1, 3, 'esgfg', 'tryiu', 'triyui@live.fr', 0),
(2, 5, 'esgfg', 'tryiu', 'triyui@test.fr', 0),
(3, 5, 'esgfg', 'tryiu', 'triyui@live.fr', 0),
(4, 10, 'esgfg', 'tryiu', 'triyui@test56.fr', 0),
(5, 10, 'esgfg', 'tryiu', 'triyui@test69.fr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_FR` varchar(255) DEFAULT NULL,
  `title_EN` varchar(255) NOT NULL,
  `content_FR` text,
  `content_EN` text NOT NULL,
  `created` int(20) DEFAULT NULL,
  `publication` int(20) NOT NULL,
  `online` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) NOT NULL,
  `organization_id` varchar(1000) NOT NULL,
  `author_id` varchar(1000) NOT NULL,
  `images_id` text NOT NULL,
  `videos_id` text NOT NULL,
  `social_online` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_posts_users1` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title_FR`, `title_EN`, `content_FR`, `content_EN`, `created`, `publication`, `online`, `type`, `slug`, `user_id`, `category_id`, `organization_id`, `author_id`, `images_id`, `videos_id`, `social_online`) VALUES
(1, 'Accueil', '', '<div class="hero-unit">\r\n<h1>Bienvenue !</h1>\r\n<p>Vestibulum id ligula porta felis euismod semper. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>\r\n<p><a href="#">Voir le blog &raquo;</a></p>\r\n</div>\r\n<div class="row">\r\n<div class="span6">\r\n<h2>Heading</h2>\r\n<p>Etiam porta sem malesuada magna mollis euismod. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>\r\n<p><a class="btn" href="#">View details &raquo;</a></p>\r\n</div>\r\n<div class="span5">\r\n<h2>Heading</h2>\r\n<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>\r\n<p><a class="btn" href="#">View details &raquo;</a></p>\r\n</div>\r\n<div class="span5">\r\n<h2>Heading</h2>\r\n<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>\r\n<p><a class="btn" href="#">View details &raquo;</a></p>\r\n</div>\r\n</div>', '', 1385748639, 0, 1, 'page', 'accueil', 'test', 'parapente', '', '', '', '', 0),
(2, 'A propos', '', '<h1>A propos</h1>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in accumsan justo. Integer nec urna quam. Nunc ut dui elit, eu facilisis nisl. Pellentesque varius tellus vel felis condimentum iaculis. Vestibulum ultrices turpis eu tellus eleifend scelerisque. Donec vitae odio dui, vel bibendum odio. Praesent vestibulum turpis at massa sollicitudin imperdiet. Fusce pulvinar, elit id facilisis vestibulum, urna dolor auctor lorem, non fringilla neque erat sit amet purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur posuere magna ut eros tincidunt tristique. Praesent eros ligula, volutpat et hendrerit a, interdum ut libero. Nullam metus lacus, tincidunt egestas sagittis ut, ultricies eu tellus. Vivamus consequat lectus sed magna sodales non lobortis libero interdum.</p>\r\n<blockquote>\r\n<p>Quisque et risus purus. Integer varius, neque in egestas hendrerit, purus orci suscipit est, ac vehicula.</p>\r\n<small>Maitre yoda</small></blockquote>\r\n<ul>\r\n<li>Aliquam dapibus ligula at leo luctus feugiat.</li>\r\n<li>Etiam egestas commodo lacus, ut euismod lectus dignissim quis.</li>\r\n</ul>\r\n<ul>\r\n<li>Praesent sed risus a turpis vehicula lobortis.</li>\r\n<li>Nullam luctus ullamcorper arcu, interdum hendrerit sapien suscipit in.</li>\r\n<li>Phasellus adipiscing elementum ipsum, eu pharetra sapien aliquam eu.</li>\r\n</ul>\r\n<p>Nunc est risus, dapibus ut iaculis at, aliquam non libero. Curabitur ipsum elit, volutpat quis fringilla sed, aliquet sit amet est. Aenean est nulla, ullamcorper id viverra quis, vestibulum nec nisl. Maecenas eget nisi elit. Cras tempor porta sapien ut volutpat. Sed sodales tortor et nulla aliquam fermentum. Pellentesque eu quam arcu, lacinia ultricies lectus. Nunc interdum aliquam blandit.</p>\r\n<p>In accumsan facilisis tempus. Quisque elit nunc, cursus quis ullamcorper in, ultrices et est. Proin lectus ipsum, eleifend at iaculis quis, tincidunt vitae sem. Mauris vel est felis, ut pharetra lorem. Donec nunc magna, eleifend vitae sagittis at, blandit id elit. Mauris pellentesque ligula id dui condimentum ut gravida mi accumsan. Nullam tincidunt urna eros, et ultricies dolor. Aenean sit amet adipiscing tortor.</p>\r\n<p>Nam nibh nunc, cursus a blandit id, vestibulum sed lectus. Praesent quis neque ipsum. Aliquam arcu quam, condimentum quis consequat et, ultricies eget ligula. Cras sed metus laoreet orci dignissim pharetra. Suspendisse varius, mauris ut egestas placerat, nunc mauris vestibulum risus, et porttitor ante arcu sit amet lorem. Nulla laoreet urna quis augue blandit venenatis. Donec ullamcorper, augue ac vestibulum semper, lorem leo pharetra urna, nec imperdiet leo lorem sit amet dui. Pellentesque cursus nunc in lacus bibendum sit amet sagittis velit fringilla. Mauris ornare justo dui, at mattis felis. Duis orci purus, tincidunt vel eleifend sit amet, rutrum tempor massa. Praesent nec dui mauris. Sed viverra venenatis pellentesque. Phasellus sodales odio vel nunc molestie sed placerat ipsum sollicitudin. Integer quam lacus, dignissim vel vulputate vitae, aliquam quis velit.</p>', '', 1385748639, 0, 1, 'page', 'a-propos', 'test', 'parapente', '', '', '', '', 0),
(19, '1Password, votre coffre fort virtuel', '', '<p><strong><a title="" href="http://ifttt.com/"><img style="margin-right: 20px; float: left;" src="/POO3/webroot/img/2011-09/1password-votre-coffre-fort-virtuel-1070.jpg" alt="" width="277" height="157" /></a></strong>Si comme moi vous avez pass&eacute; des heures &agrave; chercher des mots de passes vieux de 2 ans dans une boite mail super charg&eacute;es alors vous allez aimer&nbsp;1Password. Cette application va vous permettre d&rsquo;avoir un coffre virtuel prot&eacute;g&eacute; contenant l&rsquo;ensemble de vos identifiants (acc&egrave;s FTP, acc&egrave;s MySQL, clef Servers, Formulaire Web&hellip;) en un seul endroit.<strong><a title="" href="http://ifttt.com/"><br /></a></strong></p>', '', 1385748639, 0, 1, 'post', '1password-votre-coffre-fort-virtuel', 'test', 'aviation', '', '', '', '', 0),
(17, 'C’était (mieux || pas mieux) avant', '', '<p><img style="float: left;" src="/POO3/webroot/img/2011-09/cetait-mieux-pas-mieux-avant-1063.jpg" alt="" width="277" height="157" />Et voila la version 2011 de Grafikart.fr est en ligne. Cette nouvelle version est l’occasion pour moi de revenir a mes premiers amours en terme de Webdesign (le bois et le blanc) mais aussi d’améliorer l’interface des compte membres. Dorénavant vous pouvez suivre depuis votre compte toute l’actualité du site et de vos sujets sur le forum. La fonctionnalité n’a pas encore été testé à grande échelle donc vous serez mes cobayes. N’hésitez pas à faire des retours sur ce point là.</p>\r\n<p> </p>\r\n<ul>\r\n<li>dfhf</li>\r\n<li>fgh</li>\r\n</ul>\r\n<p><img src="/POO3/webroot/img/2013-08/ME%20-%20Mako.jpg" alt="" width="970" height="546" /></p>', '', 1385748639, 0, 1, 'post', 'cetait-mieux-pas-mieux-avant', 'admin', 'parachute', '', '', '', '', 0),
(9, 'if ifttt.com then', '', '<p><a title="" href="http://ifttt.com/"><img style="margin-right: 20px; float: left;" src="/Tuto/Site/img/2011-09/if-ifttt-com-then-1066.jpg" alt="" width="277" height="157" />Ifttt.com</a> est un site qui propose d’automatiser la publication de contenu entre réseaux sociaux à l’aide d’un opérateur bien connu des développeur : <strong>Si… Alors…</strong>. Le principe est extrêmement simple et efficace, on désigne dans un premier temps un « <strong>déclencheur</strong> » (une opération spécifique sur un premier site, comme par exemple un nouveau tweet) et dans un second temps « <strong>l’action</strong> » que cela va déclencher sur un autre site (la publication du tweet en question sur facebook). Le site est actuellement en Béta mais laisse entrapercevoir des centaines de possibilités et pour ne rien gâcher l’interface est très intuitive.</p>', '', 1385748639, 0, 1, 'post', 'if-iftttcom-then', 'admin', 'parapente', '', '', '', '', 0),
(22, 'Test1', '', '<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<iframe width="420" height="315" src="//www.youtube.com/embed/rv1o6Em9P7I" frameborder="0" allowfullscreen=""></iframe><br>\r\n</p>\r\n', '', 1385748639, 0, 1, 'post', 'test1', 'admin', 'parapente', '', '', '', '', 0),
(24, 'test2', '', '<p><iframe frameborder="0" width="480" height="270" src="http://www.dailymotion.com/embed/video/x17mpwp"></iframe><br>\r\n<a href="http://www.dailymotion.com/video/x17mpwp_welcome-to-the-jungle-jean-claude-van-damme-2014-official-trailer-vo-hd720p_shortfilms">WELCOME TO THE JUNGLE (Jean-Claude Van Damme...</a><i>par <a href="http://www.dailymotion.com/Lyricis">Lyricis</a></i><iframe width="420" height="315" src="//www.youtube.com/embed/XjgFpTVZwlI" frameborder="0"></iframe> <iframe frameborder="0" width="480" height="270" src="http://www.dailymotion.com/embed/video/x17n6ur"></iframe><br>\r\n<a href="http://www.dailymotion.com/video/x17n6ur_x-men-days-of-future-past-magneto-vs-jfk-viral_shortfilms">X-Men : Days of Future Past - Magneto vs...</a><i>par <a href="http://www.dailymotion.com/Lyricis">Lyricis</a>   Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in. </i><iframe src="//player.vimeo.com/video/80235443" width="500" height="281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe></p>\r\n\r\n<p><a href="http://vimeo.com/80235443">Flight Facilities - Stand Still (feat. Micky Green)</a> from <a href="http://vimeo.com/user4696984">Flight Facilities</a> on <a href="https://vimeo.com">Vimeo</a>.</p>\r\n', '', 1385748639, 0, 1, 'post', 'test2', 'admin', 'aviation', '', '', '', '', 0),
(25, 'test3', '', '\r\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<span rel="pastemarkerend" id="pastemarkerend15979"></span><br>\r\n</p>\r\n', '', 1385748639, 0, 1, 'post', 'test3', 'admin', 'aviation', '', '', '', '', 0),
(26, 'test4', '', '\r\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<span rel="pastemarkerend" id="pastemarkerend59809"></span><br>\r\n</p>\r\n', '', 1385748639, 0, 1, 'post', 'test4', 'admin', 'parachute', '', '', '', '', 0),
(27, 'test5', '', '\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<span rel="pastemarkerend" id="pastemarkerend49993"></span><br>\n</p>\n', '', 1385748639, 0, 1, 'post', 'test5', 'admin', 'parachute', '', '', '', '', 0),
(28, 'test6', '', '\r\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<span rel="pastemarkerend" id="pastemarkerend55288"></span><br>\r\n</p>\r\n', '', 1385748639, 0, 1, 'post', 'test6', 'admin', 'parapente', '', '', '', '', 0),
(29, 'test7', '', '\n<p><b><i><strike>Lorem ipsum&nbsp;</strike></i></b><span style="line-height: 1.5em;"><strike style="font-weight: bold; font-style: italic;">Velit labore velit et tempor </strike>&nbsp;&nbsp;</span><a href="http://localhost/POO3/webroot/blog/test10-32">test lien interne</a>&nbsp;puis&nbsp;<a href="http://designmodo.com/create-website-day-1/;line-height: 1.5em;">test lien externe</a><span style="line-height: 1.5em;">&nbsp;&nbsp;</span><strike style="line-height: 1.5em; font-weight: bold; font-style: italic;"> puis <a href="/POO3/webroot/blog/user/test2">un lien interne relatif</a> ad </strike><span style="line-height: 1.5em;">et encore&nbsp;</span><a href="/POO3/webroot/blog/test8-30">est &nbsp;et encore un</a>&nbsp;<strike style="line-height: 1.5em; font-weight: bold; font-style: italic;">&nbsp;est &nbsp;et encore uncupidatat in non dolore aliqua anim nisi tempo<a href="/POO3/webroot/blog/test9-31">est &nbsp;et encore un</a>r voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.</strike></p>\n\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<br>\n</p>\n\n<p> 4 Aller directement à la partie traitant de :<br>\n 5 <a href="#cuisine">La cuisine</a><br>\n 6 <a href="#rollers">Les rollers</a><br>\n 7 <a href="#arc">Le tir à l''arc</a><br>\n 8</p>\n 9<h2 id="cuisine">La cuisine</h2>\n 10 11 \n<p>... (beaucoup de texte) ...</p>\n 12 13<h2 id="rollers">Les rollers</h2>\n 14 15 \n<p>... (beaucoup de texte) ...</p>\n 16 17<h2 id="arc">Le tir à l''arc</h2>\n 18 19 \n<p>... (beaucoup de texte) ...</p>\n\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<br>\n</p>\n\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<br>\n</p>\n\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<br>\n</p>\n\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<br>\n</p>\n\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<br>\n</p>\n\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<br>\n</p>\n', '', 1385748639, 0, 1, 'post', 'test7', 'admin', 'parachute', '', '', '', '', 0),
(39, NULL, '', NULL, '', NULL, 0, -1, NULL, NULL, NULL, '', '', '', '', '', 0),
(30, 'test8', '', '\n<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<span rel="pastemarkerend" id="pastemarkerend53550"></span><br>\n</p>\n', '', 1385748639, 0, 1, 'post', 'test8', 'admin', 'parachute', '', '', '', '', 0),
(31, 'test9', '', '<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<span rel="pastemarkerend" id="pastemarkerend57026"></span><br>\r\n</p>\r\n', '', 1385683200, 0, 1, 'post', 'test9', 'admin', 'aviation', '', '', '', '', 0),
(32, 'test10', '', '<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<span rel="pastemarkerend" id="pastemarkerend48214"></span><br>\r\n</p>\r\n', '', 1385769600, 0, 1, 'post', 'test10', 'admin', 'aviation', '', '', '', '', 0),
(34, 'test du cache', '', '\r\n<p>Lorem ipsum Labore irure ut anim sed minim ut ad velit culpa nulla anim elit ut irure aliquip voluptate aute sunt in aute reprehenderit adipisicing ex ad voluptate elit consectetur Ut nisi irure sed cillum irure elit reprehenderit minim anim consectetur consequat nostrud amet in sint pariatur dolore eiusmod ut minim exercitation do ut cupidatat veniam anim elit anim sunt mollit officia est et laborum Duis irure dolor enim pariatur amet elit tempor exercitation eu laborum commodo tempor fugiat cupidatat amet consectetur sint adipisicing fugiat ullamco magna sint ex est ea aliqua deserunt incididunt Excepteur in irure occaecat proident exercitation sit laborum in quis eu nostrud esse ut aliqua in nulla Excepteur deserunt eu adipisicing occaecat cupidatat do amet commodo veniam non sed in commodo voluptate dolore consectetur eu adipisicing in Ut enim minim deserunt esse laboris laborum Ut elit non ullamco nulla dolor reprehenderit occaecat do dolor consequat consequat dolore Duis consectetur sunt eu tempor tempor anim sint consequat ea Duis Ut dolor quis dolore qui officia irure labore sit in mollit sit minim et officia aliquip nulla commodo qui sed est exercitation minim amet ullamco anim culpa aliquip do voluptate amet dolor sed commodo Duis ex sed aute fugiat in proident in reprehenderit fugiat dolor exercitation voluptate qui proident do enim occaecat officia adipisicing fugiat exercitation sed sit reprehenderit veniam minim aliquip cupidatat quis labore ex cillum incididunt officia proident fugiat in consequat dolore dolore ad ut aute ad voluptate laboris in esse aliquip consequat ut est nostrud tempor velit est in nisi aliquip magna dolor consequat dolore nulla qui eu pariatur commodo enim anim.</p>\r\n<div><span rel="pastemarkerend" id="pastemarkerend44337"></span><br>\r\n</div>\r\n', '', 1385748639, 0, 1, 'post', 'test-du-cache', 'admin', 'parachute', '', '', '', '', 0),
(35, 'test select', '', '\r\n<p>dfhrkiykgfhtdjfbfhd</p>\r\n', '', 1385769600, 0, 1, 'post', 'test-select', 'admin', 'parachute', '', '', '', '', 0),
(36, 'TTTest45 :!?.;,', '', '<p>Lorem ipsum Velit labore velit et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.<span rel="pastemarkerend" id="pastemarkerend49993"></span><br></p>\r\n', '', 1386115200, 0, 1, 'post', 'tttest45-a', 'admin', 'parachute', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `club` varchar(500) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `title`, `content`, `club`, `type`, `location`, `date`) VALUES
(1, 'test de titre', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', 'club1', 'parapente', '', 1385748639),
(2, 'test', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', 'club5', 'aviation', '', 1385748639),
(3, 'titre aviation', 'Lorem ipsum Amet quis ut sint culpa et ut laborum qui cupidatat ullamco elit cillum ut in anim.', 'club5', 'aviation', '', 1385748639);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`) VALUES
(1, 'admin', 'bced6fd149cfcdb85741768da12e41c6', 'admin'),
(2, 'user2', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin'),
(3, 'test', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
