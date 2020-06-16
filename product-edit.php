<?php

require_once("entities/product.class.php");
require_once("entities/category.class.php");

if(isset($_POST["btnsubmit"])){
    
    $productName = $_POST["txtName"];
    $cateID=$_POST["txtCateID"];
    $price = $_POST["txtprice"];
    $quantity=$_POST["txtquantity"];
    $description=$_POST["txtdesc"];
    //var_dump($_FILES["img_upload"]);
    $id = $_POST["id"];
    $result = Product::edit_product($id,$productName,$cateID,$price,$quantity,$description);
    if(!$result){
        header("Sửa thành công");
    }else{
        header("Lỗi");
    }
}
?>
<?php
include_once("header.php");
if(!isset($_GET["id"])){
   header('Location:not-found.php');
}
else{
    $id=$_GET["id"];
    $temp=Product::get_product($id);
    $prod=reset($temp);
    if($prod==null)
        header('Location:not-found.php');
    $rela_prods = Product::get_product_relate($id, $prod['CateID']);
}
$cates= Category::list_category();
?>

<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-6">
<div class="card">
    <div class="card-body">
        <h1 style="text-align:center;color:red"> Sửa sản phẩm</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="<?php echo $prod["ProductID"]; ?>">
            <div class="form-group">
                <label for="txtName">Tên sản phẩm</label>
                <input type="text" class="form-control" id="txtName" name="txtName" value="<?php echo $prod["ProductName"];?>" placeholder="Nhập tên sản phẩm">
            </div>
            <!-- $description -->
            <div class="form-group">
                <label for="txtdesc">Mô tả sản phẩm</label>
                <textarea class="form-control" id="txtdesc" cols="30" rows="5" name="txtdesc" value="<?php echo isset($_POST["txtdesc"]) ? $_POST["txtdesc"] : ""?>" placeholder="<?php echo $prod["Description"];?>"></textarea>
            </div>
            <!-- so luong -->
            <div class="form-group">
                    <label for="txtquantity">Số lượng sản phẩm</label>
                    <input type="number" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo isset($_POST["txtquantity"]) ? $_POST["txtquantity"] : "" ?>" placeholder="<?php echo $prod["Quantity"];?>">
             </div>
            <!-- category -->
            <div class="form-group">
                    <label for="txtCateID">Chọn loại sản phẩm</label>
                    <select name="txtCateID" class="form-control" id="txtCateID">
                        <option value="" selected>---Chọn loại---</option>
                        <?php
                        $cates=Category::list_category();
                        foreach($cates as $item){
                            echo "<option value=".$item["CateID"].">".$item["CategoryName"]."</option>";
                        }
                        ?>
                    </select>
            </div>
            <!-- gia san pham -->
            <div class="form-group">
                    <label for="txtprice">Giá sản phẩm</label>
                    <input class="form-control" type="text" id="txtprice" name="txtprice" value="<?php echo isset($_POST["txtprice"]) ? $_POST["txtprice"] : "" ?>", placeholder="<?php echo $prod["Price"];?>">
             </div>
             </div>
            <!-- hinh anh -->
            </div>
            <!-- btn submit -->
                   <div class="text-center">
                   <input class="btn btn-success" type="submit" name="btnsubmit" value="Sửa sản phẩm">
                   </div>
        </form>
    </div>
</div>
</div>
</div>

    <div class="text-center">
    <a href="/web_banhang/index.php">Trở về danh sách sản phẩm</a>
    </div>
    <?php include_once("footer.php")?>
