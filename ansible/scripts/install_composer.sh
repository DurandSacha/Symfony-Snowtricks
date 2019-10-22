#!/bin/sh

php -r "copy ('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "si (a sha_file) php ');} echo PHP_EOL; "
php composer-setup.php
php -r "unlink ('composer-setup.php');"
