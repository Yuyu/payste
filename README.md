# Payste
Payste is a simple, yet effective pastebin designed for simplicity and security. It is built upon the [Laravel Lumen](https://lumen.laravel.com/) framework which keeps the whole source small and simple.

Its security lies within the client-based encryption and minimal footprint in the database. When a user hits the paste button, a password is generated within the browser, the paste gets encrypted with said password and only then send to the server. No vital information ever leaves the clients browser.

Try out a live version at [paste.yuyu.io](https://paste.yuyu.io/)!

## Dependencies
- A recent PHP version (>= 5.6.4)
- [Composer](https://getcomposer.org/) (to install framework dependencies)
- Some kind of database server (I personally use MySQL, but just using SQLite or anything else should be fine)
- The PHP modules for your database (PDO for MySQL, etc.)
- A webserver!

## Installing

To start, (after checking out the repo, obviously), navigate to your directory and copy `.env.sample` to `.env`. Within this `.env` file, all of the configuration is done. Specify your database type and connection details, **and don't forget to set the APP_KEY to something very secret!**

Now, install all the dependencies by executing `composer install`.

Afterwards, execute `php artisan migrate` to generate the database tables. Now you're pretty much done! Make your favorite webserver serve PHP on `public/` and that's it. A modern nginx config running on Ubuntu using PHP 7 would be something like this:
```
root /var/www/payste/public;
index index.php;
error_page 404 /index.php;

location / {
    try_files $uri $uri/ /index.php?$args;
}

location = /index.php {
    fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
    fastcgi_split_path_info ^(.+\.php)(.*)$;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
}
```

## Notes
If you get an error for using SQLite, you will need to create the database file manually. The database file to be used is defined within the `DB_DATABASE` env variable (you should use an absolute path).

So, for example, if you've set your `DB_DATABASE` to `/var/www/paste/storage/database.sqlite`, you will need to execute `touch /var/www/paste/storage/database.sqlite` before executing `php artisan migrate`.
