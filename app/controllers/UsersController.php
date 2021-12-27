<?php

namespace app\controllers;

use libs\Controller;

class UsersController extends Controller
{
   public function index()
   {
      self::view('index');
   }

   public function danhSach()
   {
      echo "Danh sách user từ admin";
   }

   public function detail($id)
   {
      echo 'Đây là hàm detail trong UserController có id = ' . $id;
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