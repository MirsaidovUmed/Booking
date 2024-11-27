.PHONY: $(MAKECMDGOALS)

.DEFAULT_GOAL := help
#SHELL := /bin/bash

SAIL := ./vendor/bin/sail

up: ## Up containers
	$(SAIL) up -d
	$(SAIL) npm run dev

down: ## Down containers in current project
	$(SAIL) down

restart: ## Restart containers
	$(SAIL) restart
	$(SAIL) npm run dev

migrate: ## run migrations
	$(SAIL) artisan migrate

seed: ## added info from seeders
	$(SAIL) artisan db:seed --class=RoleSeeder
	$(SAIL) artisan db:seed --class=DatabaseSeeder
	$(SAIL) artisan db:seed --class=HotelSeeder
	$(SAIL) artisan db:seed --class=RoomSeeder
	$(SAIL) artisan db:seed --class=FacilitySeeder
	$(SAIL) artisan db:seed --class=FacilityEntitySeeder
	$(SAIL) artisan db:seed --class=BookingSeeder
	$(SAIL) artisan db:seed --class=ReviewSeeder
