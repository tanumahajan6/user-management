This project consists of a User Management feature, where we can List, Create, Edit & Delete a user. 
Technologies like Code Igniter 4, Bootstrap 5, jQuery, CSS and HTML are used to build this feature. 

To run this project locally, we need to start Apache & MySQL services in XAMPP. 

First, we need to create a database called 'users' in phpmyadmin. Next, we will need to import the users.sql file in 'users' database. This completes the Database structure creation.

The database configurations are already done in app/Config/Database.php file with root user. 

To host this application locally, we need to execute below command:
    php spark serve

The project will be ready to use on localhost:8080.