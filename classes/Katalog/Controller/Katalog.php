<?php
namespace Katalog\Controller;

 class Katalog {
     private $model = null;
     /** @var null|\News\Decorator\News */
     private $decorator = null;

     public function __construct(\News\Model\News $model, \News\Decorator\News $decorator) {
         $this->model = $model;
         $this->decorator = $decorator;
     }

     public function getNewsModel() {
         return $this->model;
     }

     public function getNewsDecorator() {
         return $this->decorator;
     }

     public function run() {
         if(!isset($_GET['action']) || empty($_GET['action'])) {
             $this->actionIndex();
             return null;
         }
         $method = 'action'.ucfirst($_GET['action']);
         if(method_exists($this, $method)) {
             $this->$method();
         }
         else {
             $this->actionIndex();
         }
     }

     /**
      * Действие по умолчанию
      * Выводит все новости в виде таблицы
      */
     public function actionIndex() {
         $out = \Auth\Decorator\Auth::renderExitLink().'<br/><br/>';
         if(isset($_GET['msg_action']) && !empty($_GET['msg_action'])) {
             $error_reason = isset($_GET['msg_err_reason']) ? $_GET['msg_err_reason'] : '';
             echo $this->getNewsDecorator()->renderResultMsg($_GET['msg_action'],$_GET['msg_result'], $error_reason);
         }
         $data = $this->getNewsModel()->getAllNews();
         $out .= $this->getNewsDecorator()->renderNewsTable($data);
         echo $out;
     }
 }