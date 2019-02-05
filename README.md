# ProjectManagerPt2
Revised version of my original Project Manager in CodeIgniter with more style 😎 (now with Bulma)

## Installation
1. Download the files and place them in a directory on your web server.
2. Configure the .htaccess by setting RewriteBase /projects2/ to the name of your project's folder (or just '/' if you installed it at your web server's DocumentRoot)
3. In config/config.php, set $config['base_url'] to whatever you set RewriteBase to in the .htaccess
4. Set your database configuration settings in config/database.php
5. Import the database layout. The database layout is located in _database_layout/projects2.sql

## Login
Navigate to the application's URL on your web server.  The default setup is http://localhost/projects2

Username: 'admin' or 'sales' or 'user'
Password: password
