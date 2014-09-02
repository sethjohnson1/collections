-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2014 at 06:56 AM
-- Server version: 5.5.38
-- PHP Version: 5.4.4-14+deb7u12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oc_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `badwords`
--

CREATE TABLE IF NOT EXISTS `badwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(40) DEFAULT NULL,
  `replacement` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=458 ;

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE IF NOT EXISTS `collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oldid` varchar(40) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` varchar(36) NOT NULL,
  `parent_id` varchar(36) DEFAULT NULL,
  `foreign_key` varchar(36) NOT NULL,
  `argusid` varchar(42) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `model` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `is_spam` varchar(20) NOT NULL DEFAULT 'clean',
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `body` text,
  `author_name` varchar(255) DEFAULT NULL,
  `author_url` varchar(255) DEFAULT NULL,
  `author_email` varchar(128) NOT NULL DEFAULT '',
  `language` varchar(6) DEFAULT NULL,
  `comment_type` varchar(32) NOT NULL DEFAULT 'comment',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `ip` varchar(20) NOT NULL DEFAULT 'clean',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `homeflags`
--

CREATE TABLE IF NOT EXISTS `homeflags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accnum` varchar(40) DEFAULT NULL,
  `seed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=215 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sortorder` int(11) DEFAULT NULL,
  `treasure_id` int(11) DEFAULT NULL,
  `treasure_oldid` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39572 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `sortorder`, `treasure_id`, `treasure_oldid`) VALUES
