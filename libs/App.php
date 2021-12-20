<?php

namespace libs;
use app\controllers\UsersController;

class App
{
   private $router;

   public function __construct()
   {
      $this->router = new Router();
   }

   public function run()
   {
      $this->router->get('/', function (){
         echo 'đây là trang chủ';
      });
      $this->router->get('/{id}', function ($id){
         echo "đây là id = $id";
      });
      $this->router->get('/news', function (){
         echo 'Danh sách tin tức';
      });
      $this->router->get('/admin/news', function (){
         echo 'Danh sách tin tức admin';
      });
      $this->router->get('/news/{category}/{idCate}', [UsersController::class, 'news']);
//      $this->router->get('/news/{category}/{id}', function ($cate, $id){
//         echo "Tin tức thuộc danh mục $cate, id bài viết là $id";
//      });
      $this->router->get('/admin/users', [UsersController::class, 'danhSach']);
      $this->router->post('/admin/users/edit/{id}', [UsersController::class, 'edit']);
      $this->router->get('/users/detail/{id}', [UsersController::class, 'detail']);
      $this->router->get('/users', [UsersController::class, 'index']);
      $this->router->post('/admin/users/create',[UsersController::class, 'create']);
      $this->router->getRoute();
   }
}