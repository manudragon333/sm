-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.8-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.2.0.4675
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for school_management
CREATE DATABASE IF NOT EXISTS `school_management` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `school_management`;


-- Dumping structure for table school_management.abroad_exams
DROP TABLE IF EXISTS `abroad_exams`;
CREATE TABLE IF NOT EXISTS `abroad_exams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.abroad_exams: ~3 rows (approximately)
DELETE FROM `abroad_exams`;
/*!40000 ALTER TABLE `abroad_exams` DISABLE KEYS */;
INSERT INTO `abroad_exams` (`id`, `name`, `status`) VALUES
	(1, 'GRE', '1'),
	(2, 'TOEFL', '1'),
	(3, 'IELTS', '1');
/*!40000 ALTER TABLE `abroad_exams` ENABLE KEYS */;


-- Dumping structure for table school_management.academic_calendar
DROP TABLE IF EXISTS `academic_calendar`;
CREATE TABLE IF NOT EXISTS `academic_calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(10) unsigned DEFAULT '0',
  `course_id` int(10) unsigned DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.academic_calendar: ~0 rows (approximately)
DELETE FROM `academic_calendar`;
/*!40000 ALTER TABLE `academic_calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `academic_calendar` ENABLE KEYS */;


-- Dumping structure for table school_management.academic_calendar_items
DROP TABLE IF EXISTS `academic_calendar_items`;
CREATE TABLE IF NOT EXISTS `academic_calendar_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calender_id` int(10) unsigned NOT NULL DEFAULT '0',
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `item_id` int(10) unsigned NOT NULL DEFAULT '0',
  `attendance` enum('1','0') DEFAULT '1',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.academic_calendar_items: ~0 rows (approximately)
DELETE FROM `academic_calendar_items`;
/*!40000 ALTER TABLE `academic_calendar_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `academic_calendar_items` ENABLE KEYS */;


-- Dumping structure for table school_management.academic_calendar_semesters
DROP TABLE IF EXISTS `academic_calendar_semesters`;
CREATE TABLE IF NOT EXISTS `academic_calendar_semesters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calendar_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sem_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.academic_calendar_semesters: ~0 rows (approximately)
DELETE FROM `academic_calendar_semesters`;
/*!40000 ALTER TABLE `academic_calendar_semesters` DISABLE KEYS */;
/*!40000 ALTER TABLE `academic_calendar_semesters` ENABLE KEYS */;


-- Dumping structure for table school_management.academic_years
DROP TABLE IF EXISTS `academic_years`;
CREATE TABLE IF NOT EXISTS `academic_years` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.academic_years: ~0 rows (approximately)
DELETE FROM `academic_years`;
/*!40000 ALTER TABLE `academic_years` DISABLE KEYS */;
/*!40000 ALTER TABLE `academic_years` ENABLE KEYS */;


-- Dumping structure for table school_management.admission_types
DROP TABLE IF EXISTS `admission_types`;
CREATE TABLE IF NOT EXISTS `admission_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.admission_types: ~2 rows (approximately)
DELETE FROM `admission_types`;
/*!40000 ALTER TABLE `admission_types` DISABLE KEYS */;
INSERT INTO `admission_types` (`id`, `name`, `status`) VALUES
	(1, 'Management', '1'),
	(2, 'Counseling', '1');
/*!40000 ALTER TABLE `admission_types` ENABLE KEYS */;


-- Dumping structure for table school_management.admission_years
DROP TABLE IF EXISTS `admission_years`;
CREATE TABLE IF NOT EXISTS `admission_years` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.admission_years: ~0 rows (approximately)
DELETE FROM `admission_years`;
/*!40000 ALTER TABLE `admission_years` DISABLE KEYS */;
/*!40000 ALTER TABLE `admission_years` ENABLE KEYS */;


