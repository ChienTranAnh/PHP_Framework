<?php

namespace vendor;

class autoload
{
   public function __construct()
   {
      spl_autoload_register([$this, 'Autoloader']);
      require_once dirname(__DIR__) . '/routes/route.php';
   }

   private function Autoloader($class)
   {
      $file = dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
      if (file_exists($file)) {
         require_once dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
      } else exit("$class không tồn tại");
   }
}