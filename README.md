🩺 BrightSmile Dental Clinic Management System brought to you by Jaredd Vincent R. Catalan and Mhaithan Caliuag

A modern, responsive Clinical Management System built with **PHP** and **MySQL**. This project features a high-fidelity UI inspired by modern dental care applications, featuring full CRUD functionality and data-driven landing page statistics.

🚀 Features
* **Dynamic Landing Page**: Real-time stats reflecting total patients and unique treatments.
* **Patient Database**: Searchable table with hover-action controls.
* **Full CRUD**: Create, Read, Update, and Delete patient records.

🎥 Project Demo
https://github.com/user-attachments/assets/deb0f739-5024-40a7-b6e3-5409f689dd4c

🛠️ Tech Stack
* **Frontend**: HTML5, Tailwind CSS, Font Awesome, Animate.css
* **Backend**: PHP 8.x 
* **Database**: MySQL (XAMPP/MariaDB)
* **Fonts**: Outfit & Inter (Google Fonts)

📋 Installation
1. Clone this repository into your `xampp/htdocs` folder.
2. Open **phpMyAdmin** and create a database named `brightsmile_db`.
3. Import the provided SQL structure or run the following:
   ```sql
   CREATE TABLE patients (
       id INT PRIMARY KEY AUTO_INCREMENT,
       name VARCHAR(255),
       age INT,
       gender VARCHAR(20),
       contact VARCHAR(50),
       service VARCHAR(100),
       appointment_date DATE
   );
