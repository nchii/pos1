<?php require_once ("../layout/header.php") ?>
<?php require_once ("../layout/sidebar.php") ?> 

<?php
$currentPage = 0;
if (isset($_GET["pageNo"])) {
    $currentPage = (int) $_GET["pageNo"];
}

$pagTotal = get_category_pag_count($mysqli);
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
          <h3>Category List</h3>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Category Name</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $categories = get_category($mysqli,$currentPage); ?>
<?php
                if (isset($_POST["search"]) && $_POST['search'] != '') {
                    $users = get_category_filter($mysqli, $_POST['search']);
                } ?>
              <?php
              if (isset($_POST["search"])) {
                  $i = 1;
              } else {
                  $i = $currentPage + 1;
              } ?>
              <?php while ($category = $categories->fetch_assoc()) { ?>

                <tr>
                  <td><?= $i ?></td>
                  <td><?= $category['categoryName'] ?></td>
                  <td>
                    <img class="table-img" src="data:image/' . $type . ';base64,<?= $category['categoryImg'] ?>">
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