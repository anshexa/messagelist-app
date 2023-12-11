<?php
declare(strict_types=1);


function connectToDB()
{
    $host = $_ENV['MYSQL_HOST']; // Имя контейнера MySQL, указанное в docker-compose.yml в container_name. Получаем из переменных окружения
    $dbname = $_ENV['MYSQL_DATABASE'];
    $user = $_ENV['MYSQL_USER'];
    $password = $_ENV['MYSQL_PASSWORD'];

    try {
        // подключение к бд
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // создаем таблицы
        $conn->exec('CREATE TABLE IF NOT EXISTS message (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(150), summary VARCHAR(150), text VARCHAR(1500), author VARCHAR(150))');
        $conn->exec('CREATE TABLE IF NOT EXISTS comment (id INT AUTO_INCREMENT PRIMARY KEY, message_id INT, author VARCHAR(150), text VARCHAR(1500))');

        return $conn;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
