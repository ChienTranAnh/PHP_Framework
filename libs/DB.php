<?php

namespace libs;

use PDO;
use \app\Config;

class DB
{
   private $table;
   private $fields;
   private $distinct;

   public function __construct($table_name)
   {
      $this->table = $table_name;
//      $this->connect();
   }

   protected function connect()
   {
      $db = null;
      if ($db === null) {

         try
         {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch (PDOException $e)
         {
            echo "Connection failed: " . $e->getMessage();
         }
      }

      return $db;
   }

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

   public function get()
   {
      if (!isset($this->table) || empty($this->table))
      {
         return false;
      }

      $sql = $this->distinct ? 'SELECT DISTINCT ' : 'SELECT ';

      if (isset($this->fields))
      {
         $sql .= $this->fields;
      } else $sql .= '*';

      $sql .= ' FROM ' . $this->table . ';';

      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $result;
   }
}