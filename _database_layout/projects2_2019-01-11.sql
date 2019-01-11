# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.2.13-MariaDB)
# Database: projects2
# Generation Time: 2019-01-11 22:17:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table customers
# ------------------------------------------------------------

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_city` varchar(30) NOT NULL,
  `customer_state` varchar(2) NOT NULL,
  `customer_zip` varchar(5) NOT NULL,
  `customer_phone` varchar(10) NOT NULL,
  `customer_details` text NOT NULL,
  `customer_status` varchar(15) NOT NULL,
  `customer_adsi_project_manager` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `customer_name` (`customer_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table customers_contacts
# ------------------------------------------------------------

CREATE TABLE `customers_contacts` (
  `customer_contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_title` varchar(100) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_phone2` varchar(15) NOT NULL,
  `contact_email` varchar(250) NOT NULL,
  `contact_phone_type` varchar(15) NOT NULL,
  `contact_phone_type2` varchar(15) NOT NULL,
  PRIMARY KEY (`customer_contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table customers_notes
# ------------------------------------------------------------

CREATE TABLE `customers_notes` (
  `customer_note_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`customer_note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table customers_reminders
# ------------------------------------------------------------

CREATE TABLE `customers_reminders` (
  `customer_reminder_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reminder_title` varchar(250) NOT NULL,
  `reminder_description` text NOT NULL,
  `reminder_date` varchar(8) NOT NULL,
  PRIMARY KEY (`customer_reminder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table customers_reminders_employees
# ------------------------------------------------------------

CREATE TABLE `customers_reminders_employees` (
  `customer_reminder_employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `customer_reminder_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_reminder_employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table customers_systems
# ------------------------------------------------------------

CREATE TABLE `customers_systems` (
  `customer_system_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `system_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table departments
# ------------------------------------------------------------

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL,
  PRIMARY KEY (`department_id`),
  KEY `department_name` (`department_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table departments_employees
# ------------------------------------------------------------

CREATE TABLE `departments_employees` (
  `department_employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`department_employee_id`),
  KEY `employee_id` (`employee_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table departments_projects
# ------------------------------------------------------------

CREATE TABLE `departments_projects` (
  `department_project_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`department_project_id`),
  KEY `department_id` (`department_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table departments_support
# ------------------------------------------------------------

CREATE TABLE `departments_support` (
  `department_support_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  PRIMARY KEY (`department_support_id`),
  KEY `department_id` (`department_id`),
  KEY `support_id` (`support_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table employees
# ------------------------------------------------------------

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(100) NOT NULL,
  `employee_username` varchar(20) NOT NULL,
  `employee_password` varchar(60) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_admin` varchar(7) NOT NULL,
  `employee_info` text NOT NULL,
  `employee_sales` varchar(7) NOT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `employee_name` (`employee_name`),
  KEY `employee_username` (`employee_username`),
  KEY `employee_admin` (`employee_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_username`, `employee_password`, `employee_email`, `employee_admin`, `employee_info`, `employee_sales`)
VALUES
	(2,'Admin Account','admin','$2y$10$i3SKdxlOMw40V70nhqk/1.PuY7kcLEVCxZZIAyPihjWuABSGH4RR6','admin@example.com','CHECKED','','');

/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employees_projects
# ------------------------------------------------------------

CREATE TABLE `employees_projects` (
  `employee_project_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_project_id`),
  KEY `employee_id` (`employee_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table employees_reminders
# ------------------------------------------------------------

CREATE TABLE `employees_reminders` (
  `employee_reminder_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `reminder_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_reminder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table employees_support
# ------------------------------------------------------------

CREATE TABLE `employees_support` (
  `employee_support_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_support_id`),
  KEY `employee_id` (`employee_id`),
  KEY `support_id` (`support_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table projects
# ------------------------------------------------------------

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `project_tags` varchar(100) NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `customer_id` (`customer_id`),
  KEY `project_name` (`project_name`),
  KEY `project_date` (`project_date`),
  KEY `project_status` (`project_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table projects_files
# ------------------------------------------------------------

CREATE TABLE `projects_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `project_id` (`project_id`),
  KEY `file_name` (`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table projects_tasks
# ------------------------------------------------------------

CREATE TABLE `projects_tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `task` varchar(250) NOT NULL,
  `task_status` char(1) NOT NULL,
  `task_date` varchar(8) NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table sessions
# ------------------------------------------------------------

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table support
# ------------------------------------------------------------

CREATE TABLE `support` (
  `support_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `support_archived_date` varchar(8) NOT NULL,
  PRIMARY KEY (`support_id`),
  KEY `customer_id` (`customer_id`),
  KEY `support_name` (`support_name`),
  KEY `support_date` (`support_date`),
  KEY `support_status` (`support_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table support_files
# ------------------------------------------------------------

CREATE TABLE `support_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `support_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `support_id` (`support_id`),
  KEY `file_name` (`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table support_tasks
# ------------------------------------------------------------

CREATE TABLE `support_tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `support_id` int(11) NOT NULL,
  `task` varchar(250) NOT NULL,
  `task_status` char(1) NOT NULL,
  `task_date` varchar(8) NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `project_id` (`support_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table systems
# ------------------------------------------------------------

CREATE TABLE `systems` (
  `system_id` int(11) NOT NULL AUTO_INCREMENT,
  `system_code` varchar(10) NOT NULL,
  `system_name` varchar(100) NOT NULL,
  PRIMARY KEY (`system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
