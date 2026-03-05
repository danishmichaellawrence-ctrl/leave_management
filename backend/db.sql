CREATE DATABASE leave_system;
USE leave_system;

CREATE TABLE student (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  reg VARCHAR(100),
  email VARCHAR(100),
  password VARCHAR(255),
  dept_name VARCHAR(50),
  year INT
);

create table hod (
  id int AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  dept_name VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255)
);

CREATE TABLE leaves (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT,
  department VARCHAR(50),
  year INT,
  from_date DATE,
  to_date DATE,
  reason TEXT,
  status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
  hod_remark TEXT,
  applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO hod (name, dept_name, email, password) VALUES 
('Dr. Jagadhees', 'B.Sc Maths', 'jagadheesh621@gmail.com', 'jagadheesh621'),
('Dr. Sjc', 'B.Sc Physics', 'sjc123@gmail.com', 'sjc123'),
('Dr. Dany', 'B.Sc Chemistry', 'danysuno2005@gmail.com', 'danysuno2005'),
('Dr. Vasanth', 'BCA', 'vasanth235n@gmail.com', 'vasanth235n'),
('Dr. Sharukpg', 'BBA', 'sharukpg401@gmail.com', 'sharukpg401');

INSERT INTO student (name, reg, email, password, dept_name, year) VALUES 
('Benito', 'CS2021001', 'benitojerome2006@gmail.com', 'benitojerome2006', 'B.Sc Maths', 2021),
('Ytmadhan', 'EE2021002', 'ytmadhan805@gmail.com', 'ytmadhan805', 'B.Sc Physics', 2021),
('Danish', 'ME2021003', 'danishmichaellawrence@gmail.com', 'danishmichaellawrence', 'B.Sc Chemistry', 2021),
('Ajibharath', 'CE2021004', 'ajibharath13@gmail.com', 'ajibharath13', 'BCA', 2021),
('Mathan', 'CHE2021005', 'mathani15122005@gmail.com', 'mathani15122005', 'BBA', 2021);
