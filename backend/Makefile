CONTAINER:=keystone-keystone-app-1
DC_EXEC := docker exec -it $(CONTAINER)

.PHONY: help

help: ## Display this help screen
	@echo "\033[1;32mKeystone Backend CLI\033[0m"
	@echo "--------------------"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'
	@echo "--------------------"

init: ## Init symfony composer, migration and generate JWT
	@echo "🚀 Init symfony..."
	$(MAKE) install
	$(MAKE) create-database
	$(MAKE) migrate
	$(MAKE) jwt-generate
	$(MAKE) cache-clear
	@echo "✅ Backend Symfony is ready!"


install: ## Install composer dependencies
	$(DC_EXEC) composer install

terminal: ## Open bash terminal inside the container
	$(DC_EXEC) bash

cache-clear: ## Clear Symfony cache
	$(DC_EXEC) php bin/console cache:clear

# ---- Libraries ----

openapi-generate: ## Generate OpenAPI documentation from attributes
	$(DC_EXEC) bin/console nelmio:apidoc:dump --format=yaml > openapi.yaml

jwt-generate: ## Generate JWT (LexikJWTBundle) keys
	$(DC_EXEC) php bin/console lexik:jwt:generate-keypair --overwrite --no-interaction

# ---- DATABASE ----
create-database:
	$(DC_EXEC) php bin/console doctrine:database:create --if-not-exists

create-migration: ## Generate a new doctrine migration
	$(DC_EXEC) php bin/console make:migration

migrate: ## Run pending migrations
	$(DC_EXEC) php bin/console doctrine:migrations:migrate --no-interaction

schema-validate: ## Validate doctrine mapping and sync state
	$(DC_EXEC) php bin/console doctrine:schema:validate

revert-migration: ## Revert migration default last
	$(DC_EXEC) php bin/console doctrine:migrations:migrate prev

# ---- QUALITY ASSURANCE ----

phpstan: ## Run static analysis using PHPStan
	$(DC_EXEC) vendor/bin/phpstan analyse src/

phpcsfixer: ## Fix code style using PHP-CS-Fixer
	$(DC_EXEC) vendor/bin/php-cs-fixer fix src --allow-risky=yes

phpunit: ## Run unit and integration tests
	$(DC_EXEC) vendor/bin/phpunit $(ARGS)

deptrac: ## Enforce architectural layer boundaries
	$(DC_EXEC) vendor/bin/deptrac analyse

before-commit: ## Run all QA tools before pushing code
	@echo "\033[1;33mRunning QA suite...\033[0m"
	$(MAKE) schema-validate
	$(MAKE) deptrac
	$(MAKE) phpstan
	$(MAKE) phpunit
	$(MAKE) phpcsfixer
	@echo "\033[1;32mAll checks passed!\033[0m"
