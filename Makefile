.PHONY: start
start: erase build up ## clean env, run composer install, up docker-compose

.PHONY: update
update: stop build up migrate

.PHONY: stop
stop: ## stop environment
		docker-compose stop

.PHONY: erase
erase: ## clean environment
		docker-compose stop
		docker-compose rm -v -f

.PHONY: build
build: ## build environment and initialize composer and project dependencies
		docker-compose build
		docker-compose run --rm php sh -lc 'xoff;COMPOSER_MEMORY_LIMIT=-1 composer install'

.PHONY: up
up: ## spin up environment
		docker-compose up -d

.PHONY: bash
bash: ## run bash inside php container
		docker-compose exec php bash -i

.PHONY: cs
cs: ## run cs fixer
		docker-compose run --rm php php ./vendor/bin/php-cs-fixer fix --config ".php_cs.dist"

.PHONY: logs
logs: ## look for 's' service logs, make s=php logs
		docker-compose logs -f $(s)

.PHONY: help
help: ## Display this help message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'