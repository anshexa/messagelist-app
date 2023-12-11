<?php
// страница со списком сообщений

require_once 'views/templates/header.php';

require_once 'controllers/message_controller.php';
$controller = new MessageController();
$controller->getListMessages();


require_once 'views/templates/footer.php';
