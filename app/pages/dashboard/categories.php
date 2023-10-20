<?php
$limit = 5;
$offset = ($PAGE['page_number'] - 1) * $limit;
$select_categories =
    "SELECT * FROM `category` 
ORDER BY id
DESC
LIMIT $limit
OFFSET $offset";
$rows = query($select_categories);

?>
<?php if ($action == 'add'):
    require_once "../app/pages/dashboard/category_crud/add.php";
    ?>

<?php elseif ($action == 'edit'):
    $row = query("SELECT * FROM category WHERE id = :id LIMIT 1", ['id' => $id]);
    if ($row) {
        require_once "../app/pages/dashboard/category_crud/edit.php";
    } else {
        echo '<div class="alert alert-danger my-5 mx-auto">This Record Does Not Exist!</div>';
    }
?>
<?php elseif ($action == 'delete'):
    $row = query("SELECT * FROM category WHERE id = :id LIMIT 1", ['id' => $id]);
    if ($row) {
        require_once "../app/pages/dashboard/category_crud/delete.php";
    } else {
        echo '<div class="alert alert-danger my-5 mx-auto">This Record Does Not Exist!</div>';
    }
?>
<?php else: ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Categories
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
            <h1 style="margin: 18px;margin-top: 5px;margin-bottom: 0px;margin-right: 0px;padding-left: 60px;">All Categories
                <a class="btn btn-dark btn-lg mr-2" role="button" href="<?= ROOT ?>/dashboard/categories/add">New
                    Category</a>
            </h1>

            <hr style="border: 5px solid rgb(0,0,0);background: #000000;margin-right: 18px;margin-left: 18px;">
            <div class="table-responsive mx-5 px-0">
                <table class="table ml-5 ">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>slug</th>
                        <th>active</th>
                    </tr>

                    <?php if (!empty($rows)): ?>
                        <?php $counter = 0; ?>
                        <?php foreach ($rows as $row): ?>
                            <?php $counter++; ?>
                            <tr>
                                <td>
                                    <?= esc($counter) ?>
                                </td>
                                <td class="pt-5">
                                    <?= esc($row['category']) ?>
                                </td>
                                <td class="pt-5">
                                    <?= esc($row['slug']) ?>
                                </td>
                                <td class="pt-5">
                                    <?=($row['active'])?'on':'off' ?>
                                </td>
                                <td class="pt-5">
                                    <a class="btn btn-dark mr-2" role="button"
                                        href="<?= ROOT ?>/dashboard/categories/edit/<?= $row['id'] ?>">Edit</a>
                                    <a class="btn btn-outline-dark " role="button"
                                        href="<?= ROOT ?>/dashboard/categories/delete/<?= $row['id'] ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
            <hr>
            <div id="pagination" class="d-flex justify-content-center" style="padding-bottom: 0px;">
                <a class="pagination-item <?= ($PAGE['page_number'] == 1) ? 'disabled' : 'active' ?>"
                    href="<?= $PAGE['prev_link'] ?>"><img
                        src="<?= ROOT ?>/assets/img/icon_arrow-left.svg"><span>Previos</span>
                </a>
                <a class="pagination-item  <?= ($PAGE['page_number'] == 1) ? 'disabled' : 'active' ?>"
                    href="<?= $PAGE['first_link'] ?>">&nbsp;Home&nbsp;
                </a>
                <a class="pagination-item" href="<?= $PAGE['next_link'] ?>"><span>Next</span><img
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