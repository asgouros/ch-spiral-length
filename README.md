# Challenge Spiral Length

This project provides a solution for a **Spiral Length** as described in: [Algorithm - L3 - Spiral Length.docx](./Algorithm - L3 - Spiral Length.docx)

## Design notes

### Overview

Application is split into three main logical components: the Command, Models and Services.

The Command acts as a "Controller" in MVC terms, is responsible of handling input, controlling the overall flow of 
execution and producing the desired outcome while consuming / interconnecting Models and Services.

The Models (again similar to MVC "Models"), provide app's structured data and logic.

The Services are dependencies to either the Models or the Command and augment them with any needed re-usable functionality. 
 
### Dependency Injection

Attention has been paid so that project structure facilitates testing, ie. components are generally loosely coupled or at least
their dependencies are defined in a way that they can be injected from "outside".

So, in general PHP-DI with constructor injection and auto-wiring (using type-hints) has been used widely.

In the case of dependencies against HaversineCalculator service, type-hints have been defined against an interface, 
so that the app can easily adopt another actual implementation if needed.

The Command component is the single component where it seemed that "partial" Dependency Injection is more adequate 
ie. Services are injected, Models are controlled directly. This still allowed it to be properly testable.

### Models

Models incorporate most of requirements' logic and are the following: 


### Generators

A very crucial point for the project is the ability to handle large data-sets.
To facilitate this, [Generators](https://www.php.net/manual/en/language.generators.php) have been adopted. 
Indeed, load testing proved that memory consumption is fixed and limited, regardless of the size of dataset.

### Testing

Project is covered comprehensively by unit-tests which cover adequately the most critical and complex parts: 
- execution flow
- tools used

## Notable assumptions not otherwise defined

 

## Getting Started

Instructions to get the app up and running on a local machine for development and testing purposes.

### Prerequisites

* PHP >= 7.4
* [composer](http://getcomposer.org/)  

### Installing

Install using composer:

```
composer install --no-dev
```

### Running the app

1. The input CSV file should be copied under `[preject's-root]/data/input` 

2. Next, to run the app:

```
php ./csl run [x] [y]
```

* `[x]`: X coordinate value
* `[y]`: Y coordinate value
* `--mem` flag: (Optional) Can be used to display max. memory usage by script


## Running the tests

For the tests to run, project should be installed in DEV mode: 

```
composer install --dev
```

Then run:
```
composer run tests
```

### Coding style tests

PHP-CodeSniffer has been used to ensure [PSR-2](https://www.php-fig.org/psr/psr-2/) compatibility.

The full set of rules used are defined in [cs-ruleset.xml](./cs-ruleset.xml)

## Built With

* [Silly CLI micro-framework](https://github.com/mnapoli/silly) 
Silly CLI micro-framework based on Symfony Console

* [PHP-DI](http://php-di.org) 
The dependency injection container for humans

### Tools used

* [PHPUnit](http://phpunit.de/) - The de-facto PHP-Unit suite 
* [GrumPHP](https://github.com/phpro/grumphp) - A PHP code-quality tool 
* [PHPMD](https://phpmd.org/) - PHP Mess Detector
* [PHP Codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) - Detection of violations  of a defined set of coding standards

## Versioning

**_v1.0.0_**

We use [SemVer](http://semver.org/) for versioning. 

## Authors

* **Andreas Sgouros** - [asgouros](https://www.linkedin.com/in/andreas-sgouros-46903a31/)

