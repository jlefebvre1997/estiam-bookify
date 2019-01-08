DOCKER_COMPOSE  = docker-compose

EXEC_PHP        = $(DOCKER_COMPOSE) exec -T php /entrypoint
EXEC_JS         = $(DOCKER_COMPOSE) exec -T node /entrypoint

SYMFONY         = $(EXEC_PHP) bin/console
COMPOSER        = $(EXEC_PHP) composer
NPM             = $(EXEC_JS) npm

##
## Project
## -------
##

build: .env
	touch docker/data/history
	$(DOCKER_COMPOSE) build

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

install: build start db assets                               ## Install and start the project

reset: kill install                                          ## Stop and start a fresh install of the project

start: .env                                                  ## Start the project
	$(DOCKER_COMPOSE) up -d

stop:                                                        ## Stop the project
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

clean: kill                                                  ## Stop the project and remove generated files
	rm -rf .env vendor node_modules var/cache/* var/log/* var/sessions/* docker/data/*

.PHONY: build kill install reset start stop clean

##
## Utils
## -----
##

db: .env vendor                                              ## Reset the database and load fixtures
	@$(EXEC_PHP) php -r 'echo "Wait database...\n"; set_time_limit(15); require __DIR__."/vendor/autoload.php"; (new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__."/.env"); $$host = getenv("MYSQL_HOST"); for(;;) { if(@fsockopen($$host.":3306")) { break; }}'
	$(SYMFONY) doctrine:database:drop --if-exists --force
	$(SYMFONY) doctrine:database:create --if-not-exists
	$(SYMFONY) doctrine:migrations:migrate --no-interaction --allow-no-migration
	#$(SYMFONY) doctrine:schema:update --force --no-interaction
	$(SYMFONY) doctrine:fixtures:load --no-interaction --append

assets: node_modules                                         ## Run Webpack Encore to compile assets
	$(NPM) run build

watch: node_modules                                          ## Run Webpack Encore in watch mode
	$(NPM) run watch

cc:                                                          ## Clear the cache in dev env
	$(SYMFONY) cache:clear --no-warmup
	$(SYMFONY) cache:warmup

node:                                                        ## Run interactive bash inside node
	$(DOCKER_COMPOSE) run --rm node sh

php:                                                         ## Run interactive bash inside php
	$(DOCKER_COMPOSE) run --rm php bash

xdebug:                                                      ## Run interactive xdebug bash inside php
	$(DOCKER_COMPOSE) run --rm -e XDEBUG=1 php bash

mysql:                                                       ## Connect to mysql
	$(DOCKER_COMPOSE) exec mariadb sh -c 'mysql -h $$MYSQL_HOST -u $$MYSQL_USER -p"$$MYSQL_PASSWORD" $$MYSQL_DATABASE'

mysqldump:                                                     ## Mysqldump
	$(DOCKER_COMPOSE) exec -T mariadb sh -c 'mysqldump -h $$MYSQL_HOST -u $$MYSQL_USER -p"$$MYSQL_PASSWORD" $$MYSQL_DATABASE' > docker/data/mysqldump_$$(date +%Y-%m-%d_%H:%M).sql

.PHONY: db assets watch cc node php mysql mysqldump

# rules based on files
composer.lock: composer.json
	$(COMPOSER) update --lock --no-scripts --no-interaction

vendor: composer.lock
	$(COMPOSER) install

node_modules: package-lock.json
	$(NPM) install
	@touch -c node_modules

package-lock.json: package.json
	$(NPM) update

.env: .env.dist
	@if [ -f .env ]; \
	then\
		echo '\033[1;41m/!\ The .env.dist file has changed. Please check your .env file (this message will not be displayed again).\033[0m';\
		touch .env;\
		exit 1;\
	else\
		echo cp .env.dist .env;\
		cp .env.dist .env;\
	fi

##
## Tests
## -----
##

test: tu tf ## Run unit and functional tests

tu: vendor ## Run unit tests
	$(EXEC_PHP) ./vendor/bin/simple-phpunit install
	$(EXEC_PHP) ./vendor/bin/simple-phpunit --exclude-group functional

##
## Quality assurance
## -----------------
##

lint: ly                                                     ## Lints twig and yaml files

ly: vendor
	$(SYMFONY) lint:yaml config

php-cs-fixer:                                                ## php-cs-fixer (http://cs.sensiolabs.org)
	$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --verbose --diff

.PHONY: lint ly php-cs-fixer

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
