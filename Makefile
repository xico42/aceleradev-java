.PHONY: image it

COMPOSER_BIN ?= docker run --rm -it -v $(shell pwd):/opt/project fcoedno/aceleradev

it: image
	${COMPOSER_BIN} composer install

image:
	 docker build -t fcoedno/aceleradev .
