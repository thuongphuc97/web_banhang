<?php
require_once("config/db.class.php");
// 
class Product{

    
    public $productID;
    public $productName;
    public $cateID;
    public $price;
    public $quantity;
    public $description;
    public $picture;

    // theem bieen de debug
    public $msg;
    
    public function __construct($pro_name,$cate_id,$price,$quantity,$desc,$pic)
    {
        # code...
        $this->productName = $pro_name;
        $this->cateID=$cate_id;
        $this->price=$price;
        $this->quantity=$quantity;
        $this->description=$desc;
        $this->picture=$pic;
    }
    public function save()
    {
        // Xử lý lưu hình ảnh
        $file_temp=$this->picture['tmp_name'];
        $user_file=$this->picture['name'];
        $timestamp=date("Y").date("m").date("d").date("h").date("i").date("s");
        $file_path="uploads/".$timestamp.$user_file;
        if(move_uploaded_file($file_temp,$file_path)==false)
            return false;

        $db=new Db();

        $sql = "INSERT INTO Product (`ProductName`, `CateID`, `Price`, `Quantity`, `Description`, `Picture`) Values
        ('$this->productName','$this->cateID',{$this->price}, '$this->quantity','$this->description','$file_path')";

        
        $result = $db->querry_execute($sql);
        return $result;
    }
    
    public static function list_product(){
        $db = new Db();

        $sql = "SELECT * FROM `product`, category WHERE category.CateID=product.CateID";
        $result = $db->select_to_array($sql);
        return $result;
    }
    public static function get_list_by_cate($cat_id)
    {
        $db = new Db();

        $sql = "SELECT * FROM `product` WHERE CateID='$cat_id'";
        $result = $db->select_to_array($sql);
        return $result;
    }
    public static function get_product($id)
    {
        $db = new Db();

        $sql = "SELECT * FROM `product` WHERE ProductID='$id'";
        $result = $db->select_to_array($sql);
        return $result;
    }
    public function get_product_relate($id,$cate_id)
    {
        $db = new Db();

        $sql = "SELECT * FROM `product` WHERE ProductID!='$id' and CateID='$cate_id'";
        $result = $db->select_to_array($sql);
        return $result;
    }
} 
 
?>
