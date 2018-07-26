# PHP PDF CV Generator

## Why?
Just wanted to write my own geekish simple pdf cv generator with php to update my old cv :)
No super styling done. Very quick and simple usage of tcpdf.

## Requirements
- php 7
- composer

## How to use
1) clone this repo
2) run composer install (you can do `wget https://getcomposer.org/download/1.6.5/composer.phar` inside repo directory if you don't have local composer)
3) copy `cli.php` to `out/cli.php`
4) modify `out/cli.php` with your data by changing example data
5) run `php out/cli.php > out/cv.pdf` to generate pdf with cv to `out` directory

## Usage and Contribution
Feel free to contribute any geeky stuff to this lib, just make it as simple as possible.
No licensing. Feel free to use or modify by any your needs
