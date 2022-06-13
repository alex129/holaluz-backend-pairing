##Made with

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Getting started

Requirements:

- docker

Initialization:

Create a sail alias

`alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`

Execute sail (This will execute a docker container)

`sail up`

The XML and CSV files must to be located in storage/files

Command

`sail artisan read:readings filename.xml`

## Code 

The main class of the project is located in app/Console/Commands/checkCustomerReadings.php

Te function handle will execute the logic of the `read:readings {file_name}` command.

## Testing
Tests are located in test folder.

Execute testing

`sail test`


