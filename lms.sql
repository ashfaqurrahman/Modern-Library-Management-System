-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2018 at 02:43 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `id` int(11) NOT NULL,
  `physical_form` enum('Book','Journal','CD/DVD','Manuscript','Others') CHARACTER SET utf8 NOT NULL,
  `author` text CHARACTER SET utf8 NOT NULL,
  `subtitle` varchar(100) CHARACTER SET utf8 NOT NULL,
  `edition_year` year(4) NOT NULL,
  `publisher` varchar(100) CHARACTER SET utf8 NOT NULL,
  `series` varchar(100) CHARACTER SET utf8 NOT NULL,
  `size1` enum('Medium','Large','Huge','Small','Tiny') CHARACTER SET utf8 NOT NULL,
  `price` varchar(100) CHARACTER SET utf8 NOT NULL,
  `call_no` varchar(100) CHARACTER SET utf8 NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 NOT NULL,
  `clue_page` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8 NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `edition` varchar(100) CHARACTER SET utf8 NOT NULL,
  `publishing_year` year(4) NOT NULL,
  `publication_place` varchar(100) CHARACTER SET utf8 NOT NULL,
  `number_of_pages` int(11) NOT NULL,
  `number_of_books` int(11) NOT NULL,
  `dues` varchar(100) CHARACTER SET utf8 NOT NULL,
  `isbn` varchar(100) CHARACTER SET utf8 NOT NULL,
  `source_details` enum('Local Purchase','University','World Bank Donation','Personal Donation','Others') CHARACTER SET utf8 NOT NULL,
  `notes` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cover` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT 'cover_default.jpg',
  `pdf` text CHARACTER SET utf8,
  `is_uploaded` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `deleted` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `status` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '1',
  `add_date` datetime NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`id`, `physical_form`, `author`, `subtitle`, `edition_year`, `publisher`, `series`, `size1`, `price`, `call_no`, `location`, `clue_page`, `category_id`, `editor`, `title`, `edition`, `publishing_year`, `publication_place`, `number_of_pages`, `number_of_books`, `dues`, `isbn`, `source_details`, `notes`, `cover`, `pdf`, `is_uploaded`, `deleted`, `status`, `add_date`, `group_id`) VALUES
(1, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '0', '2018-09-23 09:35:14', 0),
(2, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(3, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(4, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(5, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(6, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(7, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(8, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(9, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(10, 'Book', 'রফিকুন নবী', '', 2016, 'চন্দ্রাবতী একাডেমি', '', 'Small', '175', '', '', '', '4', '', 'রনবী’র ছড়া', '1st Published', 0000, '', 100, 10, '', '9789849229001', 'University', '', '1537673595.jpg', NULL, '1', '0', '1', '2018-09-23 09:35:14', 0),
(25, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678476.jpg', NULL, '1', '1', '1', '2018-09-23 10:54:36', 0),
(26, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '0', '2018-09-23 10:56:54', 0),
(27, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '0', '2018-09-23 10:56:54', 0),
(28, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '1', '2018-09-23 10:56:54', 0),
(29, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '0', '2018-09-23 10:56:54', 0),
(30, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '1', '2018-09-23 10:56:54', 0),
(31, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '1', '2018-09-23 10:56:54', 0),
(32, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '1', '2018-09-23 10:56:54', 0),
(33, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '1', '2018-09-23 10:56:54', 0),
(34, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '1', '2018-09-23 10:56:54', 0),
(35, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537678614.jpg', NULL, '1', '0', '1', '2018-09-23 10:56:54', 0),
(36, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537679662.jpg', NULL, '1', '0', '1', '2018-09-23 11:14:22', 0),
(37, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537679829.jpg', NULL, '1', '0', '1', '2018-09-23 11:17:09', 0),
(38, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537680441.jpg', NULL, '1', '0', '1', '2018-09-23 11:27:21', 0),
(39, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537680573.jpg', NULL, '1', '0', '1', '2018-09-23 11:29:33', 0),
(40, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537680594.jpg', NULL, '1', '0', '1', '2018-09-23 11:29:54', 0),
(41, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537680605.jpg', NULL, '1', '0', '1', '2018-09-23 11:30:05', 0),
(42, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537680692.jpg', NULL, '1', '0', '1', '2018-09-23 11:31:32', 0),
(43, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537680835.jpg', NULL, '1', '0', '1', '2018-09-23 11:33:55', 0),
(44, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537681691.jpg', NULL, '1', '0', '1', '2018-09-23 11:48:11', 0),
(45, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4,', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537682678.jpg', NULL, '1', '0', '1', '2018-09-23 12:04:38', 0),
(46, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4,,', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537682850.jpg', NULL, '1', '0', '1', '2018-09-23 12:07:30', 0),
(47, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4,', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537682865.jpg', NULL, '1', '0', '1', '2018-09-23 12:07:45', 0),
(48, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537683100.jpg', NULL, '1', '0', '1', '2018-09-23 12:11:40', 0),
(49, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '4', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537739199.jpg', NULL, '1', '0', '1', '2018-09-24 03:46:39', 0),
(50, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537739508.jpg', NULL, '1', '0', '1', '2018-09-24 03:51:48', 0),
(51, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537796761.jpg', NULL, '1', '0', '1', '2018-09-24 19:46:01', 0),
(52, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537797209.jpg', NULL, '1', '0', '1', '2018-09-24 19:53:29', 0),
(53, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537797322.jpg', NULL, '1', '0', '1', '2018-09-24 19:55:22', 0),
(54, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', 'https://s3-ap-southeast-1.amazonaws.com/rokomari110/inside/b75bc0612_11893-2.jpg', '', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537797372.jpg', NULL, '1', '0', '1', '2018-09-24 19:56:12', 0),
(55, 'Book', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '', 2013, 'বিশ্বসাহিত্য ভবন', '', 'Medium', '150', '', '', '', '', '', 'কবি', '1st Published', 0000, '', 144, 30, '', '98483091253', 'Local Purchase', '', '1537871014.jpg', NULL, '1', '0', '1', '2018-09-25 16:23:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `deleted`) VALUES
(1, 'Science Fiction', '0'),
(2, 'Comic', '0'),
(3, 'Cartoon', '0'),
(4, 'Poem', '0');

-- --------------------------------------------------------

--
-- Table structure for table `circulation`
--

CREATE TABLE `circulation` (
  `id` int(11) NOT NULL,
  `member_id` varchar(99) NOT NULL,
  `book_id` varchar(99) NOT NULL,
  `issue_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `return_date` date NOT NULL,
  `fine_amount` double NOT NULL,
  `is_returned` tinyint(1) NOT NULL,
  `is_expired` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `circulation`
