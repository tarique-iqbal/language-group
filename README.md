# Language Group test
A small command-line utility that will list all the countries which speaks the same language or checks if given two countries speak the same language by using open rest api:​ [restcountries](https://restcountries.com/)

## Prerequisites

```
composer
php (>=8.2)
```

## Note
The application will now work if [register_argc_argv](http://php.net/manual/en/ini.core.php#ini.register-argc-argv) is disabled.

## Installation and Run the script

- All the `code` required to get started
- Clone this repo to your local machine using
```shell
$ git clone https://github.com/tarique-iqbal/language-group.git
```

- Need write permission to following `directory`

`./var/logs`

- Install the script

```shell
$ cd /path/to/base/directory
$ composer install --no-dev
```

- Run the script and sample output

```shell
$ php index.php Germany
Country language code: de
Germany speaks same language with these countries: Austria, Belgium, Holy See, and so on...
```

```shell
$ php index.php Canada
Country language code: en
Canada speaks same language with these countries: American Samoa, Anguilla, and so on...
Country language code: fr
Canada speaks same language with these countries: Belgium, Benin, Burkina Faso, and so on...
```

```shell
$ php index.php Germany Canada
Country language code: de
Germany and Canada don’t speak the same language.
```

```shell
$ php index.php Canada France
Country language code: en
Canada and France don’t speak the same language.
Country language code: fr
Canada and France speak the same language.
```

## Running the tests

- Follow Install instructions.

Adapt `phpunit.xml.dist` PHP Constant according to your setup environment.

```shell
$ cd /path/to/base/directory
$ composer update
$ ./vendor/bin/phpunit tests
```

Test-cases, test unit and integration tests.