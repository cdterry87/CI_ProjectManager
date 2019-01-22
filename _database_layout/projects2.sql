-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 22, 2019 at 02:09 AM
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
  `customer_project_manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_address`, `customer_city`, `customer_state`, `customer_zip`, `customer_phone`, `customer_details`, `customer_status`, `customer_project_manager`) VALUES
(1, 'Sample Customer', '', 'Sample City', 'MS', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur blandit, dui vitae faucibus condimentum, dui velit lobortis ligula, id vulputate tellus lorem eu ipsum. Etiam et dictum enim. Phasellus eleifend urna eu metus mollis ullamcorper. Integer mattis, metus in congue consequat, lorem arcu aliquam leo, non volutpat lorem nibh et odio. Fusce sodales ligula eu blandit ultrices. Phasellus non lacus sed risus varius tempor. Maecenas interdum est tellus. Donec maximus odio eget libero molestie porttitor. Praesent eu maximus lacus.</p>\r\n<p>&nbsp;</p>\r\n<p>Aenean ac mattis diam. Nulla viverra nunc non sollicitudin porta. Nam porttitor dui augue, et pellentesque nibh molestie a. Cras enim lectus, aliquam sit amet faucibus vel, finibus at dui. Sed enim lorem, feugiat et pharetra et, vulputate ac turpis. Aliquam mattis porttitor arcu, eget bibendum felis pulvinar ac. Sed elementum iaculis tellus vestibulum varius. Aenean et felis nec nisl convallis cursus. Ut tempus lorem sem, id tincidunt nisl pretium a. Donec tempor, purus nec mollis aliquet, felis augue maximus augue, viverra dignissim lorem nibh sed mauris.</p>', 'live', 2);

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
  `contact_phone_alt` varchar(15) NOT NULL DEFAULT '',
  `contact_email` varchar(250) NOT NULL,
  `contact_phone_type` varchar(15) NOT NULL,
  `contact_phone_alt_type` varchar(15) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_contacts`
--

INSERT INTO `customers_contacts` (`customer_contact_id`, `customer_id`, `contact_name`, `contact_title`, `contact_phone`, `contact_phone_alt`, `contact_email`, `contact_phone_type`, `contact_phone_alt_type`) VALUES
(1, 1, 'John Smith', 'Administrator', '', '', 'johnsmith@example.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers_files`
--

CREATE TABLE `customers_files` (
  `file_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers_notes`
--

CREATE TABLE `customers_notes` (
  `customer_note_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_notes`
--

INSERT INTO `customers_notes` (`customer_note_id`, `customer_id`, `employee_id`, `note`, `datetime`) VALUES
(1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam et leo dignissim, sodales justo ut, placerat neque. Suspendisse molestie euismod mi, ac lacinia augue. Quisque dictum pulvinar laoreet. Praesent at massa vitae magna laoreet lacinia. Maecenas a neque id massa ullamcorper tempor eu at metus. Morbi accumsan magna vel magna pretium pharetra.', '2019-01-22 02:05:37'),
(2, 1, 1, 'Integer in enim at mi pretium pretium. Integer molestie, nisi ac rutrum interdum, mauris justo varius enim, a dictum odio lectus in massa. Vestibulum convallis euismod orci, id elementum lorem maximus euismod. ', '2019-01-22 02:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `customers_reminders`
--

CREATE TABLE `customers_reminders` (
  `customer_reminder_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reminder` text NOT NULL,
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

--
-- Dumping data for table `customers_systems`
--

INSERT INTO `customers_systems` (`customer_system_id`, `customer_id`, `system_id`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'Sample Department');

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

--
-- Dumping data for table `departments_projects`
--

INSERT INTO `departments_projects` (`department_project_id`, `department_id`, `project_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments_support`
--

CREATE TABLE `departments_support` (
  `department_support_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments_support`
--

INSERT INTO `departments_support` (`department_support_id`, `department_id`, `support_id`) VALUES
(1, 1, 1);

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
(1, 'Admin Account', 'admin', '$2y$10$i3SKdxlOMw40V70nhqk/1.PuY7kcLEVCxZZIAyPihjWuABSGH4RR6', 'admin@example.com', 'CHECKED', '', ''),
(2, 'Sales Account', 'sales', '$2y$10$PmMjHGiSw4JA75RLwqO1ZuQWwkx.3ugzuDrYQDBM4jCfODVCvEu/K', 'sales@example.com', '', '', 'CHECKED'),
(3, 'User Account', 'user', '$2y$10$SU9IU0EZygaI1g1fz.n8PuNJM7ohu5E/69Ft6egy9g0grfNbPYeeC', 'user@example.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees_projects`
--

CREATE TABLE `employees_projects` (
  `employee_project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees_projects`
--

INSERT INTO `employees_projects` (`employee_project_id`, `employee_id`, `project_id`) VALUES
(1, 1, 1),
(2, 3, 1);

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

--
-- Dumping data for table `employees_support`
--

INSERT INTO `employees_support` (`employee_support_id`, `employee_id`, `support_id`) VALUES
(1, 1, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `files_documentation`
--

CREATE TABLE `files_documentation` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_title` varchar(100) NOT NULL,
  `file_description` text NOT NULL,
  `file_size` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `files_forms`
--

CREATE TABLE `files_forms` (
  `file_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_title` varchar(100) NOT NULL,
  `file_description` text NOT NULL,
  `file_size` varchar(30) NOT NULL
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
  `project_start_date` varchar(8) NOT NULL,
  `project_completed_date` varchar(8) NOT NULL,
  `project_archived_date` varchar(8) NOT NULL,
  `project_status` char(1) NOT NULL,
  `project_estimated_completion_date` varchar(8) NOT NULL,
  `project_lead` int(11) NOT NULL,
  `project_percentage_completed` varchar(3) NOT NULL,
  `project_approved` varchar(1) NOT NULL,
  `project_approved_by` int(11) NOT NULL,
  `project_approved_date` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `customer_id`, `project_name`, `project_type`, `project_details`, `project_date`, `project_due_date`, `project_start_date`, `project_completed_date`, `project_archived_date`, `project_status`, `project_estimated_completion_date`, `project_lead`, `project_percentage_completed`, `project_approved`, `project_approved_by`, `project_approved_date`) VALUES
(1, 1, 'Sample Project', 'P', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae posuere velit. Sed mollis urna ante, non ultricies lectus hendrerit a. Nam est magna, lacinia id purus vel, dapibus pulvinar enim. Pellentesque aliquam fringilla urna quis dignissim. Fusce bibendum libero lectus, ac egestas tellus lobortis quis. Fusce ante ligula, placerat feugiat velit ac, vestibulum sollicitudin enim. Nulla facilisi.</p>\r\n<p>&nbsp;</p>\r\n<p>Aenean mollis augue et metus maximus, quis tincidunt nulla lacinia. Sed viverra arcu vel ultricies luctus. Sed tellus purus, commodo quis mauris et, finibus posuere est. Donec lorem lacus, vulputate ac nulla vel, sagittis convallis ex. Curabitur eros arcu, egestas vel arcu vel, dapibus interdum purus. Phasellus aliquet erat feugiat blandit auctor. Vivamus tempor blandit lorem quis posuere. Integer condimentum iaculis eros ac ultricies. Etiam ut consectetur lorem.</p>\r\n<p>&nbsp;</p>\r\n<p>Nam eu eros vel odio luctus lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed faucibus, lectus nec cursus aliquam, purus neque congue mi, ac consectetur mi tellus sed neque. Duis euismod odio mollis pulvinar tristique. In volutpat, nunc id bibendum pulvinar, nibh leo rhoncus nunc, in scelerisque orci purus sit amet sapien. Vestibulum eget neque nunc. Maecenas bibendum libero at ullamcorper mollis. Mauris hendrerit eros id vehicula pharetra. Nulla facilisi.</p>', '20190121', '', '', '', '', 'I', '20191230', 3, '25', '', 0, '');

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
-- Table structure for table `projects_history`
--

CREATE TABLE `projects_history` (
  `project_history_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `history_action` varchar(50) NOT NULL,
  `history_employee_id` int(11) NOT NULL,
  `history_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects_history`
--

INSERT INTO `projects_history` (`project_history_id`, `project_id`, `history_action`, `history_employee_id`, `history_datetime`) VALUES
(1, 1, 'Project created', 1, '2019-01-22 01:56:50'),
(2, 1, 'Task #1 created', 1, '2019-01-22 01:58:50'),
(3, 1, 'Note #1 created', 1, '2019-01-22 01:59:18'),
(4, 1, 'Task #2 created', 1, '2019-01-22 02:00:57'),
(5, 1, 'Task #3 created', 1, '2019-01-22 02:02:59'),
(6, 1, 'Note #2 created', 1, '2019-01-22 02:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `projects_notes`
--

CREATE TABLE `projects_notes` (
  `project_note_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_notes`
--

INSERT INTO `projects_notes` (`project_note_id`, `project_id`, `employee_id`, `note`, `datetime`) VALUES
(1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquet mi augue, sit amet iaculis nibh congue eu. Phasellus ut sapien sed elit mattis luctus ac in nulla. Nunc eu est nec nulla fermentum imperdiet id sed nulla. Praesent nec venenatis leo. Maecenas in augue sed nisl venenatis cursus.', '2019-01-22 01:59:18'),
(2, 1, 1, 'Phasellus eleifend felis ac tempus viverra. Quisque eu sapien odio. Nam dictum, justo nec pretium suscipit, risus arcu malesuada tortor, et faucibus lorem neque quis enim. Vestibulum tincidunt, risus convallis accumsan egestas, sapien tortor convallis diam, vel egestas orci odio sit amet justo.', '2019-01-22 02:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `projects_reminders`
--

CREATE TABLE `projects_reminders` (
  `project_reminder_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reminder` text NOT NULL,
  `reminder_date` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects_reminders_employees`
--

CREATE TABLE `projects_reminders_employees` (
  `project_reminder_employee_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `project_reminder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects_tasks`
--

CREATE TABLE `projects_tasks` (
  `project_task_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `task_description` text NOT NULL,
  `task_date` varchar(8) NOT NULL,
  `task_assigned_by` int(11) NOT NULL,
  `task_assigned_date` varchar(8) NOT NULL,
  `task_start_date` varchar(8) NOT NULL,
  `task_due_date` varchar(8) NOT NULL,
  `task_completed_date` varchar(8) NOT NULL,
  `task_completed_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_tasks`
--

INSERT INTO `projects_tasks` (`project_task_id`, `project_id`, `task_title`, `task_description`, `task_date`, `task_assigned_by`, `task_assigned_date`, `task_start_date`, `task_due_date`, `task_completed_date`, `task_completed_by`) VALUES
(1, 1, 'A Sample Task', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque velit lacus, congue quis sagittis eget, fringilla quis lorem. Nunc posuere euismod lorem a sollicitudin. Etiam feugiat molestie ornare.', '20190122', 1, '20190122', '20190121', '20190121', '', 0),
(2, 1, 'Another Sample Task', 'Nam sagittis erat lectus, quis facilisis tortor vehicula vitae. Fusce at blandit augue. Duis bibendum, ipsum eu aliquam lobortis, ante ex condimentum justo, nec congue mauris sem ut felis. ', '20190122', 1, '20190321', '20190321', '20191230', '', 0),
(3, 1, 'A Completed Sample Task', 'Mauris consectetur, mi vitae volutpat tristique, odio mi sollicitudin ligula, ac vulputate felis quam in dui. Praesent vehicula faucibus urna sed tempus.', '20190122', 1, '20190121', '20190121', '20190121', '20190121', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects_tasks_employees`
--

CREATE TABLE `projects_tasks_employees` (
  `project_task_employee_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `project_task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_tasks_employees`
--

INSERT INTO `projects_tasks_employees` (`project_task_employee_id`, `employee_id`, `project_task_id`) VALUES
(1, 3, 1),
(2, 1, 2),
(3, 3, 2),
(4, 3, 3);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('uqf26s7sneiddlhb5mfidq2l3vhu5uv0', '::1', 1548118731, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383131383733313b656d706c6f7965655f69647c733a313a2231223b656d706c6f7965655f757365726e616d657c733a353a2261646d696e223b656d706c6f7965655f656d61696c7c733a31373a2261646d696e406578616d706c652e636f6d223b656d706c6f7965655f6e616d657c733a31333a2241646d696e204163636f756e74223b656d706c6f7965655f61646d696e7c733a373a22434845434b4544223b656d706c6f7965655f73616c65737c733a303a22223b656d706c6f7965655f6465706172746d656e74737c613a303a7b7d70726f6a656374735f76616c69646174696f6e737c733a3436303a227b227265717569726564223a7b227461736b5f61737369676e65645f646174655f6d6f223a7b2276616c7565223a223031222c226c6162656c223a2241737369676e65642044617465204d6f6e7468227d2c227461736b5f61737369676e65645f646174655f646179223a7b2276616c7565223a223232222c226c6162656c223a2241737369676e6564204461746520446179227d2c227461736b5f61737369676e65645f646174655f7972223a7b2276616c7565223a2232303139222c226c6162656c223a2241737369676e656420446174652059656172227d2c227461736b5f73746172745f646174655f6d6f223a7b2276616c7565223a223031222c226c6162656c223a2253746172742044617465204d6f6e7468227d2c227461736b5f73746172745f646174655f646179223a7b2276616c7565223a223231222c226c6162656c223a225374617274204461746520446179227d2c227461736b5f73746172745f646174655f7972223a7b2276616c7565223a2232303139222c226c6162656c223a22537461727420446174652059656172227d2c227461736b5f7469746c65223a7b2276616c7565223a22412053616d706c65205461736b222c226c6162656c223a22227d7d7d223b),
('n68cn89mb8tj55judba4ld6n93dpoaqb', '::1', 1548119059, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383131393035393b656d706c6f7965655f69647c733a313a2231223b656d706c6f7965655f757365726e616d657c733a353a2261646d696e223b656d706c6f7965655f656d61696c7c733a31373a2261646d696e406578616d706c652e636f6d223b656d706c6f7965655f6e616d657c733a31333a2241646d696e204163636f756e74223b656d706c6f7965655f61646d696e7c733a373a22434845434b4544223b656d706c6f7965655f73616c65737c733a303a22223b656d706c6f7965655f6465706172746d656e74737c613a303a7b7d70726f6a656374735f76616c69646174696f6e737c733a3334303a227b227265717569726564223a7b226e6f7465223a7b2276616c7565223a2250686173656c6c757320656c656966656e642066656c69732061632074656d70757320766976657272612e20517569737175652065752073617069656e206f64696f2e204e616d2064696374756d2c206a7573746f206e6563207072657469756d2073757363697069742c2072697375732061726375206d616c65737561646120746f72746f722c206574206661756369627573206c6f72656d206e65717565207175697320656e696d2e20566573746962756c756d2074696e636964756e742c20726973757320636f6e76616c6c697320616363756d73616e20656765737461732c2073617069656e20746f72746f7220636f6e76616c6c6973206469616d2c2076656c2065676573746173206f726369206f64696f2073697420616d6574206a7573746f2e222c226c6162656c223a22227d7d7d223b),
('s989dullk79fiahlshdi8dqrvcncn2pq', '::1', 1548119347, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534383131393035393b656d706c6f7965655f69647c733a313a2231223b656d706c6f7965655f757365726e616d657c733a353a2261646d696e223b656d706c6f7965655f656d61696c7c733a31373a2261646d696e406578616d706c652e636f6d223b656d706c6f7965655f6e616d657c733a31333a2241646d696e204163636f756e74223b656d706c6f7965655f61646d696e7c733a373a22434845434b4544223b656d706c6f7965655f73616c65737c733a303a22223b656d706c6f7965655f6465706172746d656e74737c613a303a7b7d70726f6a656374735f76616c69646174696f6e737c733a3332353a227b227265717569726564223a7b227461736b5f646174655f6d6f223a7b2276616c7565223a223031222c226c6162656c223a2244617465204d6f6e7468227d2c227461736b5f646174655f646179223a7b2276616c7565223a223235222c226c6162656c223a224461746520446179227d2c227461736b5f646174655f7972223a7b2276616c7565223a2232303139222c226c6162656c223a22446174652059656172227d2c227461736b223a7b2276616c7565223a224e616d207365642076656e656e61746973206d617373612c20736564207661726975732070757275732e2041656e65616e206174206572617420616e74652e20446f6e656320666163696c6973697320656e696d2069642064756920666163696c697369732c206e6563206461706962757320656e696d206375727375732e222c226c6162656c223a22227d7d7d223b);

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
  `support_complete_date` varchar(8) NOT NULL,
  `support_complete_time` varchar(4) NOT NULL,
  `support_closed_date` varchar(8) NOT NULL,
  `support_archived_date` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`support_id`, `customer_id`, `support_name`, `support_details`, `support_date`, `support_time`, `support_duration_days`, `support_duration_hours`, `support_duration_minutes`, `support_status`, `support_complete_date`, `support_complete_time`, `support_closed_date`, `support_archived_date`) VALUES
(1, 1, 'Sample Support', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tempor, risus in ultricies pharetra, diam arcu rutrum lorem, a pretium justo turpis et elit. Mauris sit amet pellentesque nisl. Nullam accumsan bibendum lacinia. Proin neque mauris, maximus sed tempor et, rhoncus eget massa. Nulla auctor mi in faucibus volutpat. Integer accumsan massa turpis, id iaculis nisl laoreet et. Phasellus nunc lacus, tempor sit amet pellentesque gravida, hendrerit ac sem. Etiam feugiat dictum urna, sed scelerisque nibh laoreet a. Maecenas tempus ullamcorper eros id auctor. Morbi finibus ultricies porttitor. Fusce nec interdum nisl. Donec rhoncus ipsum risus, eu varius orci venenatis sed. Cras ut euismod purus. Curabitur iaculis a urna vitae accumsan. Donec eleifend nisi in metus laoreet, quis luctus metus pulvinar. Sed vulputate hendrerit placerat.</p>\r\n<p>&nbsp;</p>\r\n<p>Sed cursus, mi sed maximus consectetur, elit neque tincidunt lectus, a pellentesque nibh diam vitae augue. Aliquam erat volutpat. Donec condimentum facilisis congue. Ut rutrum cursus augue eu facilisis. Pellentesque egestas nunc lacus. Fusce ullamcorper mauris eleifend nulla efficitur varius. Nam id dolor ac orci suscipit rutrum bibendum in tortor. Donec felis ipsum, tempus a quam sed, pellentesque gravida turpis.</p>', '20190121', '1900', 0, 0, 0, 'O', '', '', '', '');

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
-- Table structure for table `support_history`
--

CREATE TABLE `support_history` (
  `support_history_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  `history_action` varchar(50) NOT NULL,
  `history_employee_id` int(11) NOT NULL,
  `history_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `support_history`
--

INSERT INTO `support_history` (`support_history_id`, `support_id`, `history_action`, `history_employee_id`, `history_datetime`) VALUES
(1, 1, 'Support created', 1, '2019-01-22 02:07:19'),
(2, 1, 'Task #1 created', 1, '2019-01-22 02:08:04'),
(3, 1, 'Task #2 created', 1, '2019-01-22 02:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `support_tasks`
--

CREATE TABLE `support_tasks` (
  `task_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task` varchar(250) NOT NULL,
  `task_date` varchar(8) NOT NULL,
  `task_completed` datetime NOT NULL,
  `task_completed_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support_tasks`
--

INSERT INTO `support_tasks` (`task_id`, `support_id`, `employee_id`, `task`, `task_date`, `task_completed`, `task_completed_by`) VALUES
(1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fringilla venenatis iaculis. Integer ornare, turpis at ullamcorper dictum, mauris est tincidunt sem, vitae varius lacus nisl vitae metus.', '20190121', '0000-00-00 00:00:00', 0),
(2, 1, 1, 'Nam sed venenatis massa, sed varius purus. Aenean at erat ante. Donec facilisis enim id dui facilisis, nec dapibus enim cursus.', '20190125', '0000-00-00 00:00:00', 0);

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
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`system_id`, `system_code`, `system_name`) VALUES
(1, '', 'Sample System');

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
-- Indexes for table `customers_files`
--
ALTER TABLE `customers_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `project_id` (`customer_id`),
  ADD KEY `file_name` (`file_name`);

--
-- Indexes for table `customers_notes`
--
ALTER TABLE `customers_notes`
  ADD PRIMARY KEY (`customer_note_id`);

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
-- Indexes for table `files_documentation`
--
ALTER TABLE `files_documentation`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `file_name` (`file_name`);

--
-- Indexes for table `files_forms`
--
ALTER TABLE `files_forms`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `file_name` (`file_name`);

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
-- Indexes for table `projects_history`
--
ALTER TABLE `projects_history`
  ADD PRIMARY KEY (`project_history_id`);

--
-- Indexes for table `projects_notes`
--
ALTER TABLE `projects_notes`
  ADD PRIMARY KEY (`project_note_id`);

--
-- Indexes for table `projects_reminders`
--
ALTER TABLE `projects_reminders`
  ADD PRIMARY KEY (`project_reminder_id`);

--
-- Indexes for table `projects_reminders_employees`
--
ALTER TABLE `projects_reminders_employees`
  ADD PRIMARY KEY (`project_reminder_employee_id`);

--
-- Indexes for table `projects_tasks`
--
ALTER TABLE `projects_tasks`
  ADD PRIMARY KEY (`project_task_id`) USING BTREE,
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `projects_tasks_employees`
--
ALTER TABLE `projects_tasks_employees`
  ADD PRIMARY KEY (`project_task_employee_id`);

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
-- Indexes for table `support_history`
--
ALTER TABLE `support_history`
  ADD PRIMARY KEY (`support_history_id`);

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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers_contacts`
--
ALTER TABLE `customers_contacts`
  MODIFY `customer_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers_files`
--
ALTER TABLE `customers_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers_notes`
--
ALTER TABLE `customers_notes`
  MODIFY `customer_note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `customer_system_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `departments_employees`
--
ALTER TABLE `departments_employees`
  MODIFY `department_employee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments_projects`
--
ALTER TABLE `departments_projects`
  MODIFY `department_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `departments_support`
--
ALTER TABLE `departments_support`
  MODIFY `department_support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employees_projects`
--
ALTER TABLE `employees_projects`
  MODIFY `employee_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees_reminders`
--
ALTER TABLE `employees_reminders`
  MODIFY `employee_reminder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees_support`
--
ALTER TABLE `employees_support`
  MODIFY `employee_support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `files_documentation`
--
ALTER TABLE `files_documentation`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `files_forms`
--
ALTER TABLE `files_forms`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `projects_files`
--
ALTER TABLE `projects_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects_history`
--
ALTER TABLE `projects_history`
  MODIFY `project_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `projects_notes`
--
ALTER TABLE `projects_notes`
  MODIFY `project_note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `projects_reminders`
--
ALTER TABLE `projects_reminders`
  MODIFY `project_reminder_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects_reminders_employees`
--
ALTER TABLE `projects_reminders_employees`
  MODIFY `project_reminder_employee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects_tasks`
--
ALTER TABLE `projects_tasks`
  MODIFY `project_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `projects_tasks_employees`
--
ALTER TABLE `projects_tasks_employees`
  MODIFY `project_task_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `support_files`
--
ALTER TABLE `support_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `support_history`
--
ALTER TABLE `support_history`
  MODIFY `support_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `support_tasks`
--
ALTER TABLE `support_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `system_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
