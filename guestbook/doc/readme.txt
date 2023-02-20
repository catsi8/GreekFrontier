Advanced Guestbook 2.4.3 (PHP/MySQL)
Copyright (c) Chi Kien Uong
URL: http://www.proxy2.de

Requirements:

  - MySQL 3.22.x or higher
  - PHP 4.1 or higher

Installation:

1. Open the configuration file 'config.inc.php' with a text editor
   and set up your database settings.

2. Create the tables for the guestbook:
   mysql -u<user> -p<pass> <database> < guestbook.sql
   Or use the script 'install.php' -> http://www.yourDomain.com/guestbook/install.php

3. Give write permissions to these directories:

    - public - 777 (drwxrwxrwx) (directory)
    - tmp    - 777 (drwxrwxrwx) (directory)
    




