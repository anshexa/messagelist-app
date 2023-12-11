<?php
declare(strict_types=1);

require_once 'models/message_model.php';
require_once 'views/message_view.php';
require_once 'controllers/comment_controller.php';


class MessageController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new MessageModel();
        $this->view = new MessageView();
    }


    // обработка /index.php
    public function getListMessages(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formType = isset($_POST['form_type']) ? $_POST['form_type'] : '';

            if ($formType === 'add_message') {
                $title = $_POST['title'];
                $author = $_POST['author'];
                $summary = $_POST['summary'];
                $text = $_POST['text'];

                $this->model->addMessage($title, $summary, $text, $author);
            }
        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $numMessages = 3;

        $messageList = $this->model->getListMessages($currentPage, $numMessages);

        // для пагинации
        $totalMessages = $this->model->getCountMessages();
        $totalPages = ceil($totalMessages / $numMessages);
        $totalPages = (int)$totalPages;

        $messages = [
            'messages' => $messageList,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ];

        $this->view->renderMessageList($messages);
    }


    // обработка /message.php
    public function getMessage(): void
    {
        $messageId = (int)$_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formType = isset($_POST['form_type']) ? $_POST['form_type'] : '';

            if ($formType === 'edit_message') {
                $title = $_POST['title'];
                $summary = $_POST['summary'];
                $text = $_POST['text'];

                $this->model->editMessage($messageId, $title, $summary, $text);
            }

        }

        $message = $this->model->getMessage($messageId);

        $this->view->renderMessage($message);

        $commentController = new CommentController();
        $commentController->getComments();
    }
}
