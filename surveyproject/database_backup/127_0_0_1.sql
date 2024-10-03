-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2023 at 06:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"survey\",\"table\":\"invitations\"},{\"db\":\"survey\",\"table\":\"surveyinfodata\"},{\"db\":\"survey\",\"table\":\"users\"},{\"db\":\"survey\",\"table\":\"questions\"},{\"db\":\"survey\",\"table\":\"answers\"},{\"db\":\"survey\",\"table\":\"options\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'survey', 'answers', '{\"sorted_col\":\"`answers`.`Survey_Id` ASC\"}', '2023-01-17 05:28:10'),
('root', 'survey', 'invitations', '{\"sorted_col\":\"`invitations`.`invitation_id` DESC\"}', '2022-12-29 06:01:24'),
('root', 'survey', 'options', '{\"sorted_col\":\"`options`.`option_id` DESC\"}', '2023-01-09 05:27:29'),
('root', 'survey', 'questions', '{\"sorted_col\":\"`questions`.`survey_id` ASC\"}', '2023-01-17 07:45:42'),
('root', 'survey', 'surveyinfodata', '{\"sorted_col\":\"`surveyinfodata`.`survey_id` DESC\"}', '2022-12-29 06:00:25'),
('root', 'survey', 'users', '{\"sorted_col\":\"`users`.`User_id` DESC\"}', '2023-01-04 09:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2023-02-07 05:58:39', '{\"Console\\/Mode\":\"collapse\",\"ThemeDefault\":\"metro\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `survey`
--
CREATE DATABASE IF NOT EXISTS `survey` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `survey`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL,
  `admin_name` text NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Krati', 'kratigarg077@gmail.com', 'Kk2@2'),
(2, 'Krati', 'kratigarg077@gmail.com', 'Kk2@2'),
(3, 'test', 'test@test.com', 'Te2@2'),
(4, 'demo', 'demo@gmail.com', '$2y$10$M1As7.PyhuPGm'),
(5, 'Krati Garg', 'kratigarg077@gmail.com', '4cb8f55b555367ae9248'),
(6, 'abcd', 'abcd@gmail.com', '9ce086727c3752234c7e702b2f4d3f19'),
(7, 'abcd', 'abcd@gmail.com', '1ebd18622fb9d623b6eef01e06b763b6'),
(8, 'abc', 'abcd@gmail.com', '1ebd18622fb9d623b6eef01e06b763b6'),
(9, 'abc', 'abcd@gmail.com', '1ebd18622fb9d623b6eef01e06b763b6'),
(10, 'abc', 'abcd@gmail.com', '1ebd18622fb9d623b6eef01e06b763b6'),
(11, 'abcde', 'abcde@gmail.com', '1ebd18622fb9d623b6eef01e06b763b6'),
(12, 'abcdef', 'abcdfe@gmail.com', '1ebd18622fb9d623b6eef01e06b763b6'),
(13, 'def', 'def@defs.com', '7f6c18b81956a3a53305eed834f3dac5');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(50) NOT NULL,
  `Survey_Id` int(5) NOT NULL,
  `ans_question_id` int(5) NOT NULL,
  `answer_selected` varchar(50) NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `answer_submitted_by` text NOT NULL,
  `answer_submitted_email` varchar(50) NOT NULL,
  `answer_submitted_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `Survey_Id`, `ans_question_id`, `answer_selected`, `comment`, `answer_submitted_by`, `answer_submitted_email`, `answer_submitted_date`) VALUES
(1, 1, 3, 'opt 0', '', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:12:49.441981'),
(2, 1, 4, '11', 'Success', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:12:49.444958'),
(3, 1, 4, '22', 'Success', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:12:49.446496'),
(4, 1, 5, 'Krati Garg.pdf', '', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:12:49.448158'),
(5, 1, 6, '5', '', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:12:49.449816'),
(6, 1, 7, 'Hello', 'Heyy!!!!', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:12:49.451176'),
(7, 4, 12, '', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-04 12:18:17.608558'),
(8, 4, 13, 'Newspaper', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-04 12:18:17.611107'),
(9, 4, 14, 'Black', 'Black', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-04 12:18:17.612202'),
(10, 4, 15, 'casper.jpg', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-04 12:18:17.613805'),
(11, 4, 16, '4', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-04 12:18:17.615380'),
(12, 1, 3, 'opt 1', '', ' Aditya', 'kumaradi360@gmail.com', '2023-01-04 12:20:33.888506'),
(13, 1, 4, '22', '33', ' Aditya', 'kumaradi360@gmail.com', '2023-01-04 12:20:33.890950'),
(14, 1, 5, 'pic2.jpg', '', ' Aditya', 'kumaradi360@gmail.com', '2023-01-04 12:20:33.892657'),
(15, 1, 6, '5', '', ' Aditya', 'kumaradi360@gmail.com', '2023-01-04 12:20:33.894303'),
(16, 1, 7, 'Hello', '', ' Aditya', 'kumaradi360@gmail.com', '2023-01-04 12:20:33.895972'),
(17, 5, 1, 'casper1.jfif', '', 'Abc', 'kratigarg077@gmail.com', '2023-01-04 12:32:47.381240'),
(18, 5, 2, '5', '', 'Abc', 'kratigarg077@gmail.com', '2023-01-04 12:32:47.382525'),
(19, 5, 20, 'One', '', 'Abc', 'kratigarg077@gmail.com', '2023-01-04 12:32:47.384249'),
(20, 5, 21, 'No', '', 'Abc', 'kratigarg077@gmail.com', '2023-01-04 12:32:47.385999'),
(21, 6, 17, '', '', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:40:11.872102'),
(22, 6, 18, 'Description!!', '', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:40:11.875716'),
(23, 6, 19, 'Badminton', '', 'Krati', 'kratigarg077@gmail.com', '2023-01-04 12:40:11.877262'),
(29, 10, 56, 'gfh', '', '', '', '2023-01-24 14:04:10.230333'),
(30, 12, 60, 'Opt1', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-24 16:14:33.998369'),
(31, 12, 61, '4', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-24 16:14:34.000892'),
(32, 12, 0, '', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-24 16:14:34.002781'),
(33, 12, 63, 'fdsf', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-24 16:14:34.004357'),
(34, 12, 63, 'dsffg', '', 'Krati Garg', 'kratigarg077@gmail.com', '2023-01-24 16:14:34.006235');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `invitation_id` int(5) NOT NULL,
  `Survey_Id` int(6) NOT NULL,
  `invitation_to_name` text NOT NULL,
  `invitation_to_email` varchar(100) NOT NULL,
  `invitation_link` varchar(100) NOT NULL,
  `invited_by` varchar(50) NOT NULL,
  `invitation_subject` text NOT NULL,
  `invitation_message` varchar(255) NOT NULL,
  `invitation_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `status` varchar(20) NOT NULL DEFAULT 'Invited'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`invitation_id`, `Survey_Id`, `invitation_to_name`, `invitation_to_email`, `invitation_link`, `invited_by`, `invitation_subject`, `invitation_message`, `invitation_date`, `status`) VALUES
