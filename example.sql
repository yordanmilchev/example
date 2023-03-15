-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2023 at 06:13 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `image`, `icon`, `weight`, `created_at`, `updated_at`) VALUES
(1, 'otoplenie.png', 'heat.svg', 1, '2023-02-28 08:44:36', '2023-03-06 11:15:37'),
(2, 'ventilacia.png', 'fans.svg', 2, '2023-02-28 08:48:14', '2023-03-06 14:04:35'),
(3, 'Klimatizacia.png', 'aircon.svg', 3, '2023-02-28 08:49:25', '2023-03-06 11:18:54'),
(4, 'ViK.png', 'plumbing.svg', 4, '2023-02-28 08:50:31', '2023-03-06 11:20:19'),
(5, 'sprinkler systems.png', 'sprinklers.svg', 5, '2023-02-28 08:51:31', '2023-03-06 11:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `activity_translations`
--

CREATE TABLE `activity_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_translations`
--

INSERT INTO `activity_translations` (`id`, `activity_id`, `locale`, `title`, `slug`, `excerpt`, `description`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'bg', 'Отопление', 'otoplenie', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur egestas vestibulum lorem, nec feugiat magna accumsan nec. Vestibulum sit amet vulputate odio, accumsan ornare dui. Sed eu imperdiet augue. Praesent sem enim, tristique at rutrum non, viverra sit amet massa. Nullam suscipit et libero in molestie. Nam finibus erat non tellus mattis, quis auctor urna commodo. Cras vel maximus arcu. Integer sed scelerisque odio. Etiam sodales, nulla in imperdiet congue, nunc turpis faucibus felis, et lacinia urna velit at lacus. Aenean eget libero malesuada, aliquet ante a, condimentum urna.</p>', 1, '2023-02-28 08:44:36', '2023-03-06 11:22:33'),
(2, 2, 'bg', 'Вентилация', 'ventilaciya', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur egestas vestibulum lorem, nec feugiat magna accumsan nec. Vestibulum sit amet vulputate odio, accumsan ornare dui. Sed eu imperdiet augue. Praesent sem enim, tristique at rutrum non, viverra sit amet massa. Nullam suscipit et libero in molestie. Nam finibus erat non tellus mattis, quis auctor urna commodo. Cras vel maximus arcu. Integer sed scelerisque odio. Etiam sodales, nulla in imperdiet congue, nunc turpis faucibus felis, et lacinia urna velit at lacus. Aenean eget libero malesuada, aliquet ante a, condimentum urna.</p>', 1, '2023-02-28 08:48:14', '2023-03-06 11:22:44'),
(3, 3, 'bg', 'Климатизация', 'klimatizaciya', '<p>Lorem ipsum dolor sit amet, consectetur adipisc...</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisc...</p>', 1, '2023-02-28 08:49:25', '2023-03-06 11:22:56'),
(4, 4, 'bg', 'Вик', 'vik', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur egestas vestibulum lorem, nec feugiat magna accumsan nec. Vestibulum sit amet vulputate odio, accumsan ornare dui. Sed eu imperdiet augue. Praesent sem enim, tristique at rutrum non, viverra sit amet massa. Nullam suscipit et libero in molestie. Nam finibus erat non tellus mattis, quis auctor urna commodo. Cras vel maximus arcu. Integer sed scelerisque odio. Etiam sodales, nulla in imperdiet congue, nunc turpis faucibus felis, et lacinia urna velit at lacus. Aenean eget libero malesuada, aliquet ante a, condimentum urna.</p>', 1, '2023-02-28 08:50:31', '2023-02-28 08:50:31'),
(5, 5, 'bg', 'Спринклерни системи', 'splinkterni-sistemi', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur egestas vestibulum lorem, nec feugiat magna accumsan nec. Vestibulum sit amet vulputate odio, accumsan ornare dui. Sed eu imperdiet augue. Praesent sem enim, tristique at rutrum non, viverra sit amet massa. Nullam suscipit et libero in molestie. Nam finibus erat non tellus mattis, quis auctor urna commodo. Cras vel maximus arcu. Integer sed scelerisque odio. Etiam sodales, nulla in imperdiet congue, nunc turpis faucibus felis, et lacinia urna velit at lacus. Aenean eget libero malesuada, aliquet ante a, condimentum urna.</p>', 1, '2023-02-28 08:51:31', '2023-02-28 09:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `blog_articles`
--

CREATE TABLE `blog_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_article_categories`
--

CREATE TABLE `blog_article_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_article_category`
--

CREATE TABLE `blog_article_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_article_category_id` bigint(20) UNSIGNED NOT NULL,
  `blog_article_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_article_category_translations`
--

CREATE TABLE `blog_article_category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_article_category_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_article_edit_logs`
--

CREATE TABLE `blog_article_edit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_article_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_article_translations`
--

CREATE TABLE `blog_article_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_article_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_village` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `population` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lat_name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat_municipality` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat_district` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiries`
--

CREATE TABLE `contact_inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inquiry` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dossiers`
--

CREATE TABLE `dossiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_image_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_image_category_id`, `name`, `title`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, '385x290-1_1677232029.png', NULL, 1, '2023-02-24 09:47:09', '2023-02-24 09:47:58'),
(2, 1, '385x290-2_1677232034.png', NULL, 2, '2023-02-24 09:47:14', '2023-02-24 09:47:58'),
(3, 1, '385x290-3_1677232038.png', NULL, 3, '2023-02-24 09:47:18', '2023-02-24 09:47:58'),
(4, 1, '385x290-4_1677232047.png', NULL, 4, '2023-02-24 09:47:27', '2023-02-24 09:47:58'),
(5, 1, '500x365-1_1677232053.png', NULL, 5, '2023-02-24 09:47:33', '2023-02-24 09:47:58'),
(6, 1, '500x365-2_1677232058.png', NULL, 6, '2023-02-24 09:47:38', '2023-02-24 09:47:58'),
(7, 1, '500x365-3_1677232065.png', NULL, 7, '2023-02-24 09:47:45', '2023-02-24 09:47:58'),
(8, 1, '800x400_1677232075.png', NULL, 8, '2023-02-24 09:47:55', '2023-02-24 09:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_image_categories`
--

CREATE TABLE `gallery_image_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `weight` smallint(6) NOT NULL DEFAULT '0',
  `icon_class` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_image_categories`
--

INSERT INTO `gallery_image_categories` (`id`, `parent_id`, `weight`, `icon_class`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, '2023-02-24 09:47:58', '2023-02-24 09:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_image_category_translations`
--

CREATE TABLE `gallery_image_category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_image_category_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_image_category_translations`
--

INSERT INTO `gallery_image_category_translations` (`id`, `gallery_image_category_id`, `locale`, `title`, `slug`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'bg', 'Example gallery', 'example-gallery', 1, '2023-02-24 09:47:58', '2023-02-24 09:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layout_blocks`
--

CREATE TABLE `layout_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'LayoutRegionConstant class values',
  `static_content` text COLLATE utf8mb4_unicode_ci,
  `dynamic_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'DynamicLayoutBlockConstant class values. Override static_content value.',
  `weight` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Block with weight 1 is shown before 5',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `locale` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_filter_operator` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_filter_values` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ltm_translations`
--

CREATE TABLE `ltm_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `key` text COLLATE utf8mb4_bin NOT NULL,
  `value` text COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_04_02_193005_create_translations_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_02_10_151958_create__a_c_l_tables', 1),
(7, '2022_02_11_153440_create_user_activities_table', 1),
(8, '2022_02_15_091033_create_product_categories_table', 1),
(9, '2022_02_15_114255_create_product_category_translations_table', 1),
(10, '2022_02_15_143819_create_settings_table', 1),
(11, '2022_02_16_075535_create_favorite_products_table', 1),
(12, '2022_02_17_103924_create_products_table', 1),
(13, '2022_02_17_131510_create_product_translations_table', 1),
(14, '2022_02_17_150941_create_product_category_product_table', 1),
(15, '2022_02_17_151505_create_product_files_table', 1),
(16, '2022_02_22_085818_create_setting_translations_table', 1),
(17, '2022_02_22_133027_create_attributes_table', 1),
(18, '2022_02_23_084035_create_attribute_translations_table', 1),
(19, '2022_02_23_091039_create_attribute_choices_table', 1),
(20, '2022_02_23_093027_create_attribute_choice_translations_table', 1),
(21, '2022_02_23_123117_create_product_attribute_choices_table', 1),
(22, '2022_02_23_151916_create_pages_table', 1),
(23, '2022_02_24_080241_create_page_translations_table', 1),
(24, '2022_02_24_090346_create_route_keys_table', 1),
(25, '2022_02_25_131352_create_orders_table', 1),
(26, '2022_02_25_131548_create_order_products_table', 1),
(27, '2022_02_25_132030_create_order_services_table', 1),
(28, '2022_02_25_132917_create_carts_table', 1),
(29, '2022_02_25_133145_create_cart_products_table', 1),
(30, '2022_03_04_152853_create_dossiers_table', 1),
(31, '2022_03_04_153400_update_users_table_with_dossier_id', 1),
(32, '2022_03_06_123923_create_order_comments_table', 1),
(33, '2022_03_07_073213_create_cities_table', 1),
(34, '2022_03_09_114200_create_layout_blocks_table', 1),
(35, '2022_03_11_071415_create_product_stocks_table', 1),
(36, '2022_03_15_091232_create_product_category_attributes', 1),
(37, '2022_03_25_130026_create_stores_table', 1),
(38, '2022_03_25_131630_create_store_translations_table', 1),
(39, '2022_04_11_114658_create_blog_articles_table', 1),
(40, '2022_04_11_114805_create_blog_article_translations_table', 1),
(41, '2022_04_12_140516_create_blog_article_categories_table', 1),
(42, '2022_04_12_140527_create_blog_article_category_translations_table', 1),
(43, '2022_04_13_061342_create_blog_article_category', 1),
(44, '2022_04_26_075215_create_url_metas_table', 1),
(45, '2022_04_27_135332_create_product_edit_logs_table', 1),
(46, '2022_07_14_134812_create_product_models_table', 1),
(47, '2022_07_14_142244_create_product_model_translations_table', 1),
(48, '2022_07_28_133859_create_contact_inquiries_table', 1),
(49, '2022_08_03_081052_create_blog_article_edit_logs_table', 1),
(50, '2022_08_19_083945_create_gallery_image_categories_table', 1),
(51, '2022_08_19_084058_create_gallery_image_category_translations_table', 1),
(52, '2022_08_19_084529_create_gallery_images_table', 1),
(53, '2022_08_22_085310_create_speedy_shipments_table', 1),
(54, '2022_08_22_112251_create_speedy_shipment_parcels_table', 1),
(55, '2022_08_22_133523_create_order_feedback_table', 1),
(56, '2022_08_26_074219_create_order_product_feedback_table', 1),
(57, '2022_08_29_101240_create_order_product_feedback_files', 1),
(58, '2022_08_31_080537_create_neighbourhoods_table', 1),
(59, '2022_09_21_100507_create_user_addresses_table', 1),
(60, '2022_09_23_081223_create_order_additional_infos_table', 1),
(61, '2022_09_26_132212_create_my_pos_responses_table', 1),
(62, '2022_09_30_140619_create_payment_responses_table', 1),
(63, '2022_10_17_131312_create_jobs_table', 1),
(64, '2023_02_24_151541_create_services_table', 2),
(65, '2023_02_24_151715_create_service_translations_table', 2),
(68, '2023_02_28_101300_create_activities_table', 3),
(69, '2023_02_28_101346_create_activity_translations_table', 3),
(71, '2023_02_28_113125_create_sliders_table', 4),
(72, '2023_03_02_121240_create_partners_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `my_pos_responses`
--

CREATE TABLE `my_pos_responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `ipc_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_datetime` datetime DEFAULT NULL,
  `transaction_datetime` datetime DEFAULT NULL,
  `card_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipc_trnref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_stan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'view.pages',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=disabled; 1=enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `route_key`, `template`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 'general_terms', 'default', 1, '2023-03-02 12:07:07', '2023-03-02 12:08:02'),
(2, 'cookies', 'default', 1, '2023-03-02 12:11:24', '2023-03-02 12:11:49'),
(3, 'personal_data', 'default', 1, '2023-03-02 12:14:46', '2023-03-02 12:15:10'),
(4, 'about_us', 'default', 1, '2023-03-02 16:17:32', '2023-03-02 16:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `locale`, `slug`, `title`, `content`) VALUES
(1, 1, 'bg', 'obshhi-usloviya', 'Общи условия', '<div class=\"section section-terms bg-dark\">\r\n<div class=\"section-terms-inner\">\r\n<div class=\"container p-4 bg-white\">\r\n<div class=\"section-head mb-2 text-center\">\r\n<h1 class=\"section-title\">Общи условия</h1>\r\n</div>\r\n<p>Настоящият документ съдържа Общите условия на договора за ползване на предоставяните от &bdquo;МАЛЕВ ИНЖЕНЕРИНГ ВТ &rdquo; ООД услуги посредством уебсайт <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a> (&bdquo;Общите условия&rdquo;) и урежда отношенията между &bdquo;МАЛЕВ ИНЖЕНЕРИНГ ВТ &rdquo; ООД и всеки един от потребителите на уебсайта <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>.</p>\r\n<p><strong>І. ДЕФИНИЦИИ </strong></p>\r\n<p>При тълкуването и прилагането на настоящите Общи условия използваните термини и изрази ще имат следното значение:</p>\r\n<p>1.1. &bdquo;IP Адрес&rdquo; (&bdquo;IP address&rdquo;) е уникален идентификационен номер, асоцииращ устройство, Интернет страница или ресурс на потребителя, по начин, който позволява локализирането им в глобалната Интернет мрежа.</p>\r\n<p>1.2. &bdquo;МАЛЕВ ИНЖЕНЕРИНГ ВТ &rdquo; ООД, е търговско дружество с ЕИК: 202515232 , със седалище и адрес на управление и кореспонденция: гр. Велико Търново, ул.ПОЛТАВА, 3, вх. Ж, e-mail: <a href=\"mailto:gercho@malev-bg.com\">gercho@malev-bg.com</a>, което предоставя услугите, предмет на настоящите Общи условия, посредством администрираният от него сайт: <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>.</p>\r\n<p>1.3. &bdquo;Електронна препратка&rdquo; е връзка, обозначена в определена Интернет страница, която позволява автоматизирано препращане към друга Интернет страница, информационен ресурс или обект чрез стандартизирани протоколи.</p>\r\n<p>1.4. &bdquo;Злоумишлени действия&rdquo; са действия или бездействия, нарушаващи Интернет етиката или нанасящи вреди на лица, свързани към Интернет или асоциирани мрежи, включително, но не само изпращане на нежелана поща (SPAM, JUNK MAIL), препълване на каналите (FLOOD), получаване на достъп до ресурси с чужди права и пароли, използуване на недостатъци в системите с цел собствена облага или добиване на информация (HACK), извършване на действия, които могат да бъдат квалифицирани като промишлен шпионаж или саботаж, повреждане или разрушаване на системи или информационни масиви (CRACK), изпращане на &bdquo;троянски коне&rdquo; или предизвикване инсталация на вируси или системи за отдалечен контрол, смущаване нормалната работа на останалите потребители на Интернет и асоциираните мрежи, както и извършване на каквито и да било действия, които могат да се квалифицират като престъпление или административно нарушение по българското законодателство или по друго приложимо право.</p>\r\n<p>1.5. &bdquo;Интернет страница&rdquo; е част от уебсайт, която може да е съставна или обособена.</p>\r\n<p>1.6. &bdquo;Информационна система&rdquo; е устройство или система от свързани устройства, което или някое от които е предназначено да съхранява, изпраща или получава електронни документи.</p>\r\n<p>1.7. &bdquo;ПОТРЕБИТЕЛ&rdquo; е всяко лице с навършени 18 години, което ползва предоставяните уебсайта <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a> услуги и ресурси.</p>\r\n<p>1.8. &bdquo;Сървър&rdquo; е устройство или система от свързани устройства, на което или на някое от които е инсталиран системен софтуер за изпълняване на задачи във връзка със съхраняване, обработка, приемане или предаване на информация.</p>\r\n<p>1.9. &bdquo;Уебсайт&rdquo; е обособеното място в глобалната Интернет мрежа, достъпно чрез своя унифициран адрес (URL) по протокол HTTP или HTTPS и съдържащо файлове, програми, текст, звук, картина, изображение, електронни препратки или други материали и ресурси.</p>\r\n<p>1.10. &bdquo;Търговски съобщения&rdquo; са рекламни или други съобщения, представящи пряко или косвено стоките, услугите или репутацията на лице, извършващо търговска или занаятчийска дейност или упражняващо регулирана професия.</p>\r\n<p><strong>ІІ. ПРИЛОЖНО ПОЛЕ. СЪГЛАСИЕ С ОБЩИТЕ УСЛОВИЯ </strong></p>\r\n<p>2.1. Настоящите Общи условия се прилагат в отношенията с ПОТРЕБИТЕЛИТЕ, използващи Уебсайта <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a></p>\r\n<p>2.2. Текстът на настоящите Общи условия е достъпен в Интернет на интернет страница с адрес <a href=\"#\">http://</a> по начин, който позволява неговото съхраняване и възпроизвеждане. Електронна препратка към Интернет страницата, съдържаща текста на настоящите Общи условия, е разположена на всяка страница от Уебсайта <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>. С всяко ползване на услугите и ресурси на Уебсайта <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>, включително с отварянето на Интернет страница от Уебсайта <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>, както и чрез натискане на електронна препратка от заглавната (началната) или която и да е друга Интернет страница на Уебсайта <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>, ПОТРЕБИТЕЛИТЕ декларират, че са запознати с настоящите Общи условия, съгласяват се с тях и се задължават да ги спазват.</p>\r\n<p><strong>ІІІ. ПРОМЕНИ В ОБЩИТЕ УСЛОВИЯ </strong></p>\r\n<p>3.1. С оглед периодичното допълване и модификации на Услугите, тяхното усъвършенстване и разширяване, както и във връзка с възможни законодателни промени, които рефлектират върху тях, Общите условия могат да бъдат променяни едностранно от Кинди. Тази промяна може да се извършва и при изменение на вида, естеството или технологията на предоставяните Услуги, при прекратяване предоставянето на определени Услуги, както и при изменение в икономическите условия.</p>\r\n<p><strong>ІV. ПРАВА И ЗАДЪЛЖЕНИЯ НА ПОТРЕБИТЕЛЯ </strong></p>\r\n<p>4.1. ПОТРЕБИТЕЛЯТ сам осигурява необходимото му за ползването на предоставяните от Кинди услуги клиентско оборудване (крайни устройства за достъп до Интернет и съответни софтуерни приложения) и достъп до Интернет.</p>\r\n<p>4.2. ПОТРЕБИТЕЛЯТ се задължава при ползване на предоставяните от МАЛЕВ ИНЖЕНЕРИНГ ВТ услуги:</p>\r\n<p>а. да не извършва злоумишлени действия по смисъла на настоящите Общи условия;</p>\r\n<p>б. да уведомява незабавно Кинди за всеки случай на извършено или открито нарушение при използване на предоставяните услуги;</p>\r\n<p>в. да не използува методи, водещи до принудително зареждане на нежелано от Интернет-потребителите съдържание (\"pop-up\", \"blind link\" и други подобни).</p>\r\n<p>г. ПОТРЕБИТЕЛЯТ има право по всяко време по своя собствена преценка да прекрати използването на предоставяните от Кинди Услуги, като дезактивира предоставянето им съответно преустанови използването на уебсайта</p>\r\n<p>Настоящите Общи условия са приети с решение на МАЛЕВ ИНЖЕНЕРИНГ ВТ ООД от 01.03.2023 г. и влизат в сила от 01.03.2023 г.</p>\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n<!-- /.section-terms-inner --></div>\r\n<!-- /.section section-terms -->\r\n<p>&nbsp;</p>'),
(2, 2, 'bg', 'biskvitki', 'Бисквитки', '<div class=\"section section-terms bg-dark\">\r\n<div class=\"section-terms-inner\">\r\n<div class=\"container bg-white\">\r\n<div class=\"section-head pt-3 text-center\">\r\n<h1 class=\"section-title\"><strong>Бисквитки</strong></h1>\r\n</div>\r\n<!-- /.section-head  text-center -->\r\n<div class=\"section-body px-3 pb-4\">\r\n<p>Тази политика се отнася до \"бисквитките\", използвани, според случая, в уеб сайт <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>, собственост на &bdquo;МАЛЕВ ИНЖЕНЕРИНГ ВТ&rdquo; ООД със седалище и адрес на управление в гр. Велико Търново, ул.ПОЛТАВА, 3, вх. Ж.</p>\r\n<p><strong>1. Бисквитките се използват за следните цели:</strong></p>\r\n<p>- за функционирането на сайта,</p>\r\n<p>- за анализ на поведението на посетителите на сайта,</p>\r\n<p>- за реклама.</p>\r\n<p><strong>2. Какво представляват бисквитките?</strong></p>\r\n<p>\"Бисквитката\" са малки текстови файлове, състоящи се от букви и цифри, които ще бъдат запазвани на Вашия компютър, мобилен телефон или друго терминално оборудване на потребителя, през което той осъществява достъп до интернет. Бисквитката се инсталира чрез искане, подадено от терминала на потребителя към сървъра на \"МАЛЕВ ИНЖЕНЕРИНГ ВТ\" ООД .</p>\r\n<p><strong>3. За какво се използват бисквитките?</strong></p>\r\n<p>Тези файлове правят възможно, като цяло, разпознаването на терминала на потребителя и представянето на съдържанието по начин, който е от значение, адаптирано към предпочитанията на потребителя. Бисквитките гарантират, че потребителите ще си прекарат добре и подпомагат усилията на &bdquo;МАЛЕВ ИНЖЕНЕРИНГ ВТ&rdquo; ООД да предоставя услуги, които са възможно най-добре пригодени към потребители, например относно предпочитанията за онлайн поверителност, кошницата с покупки или подходящи реклами. Също така, те се използват при подготовката на анонимни обобщени статистически данни, които ни помагат да разберем как потребителите се възползват от нашите интернет страници, което ни позволява да подобрим структурата и съдържанието, без да идентифицираме всеки отделен потребител.</p>\r\n<p><strong>4. Как се използват бисквитките от този сайт?</strong></p>\r\n<p>Посещение на този сайт може да оставят следните типове бисквитки:</p>\r\n<p>- Бисквитките са строго необходими за работата на сайта</p>\r\n<p>- Бисквитки за анализ;</p>\r\n<p>- Бисквитки за реклама;</p>\r\n<p>Бисквитките и/или другите са от съществено значение за правилното функциониране на сайта, бидейки зададени на Вашето устройство при влизането в уеб сайта или в резултат на действия, извършвани в сайта, според случая. Можете да настроите браузъра си да блокира \"бисквитките\", но в този случай, някои раздели на сайта няма да работят правилно.</p>\r\n<p><strong>5. Съдържат ли бисквитките или подобните технологии лични данни?</strong></p>\r\n<p>Бисквитките или другите подобни технологии, сами по себе си, не изискват лична информация, за да се използва и в много случаи, дори не идентифицират личността на интернет потребителите. Има обаче ситуации, когато личните данни могат да бъдат събирани чрез използването на бисквитки за улесняване на някои функции на потребителя или да предоставят на потребителя усещане, което е пригодено да неговите предпочитания. Тези данни са шифровани по начин, който прави невъзможен неоторизирания достъп до тях.</p>\r\n<p><strong>6. Блокирането на бисквитки</strong></p>\r\n<p>Ако искате да блокирате бисквитките, някои функции на сайта ще бъдат спрени, а това може да създаде някои неизправности или грешки при използването на нашия сайт. Например, блокирането на бисквитките може да Ви попречи да:</p>\r\n<p>- купувате онлайн</p>\r\n<p>- да се идентифицирате при влизане във Вашия профил</p>\r\n<p>- Повечето браузъри са настроени по подразбиране да приемат \"бисквитки\", но можете да промените Вашите настройки за блокиране на някои или всички бисквитки.</p>\r\n<p><strong>7. Управлението на преференции за разполагането на бисквитки</strong></p>\r\n<p>По принцип, едно приложение, използвано за достъп до уеб страници позволява съхраняването на бисквитки по подразбиране. Тези настройки могат да бъдат променени по такъв начин, че автоматичното управление на бисквитките да бъде блокирано от Вашия уеб браузър или потребителят трябва да бъде информиран, когато бисквитките бъдат изпратени до терминала. Подробна информация за възможностите и начините на управление на бисквитките могат да бъдат намерени в зоната на настройките на приложението (уеб браузъра). Ограничаването на използването на бисквитки може да засегне някои от функционалностите на сайта</p>\r\n<p><strong> 8. Защо бисквитките са важни за Интернет?</strong></p>\r\n<p>Бисквитките заемат централно място за ефективното функциониране на интернет, подпомагайки да се създаде едно приятелско насочено усещане и престой, който да е адаптиран към интересите и предпочитанията на всеки потребител. Отказът или Деактивирането на бисквитки може да направи някои сайтове или части от сайтове да не могат да бъдат използвани. Деактивирането на бисквитките не означава, че вече няма да получавате, съгласно законодателство, онлайн реклама, а само това, че тя вече няма да бъде в състояние да взима предвид Вашите предпочитания и интереси, видими от Вашето поведение при сърфиране в Интернет. Примери за важна необходимост от използване на бисквитки (при които не се изисква разрешение на потребителя през профила):</p>\r\n<p>- Съдържание и услуги, съобразени с потребителските предпочитания - категории продукти и услуги.</p>\r\n<p>- Оферти, съобразени с интересите на потребителите</p>\r\n<p>- Запаметяване на пароли</p>\r\n<p>- Запаметяване на филтрите за защита на деца за съдържанието в Интернет (опции семеен режим (family mode), функция за безопасно търсене (safe search)).</p>\r\n<p>- Ограничаване честотата на разпространение на реклами - ограничаване на броя на показване на дадена реклама за определен потребител в някой сайт.</p>\r\n<p>- Осигуряване на подходяща за потребителя реклама.</p>\r\n<p>- Измерването, оптимизацията и адаптацията на характеристиките за анализ - като например потвърждение на определено ниво на трафика в уебсайта, какъв тип съдържание се разглежда и как даден потребител влиза в уеб сайта (например: чрез търсачките, директно, от други уеб сайтове и т.н.). Уебсайтове обработват тези анализи относно използването им за подобряване на услугите в полза на потребителите.</p>\r\n<p><strong> 9. Въпроси на защита и поверителността</strong></p>\r\n<p>По принцип, браузърите имат интегрирани настройки за поверителност, които осигуряват различни нива на приемане на бисквитки, период на валидност и автоматично изтриване, след като потребителят е посетил определен сайт. Други аспекти на сигурността, свързани с бисквитките:</p>\r\n<p>- Персонализиране на настройките на браузъра по отношение на бисквитките, за да се достигне до удобното ниво на Вашата безопасност при използването на бисквитки.</p>\r\n<p>- Ако вие сте единственият човек, който използва определен компютър, можете да зададете дали искате по-дълги период от време за съхранение историята на сърфирането и лични данни за достъп.</p>\r\n<p>- Ако споделяте достъп до определен компютър, можете да вземете предвид настройката на браузъра така, че той да изтрива индивидуалните Ви данни за сърфирането, всеки път, когато затворите браузъра. Това е един от вариантите за достъпа до сайтове, които използват бисквитки и за изтриване на цялата информация от посещението.</p>\r\n</div>\r\n<!-- /.section-body --></div>\r\n<!-- /.container --></div>\r\n<!-- /.section-terms-inner --></div>\r\n<!-- /.section section-terms -->'),
(3, 3, 'bg', 'zashhita-na-licnite-danni', 'Защита на личните данни', '<div class=\"section section-terms bg-dark\">\r\n<div class=\"section-terms-inner\">\r\n<div class=\"container bg-white\">\r\n<div class=\"section-head pt-3 border-bottom-sm  text-center wow animate__animated animate__fadeInDown\" data-wow-duration=\".7s\" data-wow-delay=\".7s\">\r\n<h1 class=\"section-title\"><strong>Защита на личните данни</strong></h1>\r\n</div>\r\n<!-- /.section-head  text-center -->\r\n<div class=\"section-body px-3 wow animate__animated animate__fadeInUp\" data-wow-duration=\".7s\" data-wow-delay=\".7s\">\r\n<p>НАСТОЯЩАТА ПОЛИТИКА е неразделна част от ОБЩИТЕ УСЛОВИЯ за ползването на сайта <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>.</p>\r\n<p>\"МАЛЕВ ИНЖЕНЕРИНГ ВТ\" ООД с ЕИК: 202515232 , със седалище и адрес на управление: България, гр. Велико Търново,ул.ПОЛТАВА, 3, вх. Ж, е търговско дружество - собственик на ИНТЕРНЕТ МАГАЗИН на адрес <a href=\"http://www.malev-bg.com/\">http://www.malev-bg.com/</a>.</p>\r\n<p>\"МАЛЕВ ИНЖЕНЕРИНГ ВТ ООД осъществява своята дейност съгласно Закона за защита на личните данни и Регламент (ЕС) 2016/679 на Европейския парламент и на Съвета от 27 април 2016 година относно защитата на физическите лица във връзка с обработването на лични данни и относно свободното движение на такива данни.</p>\r\n<p>Поверителността и сигурността на личните данни на потребителите на сайта е от първостепенно значение за нас. Във връзка с това създадохме настоящата Политиката за защита на личните данни, която регламентира начина, по който събираме, използваме, съхраняваме, разкриваме и изтриваме, или най-общо &bdquo;обработваме&ldquo; данните Ви.</p>\r\n<p>Вашите данни, предоставени при изпращане на съобщение до нас, ще бъдат записани в база данни на \"МАЛЕВ ИНЖЕНЕРИНГ ВТ\" ООД и в тази връзка предоставянето на съгласие с Общите условия, неразделна част от които е настоящата Политика за защита на личните данни, се счита за съгласие предоставените данни или предоставените по друг начин данни на сайта ни да се обработват съгласно посочените по-долу правила.</p>\r\n<p>Важно е да знаете, че:</p>\r\n<p>- Влизайки в сайта ни, Вие се съгласявате с настоящата Политика и изрично потвърждавате, че я приемате.</p>\r\n<p>- Вашите лични данни се обработват единствено на територията на Република България и само за срока и за целите, за които са предоставени.</p>\r\n<p>- Ако не желаете да обработваме Личните Ви данни по начина, описан в Политиката, моля, не ни ги предоставяйте. Предоставянето на Лични данни е доброволно, с оглед на използването на услугите на сайта ни или осъществяване на достъп до тях. Евентуалният Ви отказ да предоставите необходимите Лични данни за използване на услугите на сайта би означавал единствено отказ да използвате съответните услуги, без каквито и да било неблагоприятни последици за Вас.</p>\r\n<p>- Контролен орган по отношение на защитата на Лични данни е: Комисия за защита на личните данни (КЗЛД), адрес:гр. София 1592, бул. &bdquo;Проф. Цветан Лазаров&rdquo; № 2, тел. за информация и контакти 02/91-53-518; Електронна поща: <a href=\"mailto:kzld@cpdp.bg\">kzld@cpdp.bg</a> ; Интернет страница: <a href=\"www.cpdp.bg\" target=\"_blank\" rel=\"noopener\">www.cpdp.bg</a></p>\r\n<p>Услугите, предоставяни от сайта са предназначени за лица, навършили 18 години.</p>\r\n<p>Как и защо използваме личните Ви данни</p>\r\n<p>- Обработваме личните Ви данни на основание изричното Ви съгласие, или</p>\r\n<p>- Обработваме личните Ви данни, за да изпълним задълженията си като страна по договор за предоставяне на услуги. Възможно е периодично да ги използваме за да изпращаме важни съобщения като известия относно Ваши запитвания свързани с конкретни събития, промени в Общите условия и/или други правила.</p>\r\n<p>Как защитаваме Вашите лични данни:</p>\r\n<p>В Дружеството са създадени правила по предотвратяване на злоупотреби и пробиви в сигурността и защитата на Вашите данни.</p>\r\n<p>С цел максимална сигурност при обработка, пренос и съхранение на Вашите данни, може да използваме допълнителни механизми за защита като криптиране, псевдонимизация и др.</p>\r\n<p>Кога изтриваме Вашите лични данни:</p>\r\n<p>Ще съхраняваме и обработваме личните Ви данни за период, необходим за изпълнението на конкретната цел, за която същите се обработват, след което ще бъдат изтрити, освен ако нормативен акт изисква съхраняването и обработването им за по-дълъг период.</p>\r\n<p>&nbsp;</p>\r\n</div>\r\n<!-- /.section-body --></div>\r\n<!-- /.container --></div>\r\n<!-- /.section-terms-inner --></div>\r\n<!-- /.section section-terms -->'),
(4, 4, 'bg', 'za-nas', 'За нас', '<div class=\"section section-teaser bg-dark\">\r\n<div class=\"container\">\r\n<div class=\"bg-white\">\r\n<ul class=\"slider slider-main\">\r\n<li class=\"slide\"><picture> <source srcset=\"../../themes/custom/css/images/assets/about-us/1920x425.png\" media=\"(min-width: 767px)\" /> <source srcset=\"../../themes/custom/css/images/assets/about-us/800x400.png\" /> <img src=\"../../themes/custom/css/images/assets/about-us/1920x425.png\" alt=\"\" /> </picture></li>\r\n<!-- /.slide --></ul>\r\n<!-- /.slider -->\r\n<div class=\"section-head border-bottom\">\r\n<h1 class=\"section-title\">ЗА НАС</h1>\r\n</div>\r\n<!-- /.section-head border-bottom -->\r\n<div class=\"section-body\">\r\n<div class=\"section-text\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur egestas vestibulum lorem, nec feugiat magna accumsan nec. Vestibulum sit amet vulputate odio, accumsan ornare dui. Sed eu imperdiet augue. Praesent sem enim, tristique at rutrum non, viverra sit amet massa. Nullam suscipit et libero in molestie. Nam finibus erat non tellus mattis, quis auctor urna commodo. Cras vel maximus arcu. Integer sed scelerisque odio. Etiam sodales, nulla in imperdiet congue, nunc turpis faucibus felis, et lacinia urna velit at lacus. Aenean eget libero malesuada, aliquet ante a, condimentum urna.</p>\r\n</div>\r\n</div>\r\n<!-- /.section-body -->\r\n<div class=\"section-bottom text-center\"><a class=\"btn btn-primary box-shadow\" href=\"../../../contacts\">Свържи се с нас</a></div>\r\n<!-- /.section-bottom --></div>\r\n</div>\r\n<!-- /.container --></div>\r\n<!-- /.section section-teaser -->\r\n<div class=\"section section-statistic bg-danger\">\r\n<div class=\"container\">\r\n<div class=\"section-head border-bottom text-white wow animate__animated animate__fadeInDown\" data-wow-duration=\".5s\" data-wow-delay=\".5s\">\r\n<h2 class=\"section-title\">MALEV В ЦИФРИ</h2>\r\n</div>\r\n<div class=\"section-body\">\r\n<div class=\"row justify-content-center\">\r\n<div class=\"col-lg-3 col-md-4 col-sm-6 text-center\"><object id=\"\" class=\"icon wow animate__animated animate__fadeInDown\" data=\"../../themes/custom/css/images/assets/home/repair.svg\" type=\"image/svg+xml\" data-wow-duration=\".5s\" data-wow-delay=\".5s\"></object>\r\n<div class=\"d-flex justify-content-center\">\r\n<div class=\"number number_1\">&nbsp;</div>\r\n<span class=\"number\">+</span></div>\r\n<p class=\"ff-mb text-white wow animate__animated animate__fadeInUp\" data-wow-duration=\".5s\" data-wow-delay=\".5s\">Монтирани съоръжения</p>\r\n</div>\r\n<!-- /.col-lg-3 col-md-4 col-sm-6 -->\r\n<div class=\"col-lg-3 col-md-4 col-sm-6 text-center\"><object id=\"\" class=\"icon wow animate__animated animate__fadeInDown\" data=\"../../themes/custom/css/images/assets/home/complete.svg\" type=\"image/svg+xml\" data-wow-duration=\".5s\" data-wow-delay=\".5s\"></object>\r\n<div class=\"d-flex justify-content-center\">\r\n<div class=\"number number_2\">&nbsp;</div>\r\n<span class=\"number\">+</span></div>\r\n<p class=\"ff-mb text-white wow animate__animated animate__fadeInUp\" data-wow-duration=\".5s\" data-wow-delay=\".5s\">Завършени обекта</p>\r\n</div>\r\n<!-- /.col-lg-3 col-md-4 col-sm-6 -->\r\n<div class=\"col-lg-3 col-md-4 col-sm-6 text-center\"><object id=\"\" class=\"icon wow animate__animated animate__fadeInDown\" data=\"../../themes/custom/css/images/assets/home/pipeline.svg\" type=\"image/svg+xml\" data-wow-duration=\".5s\" data-wow-delay=\".5s\"></object>\r\n<div class=\"d-flex justify-content-center\">\r\n<div class=\"number number_3\">&nbsp;</div>\r\n<span class=\"number\">м.</span></div>\r\n<p class=\"ff-mb text-white wow animate__animated animate__fadeInUp\" data-wow-duration=\".5s\" data-wow-delay=\".5s\">Монтирана тръба</p>\r\n</div>\r\n<!-- /.col-lg-3 col-md-4 col-sm-6 -->\r\n<div class=\"col-lg-3 col-md-4 col-sm-6 text-center\"><object id=\"\" class=\"icon  wow animate__animated animate__fadeInDown\" data=\"../../themes/custom/css/images/assets/home/home.svg\" type=\"image/svg+xml\" data-wow-duration=\".5s\" data-wow-delay=\".5s\"></object>\r\n<div class=\"d-flex justify-content-center\">\r\n<div class=\"number number_4\">&nbsp;</div>\r\n<span class=\"number\">+</span></div>\r\n<p class=\"ff-mb text-white wow animate__animated animate__fadeInUp\" data-wow-duration=\".5s\" data-wow-delay=\".5s\">Газифицирани жилища</p>\r\n</div>\r\n<!-- /.col-lg-3 col-md-4 col-sm-6 --></div>\r\n<!-- /.row --></div>\r\n<!-- /.section-body --></div>\r\n<!-- /.container --></div>\r\n<!-- /.section section-statistic bg-danger -->\r\n<div class=\"py-3 bg-dark\">&nbsp;</div>');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `link`, `position`, `created_at`, `updated_at`) VALUES
(1, 'gree_1677752216.png', NULL, 1, '2023-03-02 10:16:56', '2023-03-02 10:16:56'),
(2, 'viesmann_1677752222.png', NULL, 2, '2023-03-02 10:17:02', '2023-03-02 10:17:08'),
(3, 'mitsubishi_1677752227.png', NULL, 3, '2023-03-02 10:17:07', '2023-03-02 10:17:08'),
(4, 'fujitsu_1677752243.png', NULL, 4, '2023-03-02 10:17:23', '2023-03-02 10:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_responses`
--

CREATE TABLE `payment_responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_massage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terminal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_datetime` datetime DEFAULT NULL,
  `transaction_datetime` datetime DEFAULT NULL,
  `approval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rrn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internal_reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pares_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_step_res` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_holder_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eci` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number_masc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nonce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_sign` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'access_administration_pages', 'Минимално, задължително правомощие, за да може даден потребител да има достъп до /admin частта на уебсайта.', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(2, 'manage_system', 'Най-висше правомощие за работа с уебсайта.', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(3, 'view_users', 'Достъп до данните на клиентите.', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(4, 'manage_acl', 'Най-висше правомощие за работа с роли.\n                        - може да създава, чете, редактира и изтрива роли;\n                        Обикновено се дава на роля Administrator.', '2023-02-24 09:41:54', '2023-02-24 14:13:50'),
(5, 'translate', 'Правомощие за управление на преводите.', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(6, 'manage_users', 'Най-висше правомощие за работа с потребители.', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(7, 'manage_blog', 'Може да управлява блог статии', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(8, 'manage_pages', 'Потребителят има правомощия да управлява страници.', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(9, 'manage_layout_blocks', 'Потребителят има правомощие да управлява блокове', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(10, 'manage_files', 'Може да оперира с медийни файлове от публичната директория', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(11, 'manage_inquiries', 'Може да оперира с постъпилите запитвания', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(12, 'manage_gallery', 'Може да управлява галерията', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(13, 'manage_services', 'Може да управлява списъка с услугите', '2023-02-24 14:13:50', '2023-02-24 14:13:50'),
(14, 'manage_activities', 'Може да управлява списъка с дейсностите', '2023-02-28 08:03:48', '2023-02-28 08:03:48'),
(15, 'manage_homepage', 'Може да управлява съдържанието показващо се на началната страница', '2023-02-28 09:43:30', '2023-02-28 09:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(1, 2, NULL, NULL),
(2, 1, NULL, NULL),
(3, 1, NULL, NULL),
(3, 2, NULL, NULL),
(4, 1, NULL, NULL),
(5, 1, NULL, NULL),
(6, 1, NULL, NULL),
(7, 1, NULL, NULL),
(8, 1, NULL, NULL),
(9, 1, NULL, NULL),
(10, 1, NULL, NULL),
(11, 1, NULL, NULL),
(11, 2, NULL, NULL),
(12, 1, NULL, NULL),
(12, 2, NULL, NULL),
(13, 1, NULL, NULL),
(13, 2, NULL, NULL),
(14, 1, NULL, NULL),
(14, 2, NULL, NULL),
(15, 1, NULL, NULL),
(15, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'technical_administrator', '[Технически администратор] Администрира технически настройки на уебсайта. Има всички права.', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(2, 'administrator', '[Администратор] Администрира съдържанието на уебсайта.', '2023-02-24 09:41:54', '2023-02-24 09:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `route_keys`
--

CREATE TABLE `route_keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_key` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `route_keys`
--

INSERT INTO `route_keys` (`id`, `route_key`, `created_at`, `updated_at`) VALUES
(1, 'general_terms', '2023-03-02 12:06:56', '2023-03-02 12:06:56'),
(2, 'cookies', '2023-03-02 12:11:14', '2023-03-02 12:11:14'),
(3, 'personal_data', '2023-03-02 12:14:37', '2023-03-02 12:14:37'),
(4, 'about_us', '2023-03-02 16:17:29', '2023-03-02 16:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `image`, `weight`, `created_at`, `updated_at`) VALUES
(1, 'proektirane.jpg', 1, '2023-02-27 08:30:51', '2023-03-06 11:13:09'),
(2, 'dostavka.jpg', 2, '2023-02-27 08:33:20', '2023-03-06 11:13:41'),
(3, 'montaj.jpg', 3, '2023-02-27 08:35:35', '2023-03-06 11:13:54'),
(4, 'serviz.jpg', 4, '2023-02-27 08:36:58', '2023-03-06 11:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_translations`
--

INSERT INTO `service_translations` (`id`, `service_id`, `locale`, `title`, `slug`, `excerpt`, `description`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 1, 'bg', 'Проектиране', 'proektirane', '<p>Малев Инженеринг ВТ предлага пълен инженеринг на ОВК инсталации:</p>\r\n<ul>\r\n<li>Проектиране на ОВК инсталации</li>\r\n<li>Изграждане на ОВК инсталации</li>\r\n<li>Сервиз на ОВК инсталации</li>\r\n</ul>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>', 1, '2023-02-27 08:30:51', '2023-02-27 08:32:26'),
(2, 2, 'bg', 'Доставка', 'dostavka', '<p>Доставка на всякакъв вид клматично и вентилационно оборудване</p>\r\n<ul>\r\n<li>въздуховоди;</li>\r\n<li>пекуператори;</li>\r\n<li>вентилационни решетки;</li>\r\n<li>климатичникамери;</li>\r\n<li>вентилатори;</li>\r\n</ul>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>', 1, '2023-02-27 08:33:20', '2023-02-27 08:33:20'),
(3, 3, 'bg', 'Монтаж', 'montaz', '<p>Предлагаме монтаж на всякакъв вид климатично и вентилационно оборудване:</p>\r\n<ul>\r\n<li>въздуховоди;</li>\r\n<li>пекуператори;</li>\r\n<li>вентилационни решетки;</li>\r\n<li>климатичникамери;</li>\r\n<li>вентилатори;</li>\r\n</ul>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>', 1, '2023-02-27 08:35:35', '2023-02-27 08:35:35'),
(4, 4, 'bg', 'Сервиз', 'serviz', '<p>Предлагаме сервиз и сервизни услуги , гаранционно поддържане, авариини ремонти и преработка на вентилационни, климатични и отоплителни системи.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vitae ipsum ac quam molestie ullamcorper ut eget est. Fusce porta sed dolor sed lacinia. Ut vulputate velit et libero vehicula, et fermentum odio gravida. Donec blandit dui nec ex faucibus tristique. Nullam pulvinar turpis ac augue vestibulum ultrices. Ut iaculis tristique ex vitae pretium. Aliquam consectetur, mi vitae commodo pretium, mauris sem eleifend libero, ut sodales leo metus ac massa. Sed sed consequat eros. Phasellus fringilla ullamcorper velit non lacinia. Curabitur ut urna lacus. Donec mauris sapien, porttitor nec rhoncus a, mattis vel purus. Donec mollis magna id euismod faucibus. In at ullamcorper neque, eu aliquet augue. Curabitur in ligula et orci pellentesque auctor. Vestibulum consequat, ipsum a tincidunt tempus, felis lorem aliquet nisl, tincidunt suscipit magna enim at leo. Nulla fermentum maximus eleifend.</p>', 1, '2023-02-27 08:36:58', '2023-02-27 08:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_type` int(10) UNSIGNED NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci,
  `data_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_system` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_type`, `setting_value`, `data_type`, `description`, `group`, `is_system`, `created_at`, `updated_at`) VALUES
(1, 1, '', NULL, 'Кратък срок на доставка в дни', 'Срокове за доставка', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(2, 2, '', NULL, 'Дълъг срок на доставка в дни', 'Срокове за доставка', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(3, 3, '', NULL, 'Курс', 'Валутни курсове', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(4, 4, '', NULL, 'Минимална стойност за безплатна доставка', 'Цена на доставка', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(5, 5, '', NULL, 'Плоска цена на доставка', 'Цена на доставка', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(6, 10, '', 'text', 'Продукти винаги на кратък срок на доставка.', 'Unlimited skus', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(7, 11, '', NULL, 'Процент на увеличение на цените за различните държави', 'Цени', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(8, 8, '', NULL, 'ДДС за всяка от държавите', 'ДДС', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(9, 12, '', NULL, 'Google analytics ids', 'Google analytics', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(10, 6, 'EAAC0aE5uMXMBAPjYW6Mi9LDXBOYCqwgx9bGc8Yg2jMpezZChjR6m0JXW7P4dmd5E2jz3XJcIOaYotlKn23vqu1ZB8gdH19PWZBtEDd2ZC29VH28ihF1dHrmInnnUv1PjVfTMmFsLyIbaOnm8APFEMjAHq9ToC87oMjtfm76Pu3eB3UCZCyGOO', NULL, 'Access token за Facebook интеграцията с Conversion API (CAPI)', 'Фейсбук маркетинг', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(11, 7, '907303036479881', NULL, 'Пиксел ID за Facebook', 'Фейсбук маркетинг', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(12, 14, '/themes/custom/css/images/logo.png', NULL, 'Лого на сайта', 'Лого', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(13, 15, 'Malev', NULL, 'Име на сайта', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(14, 16, 'Malev', NULL, 'Име на фирмата', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(15, 17, '', NULL, 'Еик данни на фирмата', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(16, 18, '', NULL, 'IBAN данни на фирмата', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(17, 19, '', NULL, 'Адрес на фирмата', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(18, 20, '', NULL, 'Email на фирмата', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(19, 21, '', NULL, 'Телефон на фирмата', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(20, 22, '', NULL, 'BIC на фирмата', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54'),
(21, 23, '', NULL, 'Банка на фирмата', 'Фирмени данни', '0', '2023-02-24 09:41:54', '2023-02-24 09:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `setting_translations`
--

CREATE TABLE `setting_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_by_locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_translations`
--

INSERT INTO `setting_translations` (`id`, `setting_id`, `locale`, `value_by_locale`) VALUES
(1, 1, 'bg', '3'),
(2, 1, 'en', '10'),
(3, 2, 'bg', '30'),
(4, 2, 'en', '90'),
(5, 3, 'bg', '1'),
(6, 3, 'en', '0.43'),
(7, 4, 'bg', '50'),
(8, 4, 'en', '22'),
(9, 5, 'bg', '5'),
(10, 5, 'en', '5'),
(11, 7, 'bg', '0'),
(12, 7, 'en', '0'),
(13, 8, 'bg', '20'),
(14, 8, 'en', '20'),
(15, 9, 'bg', ''),
(16, 9, 'en', '');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `mobile_image`, `weight`, `link`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, '1920x490.png', '800x400.png', 8, NULL, 1, '2023-03-02 09:33:04', '2023-03-02 09:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `url_metas`
--

CREATE TABLE `url_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_anonymous` tinyint(1) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dossier_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `phone_number`, `email_verified_at`, `password`, `is_anonymous`, `remember_token`, `created_at`, `updated_at`, `dossier_id`) VALUES
(1, 'admin', NULL, 'admin@example.bg', NULL, NULL, '$2y$10$xHsc6kmrr9IPu9BZu.Tnsu8pmuH2QdlQBEttO0Nsz4RDvT0xLWIau', 0, NULL, '2023-02-24 09:41:54', '2023-03-15 18:07:41', NULL),
(2, 'Second', 'User', 'suser@abv.bg', '0889898989898', NULL, '$2y$10$2RWVW4nWVMGncXC6mmrTzeVJzwYAiqAJWSTF9IS./vJtxHSEUE.sG', 0, NULL, '2023-02-24 09:41:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'login',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `user_id`, `action_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'login', '2023-02-24 14:12:24', '2023-02-24 14:12:24'),
(2, 1, 'login', '2023-02-27 08:20:28', '2023-02-27 08:20:28'),
(3, 1, 'login', '2023-02-28 08:02:19', '2023-02-28 08:02:19'),
(4, 1, 'login', '2023-03-02 09:28:53', '2023-03-02 09:28:53'),
(5, 1, 'login', '2023-03-06 11:12:00', '2023-03-06 11:12:00'),
(7, 1, 'login', '2023-03-15 18:05:33', '2023-03-15 18:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_translations`
--
ALTER TABLE `activity_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `activity_translations_locale_slug_unique` (`locale`,`slug`),
  ADD KEY `activity_translations_activity_id_foreign` (`activity_id`),
  ADD KEY `activity_translations_locale_index` (`locale`);

--
-- Indexes for table `blog_articles`
--
ALTER TABLE `blog_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_article_categories`
--
ALTER TABLE `blog_article_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_article_category`
--
ALTER TABLE `blog_article_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_article_category_translations`
--
ALTER TABLE `blog_article_category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_article_category_translations_locale_slug_unique` (`locale`,`slug`),
  ADD KEY `category_id` (`blog_article_category_id`),
  ADD KEY `blog_article_category_translations_locale_index` (`locale`);

--
-- Indexes for table `blog_article_edit_logs`
--
ALTER TABLE `blog_article_edit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_article_edit_logs_blog_article_id_foreign` (`blog_article_id`),
  ADD KEY `blog_article_edit_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `blog_article_translations`
--
ALTER TABLE `blog_article_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_article_translations_locale_slug_unique` (`locale`,`slug`),
  ADD KEY `blog_article_translations_blog_article_id_foreign` (`blog_article_id`),
  ADD KEY `blog_article_translations_locale_index` (`locale`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dossiers`
--
ALTER TABLE `dossiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_images_gallery_image_category_id_foreign` (`gallery_image_category_id`);

--
-- Indexes for table `gallery_image_categories`
--
ALTER TABLE `gallery_image_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_image_categories_parent_id_index` (`parent_id`);

--
-- Indexes for table `gallery_image_category_translations`
--
ALTER TABLE `gallery_image_category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gallery_image_category_translations_locale_slug_unique` (`locale`,`slug`),
  ADD KEY `image_category_id` (`gallery_image_category_id`),
  ADD KEY `gallery_image_category_translations_locale_index` (`locale`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `layout_blocks`
--
ALTER TABLE `layout_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layout_blocks_region_name_index` (`region_name`);

--
-- Indexes for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_pos_responses`
--
ALTER TABLE `my_pos_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_pos_responses_order_id_foreign` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_translations_locale_page_id_unique` (`locale`,`page_id`),
  ADD UNIQUE KEY `page_translations_locale_slug_unique` (`locale`,`slug`),
  ADD KEY `page_translations_page_id_foreign` (`page_id`),
  ADD KEY `page_translations_locale_index` (`locale`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_responses`
--
ALTER TABLE `payment_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_responses_order_id_foreign` (`order_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `route_keys`
--
ALTER TABLE `route_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_translations_locale_slug_unique` (`locale`,`slug`),
  ADD KEY `service_translations_service_id_foreign` (`service_id`),
  ADD KEY `service_translations_locale_index` (`locale`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_translations_setting_id_locale_unique` (`setting_id`,`locale`),
  ADD KEY `setting_translations_locale_index` (`locale`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `url_metas`
--
ALTER TABLE `url_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_dossier_id_foreign` (`dossier_id`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `activity_translations`
--
ALTER TABLE `activity_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_articles`
--
ALTER TABLE `blog_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_article_categories`
--
ALTER TABLE `blog_article_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_article_category`
--
ALTER TABLE `blog_article_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_article_category_translations`
--
ALTER TABLE `blog_article_category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_article_edit_logs`
--
ALTER TABLE `blog_article_edit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_article_translations`
--
ALTER TABLE `blog_article_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dossiers`
--
ALTER TABLE `dossiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gallery_image_categories`
--
ALTER TABLE `gallery_image_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery_image_category_translations`
--
ALTER TABLE `gallery_image_category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layout_blocks`
--
ALTER TABLE `layout_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `my_pos_responses`
--
ALTER TABLE `my_pos_responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_responses`
--
ALTER TABLE `payment_responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `route_keys`
--
ALTER TABLE `route_keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `setting_translations`
--
ALTER TABLE `setting_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `url_metas`
--
ALTER TABLE `url_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_translations`
--
ALTER TABLE `activity_translations`
  ADD CONSTRAINT `activity_translations_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_article_category_translations`
--
ALTER TABLE `blog_article_category_translations`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`blog_article_category_id`) REFERENCES `blog_article_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_article_edit_logs`
--
ALTER TABLE `blog_article_edit_logs`
  ADD CONSTRAINT `blog_article_edit_logs_blog_article_id_foreign` FOREIGN KEY (`blog_article_id`) REFERENCES `blog_articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_article_edit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_article_translations`
--
ALTER TABLE `blog_article_translations`
  ADD CONSTRAINT `blog_article_translations_blog_article_id_foreign` FOREIGN KEY (`blog_article_id`) REFERENCES `blog_articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD CONSTRAINT `gallery_images_gallery_image_category_id_foreign` FOREIGN KEY (`gallery_image_category_id`) REFERENCES `gallery_image_categories` (`id`);

--
-- Constraints for table `gallery_image_category_translations`
--
ALTER TABLE `gallery_image_category_translations`
  ADD CONSTRAINT `image_category_id` FOREIGN KEY (`gallery_image_category_id`) REFERENCES `gallery_image_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `my_pos_responses`
--
ALTER TABLE `my_pos_responses`
  ADD CONSTRAINT `my_pos_responses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_responses`
--
ALTER TABLE `payment_responses`
  ADD CONSTRAINT `payment_responses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD CONSTRAINT `service_translations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD CONSTRAINT `setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_dossier_id_foreign` FOREIGN KEY (`dossier_id`) REFERENCES `dossiers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
