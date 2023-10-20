<?php
$limit = 10;
$offset = ($PAGE['page_number']-1)*$limit;
$select_users =
    "SELECT u.id, u.full_name, u.email, u.profile_img, u.date, r.name AS `role`
FROM user u
JOIN role r 
ON u.role_id = r.id
ORDER BY u.date
LIMIT $limit
OFFSET $offset";
$rows = query($select_users);

?>
<?php if ($action == 'add'):
    require_once "../app/pages/dashboard/user_crud/add.php";
    ?>

<?php elseif ($action == 'edit'):
    $row = query("SELECT * FROM user WHERE id = :id LIMIT 1", ['id' => $id]);
    if ($row) {
        require_once "../app/pages/dashboard/user_crud/edit.php";
    } else {
        echo '<div class="alert alert-danger my-5 mx-auto">This Record Does Not Exist!</div>';
    }
?>
<?php elseif ($action == 'delete'):
    $row = query("SELECT * FROM user WHERE id = :id LIMIT 1", ['id' => $id]);
    if ($row) {
        require_once "../app/pages/dashboard/user_crud/delete.php";
    } else {
        echo '<div class="alert alert-danger my-5 mx-auto">This Record Does Not Exist!</div>';
    }
?>
<?php elseif ($action == 'delete'):
    require_once "../app/pages/dashboard/user_crud/delete.php";
?>
<?php else: ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>users
            <?= APP_NAME ?>
        </title>
        <link rel="stylesheet" href="<?= ROOT ?>/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Banner-Heading-Image-images.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Navbar-Centered-Links-icons.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Profile-Edit-Form-styles.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Profile-Edit-Form.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Gamanet_Pagination_bs5.css">
    </head>

    <body>
        <main>
            <h1 style="margin: 18px;margin-top: 0px;margin-bottom: 0px;margin-right: 0px;padding-left: 60px;">All Users
                <a class="btn btn-dark btn-lg mr-2" role="button" href="<?= ROOT ?>/dashboard/users/add">New User</a>
            </h1>

            <hr style="border: 5px solid rgb(0,0,0);background: #000000;margin-right: 18px;margin-left: 18px;">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Creation Date</th>
                        <th>Action</th>
                    </tr>

                    <?php if (!empty($rows)): ?>
                        <?php $counter = 0; ?>
                        <?php foreach ($rows as $row): ?>
                            <?php $counter++; ?>
                            <tr>
                                <td>
                                    <?= esc($counter) ?>
                                </td>
                                <td>
                                    <img src="<?=get_image($row['profile_img'],'avatar.png')?>" style="width:100px; height:100px; object-fit:cover;" alt="profile image">
                                </td>
                                <td  class="pt-5">
                                    <?= esc($row['full_name']) ?>
                                </td>
                                <td class="pt-5" >
                                    <?= esc($row['email']) ?>
                                </td>
                                <td  class="pt-5">
                                    <span class="p-1 border rounded text-primary">
                                        <?= $row['role'] ?>
                                    </span>
                                </td>
                                <td  class="pt-5">
                                    <?= date("jS M, Y", strtotime($row['date'])) ?>
                                </td>
                                <td  class="pt-5">
                                    <a class="btn btn-dark mr-2" role="button"
                                        href="<?= ROOT ?>/dashboard/users/edit/<?= $row['id'] ?>">Edit</a>
                                    <a class="btn btn-outline-dark " role="button"
                                        href="<?= ROOT ?>/dashboard/users/delete/<?= $row['id'] ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
            <hr>
            <div id="pagination" class="d-flex justify-content-center" style="padding-bottom: 0px;">
            <a
            class="pagination-item <?=($PAGE['page_number']==1)?'disabled':'active'?>" href="<?=$PAGE['prev_link']?>"><img
                src="<?= ROOT ?>/assets/img/icon_arrow-left.svg"><span>Previos</span>
            </a>
            <a class="pagination-item  <?=($PAGE['page_number']==1)?'disabled':'active'?>"
            href="<?=$PAGE['first_link']?>">&nbsp;Home&nbsp;
            </a>
            <a class="pagination-item" href="<?=$PAGE['next_link']?>"><span>Next</span><img
                src="<?= ROOT ?>/assets/img/icon_arrow-right.svg">
            </a>
            </div>
        </main>
        <script src="<?= ROOT ?>/assets/js/jquery.min.js"></script>
        <script src="<?= ROOT ?>/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
        <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
        <script src="<?= ROOT ?>/assets/js/Profile-Edit-Form-profile.js"></script>
    </body>

    </html>
<?php endif; ?>