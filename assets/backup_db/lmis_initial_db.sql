-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2016 at 02:24 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xx`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE IF NOT EXISTS `book_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `physical_form` enum('Book','Journal','CD/DVD','Manuscript','Others') NOT NULL,
  `author` text CHARACTER SET utf8 NOT NULL,
  `subtitle` varchar(100) CHARACTER SET utf8 NOT NULL,
  `edition_year` year(4) NOT NULL,
  `publisher` varchar(100) CHARACTER SET utf8 NOT NULL,
  `series` varchar(100) CHARACTER SET utf8 NOT NULL,
  `size1` enum('Medium','Large','Huge','Small','Tiny') NOT NULL,
  `price` varchar(100) CHARACTER SET utf8 NOT NULL,
  `call_no` varchar(100) CHARACTER SET utf8 NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 NOT NULL,
  `clue_page` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `edition` varchar(100) CHARACTER SET utf8 NOT NULL,
  `publishing_year` year(4) NOT NULL,
  `publication_place` varchar(100) CHARACTER SET utf8 NOT NULL,
  `number_of_pages` int(11) NOT NULL,
  `number_of_books` int(11) NOT NULL,
  `dues` varchar(100) NOT NULL,
  `isbn` varchar(100) CHARACTER SET utf8 NOT NULL,
  `source_details` enum('Local Purchase','University','World Bank Donation','Personal Donation','Others') NOT NULL,
  `notes` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cover` text CHARACTER SET utf8 NOT NULL,
  `pdf` text CHARACTER SET utf8,
  `is_uploaded` enum('0','1') NOT NULL DEFAULT '1',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `add_date` datetime NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `book_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category`
--


-- --------------------------------------------------------

--
-- Table structure for table `circulation`
--

CREATE TABLE IF NOT EXISTS `circulation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(99) NOT NULL,
  `book_id` varchar(99) NOT NULL,
  `issue_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `return_date` date NOT NULL,
  `fine_amount` double NOT NULL,
  `is_returned` tinyint(1) NOT NULL,
  `is_expired` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `circulation`
--


-- --------------------------------------------------------

--
-- Table structure for table `circulation_config`
--

CREATE TABLE IF NOT EXISTS `circulation_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type_id` varchar(99) NOT NULL,
  `issue_day_limit` varchar(99) NOT NULL,
  `issu_book_limit` int(11) NOT NULL,
  `fine_per_day` double NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_type_id` (`member_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `circulation_config`
--


-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(200) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `user_agent` varchar(199) NOT NULL,
  `last_activity` varchar(199) NOT NULL,
  `user_data` longtext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `daily_read_material`
--

CREATE TABLE IF NOT EXISTS `daily_read_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` varchar(99) NOT NULL,
  `read_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `daily_read_material`
--


-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE IF NOT EXISTS `email_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `smtp_host` varchar(250) NOT NULL,
  `smtp_port` varchar(100) NOT NULL,
  `smtp_user` varchar(100) NOT NULL,
  `smtp_password` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `email_config`
--


-- --------------------------------------------------------

--
-- Table structure for table `forget_password`
--

CREATE TABLE IF NOT EXISTS `forget_password` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `confirmation_code` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(250) CHARACTER SET latin1 NOT NULL,
  `success` int(11) NOT NULL DEFAULT '0',
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forget_password`
--


-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(99) CHARACTER SET utf8 NOT NULL,
  `type_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(99) NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL,
  `user_type` enum('Member','Admin') NOT NULL,
  `status` enum('1','0') NOT NULL,
  `add_date` date NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `type_id`, `email`, `mobile`, `password`, `address`, `user_type`, `status`, `add_date`, `deleted`) VALUES
(1, 'admin', 0, 'admin@gmail.com', '', '259534db5d66c3effb7aa2dbbee67ab0', '', 'Admin', '1', '2016-04-10', '0');

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE IF NOT EXISTS `member_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `deleted` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_type_name` (`member_type_name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `member_type`
--


-- --------------------------------------------------------

--
-- Table structure for table `request_book`
--

CREATE TABLE IF NOT EXISTS `request_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `book_title` text CHARACTER SET utf8 NOT NULL,
  `author` text CHARACTER SET utf8 NOT NULL,
  `edition` varchar(200) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL,
  `request_date` date NOT NULL,
  `reply` text CHARACTER SET utf8 NOT NULL,
  `request_status` varchar(55) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `request_book`
--


-- --------------------------------------------------------

--
-- Table structure for table `sms_config`
--

CREATE TABLE IF NOT EXISTS `sms_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('planet','plivo','twilio','clickatell','nexmo') CHARACTER SET utf8 NOT NULL,
  `auth_id` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `api_id` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sms_config`
--

INSERT INTO `sms_config` (`id`, `name`, `auth_id`, `token`, `api_id`, `phone_number`) VALUES
(1, 'clickatell', 'gd', 'dg', '1', 'hey');

-- --------------------------------------------------------

--
-- Table structure for table `sms_email_history`
--

CREATE TABLE IF NOT EXISTS `sms_email_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `type` enum('SMS','Email','Notification') NOT NULL,
  `sent_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sms_email_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `terms_and_condition`
--

CREATE TABLE IF NOT EXISTS `terms_and_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `terms_and_condition` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `terms_and_condition`
--

INSERT INTO `terms_and_condition` (`id`, `terms_and_condition`) VALUES
(1, '<ul>\r\n <li><strong>All copyright, trade marks, design rights,</strong> patents and other intellectual property rights (registered and unregistered) in and on LMS Online Services and LMS Content belong to the LMS and/or third parties (which may include you or other users.)</li>\r\n <li>The LMS reserves all of its rights in LMS Content and LMS Online Services. Nothing in the Terms grants you a right or licence to use any trade mark, design right or copyright owned or controlled by the LMS or any other third party except as expressly provided in the Terms.</li>\r\n</ul>');




ALTER TABLE `book_info` CHANGE `physical_form` `physical_form` ENUM( 'Book', 'Journal', 'CD/DVD', 'Manuscript', 'Others' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `book_info` CHANGE `category_id` `category_id` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `book_info` CHANGE `size1` `size1` ENUM( 'Medium', 'Large', 'Huge', 'Small', 'Tiny' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `book_info` CHANGE `dues` `dues` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `book_info` CHANGE `source_details` `source_details` ENUM( 'Local Purchase', 'University', 'World Bank Donation', 'Personal Donation', 'Others' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `book_info` CHANGE `deleted` `deleted` ENUM( '0', '1' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';
ALTER TABLE `book_info` CHANGE `status` `status` ENUM( '0', '1' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1';
ALTER TABLE `book_info` CHANGE `is_uploaded` `is_uploaded` ENUM( '0', '1' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1';


ALTER TABLE `book_info` CHANGE `cover` `cover` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'cover_default.jpg';
ALTER TABLE `book_info` CHANGE `is_uploaded` `is_uploaded` ENUM('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';
