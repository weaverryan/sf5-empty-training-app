# Setting up without Docker

If you'd prefer not to use Docker, that's ok! Here is what you need to do:

### 0) Get PHP 7.2 or higher

This project requires PHP 7.2 or higher!

### 1) Get this code!

Use `git` and the magic of the Internet to clone this repository to your
local machine.

### 2) Install Composer dependencies

Run:

```
composer install
```

### 3) Database Checks

Make sure you have MySQL running and have the `pdo_mysql`. The app
doesn't have any database logic yet - but it wil later. 

### 4) Start the web server

You can use Nginx or Apache if you want. However, I recommend using
Symfony's local web server.

Download the `symfony` binary at https://symfony.com/download.

Then run:

```
symfony serve --port=8089 -d
```

You should now be able to see the site at http://localhost:8089
