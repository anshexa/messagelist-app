## Описание
Приложение со следующей функциональностью:
1. Пользователь просматривает список сообщений.  
   Элемент списка отображается
   следующим образом: заголовок сообщения и краткое содержание. Постраничный вывод
   сообщений.
2. Пользователь просматривает сообщение со списком комментариев.
3. Пользователь добавляет сообщение. Сообщение состоит из:
    - заголовок;
    - автор;
    - краткое содержание;
    - полное содержание.
4. Пользователь редактирует сообщение.
5. Пользователь добавляет комментарий.

### Используемые инструменты:
* PHP 8.2
* MYSQL 8.0
* HTML 5
* Bootstrap 5.3
* Docker / Docker-compose

В разработке использован паттерн MVC.

## Запуск приложения через Docker
* Клонируйте репозиторий
    ```bash
    git clone https://github.com/anshexa/messagelist-app.git
    ```
* Перейдите в директорию
    ```bash
    cd messagelist-app
    ```
### Перед запуском
* Создайте файл `.env` с переменными окружения по примеру файла `example.env`

### Запуск через Docker
```bash
$ docker-compose up --build
```

## Открыть приложение в браузере 
можно по адресу http://localhost:8080

### Скриншоты
![message_list](https://user-images.githubusercontent.com/109981473/289507485-551a763c-6f3f-4946-9691-6beb3efb1e50.png)
![message_comments](https://user-images.githubusercontent.com/109981473/289508360-9e6205bc-975f-4b56-85c6-0159b6b8ae94.png)
