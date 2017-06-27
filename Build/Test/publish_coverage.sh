#!/usr/bin/env bash

wget https://scrutinizer-ci.com/ocular.phar
php ocular.phar code-coverage:upload --format=php-clover coverage.unit.clover
php ocular.phar code-coverage:upload --format=php-clover coverage.functional.clover