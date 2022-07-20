-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2022 at 12:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ck_admin`
--

--
-- Truncate table before insert `areas`
--

TRUNCATE TABLE `areas`;
--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `city`, `postcode`, `state`, `country`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Taman Ekoflora', 'Johor Bahru', 81100, 'Johor', 'Malaysia', '2022-07-20 01:38:37', '2022-07-20 01:38:37', NULL, NULL),
(2, 'Taman Austin Perdana', 'Johor Bahru', 81100, 'Johor', 'Malaysia', '2022-07-20 01:51:14', '2022-07-20 01:51:14', NULL, NULL),
(3, 'Taman Austin Perdana', 'Johor Bahru', 81100, 'Johor', 'Malaysia', '2022-07-20 01:51:51', '2022-07-20 01:52:10', '2022-07-20 01:52:10', NULL);

--
-- Truncate table before insert `area_open_project`
--

TRUNCATE TABLE `area_open_project`;
--
-- Dumping data for table `area_open_project`
--

INSERT INTO `area_open_project` (`open_project_id`, `area_id`) VALUES
(1, 1);

--
-- Truncate table before insert `area_project`
--

TRUNCATE TABLE `area_project`;
--
-- Dumping data for table `area_project`
--

INSERT INTO `area_project` (`project_id`, `area_id`) VALUES
(1, 1);

--
-- Truncate table before insert `articles`
--

TRUNCATE TABLE `articles`;
--
-- Truncate table before insert `assets`
--

TRUNCATE TABLE `assets`;
--
-- Truncate table before insert `assets_histories`
--

TRUNCATE TABLE `assets_histories`;
--
-- Truncate table before insert `asset_categories`
--

TRUNCATE TABLE `asset_categories`;
--
-- Truncate table before insert `asset_locations`
--

TRUNCATE TABLE `asset_locations`;
--
-- Truncate table before insert `asset_statuses`
--

TRUNCATE TABLE `asset_statuses`;
--
-- Dumping data for table `asset_statuses`
--

INSERT INTO `asset_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Available', '2022-06-19 22:47:37', '2022-06-19 22:47:37', NULL, NULL),
(2, 'Not Available', '2022-06-19 22:47:37', '2022-06-19 22:47:37', NULL, NULL),
(3, 'Broken', '2022-06-19 22:47:37', '2022-06-19 22:47:37', NULL, NULL),
(4, 'Out for Repair', '2022-06-19 22:47:37', '2022-06-19 22:47:37', NULL, NULL);

--
-- Truncate table before insert `audit_logs`
--

