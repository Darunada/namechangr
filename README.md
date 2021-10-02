
# NameChangr

NameChangr is an ongoing project to help transgender and gender non-conforming individuals accomplish their legal name
and gender change by automating the creation of the legal documents required.

Currently only Utah is supported, but a framework is in place that should allow additional states or documents to 
be generated easily. 

Contributing
----------------------------------------------
I would be happy to mentor someone on their first open source contribution or with adding additional functionality 
to NameChangr.  Please see [CONTRIBUTING.md](CONTRIBUTING.md) for more information about how you could help!

Architecture
----------------------------------------------
NameChangr is built in PHP, using the web development framework Laravel.  Laravel is the bees knees of PHP web 
development.  In production, NameChangr runs on two Heroku nodes.  It also uses postgres for the database and redis as 
a memory cache.  It also makes use of other Heroku services to function, as well as Amazon S3, but nothing but php 
and a database server are required for development.

You can read about Laravel and the other awesome things it does for us [here](https://laravel.com/docs/5.4)

Installation
----------------------------------------------
NameChangr works in both Windows and Linux.  Most dev computers set up as a *AMP server will be able to run it. 

* You have PHP 7.4 and Node 14 LTS installed
* You have Composer 2 installed
* You have a database available (mysql, postgres, even sqlite is supported)
* You have NameChangr cloned into a working directory.

From this point, we can begin installing NameChangr.

```console
$ cp .env.example .env              # copies local environment config file from template 
$ composer install                  # downloads all php depdendencies
$ npm install                       # downloads all js dependencies
$ php artisan key:generate          # generates new application crypto key
$ php artisan passport:keys         # generates new keypair for api token authentication
$ npm run dev                       # compiles css and js assets 
```

Now look in your `.env` file and follow the documentation within.  You must configure a database connection, but
otherwise the defaults will use Laravel's local drivers without (m)any issues.

With the database connection configured, we may now initialize it.
```console
$ php artisan migrate               # installs the database schema
$ php artisan db:seed               # seeds the database with states and other initial data
```

You may now run NameChangr with `$ php artisan serve` and connect 
on `http://localhost:8000`.  If you run into problems, troubleshoot with the logs in `storage/logs` or file an issue.
