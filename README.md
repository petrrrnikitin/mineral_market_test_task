

### Install

* Клонируем репозиторий
    ```bash
    git clone https://github.com/petrrrnikitin/mineral_market_test_task.git
    cd mineral_market_test_task
    rm -rf .git
    ```
* Устанавливаем зависимости
    ```bash
    composer install
     
    ```

   
### Setting
* Настраниваем `config/db` (соединение с БД)
* Выполняем миграцию, заполняем БД ...
    ```bash
    php yii migrate/fresh
    ```

### Run
* Запускаем сервер
    ```bash
    php yii serve
    ```
* Открываем браузер по ссылке `http://localhost::8000`


