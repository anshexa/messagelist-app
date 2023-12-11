<?php
// страница с сообщением

require_once 'views/templates/header.php';

require_once 'controllers/message_controller.php';
$controller = new MessageController();
$controller->getMessage();

require_once 'views/templates/footer.php';
