<?php require_once ("../layout/header.php") ?>
<?php require_once ("../layout/sidebar.php") ?> 

<?php
$currentPage = 0;
if (isset($_GET["pageNo"])) {
    $currentPage = (int) $_GET["pageNo"];
}

$pagTotal = get_item_pag_count($mysqli);
if (isset($_GET['lest'])) {
    $currentPage = ($pagTotal * 5) - 5;
}
if (isset($_GET['deleteId'])) {
    if (delete_users($mysqli, $_GET['deleteId'])) {
        echo "<script>location.replace('./user_list.php')</script>";
    }
}
?>

    <div class="content">
      <?php require_once ("../layout/nav.php") ?>  
      <div class="card m-5">
        <div class="card-body">
          <h3>Item List</h3>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $item_list=get_all_item_join($mysqli,$currentPage) ; ?>
                <?php
                if (isset($_POST["search"]) && $_POST['search'] != '') {
                    $item_list = get_item_filter($mysqli, $_POST['search']);
                    
                } ?>
              <?php
              if (isset($_POST["search"])) {
                  $i = 1;
              } else {
                  $i = $currentPage + 1;
              } ?>
              <?php while ($item = $item_list->fetch_assoc()) { ?>

                <tr>
                  <td><?= $i ?></td>
                  <td><?= $item['name'] ?></td>
                  <td><?= $item['price'] ?></td>
                  <td><?= $item['categoryName'] ?></td>
                  <td>
                    <img class="table-img" src="data:image/' . $type . ';base64,<?= $item['itemImg'] ?>">
                  </td>
                  <th>
                      <button class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></button>
                      <button class="btn btn-sm btn-danger deleteSelect" data-value="<?= "" ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                  </th>
                </tr>
                </tr>
              <?php $i++;
}
?>
            </tbody>
          </table>
          <?php if (!isset($_POST['search'])) {
              require_once("../layout/pagination.php");
          } elseif (isset($_POST['search']) && $_POST['search'] == "") {
              require_once("../layout/pagination.php");
          } ?>
        </div>
      </div>
    </div>

<?php require_once ("../layout/footer.php") ?>