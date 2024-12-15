# Tasker-panel

Необходимые инструменты:
1. php >= 8.2
2. composer
3. MySql

Шаги деплоя:
1. Установка composer компонентов
```$ composer install```

2. Добавление переменных среды.
    - Создание необходимого файла:
    ```$ cp .env.example .env```
    - Заполнение конфигурационных данных для подключения к бд