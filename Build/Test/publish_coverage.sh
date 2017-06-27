#!/usr/bin/env bash

ocular code-coverage:upload --format=php-clover coverage.unit.clover
ocular code-coverage:upload --format=php-clover coverage.functional.clover