-- Dumping structure for table school_management.assignments
DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `branch_id` int(11) DEFAULT '0',
  `sem_id` int(11) DEFAULT '0',
  `students_count` int(10) DEFAULT '0',
  `subject` varchar(255) DEFAULT NULL,
  `instructions` varchar(512) NOT NULL DEFAULT '',
  `doc_link` varchar(512) DEFAULT NULL,
  `max_marks` float DEFAULT '100',
  `last_date` timestamp NULL DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  `section_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.assignments: ~0 rows (approximately)
DELETE FROM `assignments`;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;


-- Dumping structure for table school_management.assignment_submissions
DROP TABLE IF EXISTS `assignment_submissions`;
CREATE TABLE IF NOT EXISTS `assignment_submissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `assignments_id` int(11) NOT NULL DEFAULT '0',
  `student_replies` varchar(512) NOT NULL DEFAULT '',
  `doc_link` varchar(512) DEFAULT NULL,
  `marks_alloted` float DEFAULT '0',
  `staff_comments` varchar(512) NOT NULL DEFAULT '',
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `Index 1` (`id`),
  KEY `assignments_id` (`assignments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.assignment_submissions: ~0 rows (approximately)
DELETE FROM `assignment_submissions`;
/*!40000 ALTER TABLE `assignment_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignment_submissions` ENABLE KEYS */;


-- Dumping structure for table school_management.attendance_breach_counter
DROP TABLE IF EXISTS `attendance_breach_counter`;
CREATE TABLE IF NOT EXISTS `attendance_breach_counter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `period_id` int(11) unsigned NOT NULL DEFAULT '0',
  `unlocked` enum('1','0') NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `staff_id_key` (`staff_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.attendance_breach_counter: ~0 rows (approximately)
DELETE FROM `attendance_breach_counter`;
/*!40000 ALTER TABLE `attendance_breach_counter` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendance_breach_counter` ENABLE KEYS */;


-- Dumping structure for table school_management.attendance_types
DROP TABLE IF EXISTS `attendance_types`;
CREATE TABLE IF NOT EXISTS `attendance_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.attendance_types: ~5 rows (approximately)
DELETE FROM `attendance_types`;
/*!40000 ALTER TABLE `attendance_types` DISABLE KEYS */;
INSERT INTO `attendance_types` (`id`, `name`, `status`) VALUES
	(1, 'Present', '1'),
	(2, 'Absent', '1'),
	(3, 'Sports', '1'),
	(4, 'Science fair', '1'),
	(5, 'Paper presentation', '1');
/*!40000 ALTER TABLE `attendance_types` ENABLE KEYS */;


-- Dumping structure for table school_management.batch_nos
DROP TABLE IF EXISTS `batch_nos`;
CREATE TABLE IF NOT EXISTS `batch_nos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL DEFAULT '0',
  `college_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `college_id` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.batch_nos: ~0 rows (approximately)
DELETE FROM `batch_nos`;
/*!40000 ALTER TABLE `batch_nos` DISABLE KEYS */;
/*!40000 ALTER TABLE `batch_nos` ENABLE KEYS */;


-- Dumping structure for table school_management.boarding_points
DROP TABLE IF EXISTS `boarding_points`;
CREATE TABLE IF NOT EXISTS `boarding_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.boarding_points: ~2 rows (approximately)
DELETE FROM `boarding_points`;
/*!40000 ALTER TABLE `boarding_points` DISABLE KEYS */;
INSERT INTO `boarding_points` (`id`, `name`, `status`) VALUES
	(1, 'ECIL', '1'),
	(2, 'Kukatpally', '1');
/*!40000 ALTER TABLE `boarding_points` ENABLE KEYS */;


-- Dumping structure for table school_management.branches
DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL DEFAULT '0',
  `college_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `college_id` (`college_id`),
  CONSTRAINT `FK_branches_courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.branches: ~9 rows (approximately)
DELETE FROM `branches`;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` (`id`, `course_id`, `college_id`, `name`, `status`) VALUES
	(1, 1, 1, 'KinderGarden', '1'),
	(2, 1, 1, 'Primary High', '1'),
	(3, 1, 1, 'Secondary High', '1'),
	(4, 2, 1, 'KinderGarden', '1'),
	(5, 2, 1, 'Primary High', '1'),
	(6, 2, 1, 'Secondary High', '1'),
	(7, 3, 1, 'KinderGarden', '1'),
	(8, 3, 1, 'Primary High', '1'),
	(9, 3, 1, 'Secondary High', '1');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;


-- Dumping structure for table school_management.branch_semister_subject
DROP TABLE IF EXISTS `branch_semister_subject`;
CREATE TABLE IF NOT EXISTS `branch_semister_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `semister_id` int(11) NOT NULL DEFAULT '0',
  `subject_id` int(11) NOT NULL DEFAULT '0',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `id` (`id`),
  KEY `branch_id` (`branch_id`),
  KEY `semister_id` (`semister_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.branch_semister_subject: 0 rows
DELETE FROM `branch_semister_subject`;
/*!40000 ALTER TABLE `branch_semister_subject` DISABLE KEYS */;
/*!40000 ALTER TABLE `branch_semister_subject` ENABLE KEYS */;


-- Dumping structure for table school_management.bus_pass_applications
DROP TABLE IF EXISTS `bus_pass_applications`;
CREATE TABLE IF NOT EXISTS `bus_pass_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT '0',
  `student_number` varchar(256) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `start_from` int(11) DEFAULT NULL,
  `branch` int(11) unsigned DEFAULT NULL,
  `course` int(11) unsigned DEFAULT NULL,
  `photo` varchar(512) DEFAULT NULL,
  `is_issued` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.bus_pass_applications: ~0 rows (approximately)
DELETE FROM `bus_pass_applications`;
/*!40000 ALTER TABLE `bus_pass_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `bus_pass_applications` ENABLE KEYS */;


-- Dumping structure for table school_management.cashbook
DROP TABLE IF EXISTS `cashbook`;
CREATE TABLE IF NOT EXISTS `cashbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `credit_amount` varchar(225) NOT NULL,
  `credit_type` varchar(225) NOT NULL,
  `credit_rec_no` varchar(225) NOT NULL,
  `debit_ammount` varchar(225) NOT NULL,
  `debit_details` varchar(225) NOT NULL,
  `debit_type` varchar(225) NOT NULL,
  `debit_rec_no` varchar(225) NOT NULL,
  `updated_by` varchar(225) NOT NULL,
  `balance` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.cashbook: 0 rows
DELETE FROM `cashbook`;
/*!40000 ALTER TABLE `cashbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `cashbook` ENABLE KEYS */;


-- Dumping structure for table school_management.castes
DROP TABLE IF EXISTS `castes`;
CREATE TABLE IF NOT EXISTS `castes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.castes: ~9 rows (approximately)
DELETE FROM `castes`;
/*!40000 ALTER TABLE `castes` DISABLE KEYS */;
INSERT INTO `castes` (`id`, `name`, `status`) VALUES
	(1, 'SC', '1'),
	(2, 'BC', '1'),
	(3, 'OC', '1'),
	(6, 'ST', '1'),
	(7, 'BC-C', '1'),
	(8, 'BC-B', '1'),
	(9, 'BC-A', '1'),
	(10, 'BC-D', '1'),
	(11, 'BC-E', '1');
/*!40000 ALTER TABLE `castes` ENABLE KEYS */;


-- Dumping structure for table school_management.chat
DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.chat: ~0 rows (approximately)
DELETE FROM `chat`;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;


-- Dumping structure for table school_management.ci_sessions
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.ci_sessions: 0 rows
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- Dumping structure for table school_management.colleges
DROP TABLE IF EXISTS `colleges`;
CREATE TABLE IF NOT EXISTS `colleges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `college_address` varchar(256) DEFAULT NULL,
  `college_code` varchar(256) DEFAULT NULL,
  `college_logo` varchar(512) NOT NULL,
  `estd` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.colleges: ~1 rows (approximately)
DELETE FROM `colleges`;
/*!40000 ALTER TABLE `colleges` DISABLE KEYS */;
INSERT INTO `colleges` (`id`, `name`, `college_address`, `college_code`, `college_logo`, `estd`, `status`) VALUES
	(1, 'Brooklyn Intl High School', 'Brooklyn Intl High School,\r\nGachibowly, Hyd', 'BIHS', '/files/user.png', '1988', '1');
/*!40000 ALTER TABLE `colleges` ENABLE KEYS */;


-- Dumping structure for table school_management.conduct_applications
DROP TABLE IF EXISTS `conduct_applications`;
CREATE TABLE IF NOT EXISTS `conduct_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `stu_number` varchar(255) DEFAULT NULL,
  `co` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `course` int(11) unsigned DEFAULT NULL,
  `from_date` varchar(255) DEFAULT NULL,
  `to_date` varchar(255) DEFAULT NULL,
  `is_issued` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.conduct_applications: ~0 rows (approximately)
DELETE FROM `conduct_applications`;
/*!40000 ALTER TABLE `conduct_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `conduct_applications` ENABLE KEYS */;


-- Dumping structure for table school_management.courses
DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `college_id` int(11) unsigned DEFAULT '0',
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `college_id` (`college_id`),
  CONSTRAINT `FK_courses_colleges` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.courses: ~3 rows (approximately)
DELETE FROM `courses`;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `name`, `college_id`, `status`) VALUES
	(1, 'I.C.S.C', 1, '1'),
	(2, 'C.B.S.E', 1, '1'),
	(3, 'S.S.C', 1, '1');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;


-- Dumping structure for table school_management.debit_payment_particulars
DROP TABLE IF EXISTS `debit_payment_particulars`;
CREATE TABLE IF NOT EXISTS `debit_payment_particulars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vorefno` varchar(30) NOT NULL,
  `particulars` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.debit_payment_particulars: ~0 rows (approximately)
DELETE FROM `debit_payment_particulars`;
/*!40000 ALTER TABLE `debit_payment_particulars` DISABLE KEYS */;
/*!40000 ALTER TABLE `debit_payment_particulars` ENABLE KEYS */;


-- Dumping structure for table school_management.debit_vouchers
DROP TABLE IF EXISTS `debit_vouchers`;
CREATE TABLE IF NOT EXISTS `debit_vouchers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `vorefno` varchar(30) NOT NULL,
  `college_code` varchar(8) NOT NULL,
  `vcreationdate` date NOT NULL,
  `debitedto` varchar(300) NOT NULL,
  `type` enum('Cash','DD','Cheque','Other') NOT NULL,
  `received` double NOT NULL,
  `createdby` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.debit_vouchers: ~0 rows (approximately)
DELETE FROM `debit_vouchers`;
/*!40000 ALTER TABLE `debit_vouchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `debit_vouchers` ENABLE KEYS */;


-- Dumping structure for table school_management.debug
DROP TABLE IF EXISTS `debug`;
CREATE TABLE IF NOT EXISTS `debug` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.debug: 0 rows
DELETE FROM `debug`;
/*!40000 ALTER TABLE `debug` DISABLE KEYS */;
/*!40000 ALTER TABLE `debug` ENABLE KEYS */;


-- Dumping structure for table school_management.designation
DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.designation: ~5 rows (approximately)
DELETE FROM `designation`;
/*!40000 ALTER TABLE `designation` DISABLE KEYS */;
INSERT INTO `designation` (`id`, `name`, `status`) VALUES
	(1, 'Principal', '1'),
	(2, 'Head Master', '1'),
	(3, 'Head teacher', '1'),
	(4, 'Teacher', '1'),
	(5, 'Floor Incharge', '1');
/*!40000 ALTER TABLE `designation` ENABLE KEYS */;


-- Dumping structure for table school_management.events
DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `title_slug` varchar(1000) NOT NULL,
  `desc` varchar(10000) NOT NULL,
  `DateTime` varchar(100) NOT NULL,
  `addedby_on` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.events: 0 rows
DELETE FROM `events`;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;


-- Dumping structure for table school_management.exams
DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `exam_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mode_of_exam_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `maximum_marks` int(10) unsigned NOT NULL DEFAULT '0',
  `pass_marks` float unsigned NOT NULL DEFAULT '0',
  `credits` float unsigned NOT NULL DEFAULT '0',
  `branch_id` int(10) unsigned NOT NULL DEFAULT '0',
  `semister_id` int(10) unsigned NOT NULL DEFAULT '0',
  `section_id` int(10) unsigned NOT NULL DEFAULT '0',
  `subject_id` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified_by` int(10) DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.exams: ~0 rows (approximately)
DELETE FROM `exams`;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;


-- Dumping structure for table school_management.exams_student_marks
DROP TABLE IF EXISTS `exams_student_marks`;
CREATE TABLE IF NOT EXISTS `exams_student_marks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `exam_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `marks_secured` int(10) unsigned NOT NULL DEFAULT '0',
  `pass` enum('1','0') NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified_by` int(10) DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.exams_student_marks: ~0 rows (approximately)
DELETE FROM `exams_student_marks`;
/*!40000 ALTER TABLE `exams_student_marks` DISABLE KEYS */;
/*!40000 ALTER TABLE `exams_student_marks` ENABLE KEYS */;


-- Dumping structure for table school_management.exam_types
DROP TABLE IF EXISTS `exam_types`;
CREATE TABLE IF NOT EXISTS `exam_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified_by` int(10) DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.exam_types: ~4 rows (approximately)
DELETE FROM `exam_types`;
/*!40000 ALTER TABLE `exam_types` DISABLE KEYS */;
INSERT INTO `exam_types` (`id`, `name`, `status`, `date_added`, `created_by`, `last_modified_by`, `last_modified`, `ip_address`) VALUES
	(1, 'Unit Test', '1', '2013-12-14 21:55:09', NULL, NULL, '0000-00-00 00:00:00', ''),
	(2, 'Quarterly Exam', '1', '2013-12-14 21:55:24', NULL, NULL, '0000-00-00 00:00:00', ''),
	(3, 'Half Yearly Exam', '1', '2013-12-14 21:55:38', NULL, NULL, '0000-00-00 00:00:00', ''),
	(4, 'Main Yearly Exam', '1', '2013-12-14 21:55:52', NULL, NULL, '0000-00-00 00:00:00', '');
/*!40000 ALTER TABLE `exam_types` ENABLE KEYS */;


-- Dumping structure for table school_management.fee_discounts
DROP TABLE IF EXISTS `fee_discounts`;
CREATE TABLE IF NOT EXISTS `fee_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `disc1` varchar(10) NOT NULL DEFAULT '0',
  `disc2` varchar(10) NOT NULL DEFAULT '0',
  `disc3` varchar(10) NOT NULL DEFAULT '0',
  `disc4` varchar(10) NOT NULL DEFAULT '0',
  `updatedon` varchar(20) NOT NULL,
  `updatedby` varchar(20) NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.fee_discounts: 0 rows
DELETE FROM `fee_discounts`;
/*!40000 ALTER TABLE `fee_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `fee_discounts` ENABLE KEYS */;


-- Dumping structure for table school_management.hods
DROP TABLE IF EXISTS `hods`;
CREATE TABLE IF NOT EXISTS `hods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `code` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.hods: ~0 rows (approximately)
DELETE FROM `hods`;
/*!40000 ALTER TABLE `hods` DISABLE KEYS */;
/*!40000 ALTER TABLE `hods` ENABLE KEYS */;


-- Dumping structure for table school_management.id_card_applications
DROP TABLE IF EXISTS `id_card_applications`;
CREATE TABLE IF NOT EXISTS `id_card_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `stu_number` varchar(255) DEFAULT NULL,
  `branch` int(11) unsigned DEFAULT NULL,
  `date_of_join` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `photo` varchar(512) DEFAULT NULL,
  `is_staff` enum('1','0') DEFAULT '0',
  `is_issued` enum('1','0') DEFAULT '0' COMMENT 'Editable by Admin/staff ',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.id_card_applications: ~0 rows (approximately)
DELETE FROM `id_card_applications`;
/*!40000 ALTER TABLE `id_card_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `id_card_applications` ENABLE KEYS */;


-- Dumping structure for table school_management.items
DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.items: ~0 rows (approximately)
DELETE FROM `items`;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;


-- Dumping structure for table school_management.leave_letters
DROP TABLE IF EXISTS `leave_letters`;
CREATE TABLE IF NOT EXISTS `leave_letters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(512) DEFAULT '',
  `staff_code` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `branch_id` int(11) unsigned NOT NULL,
  `leave_type_id` int(11) unsigned NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `purpose` varchar(512) DEFAULT '',
  `is_approved` enum('2','1','0') DEFAULT '0' COMMENT '2-Rejected, 1- Approved by HOD, 0- Waiting',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `branch_id` (`branch_id`),
  KEY `type_of_leave_id` (`leave_type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.leave_letters: ~0 rows (approximately)
DELETE FROM `leave_letters`;
/*!40000 ALTER TABLE `leave_letters` DISABLE KEYS */;
/*!40000 ALTER TABLE `leave_letters` ENABLE KEYS */;


-- Dumping structure for table school_management.leave_types
DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT '',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.leave_types: ~7 rows (approximately)
DELETE FROM `leave_types`;
/*!40000 ALTER TABLE `leave_types` DISABLE KEYS */;
INSERT INTO `leave_types` (`id`, `name`, `status`) VALUES
	(1, 'Casual Leave', '1'),
	(2, 'CCL', '1'),
	(3, 'Study Leave ', '1'),
	(4, 'Vacation', '1'),
	(5, 'Medical Leave', '1'),
	(6, 'On Duty', '1'),
	(7, 'Early Permission', '1');
/*!40000 ALTER TABLE `leave_types` ENABLE KEYS */;


-- Dumping structure for table school_management.leave_work_adjusts
DROP TABLE IF EXISTS `leave_work_adjusts`;
CREATE TABLE IF NOT EXISTS `leave_work_adjusts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `leave_letter_id` int(11) unsigned NOT NULL,
  `work_adjusted_to` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Staff ID to whom work is adjusted',
  `work_adjusted_date` timestamp NULL DEFAULT NULL COMMENT 'Date on which the period is adjusted to',
  `period_id` int(11) unsigned NOT NULL,
  `subject_id` int(11) unsigned NOT NULL COMMENT 'EXTRA...!!',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_approved` enum('2','1','0') DEFAULT '0' COMMENT '2-Reject 1-Accept, 0-Waiting. - Staff should approve to whom work is adjusted',
  `status` enum('1','0') DEFAULT '1' COMMENT '/*Status not required..!! just like that*/',
  PRIMARY KEY (`id`),
  KEY `leave_letter_id` (`leave_letter_id`),
  KEY `subject_id` (`subject_id`),
  KEY `period_id` (`period_id`),
  KEY `work_adjusted_to` (`work_adjusted_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.leave_work_adjusts: ~0 rows (approximately)
DELETE FROM `leave_work_adjusts`;
/*!40000 ALTER TABLE `leave_work_adjusts` DISABLE KEYS */;
/*!40000 ALTER TABLE `leave_work_adjusts` ENABLE KEYS */;


-- Dumping structure for table school_management.library_booking
DROP TABLE IF EXISTS `library_booking`;
CREATE TABLE IF NOT EXISTS `library_booking` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `book_id` int(10) DEFAULT '0',
  `is_dispatched` enum('1','0') DEFAULT '0',
  `dispatched_on` timestamp NULL DEFAULT NULL,
  `msg1_sent` enum('1','0') DEFAULT '0' COMMENT 'For Collecting the book',
  `msg2_sent` enum('1','0') DEFAULT '0' COMMENT 'For Returning the book',
  `date_booked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.library_booking: ~0 rows (approximately)
DELETE FROM `library_booking`;
/*!40000 ALTER TABLE `library_booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_booking` ENABLE KEYS */;


-- Dumping structure for table school_management.library_books
DROP TABLE IF EXISTS `library_books`;
CREATE TABLE IF NOT EXISTS `library_books` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `unique_number` varchar(255) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `accesion_no` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `edition_year` varchar(255) DEFAULT '',
  `pages` int(11) NOT NULL DEFAULT '0',
  `volume` varchar(255) DEFAULT '',
  `publisher_name_addr` varchar(255) DEFAULT '',
  `isbn_no` varchar(255) DEFAULT '',
  `call_no` varchar(255) DEFAULT '',
  `book_cost` varchar(255) DEFAULT '',
  `date_of_withdrawl` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT '',
  `author` varchar(255) DEFAULT '0',
  `version` varchar(255) DEFAULT '0',
  `year` varchar(255) DEFAULT '0',
  `branch_id` int(11) DEFAULT '1',
  `count` int(11) DEFAULT '1' COMMENT '/*Number of books available in the library*/',
  `status` enum('1','0') DEFAULT '1',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.library_books: ~0 rows (approximately)
DELETE FROM `library_books`;
/*!40000 ALTER TABLE `library_books` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_books` ENABLE KEYS */;


-- Dumping structure for table school_management.library_pdfs
DROP TABLE IF EXISTS `library_pdfs`;
CREATE TABLE IF NOT EXISTS `library_pdfs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `branch_id` int(11) DEFAULT '0',
  `sem_id` int(11) DEFAULT '0',
  `instructions` varchar(512) NOT NULL DEFAULT '',
  `doc_link` varchar(512) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  `section_id` int(11) NOT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.library_pdfs: ~0 rows (approximately)
DELETE FROM `library_pdfs`;
/*!40000 ALTER TABLE `library_pdfs` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_pdfs` ENABLE KEYS */;


-- Dumping structure for table school_management.library_pdf_discussions
DROP TABLE IF EXISTS `library_pdf_discussions`;
CREATE TABLE IF NOT EXISTS `library_pdf_discussions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT '0',
  `library_pdf_id` int(11) unsigned DEFAULT '0',
  `comment` varchar(512) DEFAULT '',
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `library_pdf_id` (`library_pdf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.library_pdf_discussions: ~0 rows (approximately)
DELETE FROM `library_pdf_discussions`;
/*!40000 ALTER TABLE `library_pdf_discussions` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_pdf_discussions` ENABLE KEYS */;


-- Dumping structure for table school_management.marks_type
DROP TABLE IF EXISTS `marks_type`;
CREATE TABLE IF NOT EXISTS `marks_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.marks_type: ~0 rows (approximately)
DELETE FROM `marks_type`;
/*!40000 ALTER TABLE `marks_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `marks_type` ENABLE KEYS */;


-- Dumping structure for table school_management.mode_of_exam
DROP TABLE IF EXISTS `mode_of_exam`;
CREATE TABLE IF NOT EXISTS `mode_of_exam` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.mode_of_exam: ~2 rows (approximately)
DELETE FROM `mode_of_exam`;
/*!40000 ALTER TABLE `mode_of_exam` DISABLE KEYS */;
INSERT INTO `mode_of_exam` (`id`, `name`, `date_added`, `status`) VALUES
	(1, 'Regular ', '2012-08-02 00:58:13', '1'),
	(2, 'Supplementary - Re-Sit', '2012-08-02 00:58:21', '1');
/*!40000 ALTER TABLE `mode_of_exam` ENABLE KEYS */;


-- Dumping structure for table school_management.nodue_applications
DROP TABLE IF EXISTS `nodue_applications`;
CREATE TABLE IF NOT EXISTS `nodue_applications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `is_all_approved` enum('1','0') NOT NULL DEFAULT '0',
  `is_issued` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.nodue_applications: ~0 rows (approximately)
DELETE FROM `nodue_applications`;
/*!40000 ALTER TABLE `nodue_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodue_applications` ENABLE KEYS */;


-- Dumping structure for table school_management.nodue_approvals
DROP TABLE IF EXISTS `nodue_approvals`;
CREATE TABLE IF NOT EXISTS `nodue_approvals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(10) unsigned DEFAULT '0',
  `approver_id` int(10) unsigned DEFAULT '0',
  `approver_status` enum('0','1','2') DEFAULT '0' COMMENT '0 - Default/waiting; 1- approved, 2- Disapproved/Rejected',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.nodue_approvals: ~0 rows (approximately)
DELETE FROM `nodue_approvals`;
/*!40000 ALTER TABLE `nodue_approvals` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodue_approvals` ENABLE KEYS */;


-- Dumping structure for table school_management.notification_panel
DROP TABLE IF EXISTS `notification_panel`;
CREATE TABLE IF NOT EXISTS `notification_panel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Targeted User ID to whom message is sent',
  `message` longtext NOT NULL,
  `notification_for` varchar(255) NOT NULL DEFAULT '',
  `priority` varchar(255) NOT NULL DEFAULT '',
  `doc_link` varchar(255) NOT NULL DEFAULT '',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `last_modified_by` int(10) DEFAULT NULL,
  `created_timestamp` int(10) DEFAULT '0',
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.notification_panel: ~0 rows (approximately)
DELETE FROM `notification_panel`;
/*!40000 ALTER TABLE `notification_panel` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_panel` ENABLE KEYS */;


-- Dumping structure for table school_management.pay_slip_requests
DROP TABLE IF EXISTS `pay_slip_requests`;
CREATE TABLE IF NOT EXISTS `pay_slip_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT '0',
  `from_month` int(10) unsigned DEFAULT '0',
  `to_month` int(10) unsigned DEFAULT '0',
  `year` int(10) unsigned DEFAULT '0',
  `is_issued` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.pay_slip_requests: ~0 rows (approximately)
DELETE FROM `pay_slip_requests`;
/*!40000 ALTER TABLE `pay_slip_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_slip_requests` ENABLE KEYS */;


-- Dumping structure for table school_management.periods
DROP TABLE IF EXISTS `periods`;
CREATE TABLE IF NOT EXISTS `periods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cycles_id` int(11) unsigned NOT NULL DEFAULT '0',
  `time_label` varchar(255) DEFAULT '',
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `period_label` varchar(255) DEFAULT '',
  `details` varchar(255) DEFAULT '',
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cycles_id` (`cycles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.periods: ~8 rows (approximately)
DELETE FROM `periods`;
/*!40000 ALTER TABLE `periods` DISABLE KEYS */;
INSERT INTO `periods` (`id`, `cycles_id`, `time_label`, `from`, `to`, `period_label`, `details`, `status`) VALUES
	(1, 1, '09:00:00 am to 09:50:00 am', '09:00:00', '09:50:00', 'C1 - P1', '', '1'),
	(2, 1, '09:50:00 am to 10:40:00 am', '09:50:00', '10:40:00', 'C1 - P2', '', '1'),
	(3, 1, '10:40:00 am to 11:30:00 am', '10:40:00', '11:30:00', 'C1 - P3', '', '1'),
	(4, 1, '11:30:00 am to 12:20:00 pm', '11:30:00', '12:20:00', 'C1 - P4', '', '1'),
	(5, 1, '12:20:00 pm to 01:10:00 pm', '12:20:00', '13:10:00', 'C1 - P5', '', '1'),
	(6, 1, '01:10:00 pm to 02:00:00 pm', '13:10:00', '14:00:00', 'C1 - P6', '', '1'),
	(7, 1, '02:00:00 pm to 02:50:00 pm', '14:00:00', '14:50:00', 'C1 - P7', '', '1'),
	(8, 1, '02:50:00 pm to 03:40:00 pm', '14:50:00', '15:40:00', 'C1 - P8', '', '1');
/*!40000 ALTER TABLE `periods` ENABLE KEYS */;


-- Dumping structure for table school_management.period_cycles
DROP TABLE IF EXISTS `period_cycles`;
CREATE TABLE IF NOT EXISTS `period_cycles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT '0',
  `no_of_periods` int(10) unsigned DEFAULT '0',
  `time_period` time DEFAULT '00:00:00',
  `starting_time` time DEFAULT '00:00:00',
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `college_id` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.period_cycles: ~0 rows (approximately)
DELETE FROM `period_cycles`;
/*!40000 ALTER TABLE `period_cycles` DISABLE KEYS */;
/*!40000 ALTER TABLE `period_cycles` ENABLE KEYS */;


-- Dumping structure for table school_management.placement_cell_job_alerts
DROP TABLE IF EXISTS `placement_cell_job_alerts`;
CREATE TABLE IF NOT EXISTS `placement_cell_job_alerts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL COMMENT '/*ID of user who submited alert*/',
  `alert_type` enum('1','2') DEFAULT NULL COMMENT '/*1- Mobile 2- Email*/',
  `status` enum('1','0') DEFAULT '1' COMMENT '/*1- Active 2- Unregistered */',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.placement_cell_job_alerts: ~0 rows (approximately)
DELETE FROM `placement_cell_job_alerts`;
/*!40000 ALTER TABLE `placement_cell_job_alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `placement_cell_job_alerts` ENABLE KEYS */;


-- Dumping structure for table school_management.placement_cell_news
DROP TABLE IF EXISTS `placement_cell_news`;
CREATE TABLE IF NOT EXISTS `placement_cell_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `message` longtext,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.placement_cell_news: ~0 rows (approximately)
DELETE FROM `placement_cell_news`;
/*!40000 ALTER TABLE `placement_cell_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `placement_cell_news` ENABLE KEYS */;


-- Dumping structure for table school_management.placement_cell_resumes
DROP TABLE IF EXISTS `placement_cell_resumes`;
CREATE TABLE IF NOT EXISTS `placement_cell_resumes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resume_link` varchar(256) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.placement_cell_resumes: ~0 rows (approximately)
DELETE FROM `placement_cell_resumes`;
/*!40000 ALTER TABLE `placement_cell_resumes` DISABLE KEYS */;
/*!40000 ALTER TABLE `placement_cell_resumes` ENABLE KEYS */;


-- Dumping structure for table school_management.polls
DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `access` enum('1','2','3') DEFAULT '1' COMMENT '1->student,2->teacher,3->both',
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(10) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question` (`question`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.polls: 0 rows
DELETE FROM `polls`;
/*!40000 ALTER TABLE `polls` DISABLE KEYS */;
/*!40000 ALTER TABLE `polls` ENABLE KEYS */;


-- Dumping structure for table school_management.poll_options
DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE IF NOT EXISTS `poll_options` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `poll_id` int(10) DEFAULT '0',
  `label` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`),
  KEY `label` (`label`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.poll_options: 0 rows
DELETE FROM `poll_options`;
/*!40000 ALTER TABLE `poll_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `poll_options` ENABLE KEYS */;


-- Dumping structure for table school_management.poll_users
DROP TABLE IF EXISTS `poll_users`;
CREATE TABLE IF NOT EXISTS `poll_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `poll_id` int(10) DEFAULT '0',
  `poll_option_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `poll_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`),
  KEY `poll_option_id` (`poll_option_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.poll_users: 0 rows
DELETE FROM `poll_users`;
/*!40000 ALTER TABLE `poll_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `poll_users` ENABLE KEYS */;


-- Dumping structure for table school_management.question_papers
DROP TABLE IF EXISTS `question_papers`;
CREATE TABLE IF NOT EXISTS `question_papers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `students_count` int(10) DEFAULT '0',
  `branch` int(10) DEFAULT '0',
  `year` int(11) DEFAULT '0',
  `subject_id` int(11) DEFAULT '0',
  `exam_number` varchar(255) DEFAULT NULL,
  `doc_link` varchar(512) DEFAULT NULL,
  `is_approved` enum('1','0') DEFAULT '0',
  `is_principal_approved` enum('1','0') DEFAULT '0',
  `to_print` enum('1','0') DEFAULT '0',
  `is_printed` enum('1','0') DEFAULT '0',
  `section_id` int(11) NOT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.question_papers: ~0 rows (approximately)
DELETE FROM `question_papers`;
/*!40000 ALTER TABLE `question_papers` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_papers` ENABLE KEYS */;


-- Dumping structure for table school_management.regulation
DROP TABLE IF EXISTS `regulation`;
CREATE TABLE IF NOT EXISTS `regulation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.regulation: ~0 rows (approximately)
DELETE FROM `regulation`;
/*!40000 ALTER TABLE `regulation` DISABLE KEYS */;
/*!40000 ALTER TABLE `regulation` ENABLE KEYS */;


-- Dumping structure for table school_management.regulations
DROP TABLE IF EXISTS `regulations`;
CREATE TABLE IF NOT EXISTS `regulations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.regulations: ~0 rows (approximately)
DELETE FROM `regulations`;
/*!40000 ALTER TABLE `regulations` DISABLE KEYS */;
/*!40000 ALTER TABLE `regulations` ENABLE KEYS */;


-- Dumping structure for table school_management.sections
DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `college_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `semister_id` int(11) NOT NULL,
  `start_number` int(20) NOT NULL,
  `end_number` int(20) NOT NULL,
  `section` varchar(256) NOT NULL DEFAULT '',
  `student_start` varchar(200) NOT NULL,
  `student_end` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `end_number` (`end_number`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.sections: 3 rows
DELETE FROM `sections`;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` (`id`, `college_id`, `course_id`, `branch_id`, `semister_id`, `start_number`, `end_number`, `section`, `student_start`, `student_end`) VALUES
	(1, 1, 1, 2, 3, 0, 0, 'Sec A', '', ''),
	(2, 1, 1, 2, 3, 0, 0, 'Sec B', '', ''),
	(4, 1, 1, 2, 4, 0, 0, 'Sec A', '', '');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;


-- Dumping structure for table school_management.semisters
DROP TABLE IF EXISTS `semisters`;
CREATE TABLE IF NOT EXISTS `semisters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(11) unsigned NOT NULL DEFAULT '0',
  `course_id` int(11) unsigned NOT NULL DEFAULT '0',
  `branch_id` int(11) unsigned NOT NULL DEFAULT '0',
  `sem_number` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Using to identify if its 1st semd or 2nd or 3rd ... ',
  `name` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `id` (`id`),
  KEY `college_id` (`college_id`),
  KEY `course_id` (`course_id`),
  KEY `branch_id` (`branch_id`),
  CONSTRAINT `FK_semisters_branches` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.semisters: ~12 rows (approximately)
DELETE FROM `semisters`;
/*!40000 ALTER TABLE `semisters` DISABLE KEYS */;
INSERT INTO `semisters` (`id`, `college_id`, `course_id`, `branch_id`, `sem_number`, `name`, `year`, `status`, `create_date`) VALUES
	(1, 1, 1, 1, 0, 'L.K.G', 1, '1', '2013-09-18 01:36:35'),
	(2, 1, 1, 1, 0, 'U.K.G', 1, '1', '2013-09-18 01:36:35'),
	(3, 1, 1, 2, 0, 'I Class', 1, '1', '2013-09-18 01:37:23'),
	(4, 1, 1, 2, 0, 'II Class', 1, '1', '2013-09-18 01:37:24'),
	(5, 1, 1, 2, 0, 'III Class', 1, '1', '2013-09-18 01:37:24'),
	(6, 1, 1, 2, 0, 'IV Class', 1, '1', '2013-09-18 01:37:24'),
	(7, 1, 1, 2, 0, 'V Class', 1, '1', '2013-09-18 01:37:24'),
	(8, 1, 1, 2, 0, 'VI Class', 1, '1', '2013-09-18 01:37:24'),
	(9, 1, 1, 3, 0, 'VII Class', 1, '1', '2013-09-18 01:37:52'),
	(10, 1, 1, 3, 0, 'VIII Class', 1, '1', '2013-09-18 01:37:52'),
	(11, 1, 1, 3, 0, 'IX Class', 1, '1', '2013-09-18 01:37:52'),
	(12, 1, 1, 3, 0, 'X Class', 1, '1', '2013-09-18 01:37:53');
/*!40000 ALTER TABLE `semisters` ENABLE KEYS */;


-- Dumping structure for table school_management.send_student_messages
DROP TABLE IF EXISTS `send_student_messages`;
CREATE TABLE IF NOT EXISTS `send_student_messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `choice` enum('0','1','2') DEFAULT '0' COMMENT '1- Email ; 2- Mobile',
  `choice2` enum('0','1','2') DEFAULT '0' COMMENT '1 - Group Msg ; 2- Individual Msg',
  `choice3` int(11) DEFAULT '0' COMMENT 'Student Year(For Group Message)',
  `student_number` varchar(256) DEFAULT '0' COMMENT '(For Individual Msg)',
  `message` longtext,
  `is_sent` enum('1','0') DEFAULT '0',
  `section_id` int(11) NOT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.send_student_messages: ~0 rows (approximately)
DELETE FROM `send_student_messages`;
/*!40000 ALTER TABLE `send_student_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `send_student_messages` ENABLE KEYS */;


-- Dumping structure for table school_management.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT '',
  `title` varchar(256) DEFAULT '',
  `validation_classes` varchar(256) DEFAULT '',
  `type` enum('text','select','checkbox','radio') DEFAULT 'text',
  `select_table` varchar(126) DEFAULT '',
  `select_fields` varchar(126) DEFAULT '',
  `value` varchar(512) DEFAULT '',
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.settings: ~0 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table school_management.sex
DROP TABLE IF EXISTS `sex`;
CREATE TABLE IF NOT EXISTS `sex` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.sex: ~2 rows (approximately)
DELETE FROM `sex`;
/*!40000 ALTER TABLE `sex` DISABLE KEYS */;
INSERT INTO `sex` (`id`, `name`, `status`) VALUES
	(1, 'Male', '1'),
	(2, 'Female', '1');
/*!40000 ALTER TABLE `sex` ENABLE KEYS */;


-- Dumping structure for table school_management.sms_gateways
DROP TABLE IF EXISTS `sms_gateways`;
CREATE TABLE IF NOT EXISTS `sms_gateways` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `sender_id` varchar(100) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.sms_gateways: ~1 rows (approximately)
DELETE FROM `sms_gateways`;
/*!40000 ALTER TABLE `sms_gateways` DISABLE KEYS */;
INSERT INTO `sms_gateways` (`id`, `name`, `sender_id`, `username`, `url`) VALUES
	(1, 'mvayoo', 'TEST SMS', 'firstfruitconsulting@gmail.com:kiran20', 'http://api.mVaayoo.com/mvaayooapi/MessageCompose');
/*!40000 ALTER TABLE `sms_gateways` ENABLE KEYS */;


-- Dumping structure for table school_management.staff_cycles_periods
DROP TABLE IF EXISTS `staff_cycles_periods`;
CREATE TABLE IF NOT EXISTS `staff_cycles_periods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `cycle_id` int(11) unsigned NOT NULL DEFAULT '0',
  `weekday_id` int(11) unsigned NOT NULL DEFAULT '0',
  `period_id` int(11) unsigned NOT NULL DEFAULT '0',
  `subject_id` int(11) unsigned NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `section_id` int(11) NOT NULL,
  `academic_year_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `staff_id` (`user_id`),
  KEY `weekday_id` (`weekday_id`),
  KEY `period_id` (`period_id`),
  KEY `subject_id` (`subject_id`),
  KEY `cycle_id` (`cycle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.staff_cycles_periods: ~0 rows (approximately)
DELETE FROM `staff_cycles_periods`;
/*!40000 ALTER TABLE `staff_cycles_periods` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_cycles_periods` ENABLE KEYS */;


-- Dumping structure for table school_management.staff_records
DROP TABLE IF EXISTS `staff_records`;
CREATE TABLE IF NOT EXISTS `staff_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `designation_id` int(10) DEFAULT '0',
  `branch_id` int(10) DEFAULT NULL,
  `sex` enum('1','2') DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `doj` datetime DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `salary` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL COMMENT '/*Store Session User ID in this*/',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '/*Store Session User ID in this*/',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.staff_records: ~0 rows (approximately)
DELETE FROM `staff_records`;
/*!40000 ALTER TABLE `staff_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_records` ENABLE KEYS */;


-- Dumping structure for table school_management.students_notice_board
DROP TABLE IF EXISTS `students_notice_board`;
CREATE TABLE IF NOT EXISTS `students_notice_board` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` longtext,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.students_notice_board: ~0 rows (approximately)
DELETE FROM `students_notice_board`;
/*!40000 ALTER TABLE `students_notice_board` DISABLE KEYS */;
/*!40000 ALTER TABLE `students_notice_board` ENABLE KEYS */;


-- Dumping structure for table school_management.student_attendence
DROP TABLE IF EXISTS `student_attendence`;
CREATE TABLE IF NOT EXISTS `student_attendence` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `semister_id` int(10) DEFAULT '0',
  `attend_days` int(10) DEFAULT '0',
  `tot_days` int(10) DEFAULT '0',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `semister_id` (`semister_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_attendence: 0 rows
DELETE FROM `student_attendence`;
/*!40000 ALTER TABLE `student_attendence` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_attendence` ENABLE KEYS */;


-- Dumping structure for table school_management.student_external_marks
DROP TABLE IF EXISTS `student_external_marks`;
CREATE TABLE IF NOT EXISTS `student_external_marks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(10) unsigned NOT NULL DEFAULT '0',
  `course_id` int(10) unsigned NOT NULL DEFAULT '0',
  `branch_id` int(10) unsigned NOT NULL DEFAULT '0',
  `semister_id` int(10) unsigned NOT NULL DEFAULT '0',
  `subject_id` int(10) unsigned NOT NULL DEFAULT '0',
  `academic_year_id` int(10) unsigned NOT NULL DEFAULT '0',
  `section_id` int(10) unsigned NOT NULL DEFAULT '0',
  `regulation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mode_of_exam_id` int(10) unsigned NOT NULL DEFAULT '0',
  `is_mba` enum('1','0') NOT NULL DEFAULT '0',
  `is_first_year` enum('1','0') NOT NULL DEFAULT '0',
  `student_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `external_marks` int(10) unsigned NOT NULL DEFAULT '0',
  `average_marks` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '/* Just a copy while saving */',
  `final_marks` int(10) unsigned NOT NULL DEFAULT '0',
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `pass` enum('1','0') NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `college_id` (`college_id`),
  KEY `course_id` (`course_id`),
  KEY `branch_id` (`branch_id`),
  KEY `semister_id` (`semister_id`),
  KEY `academic_year_id` (`academic_year_id`),
  KEY `regulation_id` (`regulation_id`),
  KEY `mode_of_exam_id` (`mode_of_exam_id`),
  KEY `subject_id` (`subject_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_external_marks: ~0 rows (approximately)
DELETE FROM `student_external_marks`;
/*!40000 ALTER TABLE `student_external_marks` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_external_marks` ENABLE KEYS */;


-- Dumping structure for table school_management.student_fees
DROP TABLE IF EXISTS `student_fees`;
CREATE TABLE IF NOT EXISTS `student_fees` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `fee1` varchar(255) DEFAULT '0',
  `fee2` varchar(255) DEFAULT '0',
  `fee3` varchar(255) DEFAULT '0',
  `fee4` varchar(255) DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_fees: ~0 rows (approximately)
DELETE FROM `student_fees`;
/*!40000 ALTER TABLE `student_fees` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_fees` ENABLE KEYS */;


-- Dumping structure for table school_management.student_fee_ledger
DROP TABLE IF EXISTS `student_fee_ledger`;
CREATE TABLE IF NOT EXISTS `student_fee_ledger` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receipt_no` varchar(40) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.student_fee_ledger: 0 rows
DELETE FROM `student_fee_ledger`;
/*!40000 ALTER TABLE `student_fee_ledger` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_fee_ledger` ENABLE KEYS */;


-- Dumping structure for table school_management.student_fee_payments
DROP TABLE IF EXISTS `student_fee_payments`;
CREATE TABLE IF NOT EXISTS `student_fee_payments` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(40) NOT NULL,
  `feeforyear` varchar(10) NOT NULL,
  `typeoffee` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `paymenttype` varchar(50) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `updatedby` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table school_management.student_fee_payments: 0 rows
DELETE FROM `student_fee_payments`;
/*!40000 ALTER TABLE `student_fee_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_fee_payments` ENABLE KEYS */;


-- Dumping structure for table school_management.student_internal_marks
DROP TABLE IF EXISTS `student_internal_marks`;
CREATE TABLE IF NOT EXISTS `student_internal_marks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(10) unsigned NOT NULL DEFAULT '0',
  `course_id` int(10) unsigned NOT NULL DEFAULT '0',
  `branch_id` int(10) unsigned NOT NULL DEFAULT '0',
  `semister_id` int(10) unsigned NOT NULL DEFAULT '0',
  `subject_id` int(10) unsigned NOT NULL DEFAULT '0',
  `academic_year_id` int(10) unsigned NOT NULL DEFAULT '0',
  `section_id` int(10) unsigned NOT NULL DEFAULT '0',
  `regulation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mode_of_exam_id` int(10) unsigned NOT NULL DEFAULT '0',
  `is_mba` enum('1','0') NOT NULL DEFAULT '0',
  `is_first_year` enum('1','0') NOT NULL DEFAULT '0',
  `student_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `internal_number` int(10) unsigned NOT NULL DEFAULT '0',
  `objective` int(10) unsigned NOT NULL DEFAULT '0',
  `descriptive` int(10) unsigned NOT NULL DEFAULT '0',
  `assignment` int(10) unsigned NOT NULL DEFAULT '0',
  `avg_marks` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `college_id` (`college_id`),
  KEY `course_id` (`course_id`),
  KEY `branch_id` (`branch_id`),
  KEY `semister_id` (`semister_id`),
  KEY `academic_year_id` (`academic_year_id`),
  KEY `regulation_id` (`regulation_id`),
  KEY `mode_of_exam_id` (`mode_of_exam_id`),
  KEY `subject_id` (`subject_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_internal_marks: ~0 rows (approximately)
DELETE FROM `student_internal_marks`;
/*!40000 ALTER TABLE `student_internal_marks` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_internal_marks` ENABLE KEYS */;


-- Dumping structure for table school_management.student_marks
DROP TABLE IF EXISTS `student_marks`;
CREATE TABLE IF NOT EXISTS `student_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_sem_sub_id` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL DEFAULT '0',
  `marks_type_id` int(11) NOT NULL DEFAULT '0',
  `marks` decimal(10,2) NOT NULL DEFAULT '0.00',
  `internal_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `internal_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `internal_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_marks` int(11) unsigned DEFAULT NULL,
  `tot_marks` decimal(10,2) unsigned DEFAULT NULL,
  `marks_year` int(11) unsigned DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `id` (`id`),
  KEY `branch_sem_sub_id` (`branch_sem_sub_id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_marks: 0 rows
DELETE FROM `student_marks`;
/*!40000 ALTER TABLE `student_marks` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_marks` ENABLE KEYS */;


-- Dumping structure for table school_management.student_marks_old
DROP TABLE IF EXISTS `student_marks_old`;
CREATE TABLE IF NOT EXISTS `student_marks_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_sem_sub_id` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL DEFAULT '0',
  `marks_type_id` int(11) NOT NULL DEFAULT '0',
  `marks` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_marks` int(11) unsigned zerofill DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `id` (`id`),
  KEY `branch_sem_sub_id` (`branch_sem_sub_id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_marks_old: 0 rows
DELETE FROM `student_marks_old`;
/*!40000 ALTER TABLE `student_marks_old` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_marks_old` ENABLE KEYS */;


-- Dumping structure for table school_management.student_marks_old2
DROP TABLE IF EXISTS `student_marks_old2`;
CREATE TABLE IF NOT EXISTS `student_marks_old2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_sem_sub_id` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL DEFAULT '0',
  `marks_type_id` int(11) NOT NULL DEFAULT '0',
  `marks` decimal(10,2) NOT NULL DEFAULT '0.00',
  `internal_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `internal_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `internal_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_marks` int(11) unsigned DEFAULT NULL,
  `marks_year` int(11) unsigned DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `id` (`id`),
  KEY `branch_sem_sub_id` (`branch_sem_sub_id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_marks_old2: 0 rows
DELETE FROM `student_marks_old2`;
/*!40000 ALTER TABLE `student_marks_old2` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_marks_old2` ENABLE KEYS */;


-- Dumping structure for table school_management.student_messages
DROP TABLE IF EXISTS `student_messages`;
CREATE TABLE IF NOT EXISTS `student_messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `student_number` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `message` mediumtext,
  `message_type` enum('email','sms') DEFAULT 'email',
  `status` enum('sent','failed','modaration') DEFAULT 'modaration',
  `sent_to` enum('parent','student') DEFAULT 'parent',
  `message_error` enum('stu_email','stu_mobile','parent_email','parent_mobile','no_error') DEFAULT NULL,
  `more_info` longtext,
  `sent_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='all sms wiil be stores here';

-- Dumping data for table school_management.student_messages: ~0 rows (approximately)
DELETE FROM `student_messages`;
/*!40000 ALTER TABLE `student_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_messages` ENABLE KEYS */;


-- Dumping structure for table school_management.student_periods_attendence
DROP TABLE IF EXISTS `student_periods_attendence`;
CREATE TABLE IF NOT EXISTS `student_periods_attendence` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `staff_user_id` int(10) DEFAULT '0',
  `cycle_id` int(10) DEFAULT '0',
  `weekday_id` int(10) DEFAULT '0',
  `subject_id` int(10) DEFAULT '0',
  `period_id` int(10) DEFAULT '0',
  `attendance_id` int(10) DEFAULT '0',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `weekday_id` (`weekday_id`),
  KEY `subject_id` (`subject_id`),
  KEY `attendance_id` (`attendance_id`),
  KEY `period_id` (`period_id`),
  KEY `cycle_id` (`cycle_id`),
  KEY `staff_user_id` (`staff_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_periods_attendence: 0 rows
DELETE FROM `student_periods_attendence`;
/*!40000 ALTER TABLE `student_periods_attendence` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_periods_attendence` ENABLE KEYS */;


-- Dumping structure for table school_management.student_records
DROP TABLE IF EXISTS `student_records`;
CREATE TABLE IF NOT EXISTS `student_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `regulation_id` int(10) unsigned NOT NULL DEFAULT '0',
  `admission_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `caste_id` int(10) unsigned NOT NULL DEFAULT '0',
  `college_id` int(10) unsigned NOT NULL DEFAULT '0',
  `course_id` int(10) DEFAULT '0',
  `branch_id` int(10) DEFAULT '0',
  `section_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '/*Section*/',
  `scholarship` enum('1','0') NOT NULL DEFAULT '0',
  `fname` varchar(255) DEFAULT '0',
  `lname` varchar(255) DEFAULT '0',
  `name` varchar(255) DEFAULT '0',
  `fathers_name` varchar(255) DEFAULT '0',
  `students_number` varchar(255) DEFAULT '0',
  `sex` enum('1','2') DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `doj` datetime DEFAULT NULL,
  `degree` varchar(255) DEFAULT '',
  `present_year` int(10) unsigned DEFAULT NULL,
  `completing_year` int(10) unsigned DEFAULT NULL,
  `fee_details` varchar(255) DEFAULT '0',
  `email` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `father_mobile` varchar(10) NOT NULL DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `photo` varchar(1000) DEFAULT '',
  `ssc` varchar(1000) DEFAULT '',
  `inter` varchar(1000) DEFAULT '',
  `other` varchar(1000) DEFAULT '',
  `updated_by` int(10) unsigned DEFAULT '0' COMMENT '/*Store Session User ID in this*/',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '/*Store Session User ID in this*/',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `schname` varchar(255) NOT NULL,
  `icname` varchar(255) NOT NULL,
  `ugtc` varchar(255) NOT NULL,
  `ugsc` varchar(255) NOT NULL,
  `ugpc` varchar(255) NOT NULL,
  `ugcmm` varchar(255) NOT NULL,
  `lac` varchar(255) NOT NULL,
  `cnc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `college_id` (`college_id`),
  KEY `regulation_id` (`regulation_id`),
  KEY `admission_type_id` (`admission_type_id`),
  KEY `caste_id` (`caste_id`),
  KEY `course_id` (`course_id`),
  KEY `branch_id` (`branch_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_records: ~0 rows (approximately)
DELETE FROM `student_records`;
/*!40000 ALTER TABLE `student_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_records` ENABLE KEYS */;


-- Dumping structure for table school_management.student_semisters
DROP TABLE IF EXISTS `student_semisters`;
CREATE TABLE IF NOT EXISTS `student_semisters` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0',
  `semister_id` int(10) DEFAULT '0',
  `is_current` enum('0','1') DEFAULT '1',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `semister_id` (`semister_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_semisters: 0 rows
DELETE FROM `student_semisters`;
/*!40000 ALTER TABLE `student_semisters` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_semisters` ENABLE KEYS */;


-- Dumping structure for table school_management.student_time_table
DROP TABLE IF EXISTS `student_time_table`;
CREATE TABLE IF NOT EXISTS `student_time_table` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) DEFAULT '0',
  `year` int(10) DEFAULT '0',
  `day_id` int(10) DEFAULT '0',
  `sub1` varchar(256) DEFAULT '',
  `sub2` varchar(256) DEFAULT '',
  `sub3` varchar(256) DEFAULT '',
  `sub4` varchar(256) DEFAULT '',
  `sub5` varchar(256) DEFAULT '',
  `sub6` varchar(256) DEFAULT '',
  `sub7` varchar(256) DEFAULT '',
  `lab1` varchar(256) DEFAULT '',
  `lab2` varchar(256) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_student_time_table_student_time_table_days` (`day_id`),
  CONSTRAINT `FK_student_time_table_student_time_table_days` FOREIGN KEY (`day_id`) REFERENCES `student_time_table_days` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.student_time_table: ~0 rows (approximately)
DELETE FROM `student_time_table`;
/*!40000 ALTER TABLE `student_time_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_time_table` ENABLE KEYS */;


-- Dumping structure for table school_management.student_time_table_days
DROP TABLE IF EXISTS `student_time_table_days`;
CREATE TABLE IF NOT EXISTS `student_time_table_days` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `day` varchar(256) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Days for student..!!! Just trying for simplicity..!!!';

-- Dumping data for table school_management.student_time_table_days: ~6 rows (approximately)
DELETE FROM `student_time_table_days`;
/*!40000 ALTER TABLE `student_time_table_days` DISABLE KEYS */;
INSERT INTO `student_time_table_days` (`id`, `day`, `status`) VALUES
	(1, 'Monday', '1'),
	(2, 'Tuesday', '1'),
	(3, 'Wednesday', '1'),
	(4, 'Thursday', '1'),
	(5, 'Friday', '1'),
	(6, 'Saturday', '1');
/*!40000 ALTER TABLE `student_time_table_days` ENABLE KEYS */;


-- Dumping structure for table school_management.study_abroad
DROP TABLE IF EXISTS `study_abroad`;
CREATE TABLE IF NOT EXISTS `study_abroad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '/*User ID of Student who filled d appl*/',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country_interested` varchar(255) DEFAULT NULL,
  `exam` int(11) unsigned DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `message` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.study_abroad: ~0 rows (approximately)
DELETE FROM `study_abroad`;
/*!40000 ALTER TABLE `study_abroad` DISABLE KEYS */;
/*!40000 ALTER TABLE `study_abroad` ENABLE KEYS */;


-- Dumping structure for table school_management.study_certi_applications
DROP TABLE IF EXISTS `study_certi_applications`;
CREATE TABLE IF NOT EXISTS `study_certi_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `stu_number` varchar(255) DEFAULT NULL,
  `son_of` varchar(255) DEFAULT NULL,
  `course` int(11) unsigned DEFAULT NULL,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `is_issued` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.study_certi_applications: ~0 rows (approximately)
DELETE FROM `study_certi_applications`;
/*!40000 ALTER TABLE `study_certi_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `study_certi_applications` ENABLE KEYS */;


-- Dumping structure for table school_management.subjects
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(11) unsigned NOT NULL DEFAULT '0',
  `course_id` int(11) unsigned NOT NULL DEFAULT '0',
  `branch_id` int(11) unsigned NOT NULL DEFAULT '0',
  `semister_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `subject_type_id` int(11) unsigned DEFAULT '0',
  `credits` int(15) unsigned DEFAULT '0',
  `status` enum('0','1') DEFAULT '1',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `academic_year` int(11) NOT NULL,
  `academic_year_id` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `college_id` (`college_id`),
  KEY `course_id` (`course_id`),
  KEY `branch_id` (`branch_id`),
  KEY `semister_id` (`semister_id`),
  KEY `subject_type` (`subject_type_id`),
  CONSTRAINT `FK_subjects_semisters` FOREIGN KEY (`semister_id`) REFERENCES `semisters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.subjects: ~5 rows (approximately)
DELETE FROM `subjects`;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`id`, `college_id`, `course_id`, `branch_id`, `semister_id`, `name`, `subject_type_id`, `credits`, `status`, `create_date`, `academic_year`, `academic_year_id`) VALUES
	(1, 1, 1, 1, 1, 'Rymes', 1, 1, '1', '0000-00-00 00:00:00', 1, 0),
	(2, 1, 1, 1, 1, 'Poems', 1, 1, '1', '0000-00-00 00:00:00', 1, 0),
	(3, 1, 1, 2, 3, 'Science', 1, 1, '1', '0000-00-00 00:00:00', 3, 0),
	(4, 1, 1, 2, 3, 'Maths', 1, 1, '1', '0000-00-00 00:00:00', 3, 0),
	(5, 1, 1, 2, 3, 'English', 1, 1, '1', '0000-00-00 00:00:00', 3, 0);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;


-- Dumping structure for table school_management.subject_type
DROP TABLE IF EXISTS `subject_type`;
CREATE TABLE IF NOT EXISTS `subject_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.subject_type: ~2 rows (approximately)
DELETE FROM `subject_type`;
/*!40000 ALTER TABLE `subject_type` DISABLE KEYS */;
INSERT INTO `subject_type` (`id`, `name`, `date_added`, `status`) VALUES
	(1, 'Subjective', '2012-08-12 16:11:12', '1'),
	(2, 'Lab', '2012-08-12 16:11:16', '1');
/*!40000 ALTER TABLE `subject_type` ENABLE KEYS */;


-- Dumping structure for table school_management.tc_applications
DROP TABLE IF EXISTS `tc_applications`;
CREATE TABLE IF NOT EXISTS `tc_applications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT '0',
  `class_studying` varchar(256) DEFAULT '0',
  `identification_marks` varchar(256) DEFAULT '0',
  `qualified_for` varchar(256) DEFAULT '0',
  `conduct` varchar(256) DEFAULT '0',
  `reason_of_leaving` varchar(256) DEFAULT '0',
  `is_issued` enum('1','0') DEFAULT '0',
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.tc_applications: ~0 rows (approximately)
DELETE FROM `tc_applications`;
/*!40000 ALTER TABLE `tc_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `tc_applications` ENABLE KEYS */;


-- Dumping structure for table school_management.templates
DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `body` mediumtext NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1-active, 2-inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='email or sms templates';

-- Dumping data for table school_management.templates: ~3 rows (approximately)
DELETE FROM `templates`;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` (`id`, `subject`, `body`, `status`) VALUES
	(1, 'Holiday', 'Hi %sname% today is holiday', '1'),
	(2, 'Absent', 'Hi %sname%  is absent', '1'),
	(3, 'test', 'test %sname%', '0');
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;


-- Dumping structure for table school_management.time_table
DROP TABLE IF EXISTS `time_table`;
CREATE TABLE IF NOT EXISTS `time_table` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `mon_1` varchar(256) NOT NULL,
  `mon_2` varchar(256) NOT NULL,
  `mon_3` varchar(256) NOT NULL,
  `mon_4` varchar(256) NOT NULL,
  `tue_1` varchar(256) NOT NULL,
  `tue_2` varchar(256) NOT NULL,
  `tue_3` varchar(256) NOT NULL,
  `tue_4` varchar(256) NOT NULL,
  `web_1` varchar(256) NOT NULL,
  `wed_2` varchar(256) NOT NULL,
  `wed_3` varchar(256) NOT NULL,
  `wed_4` varchar(256) NOT NULL,
  `thu_1` varchar(256) NOT NULL,
  `thu_2` varchar(256) NOT NULL,
  `thu_3` varchar(256) NOT NULL,
  `thu_4` varchar(256) NOT NULL,
  `fri_1` varchar(256) NOT NULL,
  `fri_2` varchar(256) NOT NULL,
  `fri_3` varchar(256) NOT NULL,
  `fri_4` varchar(256) NOT NULL,
  `sat_1` varchar(256) NOT NULL,
  `sat_2` varchar(256) NOT NULL,
  `sat_3` varchar(256) NOT NULL,
  `sat_4` varchar(256) NOT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.time_table: ~0 rows (approximately)
DELETE FROM `time_table`;
/*!40000 ALTER TABLE `time_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_table` ENABLE KEYS */;


-- Dumping structure for table school_management.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_type_id` int(10) unsigned DEFAULT '0',
  `username` varchar(256) DEFAULT NULL,
  `password` text,
  `email` varchar(512) DEFAULT NULL,
  `is_loggedin` enum('1','0') DEFAULT '0',
  `status` enum('1','0') DEFAULT '1',
  UNIQUE KEY `username` (`username`),
  KEY `Index 1` (`id`),
  KEY `FK_users_users_type` (`users_type_id`),
  CONSTRAINT `FK_users_users_type` FOREIGN KEY (`users_type_id`) REFERENCES `users_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `users_type_id`, `username`, `password`, `email`, `is_loggedin`, `status`) VALUES
	(1, 9, 'admin', '12345', 'manudragon333@gmail.com', '1', '1'),
	(2, 8, 'exam', '12345', 'exam@sm.com', '1', '1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table school_management.users_type
DROP TABLE IF EXISTS `users_type`;
CREATE TABLE IF NOT EXISTS `users_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.users_type: ~10 rows (approximately)
DELETE FROM `users_type`;
/*!40000 ALTER TABLE `users_type` DISABLE KEYS */;
INSERT INTO `users_type` (`id`, `name`, `status`) VALUES
	(1, 'Student', '1'),
	(2, 'Teacher', '1'),
	(3, 'HOD', '1'),
	(4, 'Librarian', '1'),
	(5, 'Book Keeper', '1'),
	(6, 'Office', '1'),
	(7, 'Office Head', '1'),
	(8, 'Exam Dept', '1'),
	(9, 'Admin', '1'),
	(10, 'Misc', '1');
/*!40000 ALTER TABLE `users_type` ENABLE KEYS */;


-- Dumping structure for table school_management.videos
DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `branch_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sem_id` int(10) unsigned NOT NULL DEFAULT '0',
  `embed_code` longtext,
  `comments` longtext,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.videos: ~0 rows (approximately)
DELETE FROM `videos`;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;


-- Dumping structure for table school_management.weekdays
DROP TABLE IF EXISTS `weekdays`;
CREATE TABLE IF NOT EXISTS `weekdays` (
  `id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table school_management.weekdays: ~6 rows (approximately)
DELETE FROM `weekdays`;
/*!40000 ALTER TABLE `weekdays` DISABLE KEYS */;
INSERT INTO `weekdays` (`id`, `name`, `status`) VALUES
	(1, 'Monday', '1'),
	(2, 'Tuesday', '1'),
	(3, 'Wednesday', '1'),
	(4, 'Thursday', '1'),
	(5, 'Friday', '1'),
	(6, 'Saturday', '1');
/*!40000 ALTER TABLE `weekdays` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
