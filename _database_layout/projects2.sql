-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2019 at 06:41 AM
-- Server version: 5.7.17
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects2`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_city` varchar(30) NOT NULL,
  `customer_state` varchar(2) NOT NULL,
  `customer_zip` varchar(5) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `customer_details` text NOT NULL,
  `customer_status` varchar(15) NOT NULL,
  `customer_adsi_project_manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers_contacts`
--

CREATE TABLE `customers_contacts` (
  `customer_contact_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_title` varchar(100) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_phone2` varchar(15) NOT NULL,
  `contact_email` varchar(250) NOT NULL,
  `contact_phone_type` varchar(15) NOT NULL,
  `contact_phone_type2` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers_notes`
--

CREATE TABLE `customers_notes` (
  `note_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers_reminders`
--

CREATE TABLE `customers_reminders` (
  `customer_reminder_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reminder_title` varchar(250) NOT NULL,
  `reminder_description` text NOT NULL,
  `reminder_date` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers_reminders_employees`
--

CREATE TABLE `customers_reminders_employees` (
  `customer_reminder_employee_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `customer_reminder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers_systems`
--

CREATE TABLE `customers_systems` (
  `customer_system_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `system_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments_employees`
--

CREATE TABLE `departments_employees` (
  `department_employee_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments_projects`
--

CREATE TABLE `departments_projects` (
  `department_project_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments_support`
--

CREATE TABLE `departments_support` (
  `department_support_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_username` varchar(20) NOT NULL,
  `employee_password` varchar(60) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_admin` varchar(7) NOT NULL,
  `employee_info` text NOT NULL,
  `employee_sales` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_username`, `employee_password`, `employee_email`, `employee_admin`, `employee_info`, `employee_sales`) VALUES
(2, 'Admin Account', 'admin', '$2y$10$i3SKdxlOMw40V70nhqk/1.PuY7kcLEVCxZZIAyPihjWuABSGH4RR6', 'admin@example.com', 'CHECKED', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees_projects`
--

CREATE TABLE `employees_projects` (
  `employee_project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees_reminders`
--

CREATE TABLE `employees_reminders` (
  `employee_reminder_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reminder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees_support`
--

CREATE TABLE `employees_support` (
  `employee_support_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_type` char(1) NOT NULL,
  `project_details` text NOT NULL,
  `project_date` varchar(8) NOT NULL,
  `project_due_date` varchar(8) NOT NULL,
  `project_approved_date` varchar(8) NOT NULL,
  `project_start_date` varchar(8) NOT NULL,
  `project_completed_date` varchar(8) NOT NULL,
  `project_archived_date` varchar(8) NOT NULL,
  `project_labor` int(2) NOT NULL,
  `project_quote` varchar(15) NOT NULL,
  `project_status` char(1) NOT NULL,
  `project_tags` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects_files`
--

CREATE TABLE `projects_files` (
  `file_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects_tasks`
--

CREATE TABLE `projects_tasks` (
  `task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task` varchar(250) NOT NULL,
  `task_status` char(1) NOT NULL,
  `task_date` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `support_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `support_name` varchar(100) NOT NULL,
  `support_details` text NOT NULL,
  `support_date` varchar(8) NOT NULL,
  `support_time` varchar(4) NOT NULL,
  `support_duration_days` int(2) NOT NULL,
  `support_duration_hours` int(2) NOT NULL,
  `support_duration_minutes` int(2) NOT NULL,
  `support_status` char(1) NOT NULL,
  `support_tags` varchar(100) NOT NULL,
  `support_complete_date` varchar(8) NOT NULL,
  `support_complete_time` varchar(4) NOT NULL,
  `support_closed_date` varchar(8) NOT NULL,
  `support_archived_date` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `support_files`
--

CREATE TABLE `support_files` (
  `file_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `support_tasks`
--

CREATE TABLE `support_tasks` (
  `task_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  `task` varchar(250) NOT NULL,
  `task_status` char(1) NOT NULL,
  `task_date` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `system_id` int(11) NOT NULL,
  `system_code` varchar(10) NOT NULL,
  `system_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_name` (`customer_name`);

--
-- Indexes for table `customers_contacts`
--
ALTER TABLE `customers_contacts`
  ADD PRIMARY KEY (`customer_contact_id`);

--
-- Indexes for table `customers_notes`
--
ALTER TABLE `customers_notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `customers_reminders`
--
ALTER TABLE `customers_reminders`
  ADD PRIMARY KEY (`customer_reminder_id`);

--
-- Indexes for table `customers_reminders_employees`
--
ALTER TABLE `customers_reminders_employees`
  ADD PRIMARY KEY (`customer_reminder_employee_id`);

--
-- Indexes for table `customers_systems`
--
ALTER TABLE `customers_systems`
  ADD PRIMARY KEY (`customer_system_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `department_name` (`department_name`);

--
-- Indexes for table `departments_employees`
--
ALTER TABLE `departments_employees`
  ADD PRIMARY KEY (`department_employee_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `departments_projects`
--
ALTER TABLE `departments_projects`
  ADD PRIMARY KEY (`department_project_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `departments_support`
--
ALTER TABLE `departments_support`
  ADD PRIMARY KEY (`department_support_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `support_id` (`support_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_name` (`employee_name`),
  ADD KEY `employee_username` (`employee_username`),
  ADD KEY `employee_admin` (`employee_admin`);

--
-- Indexes for table `employees_projects`
--
ALTER TABLE `employees_projects`
  ADD PRIMARY KEY (`employee_project_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `employees_reminders`
--
ALTER TABLE `employees_reminders`
  ADD PRIMARY KEY (`employee_reminder_id`);

--
-- Indexes for table `employees_support`
--
ALTER TABLE `employees_support`
  ADD PRIMARY KEY (`employee_support_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `support_id` (`support_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `project_name` (`project_name`),
  ADD KEY `project_date` (`project_date`),
  ADD KEY `project_status` (`project_status`);

--
-- Indexes for table `projects_files`
--
ALTER TABLE `projects_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `file_name` (`file_name`);

--
-- Indexes for table `projects_tasks`
--
ALTER TABLE `projects_tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`support_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `support_name` (`support_name`),
  ADD KEY `support_date` (`support_date`),
  ADD KEY `support_status` (`support_status`);

--
-- Indexes for table `support_files`
--
ALTER TABLE `support_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `support_id` (`support_id`),
  ADD KEY `file_name` (`file_name`);

--
-- Indexes for table `support_tasks`
--
ALTER TABLE `support_tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `project_id` (`support_id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`system_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers_contacts`
--
ALTER TABLE `customers_contacts`
  MODIFY `customer_contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers_notes`
--
ALTER TABLE `customers_notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers_reminders`
--
ALTER TABLE `customers_reminders`
  MODIFY `customer_reminder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers_reminders_employees`
--
ALTER TABLE `customers_reminders_employees`
  MODIFY `customer_reminder_employee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers_systems`
--
ALTER TABLE `customers_systems`
  MODIFY `customer_system_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments_employees`
--
ALTER TABLE `departments_employees`
  MODIFY `department_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `departments_projects`
--
ALTER TABLE `departments_projects`
  MODIFY `department_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `departments_support`
--
ALTER TABLE `departments_support`
  MODIFY `department_support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees_projects`
--
ALTER TABLE `employees_projects`
  MODIFY `employee_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employees_reminders`
--
ALTER TABLE `employees_reminders`
  MODIFY `employee_reminder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees_support`
--
ALTER TABLE `employees_support`
  MODIFY `employee_support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `projects_files`
--
ALTER TABLE `projects_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `projects_tasks`
--
ALTER TABLE `projects_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `support_files`
--
ALTER TABLE `support_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `support_tasks`
--
ALTER TABLE `support_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `system_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
