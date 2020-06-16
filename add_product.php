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
    $picture = isset($_FILES["img_upload"]) ? $_FILES["img_upload"] : '';
    // $picture = $_FILES["img_upload"];

    $newProduct = new Product($productName,$cateID,$price,$quantity,$description,$picture);

    $result = $newProduct->save();

    if(!$result){
        header("Location:add_product.php?failure");
    }else{
        header("Location:add_product.php?inserted");
    }
}
?>

<?php include_once("header.php")?>

<?php if(isset($_GET["inserted"])): ?>
    <h2 class="text-success text-center">Thêm mới sản phẩm thành công</h2>
<?php endif ?>
<?php if(isset($_GET["failure"])): ?>
    <h2 class="text-danger text-center">Có lỗi trong quá trình thêm mới, vui lòng thử lại</h2>
<?php endif ?>
<?php 
if(isset($_POST["btnsubmit"])){
    echo $newProduct->msg;
}
?>
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-6">
<div class="card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="txtName">Tên sản phẩm</label>
                <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Nhập tên sản phẩm">
            </div>
            <!-- $description -->
            <div class="form-group">
                <label for="txtdesc">Mô tả sản phẩm</label>
                <textarea class="form-control" id="txtdesc" cols="30" rows="5" name="txtdesc" value="<?php echo isset($_POST["txtdesc"]) ? $_POST["txtdesc"] : ""?> "></textarea>
            </div>
            <!-- so luong -->
            <div class="form-group">
                    <label for="txtquantity">Số lượng sản phẩm</label>
                    <input type="number" class="form-control" id="txtquantity" name="txtquantity" value="<?php echo isset($_POST["txtquantity"]) ? $_POST["txtquantity"] : "" ?>">
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
                    <input class="form-control" type="text" id="txtprice" name="txtprice" value="<?php echo isset($_POST["txtprice"]) ? $_POST["txtprice"] : "" ?>">
             </div>
            <!-- hinh anh -->
            <div class="form-group">
                    <label for="img_upload">Hình ảnh</label>
                    <input type="file" id="img_upload" name="img_upload" accept=".PNG,.GIF,.JPG" >
            </div>
            <!-- btn submit -->
                   <div class="text-center">
                   <input class="btn btn-success" type="submit" name="btnsubmit" value="Thêm sản phẩm">
                   </div>
        </form>
    </div>
</div>
</div>
</div>

    <div class="text-center">
    <a href="/web/list_product.php">Trở về danh sách sản phẩm</a>
    </div>
    <?php include_once("footer.php")?>