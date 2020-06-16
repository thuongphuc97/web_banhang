<?php

require_once("entities/product.class.php");
require_once("entities/category.class.php");
?>

<?php
include_once("header.php");
if(!isset($_GET["id"])){
   header('Location:not-found.php');
}
else{
    $id=$_GET["id"];
    $temp=Product::get_product($id);
    $prods=reset($temp);
    if($prods==null)
        header('Location:not-found.php');
    $rela_prods=Product::get_product_relate($id,$prods['CateID']);
}
$cates=Category::list_category();
?>

<div class="row">
    <div class="col-3 card">
        <h2 class="text-center card-header">Danh mục</h2>
        <ul class="list-group" style="padding-top: 40px;">
            <?php foreach($cates as $item): ?>
            <li class="list-group-item">
                <a href="/web/list_product.php?cat_id=<?php echo $item["CateID"];?>"><?php echo $item["CategoryName"];?></a>
            </li>        
            <?php endforeach;?>
        </ul>
    </div>

    <div class="col-9 card">
        <h2 class="text-center card-header">Chi tiết sản phẩm</h2>
        <div class="row">
            <div class="col-6">
                <img src="/web/<?php echo $prods["Picture"] ?>" class="product-detail-img" alt="">
            </div>
            <div class="col-6">
                <h3 class="text-info"><?php echo $prods["ProductName"];?></h3>
                <p><?php echo $prods["Description"];?></p>
                <p>Giá:<?php echo $prods["Price"];?></p>
                <a href="#" class="btn btn-primary">Mua hàng</a>
            </div>
        </div>
        <h2 class="text-center card-header">Sản phẩm liên quan</h2>
        <div class="row">
                <?php foreach($rela_prods as $item): ?>
                 <div class="col-sm-4 text-center" style="padding-top: 40px;" >
                <img src="<?php echo $item["Picture"] ?>"class="product-img"  >
              <div class="card-body">
                <h5 class="card-title"><a href="/web/product-detail.php?id=<?php echo $item["ProductID"] ?>"><?php echo $item["ProductName"] ?></a></h5>
                <p class="card-text"><?php echo $item["Price"] ?></p>
                <a href="#" class="btn btn-primary btn-block">Mua hàng</a>
              
            </div>
        </div>
                <?php endforeach; ?>
           
        </div>
    </div>
</div>
</div>

<?php
include_once("footer.php");
?>
