# ACF Encrypted Password

[![Packagist](https://img.shields.io/packagist/v/log1x/acf-encrypted-password.svg?style=flat-square)](https://packagist.org/packages/log1x/acf-encrypted-password)
[![Packagist Downloads](https://img.shields.io/packagist/dt/log1x/acf-encrypted-password.svg?style=flat-square)](https://packagist.org/packages/log1x/acf-encrypted-password)

This is a simple ACF field to use in place of the default Password field to encrypt the password stored in the database using PHP 5.5's `password_hash()` function.

## Requirements

* PHP >= 7
* ACF >= 5

## Installation

```bash
$ composer require log1x/acf-encrypted-password
```

## Usage

You can verify the password using PHP 5.5's `password_verify()` function like so:

```php
$input = $_GET['password'];
$hash  = get_field('password');

if (password_verify($input, $hash)) {
  echo 'Correct';
} else {
  echo 'Incorrect';
}
```