(1, 1, 'Krati', 'kratigarg077@gmail.com', '5bfbe7cb8e69ca717a92ad56d60473af', '44', 'Sample Survey 1', 'Please fill the form', '2023-01-04 11:18:39.054607', 'submitted'),
(2, 1, ' Aditya', 'kumaradi360@gmail.com', '588681ca71f3e9337560ba5ac1da9bbc', '44', 'Sample Survey 1', 'Please fill the form', '2023-01-04 11:18:42.953252', 'submitted'),
(3, 4, 'Krati Garg', 'kratigarg077@gmail.com', '653ae3c8c9439df0c4042bd48bbba064', '44', 'Desddcf', 'Fill the form', '2023-01-04 11:19:19.721665', 'submitted'),
(4, 4, 'Sneha', 'sneha.choudhary0106@gmail.com', '60da418b0bfa18a19f26b4e5b387cf71', '44', 'Desddcf', 'Please fill the form!!', '2023-01-04 11:20:03.245615', 'Invited'),
(5, 6, 'Krati', 'kratigarg077@gmail.com', '0d307c860cd8c0b0beff27edf7df58dd', '44', 'Demo Survey1', 'Fill the survey!', '2023-01-04 12:22:59.767300', 'submitted'),
(6, 5, 'Abc', 'kratigarg077@gmail.com', 'd12a81ed05d1bdfe17ecfb5c916a85c1', '44', 'Demo Survey', 'Fill the form!', '2023-01-04 12:32:18.431136', 'submitted'),
(7, 5, 'demo', 'demo@gmail.com', '4009f481c9d13d1cf0686865d311ce2c', '44', 'Demo Survey', 'Filll', '2023-01-04 12:33:49.970254', 'Invited'),
(8, 1, 'Krati Garg', 'kratigarg@gmail.com', '0662d21b452709ff7ecd6d99d41423cc', '44', 'Sample Survey 1', 'Please fill!!', '2023-01-04 17:53:25.341806', 'Invited'),
(9, 1, 'abc', 'abc@gmail.com', 'c674baa6d8731408cdafdc8451bbe426', '44', 'Sample Survey 1', 'Please fill!!', '2023-01-04 18:05:56.334103', 'Invited'),
(12, 12, 'Krati Garg', 'kratigarg077@gmail.com', '388f2d49f58cf6e61fb723c5abb33eb9', '44', 'Surveyy', 'Fill!!', '2023-01-24 16:13:10.393290', 'submitted'),
(13, 12, ' sneha', 'sneha.choudhary0106@gmail.com', '97056a1d14bdf936eb4f4a95266e68ef', '44', 'Surveyy', 'Fill!!', '2023-01-24 16:13:14.437104', 'Invited');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(5) NOT NULL,
  `option_type` text NOT NULL,
  `option_description` text NOT NULL,
  `Question_id` int(15) NOT NULL,
  `option_created_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `o_status` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_type`, `option_description`, `Question_id`, `option_created_date`, `o_status`) VALUES
