<?php

namespace libs;


class App
{
   private $router;
   private static $controller;
   private static $action;

   public function __construct()
   {
      $this->router = new Router();
   }

   /**
    * lấy controller từ Router
    * @param $controller
    */
   public static function setController($controller)
   {
      self::$controller = $controller;
   }

   /**
    * @return $controller đã lấy
    */
   public static function getController()
   {
      return self::$controller;
   }

   /**
    * lấy function từ Router
    * @param $action
    */
   public static function setAction($action)
   {
      self::$action = $action;
   }

   /**
    * @return $action đã lấy
    */
   public static function getAction()
   {
      return self::$action;
   }

   public function run()
   {
      $this->router->getRoute();
   }
}