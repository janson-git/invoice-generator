up:
	docker-compose up -d
	@echo 'Open http://localhost:44321/ in your browser'
down:
	docker-compose down
build:
	docker-compose build