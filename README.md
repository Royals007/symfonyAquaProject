# A Project Development with Symfony

This repository holds the code and script
for the Symfony course and this course was explained by the
knp university people. I changed as per my understanding and needs.

## Setup

If you've just downloaded the code, congrats for your enthusiastic !

To get it working, follow these steps:

**Setup parameters.yml**

Firstly, make sure you have an `app/config/parameters.yml`
file. If you don't, copy `app/config/parameters.yml.dist`
to get it.

Secondly, just look at the configuration data and make any 
adjustments or changes as per your need requirements 
(such as `database_name`, `db_password`).

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

Alternatively, you can run as `php composer.phar install`, 
depending on your configuration and how to install a Composer.

**Setup the Database**

Once again, check your `app/config/parameters.yml` setup
for your computer. Then, create the database and its
schema!

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
Otherwise, you can create manually database name in your host
and then update your schema in your system.

Check all the basic requirements inorder to avoid errors in the first
step itself such as database  and host problems.

**Start the built-in web server**

You can use Nginx or Apache, but the built-in web server works
great:

```
php bin/console server:run /
php bin/console serve 
```

Now check out the site at `http://localhost:8000`

Have fun with our Symfony Project !

## Have some Ideas or Feedback?

If you have suggestions or questions, please feel free to
open an issue or message us.