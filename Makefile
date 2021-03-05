#!/usr/bin/make
# Makefile readme (ru): <http://linux.yaroslavl.ru/docs/prog/gnu_make_3-79_russian_manual.html>
# Makefile readme (en): <https://www.gnu.org/software/make/manual/html_node/index.html#SEC_Contents>
# https://gitlab.com/tarampampam/laravel-in-docker/

SHELL = /bin/sh

REGISTRY_HOST = registry.gitlab.com
REGISTRY_PATH = solution-base/solution-base-backend
IMAGES_PREFIX := $(shell basename $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST)))))

PUBLISH_TAGS = latest
PULL_TAG = latest

# Important: Local images naming should be in docker-compose naming style

APP_IMAGE = $(IMAGES_PREFIX)_app
APP_IMAGE_DOCKERFILE = ./deployment/local/app/Dockerfile
APP_IMAGE_CONTEXT = ./deployment/local/app

WEB_IMAGE = $(IMAGES_PREFIX)_web
WEB_IMAGE_DOCKERFILE = ./deployment/local/web/Dockerfile
WEB_IMAGE_CONTEXT = ./deployment/local/web


APP_CONTAINER_NAME := app
NODE_CONTAINER_NAME := node

docker_bin := $(shell command -v docker 2> /dev/null)
docker_compose_bin := $(shell command -v docker-compose 2> /dev/null)

all_images = $(APP_IMAGE) \
             $(WEB_IMAGE)


define PROJECT_ANNOUNCE
|------------------------------------------------|
|                                                |
|     Project at http://localhost:8050           |
|     App shell: make sh                         |
|                                                |
|------------------------------------------------|
endef
export PROJECT_ANNOUNCE

.PHONY : help build test clean \
         init app web frontend \
         up down restart sh install
.DEFAULT_GOAL := help

.EXPORT_ALL_VARIABLES:
	APP_IMAGE=$(APP_IMAGE)
	WEB_IMAGE=$(WEB_IMAGE)


# This will output the help for each task. thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
help: ## Show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# --- [ Application ] -------------------------------------------------------------------------------------------------

app: ## Application - build Docker image locally
	$(docker_bin) build \
	  --tag "$(APP_IMAGE)" \
	  -f $(APP_IMAGE_DOCKERFILE) $(APP_IMAGE_CONTEXT)

# --- [ Web ] -------------------------------------------------------------------------------------------------------

web: ## Web - build Docker image locally
	$(docker_bin) build \
	  --tag "$(WEB_IMAGE)" \
	  -f $(WEB_IMAGE_DOCKERFILE) $(WEB_IMAGE_CONTEXT)

# ---------------------------------------------------------------------------------------------------------------------

build: app web ## Build all Docker images

clean: ## Remove images from local registry
	-$(docker_compose_bin) down -v
	$(foreach image,$(all_images),$(docker_bin) rmi -f $(image);)

# --- [ Development tasks ] -------------------------------------------------------------------------------------------

-----------: ## ---------------

up: ## Start all containers (in background) for development
	$(docker_compose_bin) up --no-recreate -d

down: ## Stop all started for development containers
	$(docker_compose_bin) down

restart: ## Restart all started for development containers
	$(docker_compose_bin) restart

ps: ## Show compose services
	$(docker_compose_bin) ps

sh: ## Start shell into application container
	$(docker_compose_bin) exec "$(APP_CONTAINER_NAME)" bash

frontend: ## Build frontend
	$(docker_compose_bin) run --rm "$(NODE_CONTAINER_NAME)" npm run development

install: ## Install application dependencies into application container
	$(docker_compose_bin) run --rm "$(NODE_CONTAINER_NAME)" npm install
	$(docker_compose_bin) exec "$(APP_CONTAINER_NAME)" composer copy-env
	$(docker_compose_bin) exec "$(APP_CONTAINER_NAME)" composer install --no-interaction --ansi

init: build up install frontend ## Make full application initialization (install, seed, build assets, etc)
	$(docker_compose_bin) exec "$(APP_CONTAINER_NAME)" composer generate-app-key
	$(docker_compose_bin) exec "$(APP_CONTAINER_NAME)" php artisan migrate:fresh --force --seed --no-interaction -vvv
	@echo "$$PROJECT_ANNOUNCE"

test: up ## Execute application tests
	$(docker_compose_bin) exec "$(APP_CONTAINER_NAME)" composer test
