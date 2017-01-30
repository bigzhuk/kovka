<?php
require_once('../static/admin_menu.php');
require_once('../classes/autoload.php');



$new_controller = new Katalog\Controller\Katalog(new \News\Model\News(), new \News\Decorator\News());
$new_controller->run();