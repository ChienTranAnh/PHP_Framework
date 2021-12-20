<?php

namespace app\core;


class Router
{
   private $routes = [];

  // public function __construct()
  // {
  // }

   /**
    * Get url from $_SERVER
    */
   private function getRequestURL()
   {
      $url = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : '/';
      $url = str_replace('/public', '', $url);
      $url = $url === '' || empty($url) ? '/' : $url;

      return $url;
   }

   /**
    * Get method from $_SERVER
    */
   private function getMethod()
   {
      $method = $_SERVER['REQUEST_METHOD'] ? $_SERVER['REQUEST_METHOD'] : 'GET';
      return $method;
   }

   /**/
   protected function addRoute($method, $url, $action)
   {
      $this->routes[] = [
         'method' => $method,
         'route' => $url,
         'action' => $action
      ];
//      $this->routes[] = [$method, $url, $action];
   }

   /**
    *
    */
   public function get($url, $action)
   {
      $this->addRoute('GET', $url, $action);
   }

   /**
    *
    */
   public function post($url, $action)
   {
      $this->addRoute('POST', $url, $action);
   }

   /**
    *
    */
   private function matching()
   {
      $reqURL = $this->getRequestURL();
      $reqMed = $this->getMethod();
      $params = [];
      $checkURL = false;

      foreach ($this->routes as $route)
      {
         // lấy giá trị của mảng tuần tự route
         list($method, $url, $action) = array_values($route);

         // nếu phương thức không khớp
         if (strpos($method, $reqMed) === false) {
            continue;
         }

         // nếu tồn tại đủ 2 dấu {}
         if (strpos($url, '{') != false && strpos($url, '}') != false)
         {
            $arrParams = explode('/', $url);
            $reqParams = explode('/', $reqURL);
//            echo '<pre>';
//            print_r($arrParams);
//            print_r($reqParams);
            if (count($arrParams) != count($reqParams)){continue;}
            if ($arrParams[1] == $reqParams[1]) {
               foreach ($arrParams as $key => $values) {
                  if (preg_match('/^{[A-z]+}$/', $values)) {
                     $params[] = $reqParams[$key];
                  }
               }
               $checkURL = true;
            }
//            echo '<pre>';
//            print_r($params);
         }
         elseif (strpos($url, '{') == false && strpos($url, '}') != false || strpos($url, '{') != false && strpos($url, '}') == false) {
            echo "Lỗi route!";break;
         }
         else
         {
            // nếu phương thức khớp
            if (strpos($method, $reqMed) !== false)
            {
               // nếu đường dẫn đúng
               if (strcmp(strtolower($url), strtolower($reqURL)) == 0)
               {
                  $checkURL = true;
               }
               else continue;
            }
         }
         if ($checkURL == true)
         {
            if (is_callable($action))
            {
               call_user_func_array($action, $params);
               var_dump($params);
               return;
            }
         }
      }
//      return;
   }

   /**
    *
    */
   public function getRoute()
   {
      $this->matching();
   }
}