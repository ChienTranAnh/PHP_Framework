<?php

use libs\Router;
use app\controllers\UsersController;
use libs\DB;

   Router::get('/', function (){
      echo 'Trang này không có gì cả!';
//      $db = DB::table('users')->insert(['username'=>'rosechen', "password"=>'123', "fullname"=>"Hongngng"]);
//      $db = DB::table('users')->where('id','=',4)->get();
//      $db = DB::table('users')->where('id','=',2)->update(['username'=>'mon_lon_ton', "password"=>'789', "fullname"=>"Anh Mon"]);
//      $db = DB::table('users')->where('id','=',4)->delete();
//      echo '<pre>';print_r($db);
   });

   Router::get('/api/users', [UsersController::class, 'indexAPI']);
   Router::get('/users', [UsersController::class, 'index']);
   Router::get('/users/create', [UsersController::class, 'create']);
   Router::post('/users/create', [UsersController::class, 'store']);
   Router::get('/users/detail/{id}', [UsersController::class, 'detail']);
   Router::post('/users/detail/{id}', [UsersController::class, 'update']);
   Router::get('/delete-users/{id}', [UsersController::class, 'delete']);
?>
