# Практическая работа 8

## Локальная разработка

Сначала нужно запустить тестовый docker-compose

```
docker-compose -f .\docker-compose.develop.yml up
```

Затем нужно с помощью intellij idea открыть и запустить проект java

java работает на `http://localhost:8080`

nginx работает на `http://localhost:80`

Доступ к php через nginx

## Запуска всего через docker-compose
Сначала билдим проект java
```
cd ./java
./mvnw clean install -DskipTests
```

Потом запускаем сам docker-compose

```
cd ../
docker-compose -f .\docker-compose.production.yml up
```

Доступ к приложению осуществляется через nginx по урлу `http://localhost`
