<?php

namespace libs;

use PDO;
use \app\Config;

class DB
{
   private $table;
   private $fields;
   private $distinct;
   private $where;
   private $limit;
   private $db;

   public function __construct($table_name)
   {
      $this->table = $table_name;
      $this->connect();
   }

   /**
    * Kến nối csdl
    */
   protected function connect()
   {
      if ($this->db === null) {

         try
         {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $this->db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch (PDOException $e)
         {
            echo "Connection failed: " . $e->getMessage();
         }
      }

      return $this->db;
   }

   /**
    * hàm ngắt kết nối
    */
   protected function dis_connect()
   {
      if ($this->db)
      {
         $db = null;
      }
   }

   /**
    * Gọi tên bảng trong csdl
    */
   public static function table($table_name)
   {
      return new self($table_name);
//      self::$table = $table_name;
//      return self::$table;
   }

   public function select($field)
   {
      $this->fields = $field;
      return $this;
   }

   public function distinct()
   {
      $this->distinct = true;
      return $this;
   }

   public function where($field, $operator, $value, $logic = 'AND')
   {
      $this->where[] = [$field, $operator, $value, $logic];
      return $this;
   }

   public function limit($limit)
   {
      $this->limit = $limit;
      return $this;
   }

   /**
    * lấy hết dữ liệu
    */
   public function get()
   {
      if (!isset($this->table) || empty($this->table))
      {
         return false;
      }

      $sql = $this->distinct ? 'SELECT DISTINCT ' : 'SELECT ';

      // kiểm tra nếu có chọn trường
      if (isset($this->fields))
      {
         $sql .= $this->fields;
      } else $sql .= '*';

      $sql .= ' FROM ' . $this->table;

      if (isset($this->where) && is_array($this->where))
      {
         $sql .= ' WHERE';
         foreach ($this->where as $key => $where)
         {
            $sql .= " $where[0] $where[1] '$where[2]'";
            if ($key < count($this->where) - 1)
            {
               $sql .= " $where[3]";
            }
         }
      }

      if (isset($this->limit) and intval($this->limit))
      {
         $sql .= " LIMIT $this->limit";
      }

      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $result;
//      return $sql;
   }

   /**
    * thêm mới dữ liệu
    */
   public function insert($data)
   {
      if (!isset($this->table) || empty($this->table))
      {
         return false;
      }

      $fields_list = '';
      $values_list = '';
      $sql = "INSERT INTO $this->table(";

      foreach ($data as $key => $value){
         $fields_list .= ", $key";
         $values_list .= ", " . "'$value'";
      }
      $sql .= trim($fields_list, ', ') . ") VALUES(" . trim($values_list, ', ') . ")";

      return $this->db->exec($sql);
   }

   /**
    * hàm cập nhật
    */
   public function update($data = [])
   {
      if (!isset($this->table) || empty($this->table))
      {
         return false;
      }

      $sql = "UPDATE $this->table SET ";
      foreach ($data as $key => $value){
         $sql .= "$key = '".$value."', ";
      }

      $sql = trim($sql, ', ');

      if (isset($this->where) && is_array($this->where))
      {
         $sql .= ' WHERE';
         foreach ($this->where as $key => $where)
         {
            $sql .= " $where[0] $where[1] '$where[2]'";
            if ($key < count($this->where) - 1)
            {
               $sql .= " $where[3]";
            }
         }
      }

      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      if ($stmt->rowCount() > 0)
         return "$stmt->rowCount() records UPDATED successfully";
      else
//      echo '<pre>'; print_r($data);
      return "Update fails";
   }

   /**
    * hàm xóa
    */
   public function delete()
   {
      if (!isset($this->table) || empty($this->table))
      {
         return false;
      }

      $sql = "DELETE FROM $this->table";

      if (isset($this->where) && is_array($this->where))
      {
         $sql .= ' WHERE';
         foreach ($this->where as $key => $where)
         {
            $sql .= " $where[0] $where[1] '$where[2]'";
            if ($key < count($this->where) - 1)
            {
               $sql .= " $where[3]";
            }
         }
      }

      return $this->db->exec($sql);
   }
}