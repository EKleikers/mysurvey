-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP VIEW IF EXISTS `appsforce_client`;
CREATE TABLE `appsforce_client` (`companyname` varchar(50), `registrationnumber` varchar(50), `taxnumber` varchar(50), `id` varchar(255), `urn` varchar(500), `api_token` varchar(60), `imapserver` varchar(255), `smtpserver` varchar(255), `imapserverport` varchar(255), `smtpserverport` varchar(255), `maildriver` varchar(255), `encryption` varchar(255), `username` varchar(255), `from_address` varchar(255), `from_name` varchar(255), `password` text, `phone` varchar(30), `phone2` varchar(30), `address` varchar(255), `address2` varchar(255), `city` varchar(100), `post` varchar(30), `state` varchar(50), `country` varchar(50), `logo` varchar(255), `defaultlanguage` varchar(20), `defaulttheme` varchar(20), `defaultsubtheme` varchar(20), `frontapp` varchar(50), `created_at` timestamp, `updated_at` timestamp, `created_by` smallint, `backuptype` varchar(50), `backupinterval` varchar(255), `backupencryption` varchar(255));


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2018_02_21_000001_create_surveys_table',	1),
(4,	'2018_05_25_053226_create_survey_results_table',	1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `survey_select` varchar(200) NOT NULL,
  `report_name` varchar(200) NOT NULL,
  `national_international` varchar(200) NOT NULL,
  `legal_form` varchar(200) NOT NULL,
  `business_sector` varchar(200) NOT NULL,
  `time_existence` varchar(200) NOT NULL,
  `number_employees` varchar(200) NOT NULL,
  `company_turnover` varchar(200) NOT NULL,
  `sales_market` varchar(200) NOT NULL,
  `it_arrangement` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `reports` (`id`, `survey_select`, `report_name`, `national_international`, `legal_form`, `business_sector`, `time_existence`, `number_employees`, `company_turnover`, `sales_market`, `it_arrangement`) VALUES
(19,	'7',	'Test OU',	'0',	'0',	'0',	'0',	'0',	'0',	'0',	'0');

DROP TABLE IF EXISTS `smes`;
CREATE TABLE `smes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `company_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `town` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishment` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `legal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `legal_other` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '-',
  `sector` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector_other` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '-',
  `exist` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `turnover` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supply` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '-',
  `supply_other` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '-',
  `it` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `it_other` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '-',
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `smes` (`id`, `user_id`, `company_name`, `address1`, `address2`, `postcode`, `town`, `country`, `establishment`, `province`, `active`, `legal`, `legal_other`, `sector`, `sector_other`, `exist`, `size`, `turnover`, `supply`, `supply_other`, `it`, `it_other`, `short_description`) VALUES
(54,	1,	'AppsForce',	'Spilstraat 6 C 20',	'Qeske',	'6211 CP',	'Maastricht',	'Netherlands',	'2',	'6',	'3',	'4',	NULL,	'16',	NULL,	'2',	'3',	'3',	'1',	NULL,	'3',	NULL,	'WE ARE APPSFORCE');

DROP TABLE IF EXISTS `survey_results`;
CREATE TABLE `survey_results` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `survey_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `ip_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `survey_results` (`id`, `survey_id`, `user_id`, `ip_address`, `json`, `created_at`, `updated_at`) VALUES
(350,	49,	0,	NULL,	'{\"question1\":\"Andre\",\"question2\":3}',	'2020-09-06 17:38:06',	'2020-09-06 17:38:06'),
(351,	49,	0,	NULL,	'{\"question1\":\"Peter\",\"question2\":1}',	'2020-09-06 17:38:28',	'2020-09-06 17:38:28'),
(352,	49,	0,	NULL,	'{\"question1\":\"John\",\"question2\":4}',	'2020-09-06 17:38:46',	'2020-09-06 17:38:46'),
(353,	49,	0,	NULL,	'{\"question1\":\"Tim\",\"question2\":1,\"question3\":2,\"question4\":3}',	'2020-09-06 17:48:33',	'2020-09-06 17:48:33');

DROP TABLE IF EXISTS `surveys`;
CREATE TABLE `surveys` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `duplicate` int DEFAULT NULL,
  `anonymous` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `surveys` (`id`, `name`, `slug`, `json`, `created_at`, `updated_at`, `deleted_at`, `published_at`, `duplicate`, `anonymous`) VALUES
(7,	'Open Universiteit',	'open-universiteit',	'{\"pages\":[{\"name\":\"page1\",\"elements\":[{\"type\":\"text\",\"name\":\"question2\"},{\"type\":\"checkbox\",\"name\":\"question1\",\"choices\":[\"item1\",\"item2\",\"item3\"]}]}],\"pagePrevText\":\"Previous\",\"pageNextText\":\"Next\",\"completeText\":\"Complete\"}',	'2020-06-15 07:22:23',	'2020-08-27 08:26:57',	NULL,	'2020-08-31 22:00:00',	0,	NULL),
(47,	'123',	'123',	'{\"pages\":[{\"name\":\"page1\",\"elements\":[{\"type\":\"rating\",\"name\":\"question1\"}]}],\"pagePrevText\":\"Previous\",\"pageNextText\":\"Next\",\"completeText\":\"Complete\"}',	'2020-09-06 16:46:58',	'2020-09-06 16:46:58',	NULL,	'2020-09-01 22:00:00',	NULL,	NULL),
(49,	'Test Anon',	'test-anon',	'{\"pages\":[{\"name\":\"page1\",\"elements\":[{\"type\":\"text\",\"name\":\"question1\",\"title\":\"What is your name\"},{\"type\":\"rating\",\"name\":\"question2\",\"title\":\"How many computers do you have\"},{\"type\":\"rating\",\"name\":\"question3\",\"title\":\"How many IT people do you have\"},{\"type\":\"rating\",\"name\":\"question4\",\"title\":\"How many Smartphones do you have\"}]}],\"pagePrevText\":\"Previous\",\"pageNextText\":\"Next\",\"completeText\":\"Complete\"}',	'2020-09-06 17:37:43',	'2020-09-06 17:44:20',	NULL,	'2020-09-23 22:00:00',	NULL,	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Andre Fabris',	'admin',	'af@appsforce.org',	NULL,	'$2y$10$Yw4vyTFuWQ61Gu.26fjq6O4Yw1HZ64s3LhSOSYXVjwyGFlPC6h49i',	NULL,	'2020-08-29 08:16:07',	'2020-08-29 08:38:31');

DROP TABLE IF EXISTS `appsforce_client`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `appsforce_client` AS select `myadmin`.`client`.`companyname` AS `companyname`,`myadmin`.`client`.`registrationnumber` AS `registrationnumber`,`myadmin`.`client`.`taxnumber` AS `taxnumber`,`myadmin`.`client`.`id` AS `id`,`myadmin`.`client`.`urn` AS `urn`,`myadmin`.`client`.`api_token` AS `api_token`,`myadmin`.`client`.`imapserver` AS `imapserver`,`myadmin`.`client`.`smtpserver` AS `smtpserver`,`myadmin`.`client`.`imapserverport` AS `imapserverport`,`myadmin`.`client`.`smtpserverport` AS `smtpserverport`,`myadmin`.`client`.`maildriver` AS `maildriver`,`myadmin`.`client`.`encryption` AS `encryption`,`myadmin`.`client`.`username` AS `username`,`myadmin`.`client`.`from_address` AS `from_address`,`myadmin`.`client`.`from_name` AS `from_name`,`myadmin`.`client`.`password` AS `password`,`myadmin`.`client`.`phone` AS `phone`,`myadmin`.`client`.`phone2` AS `phone2`,`myadmin`.`client`.`address` AS `address`,`myadmin`.`client`.`address2` AS `address2`,`myadmin`.`client`.`city` AS `city`,`myadmin`.`client`.`post` AS `post`,`myadmin`.`client`.`state` AS `state`,`myadmin`.`client`.`country` AS `country`,`myadmin`.`client`.`logo` AS `logo`,`myadmin`.`client`.`defaultlanguage` AS `defaultlanguage`,`myadmin`.`client`.`defaulttheme` AS `defaulttheme`,`myadmin`.`client`.`defaultsubtheme` AS `defaultsubtheme`,`myadmin`.`client`.`frontapp` AS `frontapp`,`myadmin`.`client`.`created_at` AS `created_at`,`myadmin`.`client`.`updated_at` AS `updated_at`,`myadmin`.`client`.`created_by` AS `created_by`,`myadmin`.`client`.`backuptype` AS `backuptype`,`myadmin`.`client`.`backupinterval` AS `backupinterval`,`myadmin`.`client`.`backupencryption` AS `backupencryption` from `myadmin`.`client`;

-- 2020-09-06 19:49:33
