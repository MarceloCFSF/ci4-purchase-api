prod:
	docker compose up --build -d
	$(MAKE) migrate

dev:
	docker compose -f docker-compose.yml -f docker-compose.dev.yml up --build -d
	$(MAKE) migrate

down:
	docker compose down

migrate:
	docker compose exec -it app php spark migrate