--

INSERT INTO `circulation` (`id`, `member_id`, `book_id`, `issue_date`, `expire_date`, `return_date`, `fine_amount`, `is_returned`, `is_expired`) VALUES
(8, '142-15-115', '10', '2018-09-25', '1970-01-01', '2018-09-25', 0, 1, '1'),
(9, '142-15-115', '2', '2018-09-25', '2018-10-05', '2018-09-25', 0, 1, '0'),
(10, '142-15-115', '27', '2018-09-25', '2018-10-05', '0000-00-00', 0, 0, '0'),
(11, '142-15-115', '26', '2018-09-25', '2018-10-05', '0000-00-00', 0, 0, '0'),
(12, '142-15-115', '29', '2018-09-25', '2018-10-05', '0000-00-00', 0, 0, '0'),
(13, '142-15-115', '10', '2018-09-25', '2018-10-05', '2018-09-25', 0, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `circulation_config`
--

CREATE TABLE `circulation_config` (
  `id` int(11) NOT NULL,
  `member_type_id` varchar(99) NOT NULL,
  `issue_day_limit` varchar(99) NOT NULL,
  `issu_book_limit` int(11) NOT NULL,
  `fine_per_day` double NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `circulation_config`
--

INSERT INTO `circulation_config` (`id`, `member_type_id`, `issue_day_limit`, `issu_book_limit`, `fine_per_day`, `deleted`) VALUES
(1, '1', '10', 5, 0, '0'),
(2, '2', '7', 3, 10, '0'),
(3, '3', '8', 4, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(200) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `user_agent` varchar(199) NOT NULL,
  `last_activity` varchar(199) NOT NULL,
  `user_data` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('03856b7defccf15ac6f97f9bd17541f5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537876343', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:14:\"Naznin Sultana\";s:9:\"user_type\";s:6:\"Member\";s:9:\"member_id\";s:10:\"142-15-115\";}'),
('06c4658f310e7ab4cec6b425e0054757', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge', '1537876381', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"Admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";}'),
('1c2b845b38be9789053f18eb6658b193', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537703395', 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"Admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";s:20:\"is_consumer_template\";i:0;}'),
('1ff2f2797a80ff181aeee1456e781cec', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537784366', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"Admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";}'),
('2a9416549073704a6d3f9e04e67aa77a', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537820764', ''),
('2ac6f98dc526faef9b932d86a77956f3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537821189', ''),
('358543b992d42af0c6a003214e5ea4fc', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537708539', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:9:\"Librarian\";s:9:\"user_type\";s:9:\"Librarian\";s:9:\"member_id\";s:1:\"5\";}'),
('42c79d6363fb2ee18e1980b09b6309ca', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537779910', 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:9:\"Librarian\";s:9:\"user_type\";s:9:\"Librarian\";s:9:\"member_id\";s:1:\"5\";s:20:\"is_consumer_template\";i:0;}'),
('55c090dc3ae5c11012598e61031e1488', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537714393', ''),
('5fcce9c59c11605ad9ba665e4439af01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537710384', ''),
('77691b91d63da739aba78ebe39017a36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537810515', 'a:13:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"Admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";s:20:\"is_consumer_template\";i:0;s:18:\"member_search_name\";s:0:\"\";s:24:\"member_search_member_idd\";s:0:\"\";s:21:\"member_search_type_id\";s:0:\"\";s:19:\"member_search_email\";s:0:\"\";s:20:\"member_search_mobile\";s:0:\"\";s:23:\"member_search_from_date\";s:0:\"\";s:21:\"member_search_to_date\";s:0:\"\";}'),
('7dc8c6ee7bb82ffa7ecac9eda6cab23e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537710394', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:9:\"Librarian\";s:9:\"user_type\";s:9:\"Librarian\";s:9:\"member_id\";s:1:\"5\";}'),
('8c3f480c41488e36cd6da1a4a2ba133d', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537779947', 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"Admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";s:25:\"change_member_password_id\";s:1:\"1\";}'),
('8d6d1fb4f683c0a43a84098d26bd154a', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge', '1537671043', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";}'),
('971c707e83ca29746955dc2268a6ea03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537674615', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";}'),
('98a120c43d4e2523b9c6a7aa49f88726', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537776857', ''),
('d46dd9481ff2900be6854dbbd33ae9aa', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537675814', 'a:6:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";s:20:\"is_consumer_template\";i:0;}'),
('d82cb1afa03e3d4dacdfa3df28485927', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537870302', ''),
('decfdc400ac66a1d9282fdf298af97c7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537781711', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"Admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";}'),
('f84f93f8d65af9f6a22ca0bd0a4d5319', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537834124', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:14:\"Naznin Sultana\";s:9:\"user_type\";s:6:\"Member\";s:9:\"member_id\";s:1:\"3\";}'),
('fac750b5eb83ddb72821aaaee0e7a62d', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '1537781115', 'a:5:{s:9:\"user_data\";s:0:\"\";s:9:\"logged_in\";i:1;s:8:\"username\";s:5:\"Admin\";s:9:\"user_type\";s:5:\"Admin\";s:9:\"member_id\";s:1:\"1\";}');

-- --------------------------------------------------------

--
-- Table structure for table `daily_read_material`
--

CREATE TABLE `daily_read_material` (
  `id` int(11) NOT NULL,
  `book_id` varchar(99) NOT NULL,
  `read_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_read_material`
--

INSERT INTO `daily_read_material` (`id`, `book_id`, `read_at`) VALUES
(1, '10', '2018-09-23 20:34:33'),
(2, '10', '2018-09-25 17:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `smtp_host` varchar(250) NOT NULL,
  `smtp_port` varchar(100) NOT NULL,
  `smtp_user` varchar(100) NOT NULL,
  `smtp_password` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forget_password`
--

CREATE TABLE `forget_password` (
  `id` int(12) NOT NULL,
  `confirmation_code` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(250) CHARACTER SET latin1 NOT NULL,
  `success` int(11) NOT NULL DEFAULT '0',
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(99) CHARACTER SET utf8 NOT NULL,
  `member_idd` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(99) NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL,
  `user_type` enum('Member','Admin','Librarian') NOT NULL,
  `status` enum('1','0') NOT NULL,
  `add_date` date NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `member_idd`, `type_id`, `email`, `mobile`, `password`, `address`, `user_type`, `status`, `add_date`, `deleted`) VALUES
(1, 'Admin', '142-15-116', 0, 'admin@gmail.com', '01746782021', '49e068247af419de70c29c0a575f2c59', 'House:2, Road:2, Sector:13, Uttara', 'Admin', '1', '2016-04-10', '0'),
(2, 'Ashfaqur Rahman', '142-15-122', 2, 'ashfaq@gmail.com', '017467820211', '611aa4057916f137fc68199ad3ac25d0', 'House:2, Road:2, Sector:13, Uttara', 'Member', '1', '2018-09-23', '0'),
(3, 'Naznin Sultana', '142-15-115', 1, 'naznin@gmail.com', '1234556', '49e068247af419de70c29c0a575f2c59', 'Uttara', 'Member', '1', '2018-09-23', '0'),
(4, 'Mahmuda Islam', '142-15-117', 2, 'mahmuda@gmail.com', '123456789', '49e068247af419de70c29c0a575f2c59', 'Uttara', 'Member', '1', '2018-09-23', '0'),
(5, 'Librarian', '142-15-118', 0, 'librarian@gmail.com', '01234556', '49e068247af419de70c29c0a575f2c59', 'Uttara', 'Librarian', '1', '2018-09-23', '0'),
(6, 'Taslima Ferdous', '142-15-119', 1, 'taslima@gmail.com', '123455678', '49e068247af419de70c29c0a575f2c59', 'Uttara', 'Librarian', '1', '2018-09-24', '0'),
(7, 'Salim Hoq', '142-15-120', 1, 'salim@gmail.com', '01234556789', '49e068247af419de70c29c0a575f2c59', 'Uttara', 'Member', '1', '2018-09-24', '0'),
(8, 'Ashfaqur Rahman', '142-15-114', 2, 'dreamsoft16@gmail.com', '1746782021', '49e068247af419de70c29c0a575f2c59', 'House:2, Road:2, Sector:13, Uttara', 'Member', '0', '2018-09-25', '0'),
(9, 'Anamika Majumder', '142-15-121', 2, 'anamika@gmail.com', '12345567', '49e068247af419de70c29c0a575f2c59', 'Uttara', 'Member', '1', '2018-09-25', '0');

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE `member_type` (
  `id` int(11) NOT NULL,
  `member_type_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`id`, `member_type_name`, `deleted`) VALUES
(3, 'Librarian', '1'),
(2, 'Student', '0'),
(1, 'Teacher', '0');

-- --------------------------------------------------------

--
-- Table structure for table `request_book`
--

CREATE TABLE `request_book` (
  `id` int(11) NOT NULL,
  `member_id` varchar(11) NOT NULL,
  `book_title` text CHARACTER SET utf8 NOT NULL,
  `author` text CHARACTER SET utf8 NOT NULL,
  `edition` varchar(200) CHARACTER SET utf8 NOT NULL,
  `note` text CHARACTER SET utf8 NOT NULL,
  `request_date` date NOT NULL,
  `reply` text CHARACTER SET utf8 NOT NULL,
  `request_status` varchar(55) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_book`
--

INSERT INTO `request_book` (`id`, `member_id`, `book_title`, `author`, `edition`, `note`, `request_date`, `reply`, `request_status`) VALUES
(12, '142-15-115', 'কবি', 'তারাশঙ্কর বন্দ্যোপাধ্যায়', '1st Published', 'Urgent', '2018-09-25', 'Thanks! for your request. We have accepted your request.', 'Accepted'),
(18, '142-15-115', 'The Warriors', 'Ashfaqur Rahman', '1st Published', 'Comic book', '2018-09-25', '', 'Pending'),
(22, '142-15-115', 'The Warriors', 'Ashfaqur Rahman', '1st Published', 'Comic book', '2018-09-25', 'Not possible now', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `sms_config`
--

CREATE TABLE `sms_config` (
  `id` int(11) NOT NULL,
  `name` enum('planet','plivo','twilio','clickatell','nexmo') CHARACTER SET utf8 NOT NULL,
  `auth_id` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `api_id` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_config`
--

INSERT INTO `sms_config` (`id`, `name`, `auth_id`, `token`, `api_id`, `phone_number`) VALUES
(1, 'clickatell', 'gd', 'dg', '1', 'hey');

-- --------------------------------------------------------

--
-- Table structure for table `sms_email_history`
--

CREATE TABLE `sms_email_history` (
  `id` int(11) NOT NULL,
  `member_id` varchar(11) NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `type` enum('Email','Notification') NOT NULL,
  `sent_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_email_history`
--

INSERT INTO `sms_email_history` (`id`, `member_id`, `title`, `message`, `type`, `sent_at`) VALUES
(3, '142-15-115', 'Issued', 'Your Book issued Successfully.', 'Notification', '2018-09-25 17:46:37'),
(4, '142-15-115', 'Book', 'Your Book issued Successfully.', 'Notification', '2018-09-25 17:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_condition`
--

CREATE TABLE `terms_and_condition` (
  `id` int(11) NOT NULL,
  `terms_and_condition` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms_and_condition`
--

INSERT INTO `terms_and_condition` (`id`, `terms_and_condition`) VALUES
(1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `circulation`
--
ALTER TABLE `circulation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `circulation_config`
--
ALTER TABLE `circulation_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_type_id` (`member_type_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `daily_read_material`
--
ALTER TABLE `daily_read_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forget_password`
--
ALTER TABLE `forget_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_type`
--
ALTER TABLE `member_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_type_name` (`member_type_name`,`deleted`);

--
-- Indexes for table `request_book`
--
ALTER TABLE `request_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_config`
--
ALTER TABLE `sms_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_email_history`
--
ALTER TABLE `sms_email_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_condition`
--
ALTER TABLE `terms_and_condition`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `circulation`
--
ALTER TABLE `circulation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `circulation_config`
--
ALTER TABLE `circulation_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `daily_read_material`
--
ALTER TABLE `daily_read_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forget_password`
--
ALTER TABLE `forget_password`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `member_type`
--
ALTER TABLE `member_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_book`
--
ALTER TABLE `request_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sms_config`
--
ALTER TABLE `sms_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_email_history`
--
ALTER TABLE `sms_email_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `terms_and_condition`
--
ALTER TABLE `terms_and_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
