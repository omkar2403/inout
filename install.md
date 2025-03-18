# In Out System Installation Guide

Welcome to the In Out System Installation Guide! In this tutorial, we'll walk you through the process of setting up the In Out System on your server. Let's get started!

## 1. Setting Up PHP Environment

### Step 1: Update Package Lists

```bash
sudo apt-get update
```

This command updates the package lists on your system.

### Step 2: Install Software Properties Common

```bash
sudo apt -y install software-properties-common
```

This installs software-properties-common, which helps manage software repositories.

### Step 3: Update Package Lists Again

```bash
sudo apt-get update
```

Update package lists again to include the newly added PHP repository.

### Step 4: Install PHP

```bash
sudo apt-get -y install php
```

Install PHP

### Step 5: Install Required PHP Modules

```bash
sudo apt-get -y install php-{bcmath,bz2,intl,gd,mbstring,mysql,zip}
```

```bash
sudo apt-get -y install libapache2-mod-php
```

Install necessary PHP modules and extensions.

### Step 6: Restart Apache

```bash
sudo service apache2 restart
```

Restart Apache to apply the changes.

## 2. Downloading Repository

### I. Using Git (Recommended)

#### Step 1: Install Git

```bash
sudo apt-get install git
```

Install Git, a version control system.

#### Step 2: Navigate to Desired Location

```bash
cd /usr/share/koha/opac/htdocs
```

Navigate to the directory where you want to set up the application.

#### Step 3: Clone the Repository

```bash
sudo git clone --recursive https://github.com/omkar2403/inout.git
```

Clone the In Out System repository.

### II. Download Repository from GitHub

To begin, we'll download the software package from the provided link and then move it to the Home directory. The package consists of two main files:

1. **inout** (a directory)
2. **Lib.sql** (an SQL database file)

[Download Link](https://github.com/omkar2403/inout.git)

First, unzip the downloaded file and then move it to the Home directory:

```bash
# Unzip the downloaded file
unzip inout.zip
```

```bash
# Moving the package to the Home directory
sudo mv inout /usr/share/koha/opac/htdocs
```

Next, navigate to the OPAC htdocs directory:

```bash
# Changing to the target directory
cd /usr/share/koha/opac/htdocs
```

These commands will ensure that the downloaded package is unzipped and then moved to the appropriate directories, ready for further use.

#### Step 4: Set Permissions

```bash
sudo find /usr/share/koha/opac/htdocs/inout -type d -exec chmod 755 {} \;

sudo find /usr/share/koha/opac/htdocs/inout -type f -exec chmod 644 {} \;

sudo chown www-data:www-data -R inout
```

Ensure proper permissions for the `inout` directory.

## 4. Setting Up the Database

Let's set up the MySQL database for the application.

### Step 1: Login to MySQL

```bash
mysql -uroot -p
```

Login to MySQL as root.

### Step 2: Create Database and User

```sql
create database lib;
grant all privileges on lib.* to 'admin'@'localhost';
flush privileges;
quit;
```

Create a new database named 'lib' and grant privileges to user 'admin'. The user which is handling the koha database

### Step 3: Restore Sample Database

```bash
cd /usr/share/koha/opac/htdocs/inout/DB/
```

```bash
sudo su
mysql -u admin -p lib < inout.sql
```

Navigate to the database directory, switch to superuser, and restore the sample database.

### Step 4: Update Database Connection Details

```bash
sudo nano /usr/share/koha/opac/htdocs/inout/functions/dbconn.php
```

Open the file for editing.

Replace the connection details with your MySQL username, password, and database name:

```php
<?php
$servername = "localhost";
$username = "admin"; // database username
$password = "Admin@7676";  // database password
$db = "lib";  // inout database name
$koha = "koha_library";  // koha database name
$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error($conn));
}

```

Update MySQL connection details in the `dbconn.php` file.

### Step 5: Restart Apache

```bash
sudo systemctl restart apache2
```

Restart Apache to apply changes.

## 5. Accessing the System

Congratulations! The system is now ready to use. You can access it through the following address:

[http://localhost/inout/login.php](http://localhost/inout/login.php)

## How to Use

Now that the system is set up, here's how you can log in:

### Master

- **Username:** master
- **Password:** superuser

### Operator

- **Username:** user
- **Password:** 123456

### Library Admin

- **Username:** admin
- **Password:** library

---

That's it! You've successfully set up the In Out System on your server. If you have any questions or encounter any issues during the installation, feel free to reach out for assistance. Happy managing. 

Note: Delete this file after installation!

---
