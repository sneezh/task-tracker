dc := docker-compose
de := docker-compose exec
de-php := $(de) php bash -c

reup: down up

rebuild: down build up

build:
	$(dc) build php

bash:
	$(de) php '/bin/bash'

nginx-sh:
	$(dc) exec nginx sh

up:
	$(dc) up -d

down:
	$(dc) down

composer:
	$(de-php) '$(MAKECMDGOALS)'

composer-install:
	$(de-php) 'composer install'


console:
	$(de-php) "bin/console $(filter-out $@,$(MAKECMDGOALS))"

migrate:
	$(de-php) 'bin/console doctrine:migrations:migrate --no-interaction'


### ---------------------
###	Help
### ---------------------
# ignore all not-found targets
%:
	@: