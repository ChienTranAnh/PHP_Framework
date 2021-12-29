<?php

namespace app\controllers;

use libs\Controller;
use libs\DB;

class UsersController extends Controller
{
   public function index()
   {
//      self::view('index', 'o to ke bo le ro');
      $db = DB::table('users')->get();
      echo '<pre>';print_r($db);
      return self::view('index', $db);
   }

   public function danhSach()
   {
      echo "Danh sách user từ admin";
   }

   public function detail($id)
   {
      $db = DB::table('users')->where('id','=',$id)->get();
      echo '<pre>';print_r($db);
      return $db;
   }

   public function edit($id)
   {
      echo "Check thử cái chơi $id";
   }

   public function news($category, $idCate)
   {
      echo "Tin tức có danh mục $category mang id = $idCate";
   }
}