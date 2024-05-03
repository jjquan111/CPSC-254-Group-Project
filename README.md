# CPSC-254-Group-Project
## FullCalendar with User Authentication

This project integrates FullCalendar with a PHP backend and MySQL database, allowing registered users to manage their personal events in a calendar interface. It supports user registration, login, and the ability to add, view, update, and delete events specific to each user.

### Features

- User Registration and Login
- Event Management (Add, Update, View, Delete)
- FullCalendar Integration
- Responsive Web Design

### Prerequisites

Before you begin, ensure you have met the following requirements:
- PHP 7.x or higher
- MySQL 5.7 or higher
- Apache or Nginx Web Server
- Composer (for managing PHP dependencies)

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/jjquan111/CPSC-254-Group-Project
   cd CPSC-254-Group-project

Configure Web Server (Apache):
sudo cp -r /path/to/project/* /var/www/html/

Set Up Database (MySQL):
mysql -u root -p

mysql> CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
mysql> GRANT ALL PRIVILEGES ON database_name.* TO 'username'@'localhost';
mysql> FLUSH PRIVILEGES;

Adjust File Permissions:
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/
Once you've completed these steps, your web server should be configured to serve the project files, the database should be set up and ready to use, and file permissions should be adjusted appropriately. You can now access the project through a web browser and interact with it as intended.
