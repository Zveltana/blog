# The BLOG project

## Introduction

This project is a study project, realized within the framework of the PHP/Symfony training of OpenClassrooms. You will find some basic PHP code.

This project is the realization of a blog to convince our future employers / customers and thus show them our skills.

## Require

This project requires PHP 8.1, MySQL 8.0, PDO MySQL and Apache 2.4. The CSS framework used is Tailwinds. For the database, you must have PDO MYSQL.

## For start

To start, you need to clone the main branch.

For the project to work well on your machine you need to do :
- `npm install` to use nodes modules
- `composer install` to generate a composer.json file

Create your database with the `blog_php.sql` at the `.essentials` folder at the root of the project. To connect to your database you go to `public/src/lib/config.php`, once in the file you will see this :

```php
<?php

const DB_HOST="localhost";
const DB_NAME="blog_php";
const DB_USERNAME="root";
const DB_PASSWORD="";

```

Here you will change the constants by your information used during the creation of your database

```php
<?php

const DB_HOST="YourHost";
const DB_NAME="YourNameDataBase";
const DB_USERNAME="YourUserNameConnectionDatabase";
const DB_PASSWORD="YourPasswordConnectionDatabase";

```

The command to use to build the CSS is :
``` npx tailwindcss -i ./public/css/style.scss -o ./dist/style.css --watch ```

To visualize the project in local, thanks to localhost it will be necessary to carry out this command :
```php -S localhost:8081 ```

## Used and Author

To log in to the administrator account :
- email: `admin@gmail.com`
- password : `admin`

To log in to the administrator account 2 :
- email : `admin2@gmail.com`
- password : `admin`

To log in to the user account :
- email : `user@gmail.com`
- password : `user`

The fonts come from google font. The images, logo, in-house creation. Concerning the images of the articles, they have been recovered on the internet to be used as examples.

