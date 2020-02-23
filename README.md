# proBlogger


A simple blogging platform built with cakePhp. 


## Deployment

- Clone the repo into your hosting's root directory (www)
- create database - problogger
- Duplicate app/Config/database.php.default as /app/Config/database.php and update with your database login details
- Import problogger.sql into your database
- Go to localhost/[problogger]/ - or replace the name [problogger] with your folder name (or your domain)

- There are 3 user groups: 

**Admin : 

- username: xyluz
- password: National1

**Author :

- username: mike
- password: National1

**Reader : 

- username: ola
- password: National1

You can also create account as a Reader or Author. The admin can add more users, or create a new Admin user. The admin can also update any user from one group to another.

Only authenticated users can view posts.

## Unit Tests

problogger has Overall test coverage of 68.29%.

- Create a test database : test_problogger
- Update database.php with your test database details
- Run 'composer install' to get PHPUnit installed
- CakePHP comes with a web interface for running and analysing tests, visit localhost/problogger/test.php (or your domain/test.php)
- Select the test you want to run from App 


## Built With

- CakePHP
- PHPUnit
- Bootstrap 

