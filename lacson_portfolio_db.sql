CREATE DATABASE IF NOT EXISTS lacson_portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lacson_portfolio_db;

DROP TABLE IF EXISTS projects;
CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  category VARCHAR(80) NOT NULL,
  year VARCHAR(10) NOT NULL,
  description TEXT NOT NULL,
  tech VARCHAR(255) NOT NULL,
  live_url VARCHAR(255) DEFAULT NULL,
  repo_url VARCHAR(255) DEFAULT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB;

INSERT INTO projects (title,category,year,description,tech,live_url,repo_url,sort_order) VALUES
('DocMatch','Doctor Appointment System','2026','A web-based appointment and scheduling system with patient, doctor, and coordinator workflows for booking, queue handling, follow-ups, messaging, and clinic coordination.','PHP, MySQL, JavaScript, HTML, CSS','https://docmatch.infinityfreeapp.com/','https://github.com/lykaaunice/docmatch',1),
('GRASYA WORLDWIDE','E-Commerce Group Project','2025','A 2025 group e-commerce project that I helped improve, with customer accounts, product browsing, cart and checkout, order flow, reviews, and admin product management.','PHP, MySQL, JavaScript, HTML, CSS','https://grasya-worldwide.infinityfreeapp.com/index.php','https://github.com/lykaaunice/grasya-worldwide',2),
('Lyka Lacson Portfolio','Personal Portfolio Website','2026','My personal portfolio website presenting my background, networking interests, tools, selected projects, resume, and contact information in a responsive dark and light interface.','PHP, MySQL, JavaScript, HTML, CSS',NULL,NULL,3);
