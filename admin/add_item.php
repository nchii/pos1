<?php require_once ("../layout/header.php") ?>
<?php require_once ("../layout/sidebar.php") ?>  
<?php
$itemName = $itemNameErr = "";
$price = $priceErr = "";
$category_id = $category_idErr = "";
$itemImg=$itemImgErr="";
$invalid = "";

if (isset($_POST['itemName'])) {
    $itemName = $_POST['itemName'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $file =  $_FILES['itemImg'];
    $itemImg = $file['name'];
    $tmp = $file['tmp_name'];
    $img = file_get_contents($tmp);
    $data = base64_encode($img);

    if ($itemName === "") {
        $itemNameErr = "item name can't be blank!";
        $invalid = "err";
    }
    if ($price === "") {
        $priceErr = "item Email can't be blank!";
        $invalid = "err";
    } 
    if ($category_id === "") {
        $category_idErr = "Please select item category_id!";
        $invalid = "err";
    }
    if ($itemImg === "") {
        $itemImgErr = "Please select Img!";
        $invalid = "err";
    }
    if (!$invalid) {
        $status = save_item($mysqli, $itemName, $price,  $category_id,$data);
        if ($status === true) {
                echo "<script>location.replace('./item_list.php')</script>";
            
        } else {
            $invalid = $status;
        }

    }
    
}
?>
    <div class="content">
      <?php require_once ("../layout/nav.php") ?>  
      <div class="card m-5">
        <div class="card-body"> 
            <h3>Add New item</h3>
            <div class="card my-4">
                <div class="row">
                    <div class="col-3 d-none d-md-block"></div>
                    <div class="card-body col-md-6">
                       <div class="card">
                        <div class="card-body">
                            <?php if ($invalid !== "" && $invalid !== "err") { ?>
                                    <div class="alert alert-danger"><?= $invalid ?></div>
                            <?php } ?>
                            <form method="post" enctype="multipart/form-data" >
                                <div class="form-group my-3">
                                    <label class="form-label">Item Name</label>
                                    <input type="text" name="itemName" class="form-control" value="<?= $itemName ?>">
                                    <div class="validation-message"><?= $itemNameErr ?></div>
                                </div>
                                <div class="form-group my-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="price" class="form-control" value="<?= $price ?>">
                                    <div class="validation-message"><?= $priceErr ?></div>
                                </div>
                                <div class="form-group my-3">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="" selected>Select Item's category</option>
                                        <?php $category_list=get_all_categories($mysqli);?>
                                        <?php while($category=$category_list->fetch_assoc()) {  ?>
                                            
                                        <option value="<?=$category['id']?>"<?php if($category['id']==$category_id){
                                        echo "selected";
                                        }?>><?=$category['categoryName']?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="validation-message"><?= $category_idErr ?></div>
                                </div>
                                <div class="form-group my-3">
                                    <label class="form-label">Item Image</label>
                                    <input type="file" name="itemImg" class="form-control" >
                                    <div class="validation-message"></div>
                                </div>
                                <div class="form-group my-3">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                       </div>
                    </div>
                    <div class="col-3 d-none d-md-block"></div>
                </div>
            </div>
        </div>
      </div>
      
    </div>

<?php require_once ("../layout/footer.php") ?>