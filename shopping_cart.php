<?php include_once('header.php') ?>


<?php
require_once("entities/product.class.php");
require_once("entities/category.class.php");
$cates = Category::list_category();

session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_GET["id"])) {
    $pro_id = $_GET["id"];
    $was_found = false;
    $i = 0;
    if (!isset($_SESSION["cart_items"]) || count($_SESSION["cart_items"]) < 1) {
        $_SESSION["cart_items"] = array(0 => array("pro_id" => $pro_id, "quantity" => 1));
    } else {
        foreach ($_SESSION["cart_items"] as $item) {
            $i++;
            // while (list($key, $value) = each($item))
            foreach ($item as $key => $value) {
                if ($key == "pro_id" && $value == $pro_id) {
                       array_splice($_SESSION["cart_items"], $i-1, 1, array(array("pro_id" => $pro_id, "quantity" => $item["quantity"]+1)));
                    $was_found = true;
                }
            }
        }
        if ($was_found == false) {
            array_push($_SESSION["cart_items"], array('pro_id' => $pro_id, 'quantity' => 1));
        }
    }
    header("location:shopping_cart.php");
}
?>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-3">
            <h3>Danh mục</h3>
            <ul class="list-group">
                <?php
                foreach ($cates as $item) {
                    echo '<li class="list-group-item">
                                <a href="/web/list_product.php?cateid=' . $item["CateID"] . '">' . $item["CategoryName"] . '</a>
                        </li>';
                }
                ?>
            </ul>
        </div>
        <div class="col-sm-9">
            <h3>Thông tin giỏ hàng</h3><br>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_money = 0;
                    if (isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0) :
                        foreach ($_SESSION["cart_items"] as $item) :
                            $id = $item["pro_id"];
                            $product = Product::get_product($id);
                            $prod = reset($product);
                            $total_money += $item["quantity"] * $prod["Price"];
                            ?>
                    <tr>
                        <td><?php echo $prod["ProductName"] ?></td>
                        <td><img src="<?php echo $prod["Picture"] ?>" style="width:90px;height:80px"></td>
                        <td><?php echo $item["quantity"] ?></td>
                        <td><?php echo $prod["Price"] ?></td>
                        <td><?php echo $prod["Price"] ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
                    <tr>
                        <td colspan=5 class="text-right text-danger">Tổng tiền: <?php echo $total_money ?></td>
                    </tr>
                    <tr>
                        <td colspan= 3> <a href="#" class="btn btn-info text-right">Tiếp tục mua hàng</a> </td>
                        <td colspan=2> <a href="#" class="btn btn-success text-right">Thanh toán</a> </td>
                    </tr>
                    <?php
                else :
                    echo "Không có sản phẩm trong giỏ hàng";
                endif;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php include_once("footer.php");
?> 