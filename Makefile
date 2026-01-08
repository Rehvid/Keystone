NETWORK_NAME:=keystone
DOCKER_COMPOSE_COMMAND := $(if $(shell command -v docker-compose), docker-compose, docker compose)

.PHONY: help build start stop destroy restart network-create qa

# --- Help ---
help: ## Display this help screen
	@echo "\033[1;35mKeystone Project Root CLI\033[0m"
	@echo "--------------------"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-25s\033[0m %s\n", $$1, $$2}'
	@echo "--------------------"

network-create: ## Create the docker network if it doesn't exist
	@if docker network ls -q --filter name='^$(NETWORK_NAME)$$' | xargs -r false; then \
		case "$(NETWORK_NAME)" in \
		""|none|container:*|host|ns:*|private|slirp4netns*) true ;; \
		*) docker network create $(NETWORK_NAME) ;; \
		esac; \
	fi

build: ## Build docker images
	$(DOCKER_COMPOSE_COMMAND) build

start: ## Start all containers in background
	$(DOCKER_COMPOSE_COMMAND) up -d

stop: ## Stop all containers
	$(DOCKER_COMPOSE_COMMAND) stop

restart: ## Restart all containers
	$(DOCKER_COMPOSE_COMMAND) restart

destroy: ## Stop and remove all containers and networks
	$(DOCKER_COMPOSE_COMMAND) down

# ---- Global QA ----
qa: ## Run full Quality Assurance suite (Backend & Frontend)
	@echo "\033[1;33mStarting Global QA Suite...\033[0m"
	$(MAKE) backend-before-commit
	$(MAKE) frontend-before-commit
	@echo "\033[1;32mGlobal QA Passed!\033[0m"

backend-%:
	$(MAKE) -C backend $*

front-%:
	$(MAKE) -C frontend $*