# CakeFest 2017 Workshop demo app

This is the resulting source code of the advanced workshops I did at CakeFest
2017.

## Installation

1. Install the MySQL database:
```bash
mysql -u root -e 'create database world'
mysql -u root world < world_2017-06-05.sql
```
2. Download [Composer](http://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
3. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

# License

This code is MIT licensed.
