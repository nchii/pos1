<?php $users = get_users($mysqli, $currentPage); ?>
              <?php
                if (isset($_POST["search"]) && $_POST['search'] != '') {
                    $users = get_user_filter($mysqli, $_POST['search']);
                } ?>
              <?php
              if (isset($_POST["search"])) {
                  $i = 1;
              } else {
                  $i = $currentPage + 1;
              } ?>
              <?php while ($u = $users->fetch_assoc()) { ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $u['username'] ?></td>
                  <td><?= $u['email'] ?></td>
                  <td>
                    <?php if ($u['role'] == 1) {
                        echo "Admin";
                    } elseif ($u['role'] == 2) {
                        echo "Casher";
                    } elseif ($u['role'] == 3) {
                        echo "Kitchen";
                    } else {
                        echo "Waiter";
                    }
                  ?>
                  </td>
                  <td>
                    <img class="table-img" src="../assets/profile/<?= $u['profile'] ?>">
                  </td>
                  <th>
                    <?php if ($u['id'] === $user['id']) { ?>
                      <button class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></button>
                    <?php } else { ?>
                      <button class="btn btn-sm btn-danger deleteSelect" data-value="<?= $u['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
                    <?php } ?>
                  </th>
                </tr>
              <?php $i++;
              } ?>