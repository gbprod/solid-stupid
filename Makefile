.PHONY: install database run

install: vendor database

vendor:
	composer install

database:
	php bin/console doctrine:database:create --if-not-exists
	php bin/console doctrine:schema:update --force

run:
	php bin/console server:run

