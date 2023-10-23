CREATE DATABASE IF NOT EXISTS `SIS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SIS`;
CREATE TABLE student (
    student_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255) NOT NULL,
    student_email VARCHAR(255) NOT NULL,
    student_date_of_birth DATE NOT NULL
);
CREATE TABLE course(
    course_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    course_description VARCHAR(255) NOT NULL,
    course_credits INT(11) NOT NULL
);
CREATE TABLE enrollment(
    enrollment_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    student_id INT(11) NOT NULL,
    course_id INT(11) NOT NULL,
    FOREIGN KEY (student_id) REFERENCES student(student_id),
    FOREIGN KEY (course_id) REFERENCES course(course_id),
    enrollment_semester VARCHAR(255) NOT NULL,
    enrollment_year INT(11) NOT NULL,
    enrollment_grade VARCHAR(255) NOT NULL
);
CREATE TABLE users(
    user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role VARCHAR(255) NOT NULL
);
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