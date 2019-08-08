# AcornDB

![Package Version](https://img.shields.io/packagist/v/tiny-pixel/acorn-db?style=flat-square) ![Total Downloads](https://img.shields.io/packagist/dt/tiny-pixel/acorn-db?style=flat-square)

Provides [Sage 10](https://github.com/roots/sage) and other [Acorn projects](https://github.com/roots/acorn) with an eloquent Model layer straight from the heart of the Laravel framework.

## Features

- Eloquent modeling of WordPress tables.
- Out of the box support for [Advanced Custom Fields](https://advancedcustomfields.com).
- Migrations, database seeders and factories.
- Command-line utilities to automate installation and maintenance of your database and business logic.

## Requirements

- [Sage](https://github.com/roots/sage) >= 10.0
- [PHP](https://secure.php.net/manual/en/install.php) >= 7.1.3
- [Composer](https://getcomposer.org)

## Installation

Install via Composer:

```bash
$ composer require tiny-pixel/acorn-db
```

After installation, run the following command to publish the configuration files, starter

```bash
$ wp acorn vendor:publish
```

## Bug Reports

Should you discover a bug in AcornDB, and there are going to be bugs, please [open an issue](https://github.com/pixelcollective/acorn-db/issues).

## Contributing

Contributing, whether it be through PRs, reporting an issue, or suggesting an idea is encouraged and appreciated.

All contributors absolutely must strictly adhere to our [Code of Conduct](https://github.com/pixelcollective/acorn-db/blob/master/LICENSE.md).

## Acknowledgements

* [Corcel/Corcel](https://github.com/corcel/corcel)
* [drewjbartlett/wordpress-eloquent](https://github.com/drewjbartlett/wordpress-eloquent)
* [tareq1988/wp-eloquent](https://github.com/tareq1988/wp-eloquent)

## License

AcornDB is provided under the [MIT License](https://github.com/pixelcollective/acorn-mail/blob/master/LICENSE.md).
