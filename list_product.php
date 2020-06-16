<?php

require_once("entities/product.class.php");
require_once("entities/category.class.php");
?>

<?php
include_once("header.php");
if (!isset($_GET["cat_id"])) {
    $prods = Product::list_product();
} else {
    $cat_id = $_GET["cat_id"];
    $prods = Product::get_list_by_cate($cat_id);
}
$cates = Category::list_category();
?>

<div class="row">
    <div class="col-3">
        <h1 class="text-center">Danh mục</h1>
        <ul class="list-group" style="padding-top: 40px;">
            <?php foreach ($cates as $item) : ?>
            <li class="list-group-item">
                <a href="/web/list_product.php?cat_id=<?php echo $item["CateID"]; ?>"><?php echo $item["CategoryName"]; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-9">
        <h1 class="text-center">Danh sách sản phẩm</h1>
        <?php if ($prods == null) :  ?>
        <h4 class="text-center">Không có sản phẩm!</h4>
        <?php endif;  ?>
        <div class="row">
            <?php foreach ($prods as $item) : ?>
            <div class="col-sm-4 text-center" style="padding-top: 40px;">
                <div>
                    <img src="<?php echo $item["Picture"] ?>" class="product-img">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/web/product-detail.php?id=<?php echo $item["ProductID"] ?>"><?php echo $item["ProductName"] ?></a></h5>
                        <p class="card-text"><?php echo $item["Price"] ?></p>
                        <a href="/web/shopping_cart.php?id=<?php echo $item["ProductID"] ?>" class="btn btn-primary btn-block">Mua hàng</a>
                        <a href="#" class="btn btn-warning btn-block">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php
include_once("footer.php");
?> 