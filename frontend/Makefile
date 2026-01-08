CONTAINER:=keystone-keystone-frontend-1
DC_EXEC := docker exec -it $(CONTAINER)

.PHONY: help

help: ## Display this help screen
	@echo "\033[1;32mKeystone Backend CLI\033[0m"
	@echo "--------------------"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'
	@echo "--------------------"

install: ## Install dependencies and sync node_modules with host for PHPStorm
	$(DC_EXEC) pnpm install --no-frozen-lockfile

dev: ## Start all applications in development mode
	$(DC_EXEC) pnpm run dev

build: ## Compile all applications for production
	$(DC_EXEC) pnpm run build

terminal: ## Open bash terminal inside the container
	$(DC_EXEC) sh

lint: ## Run linter for the entire project
	@$(DC_EXEC) pnpm run lint

lint-fix:
	$(DC_EXEC) pnpm run lint-fix

format: ## Run prettier to format code in the entire project
	$(DC_EXEC) pnpm run prettier-format

# ---- SHOP WORKSPACE ----
shop-lint: ## Run linter for the shop application
	$(DC_EXEC) pnpm run -r --filter shop lint

shop-format: ## Format code for the shop application using prettier
	$(DC_EXEC) pnpm -r --filter shop therapeutic-format

# ---- ADMIN WORKSPACE ----
admin-lint: ## Run linter for the admin application
	$(DC_EXEC) pnpm run -r --filter admin lint

admin-format: ## Format code for the admin application using prettier
	$(DC_EXEC) pnpm -r --filter admin therapeutic-format

# ---- QUALITY ASSURANCE ----
before-commit: ## Run all frontend checks and stop on failure
	@echo "\033[1;33mRunning Frontend QA suite...\033[0m"
	$(MAKE) lint
	$(MAKE) shop-lint
	$(MAKE) admin-lint
	@echo "\033[1;32mAll frontend checks passed!\033[0m"