(467, 'radio', 'opt 0', 3, '2023-01-03 18:24:03.507008', 'Active'),
(468, 'radio', 'opt 1', 3, '2023-01-03 18:24:03.508832', 'Active'),
(469, 'mcq_comment', '11', 4, '2023-01-03 18:24:35.800118', 'Active'),
(470, 'mcq_comment', '22', 4, '2023-01-03 18:24:35.801078', 'Active'),
(473, 'radio_comment', 'Hiiii ', 7, '2023-01-09 12:24:32.285156', 'Active'),
(474, 'radio_comment', 'Hello ', 7, '2023-01-09 12:24:32.287055', 'Active'),
(477, 'mcq', 'option 11', 10, '2023-01-03 18:27:21.714662', 'Active'),
(478, 'mcq', 'option 22', 10, '2023-01-03 18:27:21.716366', 'Active'),
(479, 'radio', 'opt 1111', 11, '2023-01-03 18:36:06.214898', 'Active'),
(480, 'radio', 'opt 2222', 11, '2023-01-03 18:36:06.216116', 'Active'),
(482, 'radio', 'Television', 13, '2023-01-04 11:15:42.019479', 'Active'),
(483, 'radio', 'Newspaper', 13, '2023-01-04 11:15:42.020747', 'Active'),
(484, 'radio', 'Others', 13, '2023-01-04 11:15:42.021948', 'Active'),
(485, 'radio_comment', 'Black', 14, '2023-01-04 11:16:50.665534', 'Active'),
(486, 'radio_comment', 'Blue', 14, '2023-01-04 11:16:50.667439', 'Active'),
(487, 'radio_comment', 'Lavender', 14, '2023-01-04 11:16:50.669478', 'Active'),
(492, 'radio', 'Cricket', 19, '2023-01-04 12:24:03.884804', 'Active'),
(493, 'radio', 'Badminton', 19, '2023-01-04 12:24:03.886462', 'Active'),
(494, 'radio', 'Hockey', 19, '2023-01-04 12:24:03.888258', 'Active'),
(495, 'radio', 'Football', 19, '2023-01-04 12:24:03.889914', 'Active'),
(496, 'radio', 'One', 20, '2023-01-04 12:31:20.050877', 'Active'),
(497, 'radio', 'Two', 20, '2023-01-04 12:31:20.052315', 'Active'),
(498, 'radio', 'Yes', 21, '2023-01-04 12:31:51.413026', 'Active'),
(499, 'radio', 'No', 21, '2023-01-04 12:31:51.414590', 'Active'),
(500, 'radio_comment', 'Yes', 22, '2023-01-04 12:36:56.848023', 'Active'),
(501, 'radio_comment', 'No', 22, '2023-01-04 12:36:56.849380', 'Active'),
(502, 'radio', 'test1   ', 23, '2023-01-09 16:00:50.514585', 'Active'),
(503, 'radio', 'test2  ', 23, '2023-01-09 16:00:50.515513', 'Active'),
(504, 'radio', 'test3  ', 23, '2023-01-09 16:00:50.516459', 'Active'),
(513, 'mcq', 'Option 1', 30, '2023-01-04 17:25:21.756138', 'Deleted'),
(523, 'radio_comment', 'sd', 32, '2023-01-05 12:19:15.087439', 'Active'),
(524, 'radio_comment', 'sd', 32, '2023-01-05 12:18:46.464676', 'Deleted'),
(525, 'radio_comment', 'fcdsfdsf', 32, '2023-01-05 12:19:15.089765', 'Active'),
(536, 'radio', 'heyy  ', 36, '2023-01-09 12:26:28.651663', 'Deleted'),
(537, 'radio', 'hiiie', 36, '2023-01-05 13:38:30.740074', 'Deleted'),
(538, 'radio', '', 36, '2023-01-05 13:29:22.670320', 'Deleted'),
(539, 'radio', '', 36, '2023-01-05 13:29:36.022957', 'Deleted'),
(540, 'radio', '', 36, '2023-01-05 13:29:52.755738', 'Deleted'),
(542, 'radio', 'uu ', 37, '2023-01-05 17:33:58.110874', 'Deleted'),
(543, 'radio_comment', ' edaw               ', 38, '2023-01-09 10:57:44.535029', 'Active'),
(544, 'mcq', ' edad ', 38, '2023-01-05 17:33:40.590120', 'Deleted'),
(545, 'radio_comment', 'yujyguj               ', 38, '2023-01-09 10:57:44.536385', 'Active'),
(547, 'radio', 'fgfd ', 40, '2023-01-09 11:46:36.289211', 'Active'),
(548, 'radio_comment', 'dfee            ', 38, '2023-01-09 10:57:44.537605', 'Active'),
(549, 'radio', 'yyy', 40, '2023-01-09 11:46:36.290929', 'Active'),
(551, 'radio_comment', 'sdee      ', 38, '2023-01-09 10:57:44.538936', 'Active'),
(552, 'mcq_comment', ' edaw     ', 38, '2023-01-05 18:23:37.619172', 'Deleted'),
(553, 'mcq_comment', 'yujyguj     ', 38, '2023-01-05 18:23:37.619980', 'Deleted'),
(554, 'mcq_comment', 'dfee  ', 38, '2023-01-05 18:23:37.621471', 'Deleted'),
(564, 'radio_comment', 'wweeer  ', 38, '2023-01-09 10:57:44.540176', 'Active'),
(565, 'mcq_comment', ' edaw          ', 38, '2023-01-05 18:30:27.983266', 'Deleted'),
(566, 'mcq_comment', 'yujyguj          ', 38, '2023-01-05 18:30:27.984211', 'Deleted'),
(567, 'mcq_comment', 'dfee       ', 38, '2023-01-05 18:30:27.985341', 'Deleted'),
(568, 'mcq_comment', 'sdee ', 38, '2023-01-05 18:30:27.986646', 'Deleted'),
(569, 'radio', ' edaw             ', 38, '2023-01-05 18:31:43.274378', 'Deleted'),
(570, 'radio', 'yujyguj             ', 38, '2023-01-05 18:31:43.275700', 'Deleted'),
(571, 'radio', 'dfee          ', 38, '2023-01-05 18:31:43.277147', 'Deleted'),
(572, 'radio', 'sdee    ', 38, '2023-01-05 18:31:43.278513', 'Deleted'),
(573, 'radio', 'wwee   ', 38, '2023-01-05 18:31:43.279522', 'Deleted'),
(575, 'radio_comment', 'gh ', 39, '2023-01-09 10:58:00.086230', 'Deleted'),
(578, 'radio', 'one1       ', 44, '2023-01-09 12:07:09.568680', 'Active'),
(579, 'radio', 'two2       ', 44, '2023-01-09 12:07:09.569934', 'Active'),
(580, 'radio', 'three3      ', 44, '2023-01-09 12:07:09.570849', 'Active'),
(581, 'radio', 'two2 ', 44, '2023-01-09 11:48:23.625645', 'Deleted'),
(582, 'radio', 'three3 ', 44, '2023-01-09 11:48:45.513842', 'Deleted'),
(583, 'radio', 'four4    ', 44, '2023-01-09 12:07:09.571955', 'Active'),
(584, 'radio', 'three3  ', 44, '2023-01-09 11:49:30.396057', 'Deleted'),
(585, 'radio', 'five5   ', 44, '2023-01-09 12:07:09.573534', 'Active'),
(586, 'radio', 'four4   ', 44, '2023-01-09 11:54:41.810683', 'Deleted'),
(587, 'radio', 'six6 ', 44, '2023-01-09 11:54:41.812446', 'Deleted'),
(588, 'radio', 'four4   ', 44, '2023-01-09 11:54:41.813985', 'Deleted'),
(589, 'radio', 'four4   ', 44, '2023-01-09 11:54:41.815455', 'Deleted'),
(590, 'radio_comment', ' EEEE', 41, '2023-01-09 12:06:01.039852', 'Active'),
(591, 'radio', 'six6', 44, '2023-01-09 12:07:09.575360', 'Active'),
(592, 'radio_comment', 'heyii', 7, '2023-01-09 12:24:32.288961', 'Active'),
(593, 'radio', 'hiii ', 36, '2023-01-09 12:26:28.653426', 'Deleted'),
(594, 'radio', 'helliee', 36, '2023-01-09 12:26:28.655231', 'Deleted'),
(595, 'radio_comment', 'ttt   ', 45, '2023-01-09 12:52:34.583239', 'Deleted'),
(596, 'radio_comment', 'eeee', 45, '2023-01-09 12:31:37.119960', 'Deleted'),
(597, 'radio_comment', 'rrrr', 45, '2023-01-09 12:35:13.356022', 'Deleted'),
(598, 'radio_comment', 'tttqq', 45, '2023-01-09 12:43:28.599312', 'Deleted'),
(599, 'radio_comment', 'uuuu', 45, '2023-01-11 15:27:31.716573', 'Active'),
(600, 'radio_comment', 'yyyy  ', 45, '2023-01-11 15:27:31.718292', 'Active'),
(601, 'radio_comment', 'yyyy', 45, '2023-01-09 12:54:17.375900', 'Deleted'),
(603, 'mcq', 'hiu', 46, '2023-01-09 12:55:48.437411', 'Deleted'),
(604, 'mcq', 'hiuu', 46, '2023-01-09 12:56:38.435396', 'Deleted'),
(605, 'radio', 'Yess        ', 24, '2023-01-09 15:27:18.380976', 'Active'),
(606, 'radio', 'No', 24, '2023-01-09 12:58:52.952131', 'Deleted'),
(607, 'radio', 'No ', 24, '2023-01-09 13:02:15.008187', 'Deleted'),
(608, 'radio', 'Why?', 24, '2023-01-09 13:02:15.009432', 'Deleted'),
(609, 'radio', 'No', 24, '2023-01-09 13:02:54.546209', 'Deleted'),
(610, 'radio', 'Noo  ', 24, '2023-01-09 15:27:18.382007', 'Deleted'),
(611, 'radio', '??', 24, '2023-01-09 13:03:43.060803', 'Deleted'),
(614, 'radio', 'None', 24, '2023-01-09 15:27:18.382977', 'Deleted'),
(615, 'radio', 'All', 24, '2023-01-09 15:27:18.384067', 'Deleted'),
(616, 'radio', 'test4', 23, '2023-01-09 16:00:50.517393', 'Active'),
(619, 'mcq_comment', ' dfdf                  ', 48, '2023-01-11 10:33:16.270383', 'Active'),
(620, 'radio', 'fdsfsdf        ', 48, '2023-01-10 10:39:37.463681', 'Deleted'),
(621, 'radio', 'ghgfh', 48, '2023-01-09 18:10:13.501377', 'Deleted'),
(622, 'radio', 'hngvhngv', 48, '2023-01-09 18:28:52.429874', 'Deleted'),
(623, 'radio', 'dfdda', 48, '2023-01-10 10:49:34.793039', 'Deleted'),
(624, 'radio', 'fdsfsdf', 48, '2023-01-10 10:55:41.941215', 'Deleted'),
(625, 'radio', 'fssd', 48, '2023-01-10 10:56:28.132194', 'Deleted'),
(626, 'radio', 'gtff', 48, '2023-01-10 10:59:25.816118', 'Deleted'),
(627, 'radio', 'hhnfn', 48, '2023-01-10 10:59:36.481710', 'Deleted'),
(628, 'mcq_comment', 'hgfhf', 48, '2023-01-10 11:12:30.595934', 'Deleted'),
(629, 'mcq_comment', 'hgfhf', 48, '2023-01-10 11:12:31.427702', 'Deleted'),
(630, 'mcq_comment', 'jhj ', 48, '2023-01-10 11:13:13.125362', 'Deleted'),
(631, 'mcq', ' ', 49, '2023-01-10 12:59:35.994499', 'Deleted'),
(632, 'radio', 'fs', 49, '2023-01-10 11:17:31.004653', 'Deleted'),
(633, 'radio', 'sfs', 49, '2023-01-10 12:06:00.138392', 'Deleted'),
(634, 'radio_comment', '   ', 49, '2023-01-10 13:02:35.409675', 'Deleted'),
(635, 'mcq_comment', 'ssq', 49, '2023-01-11 10:30:29.018081', 'Active'),
(636, 'mcq_comment', 'jmk', 49, '2023-01-11 10:30:29.020390', 'Active'),
(637, 'mcq_comment', 'ghf   ', 49, '2023-01-11 10:30:29.022434', 'Active'),
(638, 'mcq_comment', 'jhh                   ', 49, '2023-01-11 10:30:29.024272', 'Active'),
(639, 'mcq', 'jghjg', 49, '2023-01-10 16:02:46.915916', 'Deleted'),
(640, 'mcq_comment', 'fdsf  ', 49, '2023-01-10 13:43:27.130681', 'Deleted'),
(641, 'mcq_comment', 'huu  ', 49, '2023-01-11 10:30:29.026162', 'Active'),
(642, 'mcq_comment', 'ads', 48, '2023-01-11 10:33:16.272475', 'Active'),
(643, 'radio_comment', 'hgh', 45, '2023-01-11 15:27:31.721770', 'Active'),
(644, 'radio_comment', 'hggfh', 45, '2023-01-11 15:27:31.723695', 'Active'),
(645, 'mcq_comment', 'ghgf  ', 46, '2023-01-16 16:52:48.060793', 'Deleted'),
(647, 'mcq', 'Fill in checkbox   ', 35, '2023-01-13 12:01:44.571539', 'Active'),
(648, 'mcq', 'No   ', 35, '2023-01-13 12:01:44.573434', 'Active'),
(650, 'radio', 'fdg', 31, '2023-01-13 11:45:45.605781', 'Deleted'),
(655, 'radio', 'hf', 55, '2023-01-24 14:03:40.072149', 'Active'),
(656, 'radio', 'gh', 55, '2023-01-24 14:03:40.073409', 'Active'),
(657, 'mcq', 'One      ', 59, '2023-01-24 14:17:29.281665', 'Active'),
(658, 'mcq', 'Twoo     ', 59, '2023-01-24 14:17:29.283612', 'Active'),
(659, 'mcq', 'Three  ', 59, '2023-01-24 14:17:29.285886', 'Active'),
(662, 'radio', 'Opt1', 60, '2023-01-24 16:10:52.218400', 'Active'),
(663, 'radio', 'opt2', 60, '2023-01-24 16:10:52.220223', 'Active'),
(664, 'mcq', 'dzcfad', 63, '2023-01-24 16:11:42.121453', 'Active'),
(665, 'mcq', 'fdsf', 63, '2023-01-24 16:11:42.123389', 'Active'),
(666, 'mcq', 'dsffg', 63, '2023-01-24 16:11:42.125187', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(5) NOT NULL,
  `question_description` text NOT NULL,
  `question_type` varchar(50) NOT NULL,
  `question_compulsory` enum('Yes','No') NOT NULL,
  `survey_id` int(5) NOT NULL,
  `q_created_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `q_status` enum('Active','Inactive','Deleted','') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_description`, `question_type`, `question_compulsory`, `survey_id`, `q_created_date`, `q_status`) VALUES
