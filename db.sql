CREATE DATABASE IF NOT EXISTS `SIS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SIS`;
CREATE TABLE `users` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(255) NOT NULL,
    `user_email` varchar(255) NOT NULL,
    `user_password` varchar(255) NOT NULL,
    `user_role` varchar(255) NOT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci;
CREATE TABLE `course` (
    `course_id` int(11) NOT NULL AUTO_INCREMENT,
    `course_name` varchar(255) NOT NULL,
    `course_description` varchar(255) NOT NULL,
    `course_credits` int(11) NOT NULL,
    PRIMARY KEY (`course_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci;
CREATE TABLE `enrollment` (
    `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `course_id` int(11) NOT NULL,
    `enrollment_semester` varchar(255) NOT NULL,
    `enrollment_year` int(11) NOT NULL,
    `enrollment_grade` varchar(255) NOT NULL,
    PRIMARY KEY (`enrollment_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
    FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci;
INSERT INTO users (user_name, user_password, user_email, user_role)
VALUES ('turki', 'turki', 'turki@t.com', 'admin');
INSERT INTO course (course_name, course_description, course_credits)
VALUES (
        'Web Development',
        'Learn how to build a website',
        3
    );
INSERT INTO course (course_name, course_description, course_credits)
VALUES (
        'Database Management',
        'Learn how to manage a database',
        3
    );
INSERT INTO course (course_name, course_description, course_credits)
VALUES (
        'Software Engineering',
        'Learn how to build software',
        3
    );
INSERT INTO course (course_name, course_description, course_credits)
VALUES (
        'Computer Networks',
        'Learn how to build a network',
        3
    );
INSERT INTO course (course_name, course_description, course_credits)
VALUES (
        'Computer Architecture',
        'Learn how to build a computer',
        3
    );
INSERT INTO course (course_name, course_description, course_credits)
VALUES (
        'Operating Systems',
        'Learn how to build an operating system',
        3
    );
INSERT INTO course (course_name, course_description, course_credits)
VALUES (
        'Computer Security',
        'Learn how to secure a computer',
        3
    );
INSERT INTO course (course_name, course_description, course_credits)
VALUES (
        'Software Security',
        'Learn how to secure a computer',
        3
    );
UPDATE users
SET user_role = 'admin'
WHERE user_id = 1;