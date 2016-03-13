<?php
require_once('classes/autoload.php');

$new_controller = new News\Controller\News(new \News\Model\News(), new \News\Decorator\BlockKovkaFront());
$new_rows = $new_controller->getNewsModel()->getAllPublishedNews();
echo $new_controller->getNewsDecorator()->renderReklamniyBlock($new_rows);
