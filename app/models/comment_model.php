<?php
declare(strict_types=1);

require_once 'db_conn.php';


class CommentModel
{
    public function getComments(int $messageId): array
    {
        $conn = connectToDB();

        $sql = "SELECT id, author, text FROM comment WHERE message_id=:messageId ORDER BY id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':messageId', $messageId);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function addComment(int $messageId, string $author, string $text): void
    {
        $conn = connectToDB();

        $sql = "INSERT INTO comment (message_id, author, text) VALUES (:messageId, :author, :text)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":messageId", $messageId);
        $stmt->bindValue(":author", $author);
        $stmt->bindValue(":text", $text);
        $stmt->execute();
    }

}
