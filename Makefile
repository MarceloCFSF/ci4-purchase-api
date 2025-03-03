prod:
	docker compose -f docker-compose.yml -f docker-compose.prod.yml up --build -d

dev:
	docker compose -f docker-compose.yml -f docker-compose.dev.yml up --build -d

down:
	docker compose down

migrate:
	docker compose exec -it app php spark migrate