(23138, '2002.1.1.jpg', 5, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(32241, '2002.1.1v1.jpg', 6, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(32242, '2002.1.1v2.jpg', 7, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(32243, '2002.1.1v3.jpg', 8, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(32244, '2002.1.1v4.jpg', 9, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(35375, '2002.1.1v1.jpg', 1, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(35376, '2002.1.1v2.jpg', 2, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(35377, '2002.1.1v3.jpg', 3, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(35378, '2002.1.1v4.jpg', 4, 10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(39571, 'NA.202.394.JPG', 1, 18557, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `oldtreid` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4894 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `oldtreid`) VALUES
(2245, 'CFM.L3', '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}'),
(4148, 'PIM.K5', '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}');

-- --------------------------------------------------------

--
-- Table structure for table `makers`
--

CREATE TABLE IF NOT EXISTS `makers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oldid` varchar(40) DEFAULT NULL,
  `name` longtext,
  `slug` varchar(1000) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `homeflag` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2503 ;

--
-- Dumping data for table `makers`
--

INSERT INTO `makers` (`id`, `oldid`, `name`, `slug`, `img`, `num`, `homeflag`) VALUES
(1579, '{5D100E52-EC1B-4013-8E40-84F53844E58A}', 'Northern Plains', 'northern_plains', 'na.504.50.jpg', 1738, NULL),
(2020, '{DF674EE2-E6AE-49FA-BE1E-CC594240EB28}', 'Sioux', 'sioux', 'NA.106.306.JPG', 939, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `makers_treasures`
--

CREATE TABLE IF NOT EXISTS `makers_treasures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maker_id` int(11) DEFAULT NULL,
  `treasure_id` int(11) DEFAULT NULL,
  `treasure_oldid` varchar(40) DEFAULT NULL,
  `maker_oldid` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maker_id` (`maker_id`),
  KEY `treasure_id` (`treasure_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16708 ;

--
-- Dumping data for table `makers_treasures`
--

INSERT INTO `makers_treasures` (`id`, `maker_id`, `treasure_id`, `treasure_oldid`, `maker_oldid`) VALUES
(7845, 2020, 18557, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '{DF674EE2-E6AE-49FA-BE1E-CC594240EB28}'),
(16707, 1579, 18557, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '{5D100E52-EC1B-4013-8E40-84F53844E58A}');

-- --------------------------------------------------------

--
-- Table structure for table `medvalues`
--

CREATE TABLE IF NOT EXISTS `medvalues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oldid` varchar(40) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(1000) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `homeflag` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3480 ;

--
-- Dumping data for table `medvalues`
--

INSERT INTO `medvalues` (`id`, `oldid`, `name`, `slug`, `img`, `num`, `homeflag`) VALUES
(196, '{EB1EA7BF-2343-4FE0-9F4B-B839850BCD52}', 'Beads', 'beads', 'na.202.879.jpg', 2563, NULL),
(230, '{5EACB348-00A1-4F97-B183-0BF573ACF39F}', 'billed', 'billed', 'NA.202.394.JPG', 1, NULL),
(1705, '{718EB332-8823-440B-8DF8-233D92828E7B}', 'leather', 'leather', '1.69.2946.JPG', 1924, NULL),
(2088, '{70E53F58-A1BB-4458-AC36-3F02634E1273}', 'nylon', 'nylon', '1988.8.1692v2.jpg', 26, NULL),
(2386, '{F4FB5519-73F1-47BB-8615-0C85E3BA26ED}', 'plastic', 'plastic', 'na.202.196.jpg', 351, NULL),
(2748, '{81FFB5CD-4E99-4CF8-BA43-EE64B39583BB}', 'seed', 'seed', 'na.403.24.jpg', 1428, NULL),
(2988, '{B7CD15FD-B104-4CBB-841E-D7258E29159A}', 'steel', 'steel', '1995.25.1v1.jpg', 1952, NULL),
(3407, '{AAB6237D-DD0A-4FA5-9D8B-90EC993213A9}', 'wood', 'wood', '2002.8.11v1.jpg', 3805, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treasure_id` int(11) DEFAULT NULL,
  `blogid` int(11) DEFAULT NULL,
  `argusid` varchar(40) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`id`, `treasure_id`, `blogid`, `argusid`, `created`, `modified`) VALUES
(26, 18557, 9948, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '2014-08-08 12:42:30', '2014-08-08 12:42:30'),
(27, 18557, 14395, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '2014-08-08 12:42:37', '2014-08-08 12:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `tag_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2377 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `tag_count`) VALUES
(1, 'red', 6485),
(2, 'blue', 5029),
(8, 'northern', 3065),
(9, 'beaded', 2781),
(10, 'yellow', 2755),
(11, 'design', 2664),
(16, 'black', 2303),
(24, 'cloth', 2001),
(26, 'sioux', 1842),
(27, 'seed', 1796),
(35, 'geometric', 1611),
(64, 'festive', 1047),
(65, 'daily', 1044),
(78, 'light', 830),
(89, 'bill', 742),
(139, 'woven', 498),
(153, 'arrow', 447),
(181, 'plastic', 395),
(195, 'star', 371),
(333, 'beadwork', 195),
(422, 'trim', 147),
(579, 'tag', 100),
(860, 'brow', 54),
(1947, 'nylon', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tags_treasures`
--

CREATE TABLE IF NOT EXISTS `tags_treasures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) DEFAULT NULL,
  `treasure_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `treasure_id` (`treasure_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=218994 ;

--
-- Dumping data for table `tags_treasures`
--

INSERT INTO `tags_treasures` (`id`, `tag_id`, `treasure_id`) VALUES
(2340, 1, 18557),
(4496, 2, 18557),
(17078, 8, 18557),
(19309, 9, 18557),
(20690, 10, 18557),
(22263, 11, 18557),
(30191, 16, 18557),
(41505, 24, 18557),
(43320, 26, 18557),
(45171, 27, 18557),
(56798, 35, 18557),
(57318, 333, 18557),
(84916, 64, 18557),
(85957, 65, 18557),
(92742, 78, 18557),
(100386, 89, 18557),
(120377, 422, 18557),
(126352, 139, 18557),
(132635, 153, 18557),
(144289, 181, 18557),
(149358, 195, 18557),
(174777, 579, 18557),
(200609, 860, 18557),
(216409, 1947, 18557);

-- --------------------------------------------------------

--
-- Table structure for table `treasures`
--

CREATE TABLE IF NOT EXISTS `treasures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oldid` varchar(40) DEFAULT NULL,
  `accnum` varchar(255) DEFAULT NULL,
  `daterange` longtext,
  `dimensions` longtext,
  `synopsis` longtext,
  `objtitle` longtext,
  `creditline` longtext,
  `gloss` longtext,
  `inscription` longtext,
  `remarks` longtext,
  `img` longtext,
  `commonname` longtext,
  `genus` longtext,
  `taxonomic` varchar(40) DEFAULT NULL,
  `opencartid` int(11) DEFAULT NULL,
  `collection` varchar(40) DEFAULT NULL,
  `location` varchar(40) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `slug` varchar(1000) DEFAULT NULL,
  `homeflag` tinyint(3) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `sample` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18558 ;

--
-- Dumping data for table `treasures`
--

INSERT INTO `treasures` (`id`, `oldid`, `accnum`, `daterange`, `dimensions`, `synopsis`, `objtitle`, `creditline`, `gloss`, `inscription`, `remarks`, `img`, `commonname`, `genus`, `taxonomic`, `opencartid`, `collection`, `location`, `location_id`, `slug`, `homeflag`, `created`, `sample`) VALUES
(10315, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}', '2002.1.1', NULL, 'H: 7.625 in,  width: 4.4375 in, L: 12.75 in', 'other | crate, ammunition', NULL, 'Gift from Arlie Jennerjohn', NULL, 'front panel: CHEST49-1-84', NULL, '2002.1.1v1.jpg', NULL, NULL, NULL, NULL, 'CFM', NULL, 2245, 'other_crate_ammunition', 198, NULL, 1),
(18557, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', 'NA.202.394', '1984', 'H: 4.5 in, L: 10.75 in,  width: 7.5 in', 'cap - Sioux | Northern Plains - plastic | billed | Beads ~ seed | nylon - geometric | star | cross - Sioux | Northern Plains - Dress and Adornment: Daily And/or Festive Adornment.  Woven plastic, adjustable, billed. Blue with beaded bill and front. Blue, white, orange, red and yellow geometric star and cross design beadwork on light blue ground. Arrow design trim in same colors at the top. Black cloth brow band, mfg. tag - Funkap, large, made in U.S.A.', NULL, NULL, NULL, NULL, 'Dress and Adornment: Daily And/or Festive Adornment.  Woven plastic, adjustable, billed. Blue with beaded bill and front. Blue, white, orange, red and yellow geometric star and cross design beadwork on light blue ground. Arrow design trim in same colors at the top. Black cloth brow band, mfg. tag - Funkap, large, made in U.S.A.', 'NA.202.394.JPG', NULL, NULL, NULL, NULL, 'PIM', NULL, 4148, 'cap_sioux_northern_plains_plastic_billed_beads_seed_nylon_geometr', 199, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `treasures_medvalues`
--

CREATE TABLE IF NOT EXISTS `treasures_medvalues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treasure_id` int(11) DEFAULT NULL,
  `medvalue_id` int(11) DEFAULT NULL,
  `treasure_oldid` varchar(40) DEFAULT NULL,
  `medvalue_oldid` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medvalue_id` (`medvalue_id`),
  KEY `treasure_id` (`treasure_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67101 ;

--
-- Dumping data for table `treasures_medvalues`
--

INSERT INTO `treasures_medvalues` (`id`, `treasure_id`, `medvalue_id`, `treasure_oldid`, `medvalue_oldid`) VALUES
(5783, 18557, 2386, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '{F4FB5519-73F1-47BB-8615-0C85E3BA26ED}'),
(44522, 18557, 230, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '{5EACB348-00A1-4F97-B183-0BF573ACF39F}'),
(44984, 18557, 2088, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '{70E53F58-A1BB-4458-AC36-3F02634E1273}'),
(56757, 18557, 2748, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '{81FFB5CD-4E99-4CF8-BA43-EE64B39583BB}'),
(57370, 18557, 196, '{A698A7A2-030A-4DF5-84A7-F5BF60B8783F}', '{EB1EA7BF-2343-4FE0-9F4B-B839850BCD52}'),
(59611, 10315, 3407, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}', '{AAB6237D-DD0A-4FA5-9D8B-90EC993213A9}'),
(64610, 10315, 1705, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}', '{718EB332-8823-440B-8DF8-233D92828E7B}'),
(65520, 10315, 2988, '{8268DC09-2583-4ECB-BD3B-8531F15B9AA3}', '{B7CD15FD-B104-4CBB-841E-D7258E29159A}');

-- --------------------------------------------------------

--
-- Table structure for table `treasures_new`
--

CREATE TABLE IF NOT EXISTS `treasures_new` (
  `id` int(11) NOT NULL,
  `oldid` varchar(40) DEFAULT NULL,
  `accnum` varchar(255) DEFAULT NULL,
  `daterange` longtext,
  `dimensions` longtext,
  `synopsis` longtext,
  `objtitle` longtext,
  `creditline` longtext,
  `gloss` longtext,
  `inscription` longtext,
  `remarks` longtext,
  `img` longtext,
  `commonname` longtext,
  `genus` longtext,
  `taxonomic` varchar(40) DEFAULT NULL,
  `opencartid` int(11) DEFAULT NULL,
  `collection` varchar(40) DEFAULT NULL,
  `location` varchar(40) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `slug` varchar(1000) DEFAULT NULL,
  `homeflag` tinyint(3) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treasures_usergals`
--

CREATE TABLE IF NOT EXISTS `treasures_usergals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treasure_id` int(11) DEFAULT NULL,
  `usergal_id` int(11) DEFAULT NULL,
  `ord` int(11) DEFAULT NULL,
  `argusid` varchar(40) DEFAULT NULL,
  `comments` varchar(4000) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `treasure_id` (`treasure_id`),
  KEY `usergal_id` (`usergal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5943 ;

-- --------------------------------------------------------

--
-- Table structure for table `usergals`
--

CREATE TABLE IF NOT EXISTS `usergals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) DEFAULT NULL,
  `creator` varchar(400) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `editcode` varchar(400) DEFAULT NULL,
  `gloss` varchar(4000) DEFAULT NULL,
  `flagged` tinyint(1) DEFAULT NULL,
  `listed` tinyint(1) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `password_token` varchar(128) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0',
  `email_token` varchar(255) DEFAULT NULL,
  `email_token_expires` datetime DEFAULT NULL,
  `tos` tinyint(1) DEFAULT '0',
  `active` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_action` datetime DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `role` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `BY_USERNAME` (`username`),
  KEY `BY_EMAIL` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` varchar(36) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `position` float NOT NULL DEFAULT '1',
  `field` varchar(255) NOT NULL,
  `value` text,
  `input` varchar(16) NOT NULL,
  `data_type` varchar(16) NOT NULL,
  `label` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_PROFILE_PROPERTY` (`field`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
