<?php

namespace libs;

class Router
{
   private static $routes = [];

   /**
    * lấy đường dẫn từ $_SERVER
    */
   private function getRequestURL()
   {
      $url = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : '/';
      $url = str_replace('/public', '', $url);
      $url = $url === '' || empty($url) ? '/' : $url;

      return $url;
   }

   /**
    * lấy phương thức từ $_SERVER
    */
   private function getMethod()
   {
      return $_SERVER['REQUEST_METHOD'] ? $_SERVER['REQUEST_METHOD'] : 'GET';
   }

   /**/
   private static function addRoute($method, $url, $action)
   {
      self::$routes[] = [
         'method' => $method,
         'route' => $url,
         'action' => $action
      ];
//      $this->routes[] = [$method, $url, $action];
   }

   /**
    *
    */
   public static function get($url, $action)
   {
      self::addRoute('GET', $url, $action);
   }

   /**
    *
    */
   public static function post($url, $action)
   {
      self::addRoute('POST', $url, $action);
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

      foreach (self::$routes as $route)
      {
         // lấy giá trị của mảng tuần tự route
         list($method, $url, $action) = array_values($route);

         // nếu phương thức không khớp
         if (strpos($method, $reqMed) === false) {
            continue;
         }

         // nếu xuất hiện { hoặc }
         if (strpos($url, '{') != false || strpos($url, '}') != false)
         {
            //  nếu số lượng { không bằng }
            if (substr_count($url, '{') != substr_count($url, '}'))
            {
               exit("Lỗi route!");
            }
            else
            {
               $arrParams = explode('/', $url);
               $reqParams = explode('/', $reqURL);

               if (count($arrParams) != count($reqParams)) {
                  continue;
               } else
               if ($arrParams[1] == $reqParams[1]) {
                  foreach ($arrParams as $key => $values) {
                     if (preg_match('/^{[A-z]+}$/', $values)) {
                        $params[] = $reqParams[$key];
                     }
                  }
                  $checkURL = true;
               }
            }
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
            if (is_array($action))
            {
               if (class_exists($action[0]))
               {
                  if (method_exists($action[0], $action[1]))
                  {
                     call_user_func_array($action, $params);
                     return;
                  } else {
                     exit("Hàm $action[1] không tồn tại trong class $action[0]");
                  }
               } else {
                  exit("Class $action[0] không tồn tại");
               }
            }
            elseif (is_callable($action))
            {
               $action();
               return;
            }
         }
      }
      return;
   }

   /**
    *
    */
   public function getRoute()
   {
      $this->matching();
   }
}