(1, 'file', 'file', 'No', 5, '2023-01-03 18:18:13.726481', 'Active'),
(2, 'Rate us?', 'rating', 'Yes', 5, '2023-01-03 18:18:26.304169', 'Active'),
(3, 'Question 1', 'radio', 'Yes', 1, '2023-01-03 18:24:03.503747', 'Active'),
(4, 'Test', 'mcq_comment', 'No', 1, '2023-01-03 18:24:35.798792', 'Active'),
(5, 'Filee', 'file', 'Yes', 1, '2023-01-03 18:24:49.232086', 'Active'),
(6, 'Ratingg', 'rating', 'Yes', 1, '2023-01-03 18:25:02.994712', 'Active'),
(7, 'Heyy', 'radio_comment', 'No', 1, '2023-01-03 18:25:42.584647', 'Active'),
(8, 'Describee', 'text', 'No', 2, '2023-01-03 18:26:15.062871', 'Active'),
(9, 'One Word??', 'one_word', 'Yes', 2, '2023-01-03 18:26:35.853977', 'Deleted'),
(10, 'Questionnn', 'mcq', 'No', 2, '2023-01-03 18:27:21.712718', 'Active'),
(11, 'Choose one', 'radio', 'No', 2, '2023-01-03 18:36:06.213200', 'Active'),
(12, 'Short Text', 'one_word', 'No', 4, '2023-01-04 11:14:10.027839', 'Active'),
(13, 'How do you know about us?', 'radio', 'Yes', 4, '2023-01-04 11:15:42.017654', 'Active'),
(14, 'Fav Color?', 'radio_comment', 'Yes', 4, '2023-01-04 11:16:50.660910', 'Active'),
(15, 'Upload?', 'file', 'Yes', 4, '2023-01-04 11:17:03.924632', 'Active'),
(16, 'Ratingg??', 'rating', 'Yes', 4, '2023-01-04 11:18:00.501617', 'Active'),
(17, 'Date/Time', 'date', 'No', 6, '2023-01-04 12:22:02.619859', 'Active'),
(18, 'Describe', 'text', 'Yes', 6, '2023-01-04 12:22:22.913049', 'Active'),
(19, 'Fav Sports??', 'radio', 'Yes', 6, '2023-01-04 12:24:03.882810', 'Active'),
(20, 'Select?', 'radio', 'Yes', 5, '2023-01-04 12:31:20.048650', 'Active'),
(21, 'Have you visited the center?', 'radio', 'No', 5, '2023-01-04 12:31:51.409614', 'Active'),
(22, 'Any query? If yes, what?', 'radio_comment', 'Yes', 6, '2023-01-04 12:36:56.845521', 'Active'),
(23, 'Testt', 'radio', 'No', 6, '2023-01-04 13:05:55.644777', 'Active'),
(24, 'Update status?', 'radio', 'Yes', 6, '2023-01-04 13:17:26.075373', 'Active'),
(25, 'Photo', 'file', 'No', 7, '2023-01-04 13:18:42.653091', 'Active'),
(26, 'Details', 'text', 'No', 7, '2023-01-04 13:18:56.622231', 'Active'),
(27, 'Datee', 'date', 'No', 7, '2023-01-04 13:19:27.650593', 'Active'),
(28, 'One_Word', 'one_word', 'Yes', 7, '2023-01-04 13:19:49.409826', 'Active'),
(29, 'sDa', 'radio_comment', 'No', 1, '2023-01-04 17:03:58.327942', 'Deleted'),
(32, 'adsaedf', 'radio_comment', 'Yes', 1, '2023-01-05 12:16:38.011003', 'Active'),
(34, 'ZZZZ', 'text', 'No', 1, '2023-01-05 12:32:57.592232', 'Active'),
(35, 'Detailsss???????', 'mcq', 'No', 1, '2023-01-05 12:47:38.526378', 'Active'),
(38, 'gfdgdf', 'radio_comment', 'No', 7, '2023-01-05 17:19:47.804669', 'Active'),
(40, 'fgdf', 'radio', 'No', 7, '2023-01-05 17:22:12.125352', 'Active'),
(41, 'QQQQ', 'radio_comment', 'No', 7, '2023-01-09 11:01:38.593549', 'Active'),
(42, 'dsadsa', 'rating', 'No', 7, '2023-01-09 11:06:33.050171', 'Active'),
(43, 'dsad', 'rating', 'No', 7, '2023-01-09 11:46:56.098876', 'Deleted'),
(44, 'CHOOSEE', 'radio', 'No', 7, '2023-01-09 11:48:14.212633', 'Active'),
(45, 'rrrr', 'radio_comment', 'No', 1, '2023-01-09 12:31:37.118231', 'Inactive'),
(47, 'ONeword', 'one_word', 'No', 6, '2023-01-09 13:05:04.803020', 'Active'),
(48, 'MCQ_COMMENT', 'mcq_comment', 'No', 6, '2023-01-09 16:01:06.754100', 'Active'),
(49, 'fgd', 'mcq_comment', 'Yes', 6, '2023-01-10 11:13:45.909046', 'Active'),
(50, 'gujgj', 'one_word', 'No', 4, '2023-01-11 12:39:03.659950', 'Deleted'),
(51, 'Date/Time', 'date', 'No', 8, '2023-01-12 16:16:47.657114', 'Active'),
(52, 'nkj', 'file', 'No', 6, '2023-01-12 17:40:13.087244', 'Active'),
(54, 'Rate us?', 'rating', 'No', 6, '2023-01-17 12:32:10.409767', 'Active'),
(55, 'ghgd', 'radio', 'No', 10, '2023-01-24 14:03:40.068741', 'Active'),
(56, 'gfhgf', 'one_word', 'Yes', 10, '2023-01-24 14:03:49.596682', 'Active'),
(57, 'Short text', 'one_word', 'Yes', 8, '2023-01-24 14:15:28.116951', 'Active'),
(58, 'Rate?', 'rating', 'No', 8, '2023-01-24 14:15:41.747545', 'Active'),
(59, 'Multiple Choice!!', 'mcq', 'Yes', 8, '2023-01-24 14:16:06.154300', 'Active'),
(60, 'Rdioo', 'radio', 'Yes', 12, '2023-01-24 16:10:52.213191', 'Active'),
(61, 'RAting', 'rating', 'No', 12, '2023-01-24 16:11:08.686524', 'Active'),
(62, 'File', 'file', 'Yes', 12, '2023-01-24 16:11:26.500915', 'Active'),
(63, 'Mcq', 'mcq', 'No', 12, '2023-01-24 16:11:42.119294', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `question_groups`
--

CREATE TABLE `question_groups` (
  `group_title` varchar(20) NOT NULL,
  `group_description` text NOT NULL,
  `group_display_order` int(20) NOT NULL,
  `group_created_by` varchar(20) NOT NULL,
  `group_created_date` datetime(6) NOT NULL,
  `group_updated_by` varchar(20) NOT NULL,
  `group_updated_date` datetime(6) NOT NULL,
  `group_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surveyinfodata`
--

CREATE TABLE `surveyinfodata` (
  `survey_id` int(5) NOT NULL,
  `survey_title` text NOT NULL,
  `survey_description` text NOT NULL,
  `survey_start_date` date NOT NULL,
  `survey_end_date` date NOT NULL,
  `survey_created_by` varchar(30) NOT NULL,
  `survey_created_date` date NOT NULL DEFAULT current_timestamp(),
  `survey_modified_by` varchar(30) NOT NULL,
  `survey_modified_date` date NOT NULL,
  `survey_status` enum('ACTIVE','INACTIVE','EXPIRED','') NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveyinfodata`
--

INSERT INTO `surveyinfodata` (`survey_id`, `survey_title`, `survey_description`, `survey_start_date`, `survey_end_date`, `survey_created_by`, `survey_created_date`, `survey_modified_by`, `survey_modified_date`, `survey_status`, `status`) VALUES
(1, 'Sample Survey 1', 'Description of Survey!!', '2023-01-03', '2023-01-15', '44', '2023-01-03', '44', '2023-01-03', 'ACTIVE', 'Active'),
(2, 'Sample Survey 2', 'Describe here !!', '2023-01-10', '2023-01-24', '44', '2023-01-03', '44', '2023-01-03', 'INACTIVE', 'Active'),
(3, 'Titleeeee', 'Surveyyy Descriptionnn..', '2023-01-05', '2023-01-31', '44', '2023-01-03', '44', '2023-01-03', 'INACTIVE', 'Active'),
(4, 'Desddcf', 'describe here!!', '2023-01-03', '2023-02-03', '44', '2023-01-03', '44', '2023-01-03', 'ACTIVE', 'Active'),
(5, 'Demo Survey', 'Descriptionnnnn', '2023-01-03', '2023-01-08', '44', '2023-01-03', '44', '2023-01-03', 'EXPIRED', 'Active'),
(6, 'Demo Survey1', 'Demoooo Description', '2023-01-03', '2023-01-31', '77', '2023-01-03', '77', '2023-01-03', 'ACTIVE', 'Active'),
(7, 'Survey 22', 'testinggg surveyyy', '2023-01-24', '2023-01-31', '77', '2023-01-03', '77', '2023-01-24', 'INACTIVE', 'Active'),
(8, 'Testinggg', 'Test description', '2023-01-03', '2023-01-04', '77', '2023-01-03', '77', '2023-01-03', 'INACTIVE', 'Active'),
(9, 'SURVEY TITLE', 'SURVEY DESCRIPTION', '2023-01-20', '2023-01-31', '44', '2023-01-17', '44', '2023-01-17', 'INACTIVE', 'Active'),
(11, '[;pjghj', 'jhyt', '2023-01-24', '2023-01-25', '44', '2023-01-24', '44', '2023-01-24', 'INACTIVE', 'Deleted'),
(12, 'Surveyy', 'Survey Descriptionnn!!', '2023-01-24', '2023-01-25', '44', '2023-01-24', '44', '2023-01-24', 'EXPIRED', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_id` int(11) NOT NULL,
  `User_name` varchar(50) NOT NULL,
  `User_gender` varchar(20) NOT NULL,
  `Contact_number` varchar(50) NOT NULL,
  `User_role` varchar(10) NOT NULL,
  `User_email` varchar(30) NOT NULL,
  `User_password` varchar(50) NOT NULL,
  `User_created_by` varchar(30) NOT NULL,
  `user_created_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `User_updated_by` varchar(30) NOT NULL,
  `User_updated_date` datetime(6) NOT NULL,
  `u_status` enum('Active','Deleted','','') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `User_name`, `User_gender`, `Contact_number`, `User_role`, `User_email`, `User_password`, `User_created_by`, `user_created_date`, `User_updated_by`, `User_updated_date`, `u_status`) VALUES
(44, 'Demooo', 'Male', '9988667755', 'Admin', 'demo@gmail.com', 'befdfc2736c6ac62b1a0b685866f7185', '', '2022-10-20 18:09:46.268515', '44', '2023-01-24 13:35:58.000000', 'Active'),
(47, 'demo', 'Male', '2345167894', 'Admin', 'demo@gmail.com', 'befdfc2736c6ac62b1a0b685866f7185', '', '2022-10-20 18:09:46.268515', '44', '2023-01-24 13:35:58.000000', 'Deleted'),
(48, 'demo', 'Male', '2345167894', 'Admin', 'demo@gmail.com', 'befdfc2736c6ac62b1a0b685866f7185', '', '2022-10-20 18:09:46.268515', '44', '2023-01-24 13:35:58.000000', 'Active'),
(64, 'test', 'Male', '2345167894', 'Admin', 'abcd@gmail.com', 'ed63a4e6a3729ebf66b817c08e29ad09', '', '2022-10-20 18:09:46.268515', '43', '2022-11-01 12:17:38.000000', 'Active'),
(74, 'abb', 'Male', '4354637455', 'User', 'abb@gmail.com', 'ce47342d721ad55b2473160c2b1d7c2a', '43', '2022-10-31 18:44:54.825371', '43', '2022-11-01 11:45:24.000000', 'Deleted'),
(75, 'Srishti', 'Female', '9999887766', 'User', 'srishti@gmail.com', 'dixHGFlv', '44', '2022-11-02 17:05:51.201045', '44', '2022-11-02 17:05:51.000000', 'Active'),
(76, 'Nitesh', 'Male', '8769856744', 'User', 'nitesh@gmail.com', 'fdf74c616d3219a42bc0a2fc9ad99ca7', '44', '2022-11-02 17:07:37.739773', '44', '2022-11-02 17:07:37.000000', 'Active'),
(77, 'User', 'Female', '7017456776', 'User', 'sneha@gmail.com', 'd170cf8f53670d218711c42dcb61fb65', '44', '2022-11-02 17:10:17.423144', '77', '2023-01-03 18:19:39.000000', 'Active'),
(78, 'sss', 'Male', '2345167894', 'User', 'ss@gmail.com', 'e666dd6e9fec5816f0f7fca01580ed8c', '44', '2022-11-02 17:43:23.203406', '44', '2022-11-02 17:43:23.000000', 'Deleted'),
(79, 'frdgf', 'Male', '3456777777', 'User', 'fgvfd@hy.in', '786a399884a7dd9c410f99029bc4ff2a', '44', '2022-11-03 11:09:14.084763', '44', '2022-11-03 11:09:14.000000', 'Deleted'),
(80, 'fgfs', 'Male', '4354637455', 'User', 'gfhgfc@dfd.in', '80f18354421542d34faf599796121c65', '44', '2022-11-03 12:58:54.753212', '44', '2022-11-03 12:58:54.000000', 'Deleted'),
(88, 'Krati ', 'Female', '7017456773', 'Admin', 'kratigarg077@gmail.com', 'c6029e33be995f5520e9d98d460801e5', '44', '2022-11-04 17:48:55.729610', '44', '2022-11-04 17:48:55.000000', 'Active'),
(94, 'bgg', 'Male', '4354637455', 'User', 'bg@gmail.com', '2219661c6a2a3ffee48d000d7170380f', '83', '2022-11-04 17:54:44.238319', '83', '2022-11-04 17:54:44.000000', 'Deleted'),
(96, 'Aditya', 'Male', '4354637455', 'User', 'kumaradi360@gmail.com', '22f93cf05432183a6f23b69f1ba27943', '83', '2022-11-04 18:01:40.230618', '83', '2022-11-04 18:01:40.000000', 'Deleted'),
(110, 'Krati', 'Female', '1114445255', 'User', 'kratigarg077@gmail.com', 'ee611e17096d84a22cfce0c1eabf2b90', '44', '2022-11-07 17:21:44.141383', '44', '2022-11-07 17:21:44.000000', 'Active'),
(114, 'Shivangi', 'Female', '7817456773', 'User', 'kratigarg077@gmail.com', 'de82a4424be38b2768e66fb4b2f9c1ac', '44', '2022-11-07 18:48:56.023143', '44', '2022-11-07 18:48:56.000000', 'Active'),
(115, 'Krati Garg', 'Female', '4354637455', 'User', 'kumaradi360@gmail.com', '0ed01c0ef0a6807e07dfabea302ac1d7', '44', '2022-11-07 18:53:55.908380', '44', '2022-11-07 18:53:55.000000', 'Deleted'),
(119, 'kkk', 'Female', '2345167894', 'User', 'kratigarg077@gmail.com', '03001ffcf2833546ba94ee567b9526e1', '44', '2022-11-09 19:14:15.397817', '44', '2022-11-09 19:14:11.000000', 'Deleted'),
(120, 'cfdsf', 'Male', '4354637455', 'User', 'sf@gmail.com', 'e65c5a86d866062756850d6b11bbd162', '44', '2022-11-10 13:27:45.678031', '44', '2022-11-10 13:27:41.000000', 'Deleted'),
(121, 'dffdsfsd', 'Male', '2345167894', 'User', 'dfvf@gmail.com', '976793b8893718c5ef2d2d5e6a6190d2', '44', '2022-11-10 13:29:07.589732', '44', '2022-11-10 13:29:03.000000', 'Deleted'),
(122, 'sds', 'Male', '2345167894', 'User', 'ax@gmail.com', '7b76f032ab2d9790cf1e31c8bc057f84', '44', '2022-11-10 13:30:02.796962', '44', '2022-11-10 13:29:58.000000', 'Active'),
(123, 'sdsDFD', 'Female', '2345167894', 'User', 'SDSD@gmail.com', '9dcdb95f7369745d1c6f2f4b2d5b9913', '44', '2022-11-10 13:31:03.317211', '44', '2022-11-10 13:30:59.000000', 'Active'),
(124, 'ss', 'Male', '2345167894', 'User', 'ss@gmail.com', '7bef5f0e590dba8e4304f0375be07eb3', '44', '2022-11-10 15:27:18.935775', '44', '2022-11-10 15:27:14.000000', 'Active'),
(125, 'dsd', 'Male', '1114445255', 'User', 'dsd@gmail.com', 'bdf7a74e07bfe185f7d2dd0c5ca9321d', '44', '2022-11-10 15:28:16.084755', '44', '2022-11-10 15:28:11.000000', 'Active'),
(126, 'dxsd', 'Male', '2345167894', 'User', 'dsf@gmail.com', '4a8843f50b5ce57cd16cbfad4c4a77a2', '44', '2022-11-10 15:29:42.511174', '44', '2022-11-10 15:29:38.000000', 'Active'),
(127, 'szfdzf', 'Male', '7788996745', 'User', 'zf@gmail.com', 'e3d70387dda74cfdc8b62f37490cd388', '44', '2022-11-10 16:37:57.115335', '44', '2022-11-10 16:37:53.000000', 'Active'),
(128, 'rt', 'Female', '7788996745', 'User', 'frr@gmail.com', '6493dc8e84bcf498155635aad33adc71', '44', '2022-11-10 16:38:15.890608', '44', '2022-11-10 16:38:12.000000', 'Active'),
(129, 'sda', 'Male', '1234567890', 'User', 'khjj@gmail.com', '9231c80fba863c05d0d042a6125b27d0', '44', '2022-11-10 17:41:20.301869', '44', '2022-11-10 17:41:16.000000', 'Active'),
(130, 'wfedg', 'Male', '9867556644', 'User', 'jkjkjhk@gmail.com', 'd3ad4566ad386a7f47181d9fa1227371', '44', '2022-11-10 17:55:58.584258', '44', '2022-11-10 17:55:54.000000', 'Deleted'),
(131, 'kk', 'Male', '4354637455', 'User', 'lll@gmail.com', '7c3fbf52d996eef10425d1310a6f5513', '44', '2022-11-10 18:43:35.435000', '44', '2022-11-10 18:43:31.000000', 'Active'),
(132, 'heyyy', 'Male', '4354637455', 'User', 'heyyy@gmail.com', '34cc6048ee56a483c51b4a6bb6a573dd', '44', '2022-11-10 18:49:06.294706', '44', '2022-11-10 18:49:02.000000', 'Deleted'),
(133, 'abc', 'Male', '2345167894', 'User', 'dfdo@gmail.com', 'b7e52d55940ee510a95124352a1baf07', '44', '2022-11-10 19:15:24.149969', '44', '2022-11-10 19:15:20.000000', 'Deleted'),
(134, 'gftyth', 'Male', '2345167894', 'User', 'sepewos468@klblogs.com', 'c8253070621442531a0b2bb20c1f1c30', '44', '2022-11-10 19:17:52.232760', '44', '2022-11-10 19:17:48.000000', 'Deleted'),
(135, 'fdg', 'Male', '2345167894', 'User', 'fdg@gmail.com', 'bca7cada47fd89dd3eaaed547728c034', '44', '2022-11-18 17:25:25.102416', '44', '2022-11-18 17:25:21.000000', 'Deleted'),
(136, 'Sample User', 'Male', '9877665548', 'User', 'user@gmail.com', '01ef634f66e8ef3c16bf16b9cabc0092', '44', '2022-11-23 17:56:46.079776', '44', '2022-11-23 17:56:42.000000', 'Active'),
(137, 'abc', 'Male', '4354637455', 'Admin', 'abcdsss@gmail.com', 'f0cccd09f6d6b46993d6bee13968fd99', '44', '2022-11-28 16:32:55.661455', '44', '2022-11-28 16:32:51.000000', 'Active'),
(138, 'Krati Garg', 'Female', '4354637455', 'User', 'kratigarg01@gmail.com', 'a7b5f400771fc281edaccecc1ee2e784', '44', '2022-12-05 11:16:00.378544', '44', '2022-12-05 11:15:56.000000', 'Active'),
(139, 'Manager', 'Male', '7017456774', 'Management', 'kumaradi360@gmail.com', '08864b9cb704cda8614f6fa9efd61067', '44', '2023-01-04 15:14:47.070854', '139', '2023-01-04 15:30:31.000000', 'Active'),
(140, 'bfc', 'Male', '2345167894', 'User', 'bgfb@gmail.com', 'dc726689a554a12f75774bff1a7a2503', '44', '2023-01-24 13:30:54.180672', '44', '2023-01-24 13:30:50.000000', 'Deleted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`invitation_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `surveyinfodata`
--
ALTER TABLE `surveyinfodata`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `invitation_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=667;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `surveyinfodata`
--
ALTER TABLE `surveyinfodata`
  MODIFY `survey_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
