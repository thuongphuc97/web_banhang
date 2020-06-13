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
}  
