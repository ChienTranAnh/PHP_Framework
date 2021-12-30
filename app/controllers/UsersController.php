<?php

namespace app\controllers;

use libs\Controller;
use libs\DB;

class UsersController extends Controller
{
   /**
    * hàm hiển thị danh sách User
    */
   public function index()
   {
      $db = DB::table('users')->get();

      return self::view('index', $db);
   }

   /**
    * hàm hiển thị danh sách User json
    */
   public function indexAPI()
   {
      $db = DB::table('users')->get();
      echo json_encode($db);
   }

   /**
    * hàm hiện thị form thêm mới User
    */
   public function create()
   {
      return self::view('createUser');
   }

   /**
    * hàm thêm mới User
    */
   public function store($data = [])
   {
      $data['fullname'] = $_POST['t_fullname'];
      $data['username'] = $_POST['t_username'];
      $data['password'] = md5($_POST['t_password']);
      $data['email'] = $_POST['t_email'];
      $data['created_at'] = date('Y-m-d H:i:s');

      DB::table('users')->insert($data);

      return self::redirect('/users');
   }

   public function detail($id)
   {
      $detailUser = DB::table('users')->where('id','=',$id)->get();

      return self::view('updateUser', $detailUser);
   }

   /**
    * Hàm cập nhật User
    */
   public function update($id)
   {
      $data = [];
      $data['fullname'] = $_POST['t_fullname'];
      $data['username'] = $_POST['t_username'];
      $data['email'] = $_POST['t_email'];
      $data['updated_at'] = date('Y-m-d H:i:s');

      DB::table('users')->where('id','=',$id)->update($data);

      return self::redirect('/users');
   }

   public function news($category, $idCate)
   {
      echo "Tin tức có danh mục $category mang id = $idCate";
   }

   /**
    * hàm xóa User
    */
   public function delete($id)
   {
      DB::table('users')->where('id','=',$id)->delete();

      return self::redirect('/users');
   }
}