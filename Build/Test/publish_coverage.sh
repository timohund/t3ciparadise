#!/usr/bin/env bash

if [ $TRAVIS ]; then
    # Travis does not have composer's bin dir in $PATH
    export PATH="$PATH:$HOME/.composer/vendor/bin"
fi

ocular code-coverage:upload --format=php-clover coverage.unit.clover
ocular code-coverage:upload --format=php-clover coverage.functional.clover