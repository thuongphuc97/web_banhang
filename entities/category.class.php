<?php
require_once("config/db.class.php");
// 
class Category{

   public $CateID;
   public $categoryName;
   public $Description;


   public function __construct($name,$desc)
   {
     $this->CategoryName=$name;
     $this->Description=$desc;
   }
   public static function list_category()
   {
       $db = new Db();
       $sql="Select * from category";
       $result=$db->select_to_array($sql);
       return $result;
   }

}




?>
