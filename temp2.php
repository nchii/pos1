<?php $categories = get_category($mysqli); ?>
              <?php $i = 1;
while ($category = $categories->fetch_assoc()) {
    ?>
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