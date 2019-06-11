.PHONY: image it tests solution

DOCKER_RUN :=  docker run --rm -it -v $(shell pwd):/opt/project fcoedno/aceleradev
COMPOSER_BIN ?= ${DOCKER_RUN} composer
PHPUNIT_BIN ?= ${DOCKER_RUN} php vendor/bin/phpunit

it: image tests

vendor: composer.json composer.lock
	@${COMPOSER_BIN} install

tests: vendor
	@${PHPUNIT_BIN}

image:
	@docker build -t fcoedno/aceleradev .

solution:
	@bin/app php bin/console download-challenge answer.json
	@bin/app php bin/console solve-challenge answer.json
