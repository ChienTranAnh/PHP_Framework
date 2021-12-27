<?php

namespace libs;

class Controller
{
   /**
    * chuyển hướng sang đường dẫn được yêu cầu
    *
    * @param $url
    */
   public function redirect($url, $isEnd = true, $resPonseCode =302)
   {
      header('location:'.$url,true,$resPonseCode);
      if ($isEnd)
         exit();
	}

	/**
	 * Render ra view file trong thư mục views
    *
    * @param $view, $data
    */
   public function view($view, $data = null)
   {
      $controller = explode('\\',App::getController())[2];
      $folderView = strtolower(str_replace('Controller', '', $controller));
      $viewFile = dirname(__DIR__) . '/views/' . $folderView . '/' . $view . '.php';
      if (file_exists($viewFile))
      {
         include_once $viewFile;
      } else echo "File $view.php khong ton tai!";
	}
}