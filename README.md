# tasker-in-docker

## Первоначальная настройка

-   Устанавливаем Docker c [официального сайта](https://www.docker.com/products/docker-desktop) и [Docker Compose](https://docs.docker.com/compose/install/);
-   Для пользователей Windows дополнительно необходимо установить виртуальное ядро Linux, следуя данной [инструкции](https://docs.docker.com/desktop/install/windows-install/);
-   Собираем контейнер командой в папке проекта `docker-compose up -d`;
-   Инициализируем сервер:
    -   при запущенном контейнере в папке проекта запускаем команду `docker-compose exec web bash`;
    -   Далее по [инструкции](https://github.com/vik-torch/tasker-panel)