TRUNCATE TABLE `audit_logs`;
--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(1, 'audit:created', 1, 'App\\Models\\Permission#1', NULL, '{\"title\":\"user_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":1}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(2, 'audit:created', 2, 'App\\Models\\Permission#2', NULL, '{\"title\":\"permission_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":2}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(3, 'audit:created', 3, 'App\\Models\\Permission#3', NULL, '{\"title\":\"permission_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":3}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(4, 'audit:created', 4, 'App\\Models\\Permission#4', NULL, '{\"title\":\"permission_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":4}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(5, 'audit:created', 5, 'App\\Models\\Permission#5', NULL, '{\"title\":\"permission_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":5}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(6, 'audit:created', 6, 'App\\Models\\Permission#6', NULL, '{\"title\":\"permission_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":6}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(7, 'audit:created', 7, 'App\\Models\\Permission#7', NULL, '{\"title\":\"role_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":7}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(8, 'audit:created', 8, 'App\\Models\\Permission#8', NULL, '{\"title\":\"role_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":8}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(9, 'audit:created', 9, 'App\\Models\\Permission#9', NULL, '{\"title\":\"role_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":9}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(10, 'audit:created', 10, 'App\\Models\\Permission#10', NULL, '{\"title\":\"role_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":10}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(11, 'audit:created', 11, 'App\\Models\\Permission#11', NULL, '{\"title\":\"role_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":11}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(12, 'audit:created', 12, 'App\\Models\\Permission#12', NULL, '{\"title\":\"user_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":12}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(13, 'audit:created', 13, 'App\\Models\\Permission#13', NULL, '{\"title\":\"user_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":13}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(14, 'audit:created', 14, 'App\\Models\\Permission#14', NULL, '{\"title\":\"user_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":14}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(15, 'audit:created', 15, 'App\\Models\\Permission#15', NULL, '{\"title\":\"user_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":15}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(16, 'audit:created', 16, 'App\\Models\\Permission#16', NULL, '{\"title\":\"user_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":16}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(17, 'audit:created', 17, 'App\\Models\\Permission#17', NULL, '{\"title\":\"audit_log_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":17}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(18, 'audit:created', 18, 'App\\Models\\Permission#18', NULL, '{\"title\":\"audit_log_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":18}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(19, 'audit:created', 19, 'App\\Models\\Permission#19', NULL, '{\"title\":\"area_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":19}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(20, 'audit:created', 20, 'App\\Models\\Permission#20', NULL, '{\"title\":\"area_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":20}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(21, 'audit:created', 21, 'App\\Models\\Permission#21', NULL, '{\"title\":\"area_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":21}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(22, 'audit:created', 22, 'App\\Models\\Permission#22', NULL, '{\"title\":\"area_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":22}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(23, 'audit:created', 23, 'App\\Models\\Permission#23', NULL, '{\"title\":\"area_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":23}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(24, 'audit:created', 24, 'App\\Models\\Permission#24', NULL, '{\"title\":\"manage_house_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":24}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(25, 'audit:created', 25, 'App\\Models\\Permission#25', NULL, '{\"title\":\"manage_house_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":25}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(26, 'audit:created', 26, 'App\\Models\\Permission#26', NULL, '{\"title\":\"manage_house_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":26}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(27, 'audit:created', 27, 'App\\Models\\Permission#27', NULL, '{\"title\":\"manage_house_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":27}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(28, 'audit:created', 28, 'App\\Models\\Permission#28', NULL, '{\"title\":\"manage_house_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":28}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(29, 'audit:created', 29, 'App\\Models\\Permission#29', NULL, '{\"title\":\"payment_type_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":29}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(30, 'audit:created', 30, 'App\\Models\\Permission#30', NULL, '{\"title\":\"payment_type_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":30}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(31, 'audit:created', 31, 'App\\Models\\Permission#31', NULL, '{\"title\":\"payment_type_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":31}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(32, 'audit:created', 32, 'App\\Models\\Permission#32', NULL, '{\"title\":\"payment_type_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":32}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(33, 'audit:created', 33, 'App\\Models\\Permission#33', NULL, '{\"title\":\"payment_type_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":33}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(34, 'audit:created', 34, 'App\\Models\\Permission#34', NULL, '{\"title\":\"parking_lot_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":34}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(35, 'audit:created', 35, 'App\\Models\\Permission#35', NULL, '{\"title\":\"parking_lot_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":35}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(36, 'audit:created', 36, 'App\\Models\\Permission#36', NULL, '{\"title\":\"parking_lot_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":36}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(37, 'audit:created', 37, 'App\\Models\\Permission#37', NULL, '{\"title\":\"parking_lot_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":37}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(38, 'audit:created', 38, 'App\\Models\\Permission#38', NULL, '{\"title\":\"parking_lot_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":38}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(39, 'audit:created', 39, 'App\\Models\\Permission#39', NULL, '{\"title\":\"notice_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":39}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(40, 'audit:created', 40, 'App\\Models\\Permission#40', NULL, '{\"title\":\"notice_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":40}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(41, 'audit:created', 41, 'App\\Models\\Permission#41', NULL, '{\"title\":\"notice_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":41}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(42, 'audit:created', 42, 'App\\Models\\Permission#42', NULL, '{\"title\":\"notice_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":42}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(43, 'audit:created', 43, 'App\\Models\\Permission#43', NULL, '{\"title\":\"notice_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":43}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(44, 'audit:created', 44, 'App\\Models\\Permission#44', NULL, '{\"title\":\"article_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":44}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(45, 'audit:created', 45, 'App\\Models\\Permission#45', NULL, '{\"title\":\"article_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":45}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(46, 'audit:created', 46, 'App\\Models\\Permission#46', NULL, '{\"title\":\"article_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":46}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(47, 'audit:created', 47, 'App\\Models\\Permission#47', NULL, '{\"title\":\"article_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":47}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(48, 'audit:created', 48, 'App\\Models\\Permission#48', NULL, '{\"title\":\"article_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":48}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(49, 'audit:created', 49, 'App\\Models\\Permission#49', NULL, '{\"title\":\"my_case_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":49}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(50, 'audit:created', 50, 'App\\Models\\Permission#50', NULL, '{\"title\":\"my_case_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":50}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(51, 'audit:created', 51, 'App\\Models\\Permission#51', NULL, '{\"title\":\"my_case_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":51}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(52, 'audit:created', 52, 'App\\Models\\Permission#52', NULL, '{\"title\":\"my_case_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":52}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(53, 'audit:created', 53, 'App\\Models\\Permission#53', NULL, '{\"title\":\"my_case_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":53}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(54, 'audit:created', 54, 'App\\Models\\Permission#54', NULL, '{\"title\":\"cases_category_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":54}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(55, 'audit:created', 55, 'App\\Models\\Permission#55', NULL, '{\"title\":\"cases_category_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":55}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(56, 'audit:created', 56, 'App\\Models\\Permission#56', NULL, '{\"title\":\"cases_category_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":56}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(57, 'audit:created', 57, 'App\\Models\\Permission#57', NULL, '{\"title\":\"cases_category_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":57}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(58, 'audit:created', 58, 'App\\Models\\Permission#58', NULL, '{\"title\":\"cases_category_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":58}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(59, 'audit:created', 59, 'App\\Models\\Permission#59', NULL, '{\"title\":\"maintanance_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":59}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(60, 'audit:created', 60, 'App\\Models\\Permission#60', NULL, '{\"title\":\"maintanance_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":60}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(61, 'audit:created', 61, 'App\\Models\\Permission#61', NULL, '{\"title\":\"maintanance_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":61}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(62, 'audit:created', 62, 'App\\Models\\Permission#62', NULL, '{\"title\":\"maintanance_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":62}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(63, 'audit:created', 63, 'App\\Models\\Permission#63', NULL, '{\"title\":\"maintanance_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":63}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(64, 'audit:created', 64, 'App\\Models\\Permission#64', NULL, '{\"title\":\"maintanance_type_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":64}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(65, 'audit:created', 65, 'App\\Models\\Permission#65', NULL, '{\"title\":\"maintanance_type_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":65}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(66, 'audit:created', 66, 'App\\Models\\Permission#66', NULL, '{\"title\":\"maintanance_type_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":66}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(67, 'audit:created', 67, 'App\\Models\\Permission#67', NULL, '{\"title\":\"maintanance_type_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":67}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(68, 'audit:created', 68, 'App\\Models\\Permission#68', NULL, '{\"title\":\"maintanance_type_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":68}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(69, 'audit:created', 69, 'App\\Models\\Permission#69', NULL, '{\"title\":\"asset_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":69}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(70, 'audit:created', 70, 'App\\Models\\Permission#70', NULL, '{\"title\":\"asset_category_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":70}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(71, 'audit:created', 71, 'App\\Models\\Permission#71', NULL, '{\"title\":\"asset_category_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":71}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(72, 'audit:created', 72, 'App\\Models\\Permission#72', NULL, '{\"title\":\"asset_category_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":72}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(73, 'audit:created', 73, 'App\\Models\\Permission#73', NULL, '{\"title\":\"asset_category_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":73}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(74, 'audit:created', 74, 'App\\Models\\Permission#74', NULL, '{\"title\":\"asset_category_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":74}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(75, 'audit:created', 75, 'App\\Models\\Permission#75', NULL, '{\"title\":\"asset_location_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":75}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(76, 'audit:created', 76, 'App\\Models\\Permission#76', NULL, '{\"title\":\"asset_location_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":76}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(77, 'audit:created', 77, 'App\\Models\\Permission#77', NULL, '{\"title\":\"asset_location_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":77}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(78, 'audit:created', 78, 'App\\Models\\Permission#78', NULL, '{\"title\":\"asset_location_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":78}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(79, 'audit:created', 79, 'App\\Models\\Permission#79', NULL, '{\"title\":\"asset_location_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":79}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(80, 'audit:created', 80, 'App\\Models\\Permission#80', NULL, '{\"title\":\"asset_status_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":80}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(81, 'audit:created', 81, 'App\\Models\\Permission#81', NULL, '{\"title\":\"asset_status_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":81}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(82, 'audit:created', 82, 'App\\Models\\Permission#82', NULL, '{\"title\":\"asset_status_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":82}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(83, 'audit:created', 83, 'App\\Models\\Permission#83', NULL, '{\"title\":\"asset_status_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":83}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(84, 'audit:created', 84, 'App\\Models\\Permission#84', NULL, '{\"title\":\"asset_status_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":84}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(85, 'audit:created', 85, 'App\\Models\\Permission#85', NULL, '{\"title\":\"asset_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":85}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(86, 'audit:created', 86, 'App\\Models\\Permission#86', NULL, '{\"title\":\"asset_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":86}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(87, 'audit:created', 87, 'App\\Models\\Permission#87', NULL, '{\"title\":\"asset_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":87}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(88, 'audit:created', 88, 'App\\Models\\Permission#88', NULL, '{\"title\":\"asset_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":88}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(89, 'audit:created', 89, 'App\\Models\\Permission#89', NULL, '{\"title\":\"asset_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":89}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(90, 'audit:created', 90, 'App\\Models\\Permission#90', NULL, '{\"title\":\"assets_history_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":90}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(91, 'audit:created', 91, 'App\\Models\\Permission#91', NULL, '{\"title\":\"payment_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":91}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(92, 'audit:created', 92, 'App\\Models\\Permission#92', NULL, '{\"title\":\"house_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":92}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(93, 'audit:created', 93, 'App\\Models\\Permission#93', NULL, '{\"title\":\"other_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":93}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(94, 'audit:created', 94, 'App\\Models\\Permission#94', NULL, '{\"title\":\"user_alert_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":94}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(95, 'audit:created', 95, 'App\\Models\\Permission#95', NULL, '{\"title\":\"user_alert_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":95}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(96, 'audit:created', 96, 'App\\Models\\Permission#96', NULL, '{\"title\":\"user_alert_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":96}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(97, 'audit:created', 97, 'App\\Models\\Permission#97', NULL, '{\"title\":\"user_alert_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":97}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(98, 'audit:created', 98, 'App\\Models\\Permission#98', NULL, '{\"title\":\"expense_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":98}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(99, 'audit:created', 99, 'App\\Models\\Permission#99', NULL, '{\"title\":\"expense_category_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":99}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(100, 'audit:created', 100, 'App\\Models\\Permission#100', NULL, '{\"title\":\"expense_category_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":100}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(101, 'audit:created', 101, 'App\\Models\\Permission#101', NULL, '{\"title\":\"expense_category_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":101}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(102, 'audit:created', 102, 'App\\Models\\Permission#102', NULL, '{\"title\":\"expense_category_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":102}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(103, 'audit:created', 103, 'App\\Models\\Permission#103', NULL, '{\"title\":\"expense_category_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":103}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(104, 'audit:created', 104, 'App\\Models\\Permission#104', NULL, '{\"title\":\"income_category_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":104}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(105, 'audit:created', 105, 'App\\Models\\Permission#105', NULL, '{\"title\":\"income_category_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":105}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(106, 'audit:created', 106, 'App\\Models\\Permission#106', NULL, '{\"title\":\"income_category_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":106}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(107, 'audit:created', 107, 'App\\Models\\Permission#107', NULL, '{\"title\":\"income_category_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":107}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(108, 'audit:created', 108, 'App\\Models\\Permission#108', NULL, '{\"title\":\"income_category_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":108}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(109, 'audit:created', 109, 'App\\Models\\Permission#109', NULL, '{\"title\":\"expense_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":109}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(110, 'audit:created', 110, 'App\\Models\\Permission#110', NULL, '{\"title\":\"expense_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":110}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(111, 'audit:created', 111, 'App\\Models\\Permission#111', NULL, '{\"title\":\"expense_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":111}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(112, 'audit:created', 112, 'App\\Models\\Permission#112', NULL, '{\"title\":\"expense_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":112}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(113, 'audit:created', 113, 'App\\Models\\Permission#113', NULL, '{\"title\":\"expense_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":113}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(114, 'audit:created', 114, 'App\\Models\\Permission#114', NULL, '{\"title\":\"income_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":114}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(115, 'audit:created', 115, 'App\\Models\\Permission#115', NULL, '{\"title\":\"income_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":115}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(116, 'audit:created', 116, 'App\\Models\\Permission#116', NULL, '{\"title\":\"income_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":116}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(117, 'audit:created', 117, 'App\\Models\\Permission#117', NULL, '{\"title\":\"income_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":117}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(118, 'audit:created', 118, 'App\\Models\\Permission#118', NULL, '{\"title\":\"income_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":118}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(119, 'audit:created', 119, 'App\\Models\\Permission#119', NULL, '{\"title\":\"expense_report_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":119}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(120, 'audit:created', 120, 'App\\Models\\Permission#120', NULL, '{\"title\":\"expense_report_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":120}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(121, 'audit:created', 121, 'App\\Models\\Permission#121', NULL, '{\"title\":\"expense_report_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":121}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(122, 'audit:created', 122, 'App\\Models\\Permission#122', NULL, '{\"title\":\"expense_report_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":122}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(123, 'audit:created', 123, 'App\\Models\\Permission#123', NULL, '{\"title\":\"expense_report_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":123}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(124, 'audit:created', 124, 'App\\Models\\Permission#124', NULL, '{\"title\":\"payment_history_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":124}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(125, 'audit:created', 125, 'App\\Models\\Permission#125', NULL, '{\"title\":\"complaint_system_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":125}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(126, 'audit:created', 126, 'App\\Models\\Permission#126', NULL, '{\"title\":\"complaint_system_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":126}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(127, 'audit:created', 127, 'App\\Models\\Permission#127', NULL, '{\"title\":\"complaint_system_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":127}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(128, 'audit:created', 128, 'App\\Models\\Permission#128', NULL, '{\"title\":\"complaint_system_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":128}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(129, 'audit:created', 129, 'App\\Models\\Permission#129', NULL, '{\"title\":\"complaint_system_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":129}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(130, 'audit:created', 130, 'App\\Models\\Permission#130', NULL, '{\"title\":\"task_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":130}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(131, 'audit:created', 131, 'App\\Models\\Permission#131', NULL, '{\"title\":\"task_status_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":131}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(132, 'audit:created', 132, 'App\\Models\\Permission#132', NULL, '{\"title\":\"task_status_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":132}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(133, 'audit:created', 133, 'App\\Models\\Permission#133', NULL, '{\"title\":\"task_status_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":133}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(134, 'audit:created', 134, 'App\\Models\\Permission#134', NULL, '{\"title\":\"task_status_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":134}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(135, 'audit:created', 135, 'App\\Models\\Permission#135', NULL, '{\"title\":\"task_status_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":135}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(136, 'audit:created', 136, 'App\\Models\\Permission#136', NULL, '{\"title\":\"task_tag_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":136}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(137, 'audit:created', 137, 'App\\Models\\Permission#137', NULL, '{\"title\":\"task_tag_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":137}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(138, 'audit:created', 138, 'App\\Models\\Permission#138', NULL, '{\"title\":\"task_tag_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":138}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(139, 'audit:created', 139, 'App\\Models\\Permission#139', NULL, '{\"title\":\"task_tag_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":139}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(140, 'audit:created', 140, 'App\\Models\\Permission#140', NULL, '{\"title\":\"task_tag_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":140}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(141, 'audit:created', 141, 'App\\Models\\Permission#141', NULL, '{\"title\":\"task_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":141}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(142, 'audit:created', 142, 'App\\Models\\Permission#142', NULL, '{\"title\":\"task_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":142}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(143, 'audit:created', 143, 'App\\Models\\Permission#143', NULL, '{\"title\":\"task_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":143}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(144, 'audit:created', 144, 'App\\Models\\Permission#144', NULL, '{\"title\":\"task_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":144}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(145, 'audit:created', 145, 'App\\Models\\Permission#145', NULL, '{\"title\":\"task_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":145}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(146, 'audit:created', 146, 'App\\Models\\Permission#146', NULL, '{\"title\":\"tasks_calendar_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":146}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(147, 'audit:created', 147, 'App\\Models\\Permission#147', NULL, '{\"title\":\"time_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":147}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(148, 'audit:created', 148, 'App\\Models\\Permission#148', NULL, '{\"title\":\"time_work_type_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":148}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(149, 'audit:created', 149, 'App\\Models\\Permission#149', NULL, '{\"title\":\"time_work_type_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":149}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(150, 'audit:created', 150, 'App\\Models\\Permission#150', NULL, '{\"title\":\"time_work_type_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":150}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(151, 'audit:created', 151, 'App\\Models\\Permission#151', NULL, '{\"title\":\"time_work_type_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":151}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(152, 'audit:created', 152, 'App\\Models\\Permission#152', NULL, '{\"title\":\"time_work_type_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":152}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(153, 'audit:created', 153, 'App\\Models\\Permission#153', NULL, '{\"title\":\"time_project_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":153}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(154, 'audit:created', 154, 'App\\Models\\Permission#154', NULL, '{\"title\":\"time_project_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":154}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(155, 'audit:created', 155, 'App\\Models\\Permission#155', NULL, '{\"title\":\"time_project_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":155}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(156, 'audit:created', 156, 'App\\Models\\Permission#156', NULL, '{\"title\":\"time_project_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":156}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(157, 'audit:created', 157, 'App\\Models\\Permission#157', NULL, '{\"title\":\"time_project_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":157}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(158, 'audit:created', 158, 'App\\Models\\Permission#158', NULL, '{\"title\":\"time_entry_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":158}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(159, 'audit:created', 159, 'App\\Models\\Permission#159', NULL, '{\"title\":\"time_entry_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":159}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(160, 'audit:created', 160, 'App\\Models\\Permission#160', NULL, '{\"title\":\"time_entry_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":160}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(161, 'audit:created', 161, 'App\\Models\\Permission#161', NULL, '{\"title\":\"time_entry_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":161}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(162, 'audit:created', 162, 'App\\Models\\Permission#162', NULL, '{\"title\":\"time_entry_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":162}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(163, 'audit:created', 163, 'App\\Models\\Permission#163', NULL, '{\"title\":\"time_report_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":163}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(164, 'audit:created', 164, 'App\\Models\\Permission#164', NULL, '{\"title\":\"time_report_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":164}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(165, 'audit:created', 165, 'App\\Models\\Permission#165', NULL, '{\"title\":\"time_report_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":165}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(166, 'audit:created', 166, 'App\\Models\\Permission#166', NULL, '{\"title\":\"time_report_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":166}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(167, 'audit:created', 167, 'App\\Models\\Permission#167', NULL, '{\"title\":\"time_report_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":167}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(168, 'audit:created', 168, 'App\\Models\\Permission#168', NULL, '{\"title\":\"client_management_setting_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":168}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(169, 'audit:created', 169, 'App\\Models\\Permission#169', NULL, '{\"title\":\"currency_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":169}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(170, 'audit:created', 170, 'App\\Models\\Permission#170', NULL, '{\"title\":\"currency_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":170}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(171, 'audit:created', 171, 'App\\Models\\Permission#171', NULL, '{\"title\":\"currency_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":171}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(172, 'audit:created', 172, 'App\\Models\\Permission#172', NULL, '{\"title\":\"currency_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":172}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(173, 'audit:created', 173, 'App\\Models\\Permission#173', NULL, '{\"title\":\"currency_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":173}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(174, 'audit:created', 174, 'App\\Models\\Permission#174', NULL, '{\"title\":\"transaction_type_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":174}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(175, 'audit:created', 175, 'App\\Models\\Permission#175', NULL, '{\"title\":\"transaction_type_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":175}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(176, 'audit:created', 176, 'App\\Models\\Permission#176', NULL, '{\"title\":\"transaction_type_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":176}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(177, 'audit:created', 177, 'App\\Models\\Permission#177', NULL, '{\"title\":\"transaction_type_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":177}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(178, 'audit:created', 178, 'App\\Models\\Permission#178', NULL, '{\"title\":\"transaction_type_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":178}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(179, 'audit:created', 179, 'App\\Models\\Permission#179', NULL, '{\"title\":\"income_source_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":179}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(180, 'audit:created', 180, 'App\\Models\\Permission#180', NULL, '{\"title\":\"income_source_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":180}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(181, 'audit:created', 181, 'App\\Models\\Permission#181', NULL, '{\"title\":\"income_source_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":181}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(182, 'audit:created', 182, 'App\\Models\\Permission#182', NULL, '{\"title\":\"income_source_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":182}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(183, 'audit:created', 183, 'App\\Models\\Permission#183', NULL, '{\"title\":\"income_source_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":183}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(184, 'audit:created', 184, 'App\\Models\\Permission#184', NULL, '{\"title\":\"client_status_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":184}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(185, 'audit:created', 185, 'App\\Models\\Permission#185', NULL, '{\"title\":\"client_status_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":185}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(186, 'audit:created', 186, 'App\\Models\\Permission#186', NULL, '{\"title\":\"client_status_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":186}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(187, 'audit:created', 187, 'App\\Models\\Permission#187', NULL, '{\"title\":\"client_status_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":187}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(188, 'audit:created', 188, 'App\\Models\\Permission#188', NULL, '{\"title\":\"client_status_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":188}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(189, 'audit:created', 189, 'App\\Models\\Permission#189', NULL, '{\"title\":\"project_status_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":189}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(190, 'audit:created', 190, 'App\\Models\\Permission#190', NULL, '{\"title\":\"project_status_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":190}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(191, 'audit:created', 191, 'App\\Models\\Permission#191', NULL, '{\"title\":\"project_status_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":191}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(192, 'audit:created', 192, 'App\\Models\\Permission#192', NULL, '{\"title\":\"project_status_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":192}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(193, 'audit:created', 193, 'App\\Models\\Permission#193', NULL, '{\"title\":\"project_status_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":193}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(194, 'audit:created', 194, 'App\\Models\\Permission#194', NULL, '{\"title\":\"client_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":194}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(195, 'audit:created', 195, 'App\\Models\\Permission#195', NULL, '{\"title\":\"client_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":195}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(196, 'audit:created', 196, 'App\\Models\\Permission#196', NULL, '{\"title\":\"client_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":196}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(197, 'audit:created', 197, 'App\\Models\\Permission#197', NULL, '{\"title\":\"client_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":197}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(198, 'audit:created', 198, 'App\\Models\\Permission#198', NULL, '{\"title\":\"client_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":198}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(199, 'audit:created', 199, 'App\\Models\\Permission#199', NULL, '{\"title\":\"client_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":199}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(200, 'audit:created', 200, 'App\\Models\\Permission#200', NULL, '{\"title\":\"project_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":200}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(201, 'audit:created', 201, 'App\\Models\\Permission#201', NULL, '{\"title\":\"project_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":201}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
(202, 'audit:created', 202, 'App\\Models\\Permission#202', NULL, '{\"title\":\"project_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":202}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(203, 'audit:created', 203, 'App\\Models\\Permission#203', NULL, '{\"title\":\"project_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":203}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(204, 'audit:created', 204, 'App\\Models\\Permission#204', NULL, '{\"title\":\"project_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":204}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(205, 'audit:created', 205, 'App\\Models\\Permission#205', NULL, '{\"title\":\"note_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":205}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(206, 'audit:created', 206, 'App\\Models\\Permission#206', NULL, '{\"title\":\"note_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":206}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(207, 'audit:created', 207, 'App\\Models\\Permission#207', NULL, '{\"title\":\"note_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":207}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(208, 'audit:created', 208, 'App\\Models\\Permission#208', NULL, '{\"title\":\"note_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":208}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(209, 'audit:created', 209, 'App\\Models\\Permission#209', NULL, '{\"title\":\"note_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":209}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(210, 'audit:created', 210, 'App\\Models\\Permission#210', NULL, '{\"title\":\"document_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":210}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(211, 'audit:created', 211, 'App\\Models\\Permission#211', NULL, '{\"title\":\"document_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":211}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(212, 'audit:created', 212, 'App\\Models\\Permission#212', NULL, '{\"title\":\"document_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":212}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(213, 'audit:created', 213, 'App\\Models\\Permission#213', NULL, '{\"title\":\"document_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":213}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(214, 'audit:created', 214, 'App\\Models\\Permission#214', NULL, '{\"title\":\"document_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":214}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(215, 'audit:created', 215, 'App\\Models\\Permission#215', NULL, '{\"title\":\"transaction_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":215}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(216, 'audit:created', 216, 'App\\Models\\Permission#216', NULL, '{\"title\":\"transaction_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":216}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(217, 'audit:created', 217, 'App\\Models\\Permission#217', NULL, '{\"title\":\"transaction_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":217}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(218, 'audit:created', 218, 'App\\Models\\Permission#218', NULL, '{\"title\":\"client_report_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":218}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(219, 'audit:created', 219, 'App\\Models\\Permission#219', NULL, '{\"title\":\"client_report_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":219}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(220, 'audit:created', 220, 'App\\Models\\Permission#220', NULL, '{\"title\":\"client_report_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":220}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(221, 'audit:created', 221, 'App\\Models\\Permission#221', NULL, '{\"title\":\"client_report_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":221}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(222, 'audit:created', 222, 'App\\Models\\Permission#222', NULL, '{\"title\":\"client_report_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":222}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(223, 'audit:created', 223, 'App\\Models\\Permission#223', NULL, '{\"title\":\"content_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":223}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(224, 'audit:created', 224, 'App\\Models\\Permission#224', NULL, '{\"title\":\"content_category_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":224}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(225, 'audit:created', 225, 'App\\Models\\Permission#225', NULL, '{\"title\":\"content_category_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":225}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(226, 'audit:created', 226, 'App\\Models\\Permission#226', NULL, '{\"title\":\"content_category_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":226}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(227, 'audit:created', 227, 'App\\Models\\Permission#227', NULL, '{\"title\":\"content_category_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":227}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(228, 'audit:created', 228, 'App\\Models\\Permission#228', NULL, '{\"title\":\"content_category_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":228}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(229, 'audit:created', 229, 'App\\Models\\Permission#229', NULL, '{\"title\":\"content_tag_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":229}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(230, 'audit:created', 230, 'App\\Models\\Permission#230', NULL, '{\"title\":\"content_tag_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":230}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(231, 'audit:created', 231, 'App\\Models\\Permission#231', NULL, '{\"title\":\"content_tag_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":231}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(232, 'audit:created', 232, 'App\\Models\\Permission#232', NULL, '{\"title\":\"content_tag_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":232}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(233, 'audit:created', 233, 'App\\Models\\Permission#233', NULL, '{\"title\":\"content_tag_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":233}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(234, 'audit:created', 234, 'App\\Models\\Permission#234', NULL, '{\"title\":\"content_page_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":234}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(235, 'audit:created', 235, 'App\\Models\\Permission#235', NULL, '{\"title\":\"content_page_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":235}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(236, 'audit:created', 236, 'App\\Models\\Permission#236', NULL, '{\"title\":\"content_page_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":236}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(237, 'audit:created', 237, 'App\\Models\\Permission#237', NULL, '{\"title\":\"content_page_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":237}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(238, 'audit:created', 238, 'App\\Models\\Permission#238', NULL, '{\"title\":\"content_page_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":238}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(239, 'audit:created', 239, 'App\\Models\\Permission#239', NULL, '{\"title\":\"house_type_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":239}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(240, 'audit:created', 240, 'App\\Models\\Permission#240', NULL, '{\"title\":\"house_type_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":240}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(241, 'audit:created', 241, 'App\\Models\\Permission#241', NULL, '{\"title\":\"house_type_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":241}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(242, 'audit:created', 242, 'App\\Models\\Permission#242', NULL, '{\"title\":\"house_type_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":242}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(243, 'audit:created', 243, 'App\\Models\\Permission#243', NULL, '{\"title\":\"house_type_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":243}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(244, 'audit:created', 244, 'App\\Models\\Permission#244', NULL, '{\"title\":\"manage_price_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":244}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(245, 'audit:created', 245, 'App\\Models\\Permission#245', NULL, '{\"title\":\"manage_price_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":245}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(246, 'audit:created', 246, 'App\\Models\\Permission#246', NULL, '{\"title\":\"manage_price_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":246}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(247, 'audit:created', 247, 'App\\Models\\Permission#247', NULL, '{\"title\":\"manage_price_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":247}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(248, 'audit:created', 248, 'App\\Models\\Permission#248', NULL, '{\"title\":\"manage_price_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":248}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(249, 'audit:created', 249, 'App\\Models\\Permission#249', NULL, '{\"title\":\"user_detail_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":249}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(250, 'audit:created', 250, 'App\\Models\\Permission#250', NULL, '{\"title\":\"user_detail_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":250}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(251, 'audit:created', 251, 'App\\Models\\Permission#251', NULL, '{\"title\":\"user_detail_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":251}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(252, 'audit:created', 252, 'App\\Models\\Permission#252', NULL, '{\"title\":\"user_detail_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":252}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(253, 'audit:created', 253, 'App\\Models\\Permission#253', NULL, '{\"title\":\"user_detail_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":253}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(254, 'audit:created', 254, 'App\\Models\\Permission#254', NULL, '{\"title\":\"user_card_mgmt_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":254}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(255, 'audit:created', 255, 'App\\Models\\Permission#255', NULL, '{\"title\":\"user_card_mgmt_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":255}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(256, 'audit:created', 256, 'App\\Models\\Permission#256', NULL, '{\"title\":\"user_card_mgmt_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":256}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(257, 'audit:created', 257, 'App\\Models\\Permission#257', NULL, '{\"title\":\"user_card_mgmt_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":257}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(258, 'audit:created', 258, 'App\\Models\\Permission#258', NULL, '{\"title\":\"user_card_mgmt_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":258}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(259, 'audit:created', 259, 'App\\Models\\Permission#259', NULL, '{\"title\":\"street_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":259}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(260, 'audit:created', 260, 'App\\Models\\Permission#260', NULL, '{\"title\":\"street_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":260}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(261, 'audit:created', 261, 'App\\Models\\Permission#261', NULL, '{\"title\":\"street_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":261}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(262, 'audit:created', 262, 'App\\Models\\Permission#262', NULL, '{\"title\":\"street_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":262}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(263, 'audit:created', 263, 'App\\Models\\Permission#263', NULL, '{\"title\":\"street_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":263}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(264, 'audit:created', 264, 'App\\Models\\Permission#264', NULL, '{\"title\":\"payment_plan_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":264}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(265, 'audit:created', 265, 'App\\Models\\Permission#265', NULL, '{\"title\":\"payment_plan_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":265}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(266, 'audit:created', 266, 'App\\Models\\Permission#266', NULL, '{\"title\":\"payment_plan_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":266}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(267, 'audit:created', 267, 'App\\Models\\Permission#267', NULL, '{\"title\":\"payment_plan_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":267}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(268, 'audit:created', 268, 'App\\Models\\Permission#268', NULL, '{\"title\":\"payment_plan_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":268}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(269, 'audit:created', 269, 'App\\Models\\Permission#269', NULL, '{\"title\":\"transaction_management_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":269}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(270, 'audit:created', 270, 'App\\Models\\Permission#270', NULL, '{\"title\":\"setting_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":270}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(271, 'audit:created', 271, 'App\\Models\\Permission#271', NULL, '{\"title\":\"home_owner_transaction_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":271}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(272, 'audit:created', 272, 'App\\Models\\Permission#272', NULL, '{\"title\":\"payment_item_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":272}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(273, 'audit:created', 273, 'App\\Models\\Permission#273', NULL, '{\"title\":\"payment_item_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":273}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(274, 'audit:created', 274, 'App\\Models\\Permission#274', NULL, '{\"title\":\"payment_item_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":274}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(275, 'audit:created', 275, 'App\\Models\\Permission#275', NULL, '{\"title\":\"payment_item_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":275}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(276, 'audit:created', 276, 'App\\Models\\Permission#276', NULL, '{\"title\":\"payment_item_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":276}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(277, 'audit:created', 277, 'App\\Models\\Permission#277', NULL, '{\"title\":\"payment_charge_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":277}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(278, 'audit:created', 278, 'App\\Models\\Permission#278', NULL, '{\"title\":\"payment_charge_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":278}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(279, 'audit:created', 279, 'App\\Models\\Permission#279', NULL, '{\"title\":\"payment_charge_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":279}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(280, 'audit:created', 280, 'App\\Models\\Permission#280', NULL, '{\"title\":\"payment_charge_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":280}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(281, 'audit:created', 281, 'App\\Models\\Permission#281', NULL, '{\"title\":\"payment_charge_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":281}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(282, 'audit:created', 282, 'App\\Models\\Permission#282', NULL, '{\"title\":\"house_status_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":282}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(283, 'audit:created', 283, 'App\\Models\\Permission#283', NULL, '{\"title\":\"house_status_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":283}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(284, 'audit:created', 284, 'App\\Models\\Permission#284', NULL, '{\"title\":\"house_status_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":284}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(285, 'audit:created', 285, 'App\\Models\\Permission#285', NULL, '{\"title\":\"house_status_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":285}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(286, 'audit:created', 286, 'App\\Models\\Permission#286', NULL, '{\"title\":\"house_status_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":286}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(287, 'audit:created', 287, 'App\\Models\\Permission#287', NULL, '{\"title\":\"open_project_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":287}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(288, 'audit:created', 288, 'App\\Models\\Permission#288', NULL, '{\"title\":\"open_project_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":288}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(289, 'audit:created', 289, 'App\\Models\\Permission#289', NULL, '{\"title\":\"open_project_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":289}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(290, 'audit:created', 290, 'App\\Models\\Permission#290', NULL, '{\"title\":\"open_project_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":290}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(291, 'audit:created', 291, 'App\\Models\\Permission#291', NULL, '{\"title\":\"open_project_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":291}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(292, 'audit:created', 292, 'App\\Models\\Permission#292', NULL, '{\"title\":\"supplier_proposal_create\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":292}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(293, 'audit:created', 293, 'App\\Models\\Permission#293', NULL, '{\"title\":\"supplier_proposal_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":293}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(294, 'audit:created', 294, 'App\\Models\\Permission#294', NULL, '{\"title\":\"supplier_proposal_show\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":294}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(295, 'audit:created', 295, 'App\\Models\\Permission#295', NULL, '{\"title\":\"supplier_proposal_delete\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":295}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(296, 'audit:created', 296, 'App\\Models\\Permission#296', NULL, '{\"title\":\"supplier_proposal_access\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":296}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(297, 'audit:created', 297, 'App\\Models\\Permission#297', NULL, '{\"title\":\"profile_password_edit\",\"updated_at\":\"2022-07-20 08:47:00\",\"created_at\":\"2022-07-20 08:47:00\",\"id\":297}', '127.0.0.1', '2022-07-20 00:47:00', '2022-07-20 00:47:00'),
(298, 'audit:created', 1, 'App\\Models\\TransactionType#1', 1, '{\"name\":\"Project Monthly Payment\",\"updated_at\":\"2022-07-20 09:06:24\",\"created_at\":\"2022-07-20 09:06:24\",\"id\":1}', '127.0.0.1', '2022-07-20 01:06:24', '2022-07-20 01:06:24'),
(299, 'audit:created', 1, 'App\\Models\\Area#1', 1, '{\"name\":\"Taman Ekoflora\",\"city\":\"Johor Bahru\",\"postcode\":\"81100\",\"state\":\"Johor\",\"country\":\"Malaysia\",\"updated_at\":\"2022-07-20 09:38:37\",\"created_at\":\"2022-07-20 09:38:37\",\"id\":1}', '127.0.0.1', '2022-07-20 01:38:37', '2022-07-20 01:38:37'),
(300, 'audit:created', 2, 'App\\Models\\Area#2', 1, '{\"name\":\"Taman Austin Perdana\",\"city\":\"Johor Bahru\",\"postcode\":\"81100\",\"state\":\"Johor\",\"country\":\"Malaysia\",\"updated_at\":\"2022-07-20 09:51:14\",\"created_at\":\"2022-07-20 09:51:14\",\"id\":2}', '127.0.0.1', '2022-07-20 01:51:14', '2022-07-20 01:51:14'),
(301, 'audit:created', 1, 'App\\Models\\Street#1', 1, '{\"street_name\":\"Jalan Eko Flora 1\",\"area_id\":\"1\",\"updated_at\":\"2022-07-20 09:51:25\",\"created_at\":\"2022-07-20 09:51:25\",\"id\":1}', '127.0.0.1', '2022-07-20 01:51:25', '2022-07-20 01:51:25'),
(302, 'audit:created', 2, 'App\\Models\\Street#2', 1, '{\"street_name\":\"Jalan Eko Flora 2\",\"area_id\":\"1\",\"updated_at\":\"2022-07-20 09:51:39\",\"created_at\":\"2022-07-20 09:51:39\",\"id\":2}', '127.0.0.1', '2022-07-20 01:51:39', '2022-07-20 01:51:39'),
(303, 'audit:created', 3, 'App\\Models\\Area#3', 1, '{\"name\":\"Taman Austin Perdana\",\"city\":\"Johor Bahru\",\"postcode\":\"81100\",\"state\":\"Johor\",\"country\":\"Malaysia\",\"updated_at\":\"2022-07-20 09:51:51\",\"created_at\":\"2022-07-20 09:51:51\",\"id\":3}', '127.0.0.1', '2022-07-20 01:51:51', '2022-07-20 01:51:51'),
(304, 'audit:created', 3, 'App\\Models\\Street#3', 1, '{\"street_name\":\"Jalan Austin Perdana 1\",\"area_id\":\"2\",\"updated_at\":\"2022-07-20 09:52:01\",\"created_at\":\"2022-07-20 09:52:01\",\"id\":3}', '127.0.0.1', '2022-07-20 01:52:01', '2022-07-20 01:52:01'),
(305, 'audit:deleted', 3, 'App\\Models\\Area#3', 1, '{\"id\":3,\"name\":\"Taman Austin Perdana\",\"city\":\"Johor Bahru\",\"postcode\":81100,\"state\":\"Johor\",\"country\":\"Malaysia\",\"created_at\":\"2022-07-20 09:51:51\",\"updated_at\":\"2022-07-20 09:52:10\",\"deleted_at\":\"2022-07-20 09:52:10\",\"created_by_id\":null}', '127.0.0.1', '2022-07-20 01:52:10', '2022-07-20 01:52:10'),
(306, 'audit:created', 4, 'App\\Models\\Street#4', 1, '{\"street_name\":\"Jalan Austin Perdana 2\",\"area_id\":\"2\",\"updated_at\":\"2022-07-20 09:52:26\",\"created_at\":\"2022-07-20 09:52:26\",\"id\":4}', '127.0.0.1', '2022-07-20 01:52:26', '2022-07-20 01:52:26'),
(307, 'audit:created', 1, 'App\\Models\\ParkingLot#1', 1, '{\"lot_no\":\"C01\",\"floor\":\"3\",\"updated_at\":\"2022-07-20 09:52:31\",\"created_at\":\"2022-07-20 09:52:31\",\"id\":1}', '127.0.0.1', '2022-07-20 01:52:31', '2022-07-20 01:52:31'),
(308, 'audit:created', 1, 'App\\Models\\HouseStatus#1', 1, '{\"status\":\"Sold\",\"updated_at\":\"2022-07-20 09:52:37\",\"created_at\":\"2022-07-20 09:52:37\",\"id\":1}', '127.0.0.1', '2022-07-20 01:52:37', '2022-07-20 01:52:37'),
(309, 'audit:created', 2, 'App\\Models\\HouseStatus#2', 1, '{\"status\":\"Available\",\"updated_at\":\"2022-07-20 09:52:42\",\"created_at\":\"2022-07-20 09:52:42\",\"id\":2}', '127.0.0.1', '2022-07-20 01:52:42', '2022-07-20 01:52:42'),
(310, 'audit:created', 3, 'App\\Models\\HouseStatus#3', 1, '{\"status\":\"On Hold\",\"updated_at\":\"2022-07-20 09:52:46\",\"created_at\":\"2022-07-20 09:52:46\",\"id\":3}', '127.0.0.1', '2022-07-20 01:52:46', '2022-07-20 01:52:46'),
(311, 'audit:created', 1, 'App\\Models\\HouseType#1', 1, '{\"name\":\"2 Storey Cluster House\",\"type\":\"LANDED\",\"area_id\":\"1\",\"updated_at\":\"2022-07-20 09:52:55\",\"created_at\":\"2022-07-20 09:52:55\",\"id\":1}', '127.0.0.1', '2022-07-20 01:52:55', '2022-07-20 01:52:55'),
(312, 'audit:created', 2, 'App\\Models\\HouseType#2', 1, '{\"name\":\"Service Apartment\",\"type\":\"HIGH_RISE\",\"area_id\":\"2\",\"updated_at\":\"2022-07-20 09:53:10\",\"created_at\":\"2022-07-20 09:53:10\",\"id\":2}', '127.0.0.1', '2022-07-20 01:53:10', '2022-07-20 01:53:10'),
(313, 'audit:created', 3, 'App\\Models\\HouseType#3', 1, '{\"name\":\"Condominium\",\"type\":\"HIGH_RISE\",\"area_id\":\"2\",\"updated_at\":\"2022-07-20 09:53:21\",\"created_at\":\"2022-07-20 09:53:21\",\"id\":3}', '127.0.0.1', '2022-07-20 01:53:21', '2022-07-20 01:53:21'),
(314, 'audit:created', 4, 'App\\Models\\Role#4', 1, '{\"title\":\"Home Owner\",\"redirect_to\":\"\\/home\",\"updated_at\":\"2022-07-20 09:54:22\",\"created_at\":\"2022-07-20 09:54:22\",\"id\":4}', '127.0.0.1', '2022-07-20 01:54:22', '2022-07-20 01:54:22'),
(315, 'audit:created', 3, 'App\\Models\\User#3', 1, '{\"name\":\"Jason Tam\",\"username\":\"jason_tam\",\"phone_no\":\"019-783 9976\",\"email\":\"jason@marslab.com.my\",\"approved\":\"1\",\"updated_at\":\"2022-07-20 09:54:53\",\"created_at\":\"2022-07-20 09:54:53\",\"id\":3}', '127.0.0.1', '2022-07-20 01:54:53', '2022-07-20 01:54:53'),
(316, 'audit:updated', 3, 'App\\Models\\User#3', 1, '{\"name\":\"Jason Tam\",\"username\":\"jason_tam\",\"phone_no\":\"019-783 9976\",\"email\":\"jason@marslab.com.my\",\"approved\":\"1\",\"updated_at\":\"2022-07-20 09:54:53\",\"created_at\":\"2022-07-20 09:54:53\",\"id\":3,\"verified\":1,\"verified_at\":\"2022-07-20 09:54:53\"}', '127.0.0.1', '2022-07-20 01:54:53', '2022-07-20 01:54:53'),
(317, 'audit:created', 1, 'App\\Models\\ClientStatus#1', 1, '{\"name\":\"Active\",\"updated_at\":\"2022-07-20 09:55:14\",\"created_at\":\"2022-07-20 09:55:14\",\"id\":1}', '127.0.0.1', '2022-07-20 01:55:14', '2022-07-20 01:55:14'),
(318, 'audit:created', 2, 'App\\Models\\ClientStatus#2', 1, '{\"name\":\"Inactive\",\"updated_at\":\"2022-07-20 09:55:20\",\"created_at\":\"2022-07-20 09:55:20\",\"id\":2}', '127.0.0.1', '2022-07-20 01:55:20', '2022-07-20 01:55:20'),
(319, 'audit:created', 1, 'App\\Models\\ProjectStatus#1', 1, '{\"name\":\"Running\",\"updated_at\":\"2022-07-20 09:55:36\",\"created_at\":\"2022-07-20 09:55:36\",\"id\":1}', '127.0.0.1', '2022-07-20 01:55:36', '2022-07-20 01:55:36'),
(320, 'audit:created', 2, 'App\\Models\\ProjectStatus#2', 1, '{\"name\":\"Closed\",\"updated_at\":\"2022-07-20 09:55:42\",\"created_at\":\"2022-07-20 09:55:42\",\"id\":2}', '127.0.0.1', '2022-07-20 01:55:42', '2022-07-20 01:55:42'),
(321, 'audit:created', 3, 'App\\Models\\ProjectStatus#3', 1, '{\"name\":\"Paused\",\"updated_at\":\"2022-07-20 09:55:49\",\"created_at\":\"2022-07-20 09:55:49\",\"id\":3}', '127.0.0.1', '2022-07-20 01:55:49', '2022-07-20 01:55:49'),
(322, 'audit:created', 4, 'App\\Models\\ProjectStatus#4', 1, '{\"name\":\"Pending\",\"updated_at\":\"2022-07-20 09:55:58\",\"created_at\":\"2022-07-20 09:55:58\",\"id\":4}', '127.0.0.1', '2022-07-20 01:55:58', '2022-07-20 01:55:58'),
(323, 'audit:created', 1, 'App\\Models\\Task#1', 1, '{\"name\":\"Cut Grass\",\"description\":null,\"status_id\":\"2\",\"due_date\":\"2022-07-20\",\"assigned_to_id\":\"2\",\"updated_at\":\"2022-07-20 09:56:33\",\"created_at\":\"2022-07-20 09:56:33\",\"id\":1,\"attachment\":null,\"media\":[]}', '127.0.0.1', '2022-07-20 01:56:33', '2022-07-20 01:56:33'),
(324, 'audit:created', 1, 'App\\Models\\OpenProject#1', 1, '{\"name\":\"Painting\",\"description\":\"<p>Painting all houses<\\/p>\",\"start_date\":\"2022-07-20\",\"end_date\":\"2023-07-20\",\"status\":\"OPENING\",\"updated_at\":\"2022-07-20 09:57:19\",\"created_at\":\"2022-07-20 09:57:19\",\"id\":1,\"documents\":[],\"media\":[]}', '127.0.0.1', '2022-07-20 01:57:19', '2022-07-20 01:57:19'),
(325, 'audit:created', 1, 'App\\Models\\Client#1', 1, '{\"person_in_change\":\"Jason Tam\",\"company\":\"Jason Cut Grass Company\",\"desc\":\"Cut Grass Company\",\"email\":\"jason@marslab.com.my\",\"phone\":\"012-666 9999\",\"website\":\"www.google.com\",\"whatapps\":\"012-666 9999\",\"country\":\"Malaysia\",\"status_id\":\"1\",\"updated_at\":\"2022-07-20 10:01:10\",\"created_at\":\"2022-07-20 10:01:10\",\"id\":1}', '127.0.0.1', '2022-07-20 02:01:10', '2022-07-20 02:01:10'),
(326, 'audit:created', 2, 'App\\Models\\Client#2', 1, '{\"person_in_change\":\"Sam\",\"company\":\"Sam Building Company\",\"desc\":\"Building Company\",\"email\":\"dev@marslab.com\",\"phone\":\"012-666 1111\",\"website\":\"www.youtube.com\",\"whatapps\":\"012-666 1111\",\"country\":\"Malaysia\",\"status_id\":\"1\",\"updated_at\":\"2022-07-20 10:02:48\",\"created_at\":\"2022-07-20 10:02:48\",\"id\":2}', '127.0.0.1', '2022-07-20 02:02:48', '2022-07-20 02:02:48'),
(327, 'audit:created', 1, 'App\\Models\\Project#1', 1, '{\"name\":\"Cut Grass\",\"description\":\"<p>Cut Grass<\\/p>\",\"start_date\":\"2022-07-20\",\"status_id\":\"1\",\"updated_at\":\"2022-07-20 10:03:11\",\"created_at\":\"2022-07-20 10:03:11\",\"id\":1,\"documents\":[],\"media\":[]}', '127.0.0.1', '2022-07-20 02:03:11', '2022-07-20 02:03:11'),
(328, 'audit:created', 1, 'App\\Models\\SupplierProposal#1', 1, '{\"representative_name\":\"Ah John\",\"contact_no\":\"012 345 4456\",\"open_project_id\":\"1\",\"updated_at\":\"2022-07-20 10:03:32\",\"created_at\":\"2022-07-20 10:03:32\",\"id\":1,\"documents\":[],\"media\":[]}', '127.0.0.1', '2022-07-20 02:03:32', '2022-07-20 02:03:32'),
(329, 'audit:created', 1, 'App\\Models\\ManageHouse#1', 1, '{\"area_id\":\"2\",\"street_id\":\"3\",\"house_type_id\":\"2\",\"unit_no\":\"B-07-01\",\"floor\":\"7\",\"block\":\"B\",\"square_feet\":\"900\",\"house_status_id\":\"1\",\"contact_person_id\":\"3\",\"contact_person_2_id\":null,\"updated_at\":\"2022-07-20 10:05:18\",\"created_at\":\"2022-07-20 10:05:18\",\"id\":1,\"documents\":[],\"media\":[]}', '127.0.0.1', '2022-07-20 02:05:18', '2022-07-20 02:05:18');

--
-- Truncate table before insert `cases_categories`
--

TRUNCATE TABLE `cases_categories`;
--
-- Truncate table before insert `clients`
--

TRUNCATE TABLE `clients`;
--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `person_in_change`, `company`, `desc`, `email`, `phone`, `website`, `whatapps`, `country`, `created_at`, `updated_at`, `deleted_at`, `status_id`, `created_by_id`) VALUES
(1, 'Jason Tam', 'Jason Cut Grass Company', 'Cut Grass Company', 'jason@marslab.com.my', '012-666 9999', 'www.google.com', '012-666 9999', 'Malaysia', '2022-07-20 02:01:10', '2022-07-20 02:01:10', NULL, 1, NULL),
(2, 'Sam', 'Sam Building Company', 'Building Company', 'dev@marslab.com', '012-666 1111', 'www.youtube.com', '012-666 1111', 'Malaysia', '2022-07-20 02:02:48', '2022-07-20 02:02:48', NULL, 1, NULL);

--
-- Truncate table before insert `client_project`
--

TRUNCATE TABLE `client_project`;
--
-- Dumping data for table `client_project`
--

INSERT INTO `client_project` (`project_id`, `client_id`) VALUES
(1, 1);

--
-- Truncate table before insert `client_statuses`
--

TRUNCATE TABLE `client_statuses`;
--
-- Dumping data for table `client_statuses`
--

INSERT INTO `client_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Active', '2022-07-20 01:55:14', '2022-07-20 01:55:14', NULL, NULL),
(2, 'Inactive', '2022-07-20 01:55:20', '2022-07-20 01:55:20', NULL, NULL);

--
-- Truncate table before insert `complaint_systems`
--

TRUNCATE TABLE `complaint_systems`;
--
-- Truncate table before insert `content_categories`
--

TRUNCATE TABLE `content_categories`;
--
-- Truncate table before insert `content_category_content_page`
--

TRUNCATE TABLE `content_category_content_page`;
--
-- Truncate table before insert `content_pages`
--

TRUNCATE TABLE `content_pages`;
--
-- Truncate table before insert `content_page_content_tag`
--

TRUNCATE TABLE `content_page_content_tag`;
--
-- Truncate table before insert `content_tags`
--

TRUNCATE TABLE `content_tags`;
--
-- Truncate table before insert `currencies`
--

TRUNCATE TABLE `currencies`;
--
-- Truncate table before insert `documents`
--

TRUNCATE TABLE `documents`;
--
-- Truncate table before insert `expenses`
--

TRUNCATE TABLE `expenses`;
--
-- Truncate table before insert `expense_categories`
--

TRUNCATE TABLE `expense_categories`;
--
-- Truncate table before insert `home_owner_transactions`
--

TRUNCATE TABLE `home_owner_transactions`;
--
-- Truncate table before insert `house_statuses`
--

TRUNCATE TABLE `house_statuses`;
--
-- Dumping data for table `house_statuses`
--

INSERT INTO `house_statuses` (`id`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Sold', '2022-07-20 01:52:37', '2022-07-20 01:52:37', NULL, NULL),
(2, 'Available', '2022-07-20 01:52:42', '2022-07-20 01:52:42', NULL, NULL),
(3, 'On Hold', '2022-07-20 01:52:46', '2022-07-20 01:52:46', NULL, NULL);

--
-- Truncate table before insert `house_types`
--

TRUNCATE TABLE `house_types`;
--
-- Dumping data for table `house_types`
--

INSERT INTO `house_types` (`id`, `name`, `type`, `created_at`, `updated_at`, `deleted_at`, `area_id`, `created_by_id`) VALUES
(1, '2 Storey Cluster House', 'LANDED', '2022-07-20 01:52:55', '2022-07-20 01:52:55', NULL, 1, NULL),
(2, 'Service Apartment', 'HIGH_RISE', '2022-07-20 01:53:10', '2022-07-20 01:53:10', NULL, 2, NULL),
(3, 'Condominium', 'HIGH_RISE', '2022-07-20 01:53:21', '2022-07-20 01:53:21', NULL, 2, NULL);

--
-- Truncate table before insert `incomes`
--

TRUNCATE TABLE `incomes`;
--
-- Truncate table before insert `income_categories`
--

TRUNCATE TABLE `income_categories`;
--
-- Truncate table before insert `income_sources`
--

TRUNCATE TABLE `income_sources`;
--
-- Truncate table before insert `maintanances`
--

TRUNCATE TABLE `maintanances`;
--
-- Truncate table before insert `maintanance_types`
--

TRUNCATE TABLE `maintanance_types`;
--
-- Truncate table before insert `manage_houses`
--

TRUNCATE TABLE `manage_houses`;
--
-- Dumping data for table `manage_houses`
--

INSERT INTO `manage_houses` (`id`, `unit_no`, `floor`, `block`, `square_feet`, `created_at`, `updated_at`, `deleted_at`, `house_type_id`, `area_id`, `street_id`, `house_status_id`, `contact_person_id`, `contact_person_2_id`, `created_by_id`) VALUES
(1, 'B-07-01', '7', 'B', 900.00, '2022-07-20 02:05:18', '2022-07-20 02:05:18', NULL, 2, 2, 3, 1, 3, NULL, NULL);

--
-- Truncate table before insert `manage_house_parking_lot`
--

TRUNCATE TABLE `manage_house_parking_lot`;
--
-- Dumping data for table `manage_house_parking_lot`
--

INSERT INTO `manage_house_parking_lot` (`manage_house_id`, `parking_lot_id`) VALUES
(1, 1);

--
-- Truncate table before insert `manage_house_user`
--

TRUNCATE TABLE `manage_house_user`;
--
-- Dumping data for table `manage_house_user`
--

INSERT INTO `manage_house_user` (`manage_house_id`, `user_id`) VALUES
(1, 3);

--
-- Truncate table before insert `manage_prices`
--

TRUNCATE TABLE `manage_prices`;
--
-- Truncate table before insert `media`
--

TRUNCATE TABLE `media`;
--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\SupplierProposal', 1, 'b2faa294-7fef-4be2-aa0e-93c9ebd8305e', 'documents', '62d7d2f3cb4f3_JanV3S1C11BranchNoticeIndividualAccOpeningTCJCASATentCard', '62d7d2f3cb4f3_JanV3S1C11BranchNoticeIndividualAccOpeningTCJCASATentCard.pdf', 'application/pdf', 'public', 'public', 179837, '[]', '[]', '[]', '[]', 1, '2022-07-20 02:03:32', '2022-07-20 02:03:32');

--
-- Truncate table before insert `my_cases`
--

TRUNCATE TABLE `my_cases`;
--
-- Truncate table before insert `notes`
--

TRUNCATE TABLE `notes`;
--
-- Truncate table before insert `notices`
--

TRUNCATE TABLE `notices`;
--
-- Truncate table before insert `open_projects`
--

TRUNCATE TABLE `open_projects`;
--
-- Dumping data for table `open_projects`
--

INSERT INTO `open_projects` (`id`, `name`, `description`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Painting', '<p>Painting all houses</p>', '2022-07-20', '2023-07-20', 'OPENING', '2022-07-20 01:57:19', '2022-07-20 01:57:19', NULL, NULL);

--
-- Truncate table before insert `parking_lots`
--

TRUNCATE TABLE `parking_lots`;
--
-- Dumping data for table `parking_lots`
--

INSERT INTO `parking_lots` (`id`, `lot_no`, `floor`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'C01', 3, '2022-07-20 01:52:31', '2022-07-20 01:52:31', NULL, NULL);

--
-- Truncate table before insert `password_resets`
--

TRUNCATE TABLE `password_resets`;
--
-- Truncate table before insert `payment_charges`
--

TRUNCATE TABLE `payment_charges`;
--
-- Truncate table before insert `payment_charge_payment_plan`
--

TRUNCATE TABLE `payment_charge_payment_plan`;
--
-- Truncate table before insert `payment_histories`
--

TRUNCATE TABLE `payment_histories`;
--
-- Truncate table before insert `payment_items`
--

TRUNCATE TABLE `payment_items`;
--
-- Truncate table before insert `payment_item_payment_plan`
--

TRUNCATE TABLE `payment_item_payment_plan`;
--
-- Truncate table before insert `payment_plans`
--

TRUNCATE TABLE `payment_plans`;
--
-- Truncate table before insert `payment_types`
--

TRUNCATE TABLE `payment_types`;
--
-- Truncate table before insert `permissions`
--

TRUNCATE TABLE `permissions`;
--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(2, 'permission_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(3, 'permission_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(4, 'permission_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(5, 'permission_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(6, 'permission_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(7, 'role_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(8, 'role_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(9, 'role_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(10, 'role_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(11, 'role_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(12, 'user_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(13, 'user_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(14, 'user_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(15, 'user_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(16, 'user_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(17, 'audit_log_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(18, 'audit_log_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(19, 'area_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(20, 'area_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(21, 'area_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(22, 'area_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(23, 'area_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(24, 'manage_house_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(25, 'manage_house_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(26, 'manage_house_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(27, 'manage_house_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(28, 'manage_house_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(29, 'payment_type_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(30, 'payment_type_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(31, 'payment_type_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(32, 'payment_type_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(33, 'payment_type_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(34, 'parking_lot_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(35, 'parking_lot_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(36, 'parking_lot_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(37, 'parking_lot_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(38, 'parking_lot_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(39, 'notice_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(40, 'notice_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(41, 'notice_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(42, 'notice_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(43, 'notice_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(44, 'article_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(45, 'article_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(46, 'article_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(47, 'article_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(48, 'article_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(49, 'my_case_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(50, 'my_case_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(51, 'my_case_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(52, 'my_case_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(53, 'my_case_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(54, 'cases_category_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(55, 'cases_category_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(56, 'cases_category_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(57, 'cases_category_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(58, 'cases_category_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(59, 'maintanance_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(60, 'maintanance_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(61, 'maintanance_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(62, 'maintanance_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(63, 'maintanance_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(64, 'maintanance_type_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(65, 'maintanance_type_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(66, 'maintanance_type_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(67, 'maintanance_type_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(68, 'maintanance_type_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(69, 'asset_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(70, 'asset_category_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(71, 'asset_category_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(72, 'asset_category_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(73, 'asset_category_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(74, 'asset_category_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(75, 'asset_location_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(76, 'asset_location_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(77, 'asset_location_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(78, 'asset_location_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(79, 'asset_location_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(80, 'asset_status_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(81, 'asset_status_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(82, 'asset_status_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(83, 'asset_status_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(84, 'asset_status_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(85, 'asset_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(86, 'asset_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(87, 'asset_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(88, 'asset_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(89, 'asset_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(90, 'assets_history_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(91, 'payment_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(92, 'house_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(93, 'other_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(94, 'user_alert_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(95, 'user_alert_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(96, 'user_alert_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(97, 'user_alert_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(98, 'expense_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(99, 'expense_category_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(100, 'expense_category_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(101, 'expense_category_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(102, 'expense_category_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(103, 'expense_category_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(104, 'income_category_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(105, 'income_category_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(106, 'income_category_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(107, 'income_category_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(108, 'income_category_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(109, 'expense_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(110, 'expense_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(111, 'expense_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(112, 'expense_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(113, 'expense_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(114, 'income_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(115, 'income_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(116, 'income_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(117, 'income_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(118, 'income_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(119, 'expense_report_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(120, 'expense_report_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(121, 'expense_report_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(122, 'expense_report_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(123, 'expense_report_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(124, 'payment_history_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(125, 'complaint_system_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(126, 'complaint_system_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(127, 'complaint_system_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(128, 'complaint_system_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(129, 'complaint_system_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(130, 'task_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(131, 'task_status_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(132, 'task_status_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(133, 'task_status_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(134, 'task_status_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(135, 'task_status_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(136, 'task_tag_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(137, 'task_tag_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(138, 'task_tag_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(139, 'task_tag_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(140, 'task_tag_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(141, 'task_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(142, 'task_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(143, 'task_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(144, 'task_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(145, 'task_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(146, 'tasks_calendar_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(147, 'time_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(148, 'time_work_type_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(149, 'time_work_type_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(150, 'time_work_type_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(151, 'time_work_type_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(152, 'time_work_type_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(153, 'time_project_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(154, 'time_project_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(155, 'time_project_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(156, 'time_project_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(157, 'time_project_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(158, 'time_entry_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(159, 'time_entry_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(160, 'time_entry_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(161, 'time_entry_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(162, 'time_entry_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(163, 'time_report_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(164, 'time_report_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(165, 'time_report_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(166, 'time_report_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(167, 'time_report_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(168, 'client_management_setting_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(169, 'currency_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(170, 'currency_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(171, 'currency_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(172, 'currency_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(173, 'currency_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(174, 'transaction_type_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(175, 'transaction_type_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(176, 'transaction_type_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(177, 'transaction_type_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(178, 'transaction_type_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(179, 'income_source_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(180, 'income_source_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(181, 'income_source_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(182, 'income_source_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(183, 'income_source_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(184, 'client_status_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(185, 'client_status_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(186, 'client_status_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(187, 'client_status_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(188, 'client_status_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(189, 'project_status_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(190, 'project_status_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(191, 'project_status_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(192, 'project_status_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(193, 'project_status_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(194, 'client_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(195, 'client_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(196, 'client_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(197, 'client_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(198, 'client_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(199, 'client_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(200, 'project_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(201, 'project_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(202, 'project_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(203, 'project_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(204, 'project_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(205, 'note_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(206, 'note_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(207, 'note_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(208, 'note_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(209, 'note_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(210, 'document_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(211, 'document_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(212, 'document_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(213, 'document_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(214, 'document_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(215, 'transaction_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(216, 'transaction_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(217, 'transaction_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(218, 'client_report_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(219, 'client_report_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(220, 'client_report_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(221, 'client_report_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(222, 'client_report_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(223, 'content_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(224, 'content_category_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(225, 'content_category_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(226, 'content_category_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(227, 'content_category_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(228, 'content_category_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(229, 'content_tag_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(230, 'content_tag_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(231, 'content_tag_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(232, 'content_tag_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(233, 'content_tag_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(234, 'content_page_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(235, 'content_page_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(236, 'content_page_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(237, 'content_page_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(238, 'content_page_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(239, 'house_type_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(240, 'house_type_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(241, 'house_type_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(242, 'house_type_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(243, 'house_type_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(244, 'manage_price_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(245, 'manage_price_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(246, 'manage_price_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(247, 'manage_price_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(248, 'manage_price_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(249, 'user_detail_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(250, 'user_detail_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(251, 'user_detail_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(252, 'user_detail_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(253, 'user_detail_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(254, 'user_card_mgmt_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(255, 'user_card_mgmt_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(256, 'user_card_mgmt_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(257, 'user_card_mgmt_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(258, 'user_card_mgmt_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(259, 'street_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(260, 'street_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(261, 'street_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(262, 'street_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(263, 'street_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(264, 'payment_plan_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(265, 'payment_plan_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(266, 'payment_plan_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(267, 'payment_plan_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(268, 'payment_plan_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(269, 'transaction_management_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(270, 'setting_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(271, 'home_owner_transaction_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(272, 'payment_item_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(273, 'payment_item_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(274, 'payment_item_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(275, 'payment_item_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(276, 'payment_item_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(277, 'payment_charge_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(278, 'payment_charge_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(279, 'payment_charge_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(280, 'payment_charge_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(281, 'payment_charge_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(282, 'house_status_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(283, 'house_status_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(284, 'house_status_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(285, 'house_status_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(286, 'house_status_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(287, 'open_project_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(288, 'open_project_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(289, 'open_project_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(290, 'open_project_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(291, 'open_project_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(292, 'supplier_proposal_create', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(293, 'supplier_proposal_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(294, 'supplier_proposal_show', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(295, 'supplier_proposal_delete', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(296, 'supplier_proposal_access', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(297, 'profile_password_edit', '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL);

--
-- Truncate table before insert `permission_role`
--

TRUNCATE TABLE `permission_role`;
--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 163),
(1, 164),
(1, 165),
(1, 166),
(1, 167),
(1, 168),
(1, 169),
(1, 170),
(1, 171),
(1, 172),
(1, 173),
(1, 174),
(1, 175),
(1, 176),
(1, 177),
(1, 178),
(1, 179),
(1, 180),
(1, 181),
(1, 182),
(1, 183),
(1, 184),
(1, 185),
(1, 186),
(1, 187),
(1, 188),
(1, 189),
(1, 190),
(1, 191),
(1, 192),
(1, 193),
(1, 194),
(1, 195),
(1, 196),
(1, 197),
(1, 198),
(1, 199),
(1, 200),
(1, 201),
(1, 202),
(1, 203),
(1, 204),
(1, 205),
(1, 206),
(1, 207),
(1, 208),
(1, 209),
(1, 210),
(1, 211),
(1, 212),
(1, 213),
(1, 214),
(1, 215),
(1, 216),
(1, 217),
(1, 218),
(1, 219),
(1, 220),
(1, 221),
(1, 222),
(1, 223),
(1, 224),
(1, 225),
(1, 226),
(1, 227),
(1, 228),
(1, 229),
(1, 230),
(1, 231),
(1, 232),
(1, 233),
(1, 234),
(1, 235),
(1, 236),
(1, 237),
(1, 238),
(1, 239),
(1, 240),
(1, 241),
(1, 242),
(1, 243),
(1, 244),
(1, 245),
(1, 246),
(1, 247),
(1, 248),
(1, 249),
(1, 250),
(1, 251),
(1, 252),
(1, 253),
(1, 254),
(1, 255),
(1, 256),
(1, 257),
(1, 258),
(1, 259),
(1, 260),
(1, 261),
(1, 262),
(1, 263),
(1, 264),
(1, 265),
(1, 266),
(1, 267),
(1, 268),
(1, 269),
(1, 270),
(1, 271),
(1, 272),
(1, 273),
(1, 274),
(1, 275),
(1, 276),
(1, 277),
(1, 278),
(1, 279),
(1, 280),
(1, 281),
(1, 282),
(1, 283),
(1, 284),
(1, 285),
(1, 286),
(1, 287),
(1, 288),
(1, 289),
(1, 290),
(1, 291),
(1, 292),
(1, 293),
(1, 294),
(1, 295),
(1, 296),
(1, 297),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77),
(2, 78),
(2, 79),
(2, 80),
(2, 81),
(2, 82),
(2, 83),
(2, 84),
(2, 85),
(2, 86),
(2, 87),
(2, 88),
(2, 89),
(2, 90),
(2, 91),
(2, 92),
(2, 93),
(2, 98),
(2, 99),
(2, 100),
(2, 101),
(2, 102),
(2, 103),
(2, 104),
(2, 105),
(2, 106),
(2, 107),
(2, 108),
(2, 109),
(2, 110),
(2, 111),
(2, 112),
(2, 113),
(2, 114),
(2, 115),
(2, 116),
(2, 117),
(2, 118),
(2, 119),
(2, 120),
(2, 121),
(2, 122),
(2, 123),
(2, 124),
(2, 125),
(2, 126),
(2, 127),
(2, 128),
(2, 129),
(2, 130),
(2, 131),
(2, 132),
(2, 133),
(2, 134),
(2, 135),
(2, 136),
(2, 137),
(2, 138),
(2, 139),
(2, 140),
(2, 141),
(2, 142),
(2, 143),
(2, 144),
(2, 145),
(2, 146),
(2, 147),
(2, 148),
(2, 149),
(2, 150),
(2, 151),
(2, 152),
(2, 153),
(2, 154),
(2, 155),
(2, 156),
(2, 157),
(2, 158),
(2, 159),
(2, 160),
(2, 161),
(2, 162),
(2, 163),
(2, 164),
(2, 165),
(2, 166),
(2, 167),
(2, 168),
(2, 169),
(2, 170),
(2, 171),
(2, 172),
(2, 173),
(2, 174),
(2, 175),
(2, 176),
(2, 177),
(2, 178),
(2, 179),
(2, 180),
(2, 181),
(2, 182),
(2, 183),
(2, 184),
(2, 185),
(2, 186),
(2, 187),
(2, 188),
(2, 189),
(2, 190),
(2, 191),
(2, 192),
(2, 193),
(2, 194),
(2, 195),
(2, 196),
(2, 197),
(2, 198),
(2, 199),
(2, 200),
(2, 201),
(2, 202),
(2, 203),
(2, 204),
(2, 205),
(2, 206),
(2, 207),
(2, 208),
(2, 209),
(2, 210),
(2, 211),
(2, 212),
(2, 213),
(2, 214),
(2, 215),
(2, 216),
(2, 217),
(2, 218),
(2, 219),
(2, 220),
(2, 221),
(2, 222),
(2, 223),
(2, 224),
(2, 225),
(2, 226),
(2, 227),
(2, 228),
(2, 229),
(2, 230),
(2, 231),
(2, 232),
(2, 233),
(2, 234),
(2, 235),
(2, 236),
(2, 237),
(2, 238),
(2, 239),
(2, 240),
(2, 241),
(2, 242),
(2, 243),
(2, 244),
(2, 245),
(2, 246),
(2, 247),
(2, 248),
(2, 259),
(2, 260),
(2, 261),
(2, 262),
(2, 263),
(2, 264),
(2, 265),
(2, 266),
(2, 267),
(2, 268),
(2, 269),
(2, 270),
(2, 271),
(2, 272),
(2, 273),
(2, 274),
(2, 275),
(2, 276),
(2, 277),
(2, 278),
(2, 279),
(2, 280),
(2, 281),
(2, 282),
(2, 283),
(2, 284),
(2, 285),
(2, 286),
(2, 287),
(2, 288),
(2, 289),
(2, 290),
(2, 291),
(2, 292),
(2, 293),
(2, 294),
(2, 295),
(2, 296),
(2, 297),
(3, 95),
(3, 130),
(3, 131),
(3, 132),
(3, 133),
(3, 134),
(3, 135),
(3, 136),
(3, 137),
(3, 138),
(3, 139),
(3, 140),
(3, 141),
(3, 142),
(3, 143),
(3, 144),
(3, 145),
(3, 146),
(3, 168),
(3, 169),
(3, 170),
(3, 171),
(3, 172),
(3, 173),
(3, 174),
(3, 175),
(3, 176),
(3, 177),
(3, 178),
(3, 179),
(3, 180),
(3, 181),
(3, 182),
(3, 183),
(3, 184),
(3, 185),
(3, 186),
(3, 187),
(3, 188),
(3, 189),
(3, 190),
(3, 191),
(3, 192),
(3, 193),
(3, 194),
(3, 195),
(3, 196),
(3, 197),
(3, 198),
(3, 199),
(3, 200),
(3, 201),
(3, 202),
(3, 203),
(3, 204),
(3, 205),
(3, 206),
(3, 207),
(3, 208),
(3, 209),
(3, 210),
(3, 211),
(3, 212),
(3, 213),
(3, 214),
(3, 215),
(3, 216),
(3, 217),
(3, 218),
(3, 219),
(3, 220),
(3, 221),
(3, 222),
(3, 287),
(3, 288),
(3, 289),
(3, 290),
(3, 291),
(3, 292),
(3, 293),
(3, 294),
(3, 295),
(3, 296),
(3, 297),
(4, 297);

--
-- Truncate table before insert `personal_access_tokens`
--

TRUNCATE TABLE `personal_access_tokens`;
--
-- Truncate table before insert `projects`
--

TRUNCATE TABLE `projects`;
--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `start_date`, `created_at`, `updated_at`, `deleted_at`, `status_id`, `created_by_id`) VALUES
(1, 'Cut Grass', '<p>Cut Grass</p>', '2022-07-20', '2022-07-20 02:03:11', '2022-07-20 02:03:11', NULL, 1, NULL);

--
-- Truncate table before insert `project_statuses`
--

TRUNCATE TABLE `project_statuses`;
--
-- Dumping data for table `project_statuses`
--

INSERT INTO `project_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Running', '2022-07-20 01:55:36', '2022-07-20 01:55:36', NULL, NULL),
(2, 'Closed', '2022-07-20 01:55:42', '2022-07-20 01:55:42', NULL, NULL),
(3, 'Paused', '2022-07-20 01:55:49', '2022-07-20 01:55:49', NULL, NULL),
(4, 'Pending', '2022-07-20 01:55:58', '2022-07-20 01:55:58', NULL, NULL);

--
-- Truncate table before insert `qa_messages`
--

TRUNCATE TABLE `qa_messages`;
--
-- Truncate table before insert `qa_topics`
--

TRUNCATE TABLE `qa_topics`;
--
-- Truncate table before insert `roles`
--

TRUNCATE TABLE `roles`;
--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `redirect_to`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(2, 'User', NULL, '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(3, 'Supplier Manager', NULL, '2022-07-20 00:47:00', '2022-07-20 00:47:00', NULL),
(4, 'Home Owner', '/home', '2022-07-20 01:54:22', '2022-07-20 01:54:22', NULL);

--
-- Truncate table before insert `role_user`
--

TRUNCATE TABLE `role_user`;
--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(3, 4);

--
-- Truncate table before insert `streets`
--

TRUNCATE TABLE `streets`;
--
-- Dumping data for table `streets`
--

INSERT INTO `streets` (`id`, `street_name`, `created_at`, `updated_at`, `deleted_at`, `area_id`, `created_by_id`) VALUES
(1, 'Jalan Eko Flora 1', '2022-07-20 01:51:25', '2022-07-20 01:51:25', NULL, 1, NULL),
(2, 'Jalan Eko Flora 2', '2022-07-20 01:51:39', '2022-07-20 01:51:39', NULL, 1, NULL),
(3, 'Jalan Austin Perdana 1', '2022-07-20 01:52:01', '2022-07-20 01:52:01', NULL, 2, NULL),
(4, 'Jalan Austin Perdana 2', '2022-07-20 01:52:26', '2022-07-20 01:52:26', NULL, 2, NULL);

--
-- Truncate table before insert `supplier_proposals`
--

TRUNCATE TABLE `supplier_proposals`;
--
-- Dumping data for table `supplier_proposals`
--

INSERT INTO `supplier_proposals` (`id`, `representative_name`, `contact_no`, `created_at`, `updated_at`, `deleted_at`, `open_project_id`, `created_by_id`) VALUES
(1, 'Ah John', '012 345 4456', '2022-07-20 02:03:32', '2022-07-20 02:03:32', NULL, 1, NULL);

--
-- Truncate table before insert `tasks`
--

TRUNCATE TABLE `tasks`;
--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `due_date`, `created_at`, `updated_at`, `deleted_at`, `status_id`, `assigned_to_id`, `created_by_id`) VALUES
(1, 'Cut Grass', NULL, '2022-07-20', '2022-07-20 01:56:33', '2022-07-20 01:56:33', NULL, 2, 2, NULL);

--
-- Truncate table before insert `task_statuses`
--

TRUNCATE TABLE `task_statuses`;
--
-- Dumping data for table `task_statuses`
--

INSERT INTO `task_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Open', NULL, NULL, NULL, NULL),
(2, 'In progress', NULL, NULL, NULL, NULL),
(3, 'Closed', NULL, NULL, NULL, NULL);

--
-- Truncate table before insert `task_tags`
--

TRUNCATE TABLE `task_tags`;
--
-- Truncate table before insert `task_task_tag`
--

TRUNCATE TABLE `task_task_tag`;
--
-- Truncate table before insert `time_entries`
--

TRUNCATE TABLE `time_entries`;
--
-- Truncate table before insert `time_projects`
--

TRUNCATE TABLE `time_projects`;
--
-- Truncate table before insert `time_work_types`
--

TRUNCATE TABLE `time_work_types`;
--
-- Truncate table before insert `transactions`
--

TRUNCATE TABLE `transactions`;
--
-- Truncate table before insert `transaction_types`
--

TRUNCATE TABLE `transaction_types`;
--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `created_by_id`) VALUES
(1, 'Project Monthly Payment', '2022-07-20 01:06:24', '2022-07-20 01:06:24', NULL, NULL);

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phone_no`, `email`, `two_factor`, `approved`, `verified`, `verified_at`, `verification_token`, `email_verified_at`, `two_factor_code`, `password`, `remember_token`, `two_factor_expires_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '', '', 'admin@admin.com', 0, 1, 1, '2022-07-08 03:24:29', '', NULL, '', '$2y$10$qdFTPRsrabuO2RQak8ioIeXozjFlPnvcwu76D49THqw25Gtiy4Eq2', NULL, NULL, '2022-07-20 00:47:01', '2022-07-20 00:47:01', NULL),
(2, 'Supplier Manager', '', '', 'supplier@demo.com', 0, 1, 1, '2022-07-08 03:24:29', '', NULL, '', '$2y$10$TNBUjFcA9orntRp842IoPuGrr0l/xwCB.hA/UKakwx1fPlYS.LDeG', NULL, NULL, '2022-07-20 00:47:01', '2022-07-20 00:47:01', NULL),
(3, 'Jason Tam', 'jason_tam', '019-783 9976', 'jason@marslab.com.my', 0, 1, 1, '2022-07-20 09:54:53', NULL, NULL, NULL, '$2y$10$r7vZPBjTDyVPAsk5MCLJrO/u9Uj65/09mn.Wr9Mz4Zj2/hX.syLPO', NULL, NULL, '2022-07-20 01:54:53', '2022-07-20 01:54:53', NULL);

--
-- Truncate table before insert `user_alerts`
--

TRUNCATE TABLE `user_alerts`;
--
-- Truncate table before insert `user_card_mgmts`
--

TRUNCATE TABLE `user_card_mgmts`;
--
-- Truncate table before insert `user_details`
--

TRUNCATE TABLE `user_details`;
--
-- Truncate table before insert `user_user_alert`
--

TRUNCATE TABLE `user_user_alert`;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
