<?php

use libs\Router;
use app\controllers\UsersController;
use libs\DB;

   Router::get('/', function (){
      echo 'đây là trang chủ';
      $db = DB::table('posts')->select('title, content')->distinct()->get();
      echo '<pre>';print_r($db);
   });
   Router::get('/{id}', function ($id){
      echo "đây là id = $id";
   });
   Router::get('/news', function (){
      echo 'Danh sách tin tức';
   });
   Router::get('/admin/news', function (){
      echo 'Danh sách tin tức admin';
   });
   Router::get('/news/{category}/{idCate}', [UsersController::class, 'news']);
   //      Router::get('/news/{category}/{id}', function ($cate, $id){
   //         echo "Tin tức thuộc danh mục $cate, id bài viết là $id";
   //      });
   Router::get('/admin/users', [UsersController::class, 'danhSach']);
   Router::post('/admin/users/edit/{id}', [UsersController::class, 'edit']);
   Router::get('/users/detail/id', [UsersController::class, 'danhSach']);
   Router::get('/users/detail/{id}', [UsersController::class, 'detail']);
   Router::get('/users', [UsersController::class, 'index']);
   Router::get('/admin/users/create', [UsersController::class, 'create']);
?>