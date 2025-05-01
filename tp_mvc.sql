-- Create database
CREATE DATABASE IF NOT EXISTS db_mvc;
USE db_mvc;

-- Create students table
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create courses table
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `credits` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create student_courses table
CREATE TABLE IF NOT EXISTS `student_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `student_courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into students (if table is empty)
INSERT INTO `students` (`name`, `nim`, `phone`, `join_date`)
SELECT 'John Doe', '2023001', '08123456789', '2023-09-01'
WHERE NOT EXISTS (SELECT 1 FROM `students` LIMIT 1);

INSERT INTO `students` (`name`, `nim`, `phone`, `join_date`)
SELECT 'Jane Smith', '2023002', '08234567890', '2023-09-01'
WHERE NOT EXISTS (SELECT 1 FROM `students` WHERE `nim` = '2023002');

INSERT INTO `students` (`name`, `nim`, `phone`, `join_date`)
SELECT 'Alice Johnson', '2023003', '08345678901', '2023-09-01'
WHERE NOT EXISTS (SELECT 1 FROM `students` WHERE `nim` = '2023003');

-- Insert sample data into courses (if table is empty)
INSERT INTO `courses` (`course_code`, `course_name`, `credits`)
SELECT 'PPROG001', 'Object-Oriented Programming', 3
WHERE NOT EXISTS (SELECT 1 FROM `courses` LIMIT 1);

INSERT INTO `courses` (`course_code`, `course_name`, `credits`)
SELECT 'COMP101', 'Introduction to Computer Science', 3
WHERE NOT EXISTS (SELECT 1 FROM `courses` WHERE `course_code` = 'COMP101');

INSERT INTO `courses` (`course_code`, `course_name`, `credits`)
SELECT 'DATA001', 'Database Systems', 3
WHERE NOT EXISTS (SELECT 1 FROM `courses` WHERE `course_code` = 'DATA001');

-- Insert sample data into student_courses (if table is empty)
INSERT INTO `student_courses` (`student_id`, `course_id`, `semester`)
SELECT 1, 1, 'Fall 2023'
WHERE NOT EXISTS (SELECT 1 FROM `student_courses` LIMIT 1)
AND EXISTS (SELECT 1 FROM `students` WHERE `id` = 1)
AND EXISTS (SELECT 1 FROM `courses` WHERE `id` = 1);

INSERT INTO `student_courses` (`student_id`, `course_id`, `semester`)
SELECT 1, 2, 'Fall 2023'
WHERE EXISTS (SELECT 1 FROM `students` WHERE `id` = 1)
AND EXISTS (SELECT 1 FROM `courses` WHERE `id` = 2)
AND NOT EXISTS (SELECT 1 FROM `student_courses` WHERE `student_id` = 1 AND `course_id` = 2);

INSERT INTO `student_courses` (`student_id`, `course_id`, `semester`)
SELECT 2, 1, 'Fall 2023'
WHERE EXISTS (SELECT 1 FROM `students` WHERE `id` = 2)
AND EXISTS (SELECT 1 FROM `courses` WHERE `id` = 1)
AND NOT EXISTS (SELECT 1 FROM `student_courses` WHERE `student_id` = 2 AND `course_id` = 1);

INSERT INTO `student_courses` (`student_id`, `course_id`, `semester`)
SELECT 2, 3, 'Fall 2023'
WHERE EXISTS (SELECT 1 FROM `students` WHERE `id` = 2)
AND EXISTS (SELECT 1 FROM `courses` WHERE `id` = 3)
AND NOT EXISTS (SELECT 1 FROM `student_courses` WHERE `student_id` = 2 AND `course_id` = 3);

INSERT INTO `student_courses` (`student_id`, `course_id`, `semester`)
SELECT 3, 2, 'Fall 2023'
WHERE EXISTS (SELECT 1 FROM `students` WHERE `id` = 3)
AND EXISTS (SELECT 1 FROM `courses` WHERE `id` = 2)
AND NOT EXISTS (SELECT 1 FROM `student_courses` WHERE `student_id` = 3 AND `course_id` = 2);