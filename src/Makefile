.PHONY: init test

init: ## Install dependencies and prepare the app
	composer install
	cp -n .env.example .env || true
	php artisan key:generate
	php artisan migrate
	php artisan db:seed
	@echo "Project initialized"
