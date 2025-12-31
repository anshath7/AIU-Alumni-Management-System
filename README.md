# AIU Alumni Management System
The AIU - Alumni Management System is a comprehensive web-based application designed to bridge the gap between alumni and their alma mater. This project was developed as an academic group project at Albukhary International University (AIU), Malaysia. It serves as a dynamic platform for managing alumni records, organizing events, posting career opportunities, and fostering community through forums and success stories.

<img width="1901" height="862" alt="Screenshot 2025-12-24 153829" src="https://github.com/user-attachments/assets/9d058ee9-62e3-4469-96b3-caaf9b1c20e6" />

## Features

### User Types
- **Admin**: Full control over the system.
- **Alumni**: Can search alumni, post jobs, view events.
- **Student**: Can view events and alumni list (limited access).
  
<img width="1897" height="859" alt="Screenshot 2025-12-24 155319" src="https://github.com/user-attachments/assets/47f35083-f9ab-4ac6-9211-3e7761a03adf" />


### User Side
- Alumni List : Browse and search for registered alumni.
- Educational / Job Opportunities : View and apply for jobs posted by the admin or other alumni.
- Forums : Participate in discussions, share knowledge, and network with peers.
- Success Stories : Read inspiring stories and achievements from fellow alumni.
- Events Calendar : Stay updated with upcoming reunions, seminars, and workshops.
- Registration & Login : Secure account creation for alumni and students.

<img width="1897" height="864" alt="Screenshot 2025-12-24 154743" src="https://github.com/user-attachments/assets/516ba5ca-ab62-43a7-98f8-10aff3572269" />  <br/> <br/>

<img width="1896" height="868" alt="Screenshot 2025-12-24 154836" src="https://github.com/user-attachments/assets/890cb5ec-95c7-4d56-872d-f130f18a9835" />



### Admin Side

- Dashboard : Overview of system statistics (registered users, active jobs, upcoming events).
- Manage Alumni & Students : View, approve, and manage user accounts.
- Manage Content : Create and edit courses, jobs, events, and forum topics.
- Manage Users : Add new admin and manage other users.
- System Settings : Configure site information and other global settings.

<img width="1914" height="859" alt="Screenshot 2025-12-24 155118" src="https://github.com/user-attachments/assets/0b833292-e7e0-4825-a9b9-b38d4596f848" />  <br/> <br/>


<img width="1916" height="875" alt="Screenshot 2025-12-24 155234" src="https://github.com/user-attachments/assets/f444e86f-2874-44c3-9560-9285f420a370" />


## Demo Video
A short demonstration of the system showing:
- User login (Alumni & Student)
- Admin dashboard
- Job postings and forums

> Demo video link will be added here.


## Technology Stack

- Backend : PHP
- Database : MySQL
- Frontend : HTML, CSS, JavaScript
- Server Environment : XAMPP (Apache, MySQL)



## Installation Guide

1.  Prerequisites :
    - Install [XAMPP](https://www.apachefriends.org/) or any local web server environment that supports PHP and MySQL.

2.  Clone/Download :
    - Download the project source code.
    - Extract the folder and rename it to `alumni`.
    - Move the `alumni` folder to your server's root directory (e.g., `C:\xampp\htdocs\`).

3.  Database Setup :
    - Open your web browser and go to `http://localhost/phpmyadmin`.
    - Create a new database named `alumni_db`.
    - Click on the **Import** tab.
    - Choose the file `database/alumni_db.sql` from the project directory and click **Go**.

4.  Configuration :
    - The database connection is configured in `admin/db_connect.php`.
    - Default settings:
        - Host: `localhost`
        - User: `root`
        - Password: `` (empty)
        - Database: `alumni_db`
    - If your MySQL password is different, please update this file accordingly.

5.  Running the Application :
    - Public Site: Access `http://localhost/alumni` in your browser.
    - Admin Panel: Access `http://localhost/alumni/admin`.

## Default Credentials
*Note: Please check the `users` table in the database if these do not work, as they might have been changed.*

- **Admin Username**: `admin`
- **Admin Password**: `admin123`



## Contributors
- Anshath Ahamed Ajumil
- Zin May Oo
- Mohamed Afrath Mohamed Naseer
- Asiyan Bahahkhiri
- Faruk Dagawa Umar


> ⚠️ Note: Default credentials are provided for demonstration purposes only. Please change them before deploying the system in a production environment.


If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!


**License** :
Distributed under the MIT License.


**Contact** :
Anshath Ahamed Ajumil - anshath7@gmail.com

Project Link - https://github.com/anshath7/AIU-Alumni-Management-System

Project Demo - https://drive.google.com/drive/folders/125ymNVp1BalF40XG0sKxiVc8FhhJ3Qgr?usp=sharing
