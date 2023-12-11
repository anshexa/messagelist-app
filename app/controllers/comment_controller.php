<?php
declare(strict_types=1);

require_once 'models/comment_model.php';
require_once 'views/comment_view.php';


class CommentController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new CommentModel();
        $this->view = new CommentView();
    }

    public function getComments(): void
    {
        $messageId = (int)$_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formType = isset($_POST['form_type']) ? $_POST['form_type'] : '';

            if ($formType === 'add_comment') {
                $author = $_POST['author'];
                $text = $_POST['text'];

                $this->model->addComment($messageId, $author, $text);
            }
        }

        $comments = $this->model->getComments($messageId);

        $this->view->renderListComments($comments);
    }

}
