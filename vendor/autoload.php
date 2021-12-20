<?php

namespace vendor;
// echo __DIR__.'<br>';
// echo dirname(__DIR__).'<br>';
// echo dirname(__FILE__).'<br>';
// echo __FILE__.'<br>';

class autoload
{
   public function __construct()
   {
      spl_autoload_register([$this, 'Autoloader']);
   }

   private function Autoloader($class)
   {
      $file = dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
      if (file_exists($file)) {
         require_once dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
      }
   }
}