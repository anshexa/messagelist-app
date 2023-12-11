<?php
declare(strict_types=1);
require_once 'db_conn.php';


class MessageModel
{

    public function getListMessages(int $currentPage = 1, int $numMessages = 3): array
    {
        $offset = ($currentPage - 1) * $numMessages;

        $conn = connectToDB();

        $sql = "SELECT id, title, summary FROM message ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $numMessages, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();

    }

    public function getMessage(int $messageId): array
    {
        $conn = connectToDB();
        $sql = "SELECT id, title, summary, text, author FROM message WHERE id=:messageId";
        $stmt = $conn->prepare($sql); // подготавливаем
        $stmt->bindValue(":messageId", $messageId); // привязываем значение параметра
        $stmt->execute(); // исполняем

        return $stmt->fetch();
    }

    public function getCountMessages(): int
    {
        $conn = connectToDB();
        $sql = "SELECT COUNT(*) as count FROM message";
        $stmt = $conn->query($sql);
        $result = $stmt->fetch();

        return (int)$result['count'];
    }

    function addMessage(string $title, string $summary, string $text, string $author): void
    {
        $conn = connectToDB();

        $sql = "INSERT INTO message (title, summary, text, author) VALUES (:title, :summary, :text, :author)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":summary", $summary);
        $stmt->bindValue(":text", $text);
        $stmt->bindValue(":author", $author);
        $stmt->execute();
    }

    public function editMessage(int $messageId, string $title, string $summary, string $text): void
    {
        $conn = connectToDB();

        $sql = "UPDATE message SET title=:title, summary=:summary, text=:text WHERE id=:messageId";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":summary", $summary);
        $stmt->bindValue(":text", $text);
        $stmt->bindValue(":messageId", $messageId);
        $stmt->execute();
    }

}
