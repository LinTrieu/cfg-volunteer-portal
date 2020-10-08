.DEFAULT_GOAL := help

help:
	 @echo "Helper tasks for managing application via Makefile. Please input a make command."

install: ## Install composer dependencies
	composer install

test:
	php artisan test $(ARGS)

phpunit: ## Run phpunit test suite with stack trace
	vendor/bin/phpunit -v

migrate: ## Migrate database
	php artisan migrate

migrate-fresh: ## Recreate database fresh (drop all tables and migrate)
	php artisan migrate:fresh $(ARGS)

migrate-seed: ## Migrate and seed database
	php artisan migrate
	php artisan db:seed

migrate-rollback: ## Rollback database migration
	php artisan migrate:rollback

start: ## Serve application
	php artisan serve

tinker: ## Tinker REPL
	php artisan tinker

composer-dump-autoload: ## Run composer dump-autoload
	composer dump-autoload

composer-require: ## install or update latest versions of package dependencies
	composer require $(ARGS)

composer-install: ## install packages specified in composer lock file
	composer install $(ARGS)

composer-update: ## update packages to latest version, as stated in composer json
	composer update $(ARGS)

route: ## list routes --filter via name, path or method
	php artisan route:list

clear-config-cache: ## clear configuration cache
	php artisan config:clear

clear-application-cache: ## clear application cache
	php artisan cache:clear

clear-cache: ## clear config and application cache
	make clear-config-cache
	make clear-application-cache
