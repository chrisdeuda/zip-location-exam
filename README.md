# Zap-Map Project Setup Guide

This guide will walk you through setting up the Zap-Map project on your local development environment.

## Prerequisites

Before you start, make sure you have the following installed:

- PHP
- Composer
- MySQL
- Laravel CLI

## Step 1: Clone the repository

Clone the project repository to your local machine:

```bash
download file on https://www.dropbox.com/home/CloudEmploye-Test/zip-location-test
```

## Step 2: Install dependencies

cd zap-map
composer install


Step 3: Configure environment variables
Duplicate the .env.example file and rename it to .env:


Then, open the .env file and update the database connection settings:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 4: Generate application key

`php artisan key:generate`

## Setting up the Database


Before you can run the migrations and seeders, you will need to create a new MySQL database for the project.

Here's how you can do this:

1. Open your terminal.

2. Log in to the MySQL shell with the following command:

   ```bash
   mysql -u root -p
   ```

You'll be prompted to enter the password for the root user. If your MySQL server has a different setup, replace root with your MySQL username.

#### 1. At the MySQL prompt, create a new database with the following command:


```CREATE DATABASE zap_map;```

This command creates a new database named zap_map. You can replace zap_map with the name you want to use for your database.

#### 2. To confirm that the database was created successfully, use the following command:


```SHOW DATABASES;```

You should see zap_map (or the name you chose for your database) in the list of databases.

Remember to update the .env file in your Laravel project with the name of your new database, as well as the username and password for your MySQL server.



### Step 5: Run the migrations and seeders

```
php artisan migrate --seed
```

### Step 6: Start the server

You should now be able to access the API at http://localhost:8000/api/

```
php artisan serve
```
# API Documentations

[API Location Search](./app/Http/Controllers/API/readme.md)
