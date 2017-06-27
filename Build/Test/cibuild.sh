#!/usr/bin/env bash

echo "PWD: $(pwd)"

export TYPO3_PATH_WEB="$(pwd)/.Build/Web/"
export TYPO3_PATH_PACKAGES="$(pwd)/.Build/vendor/"
export TYPO3_BIN_DIR="$(pwd)/.Build/bin/"

export PATH="$PATH:$HOME/.composer/vendor/bin:$TYPO3_BIN_DIR"

echo "Run PHP Lint"
find . -name \*.php ! -path "./.Build/*" | parallel --gnu php -d display_errors=stderr -l {} > /dev/null \;

php-cs-fixer --version > /dev/null 2>&1
if [ $? -eq "0" ]; then
    echo "Check PSR-2 compliance"
    php-cs-fixer fix --level=psr2 --diff --verbose Classes

    if [ $? -ne "0" ]; then
        echo "Some files are not PSR-2 compliant"
        echo "Please fix the files listed above"
        exit 1
    fi
fi

echo "Run unit tests"
UNIT_BOOTSTRAP=".Build/vendor/nimut/testing-framework/res/Configuration/UnitTestsBootstrap.php"
phpunit --colors -c Build/Test/UnitTests.xml --coverage-clover=coverage.unit.clover --bootstrap=$UNIT_BOOTSTRAP
if [ $? -ne "0" ]; then
    echo "Error during running the unit tests please check and fix them"
    exit 1
fi

#
# Map the travis and shell variable names to the expected
# casing of the TYPO3 core.
#
if [ -n $TYPO3_DATABASE_NAME ]; then
	export typo3DatabaseName=$TYPO3_DATABASE_NAME
else
	echo "No environment variable TYPO3_DATABASE_NAME set. Please set it to run the integration tests."
	exit 1
fi

if [ -n $TYPO3_DATABASE_HOST ]; then
	export typo3DatabaseHost=$TYPO3_DATABASE_HOST
else
	echo "No environment variable TYPO3_DATABASE_HOST set. Please set it to run the integration tests."
	exit 1
fi

if [ -n $TYPO3_DATABASE_USERNAME ]; then
	export typo3DatabaseUsername=$TYPO3_DATABASE_USERNAME
else
	echo "No environment variable TYPO3_DATABASE_USERNAME set. Please set it to run the integration tests."
	exit 1
fi

if [ -n $TYPO3_DATABASE_PASSWORD ]; then
	export typo3DatabasePassword=$TYPO3_DATABASE_PASSWORD
else
	echo "No environment variable TYPO3_DATABASE_PASSWORD set. Please set it to run the integration tests."
	exit 1
fi

echo "Run functional tests"
FUNCTIONAL_BOOTSTRAP=".Build/vendor/nimut/testing-framework/res/Configuration/FunctionalTestsBootstrap.php"
phpunit --colors -c Build/Test/FunctionalTests.xml --coverage-clover=coverage.functional.clover --bootstrap=$FUNCTIONAL_BOOTSTRAP