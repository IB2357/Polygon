<?php
$limit = 5;
$offset = ($PAGE['page_number'] - 1) * $limit;
$select_posts =
"SELECT p.`id`, p.`title`, p.`intro`, p.`status`,p.`create_date`, p.`poster_img`, p.`user_id`, p.`category_id` ,u.`full_name` ,c.`category`
FROM `post` p 
JOIN `user` u
ON p.`user_id` = u.id
JOIN `category` c 
ON p.category_id = c.id
ORDER BY u.date
DESC
LIMIT $limit
OFFSET $offset";
$rows = query($select_posts);

?>
<?php if ($action == 'add'):
    require_once "../app/pages/dashboard/post_crud/add.php";
    ?>

<?php elseif ($action == 'edit'):
    $row = query("SELECT * FROM post WHERE id = :id LIMIT 1", ['id' => $id]);
    if ($row) {
        require_once "../app/pages/dashboard/post_crud/edit.php";
    } else {
        echo '<div class="alert alert-danger my-5 mx-auto">This Record Does Not Exist!</div>';
    }
?>
<?php elseif ($action == 'delete'):
    $row = query("SELECT p.`id`, p.`title`, p.`intro`,p.`poster_img`, p.`create_date`, u.`full_name` FROM post p JOIN `user` u ON p.`user_id` = u.id WHERE p.id = :id LIMIT 1", ['id' => $id]);
    if ($row) {
        require_once "../app/pages/dashboard/post_crud/delete.php";
    } else {
        echo '<div class="alert alert-danger my-5 mx-auto">This Record Does Not Exist!</div>';
    }
?>
<?php elseif ($action == 'publish'):
    $row = query("SELECT p.`id`, p.`title`, p.`intro`,p.`poster_img`, p.`create_date`, u.`full_name` FROM post p JOIN `user` u ON p.`user_id` = u.id WHERE p.id = :id LIMIT 1", ['id' => $id]);
    if ($row) {
        require_once "../app/pages/dashboard/post_crud/publish.php";
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
        <title>Posts
            <?= APP_NAME ?>
        </title>
        <link rel="stylesheet" href="<?= ROOT ?>/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Banner-Heading-Image-images.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Navbar-Centered-Links-icons.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Profile-Edit-Form-styles.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Profile-Edit-Form.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Gamanet_Pagination_bs5.css">
    </head>

    <body>
        <main>
            <h1 style="margin: 18px;margin-top: 5px;margin-bottom: 0px;margin-right: 0px;padding-left: 60px;">All Posts
                <a class="btn btn-dark btn-lg mr-2" role="button" href="<?= ROOT ?>/dashboard/posts/add">New Post</a>
            </h1>
            <hr style="border: 5px solid rgb(0,0,0);background: #000000;margin-right: 18px;margin-left: 18px;">
            <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                    <div class="container py-4 py-xl-5">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="p-xl-5 m-xl-5"><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;"
                                        src=" <?= get_image($row['poster_img'],'background_placeholder.png') ?>"></div>
                            </div>
                            <div class="col-md-6 d-md-flex align-items-md-center mb-4">
                                <div style="max-width: 350px;">
                                    <h2 class="text-uppercase font-weight-bold">
                                        <?= $row['title'] ?>
                                    </h2>
                                    <span class="p-1 border rounded text-primary">
                                        <?= $row['category'] ?>
                                    </span>
                                    
                                    <p class="my-3"><?= $row['intro'] ?></p>
                                    <p class="my-3">by&nbsp;&nbsp;<a href="#"><?= $row['full_name'] ?></a>.&nbsp;
                                        <?= date("jS M, Y", strtotime($row['create_date'])) ?>
                                        <span class="p-1 border rounded text-dark ml-3">
                                        <?= $row['status'] ?>
                                    </span>
                                    </p>
                                    <a class="btn btn-dark btn-lg mr-2" role="button" href="<?= ROOT ?>/dashboard/posts/edit/<?= $row['id'] ?>">Edit</a>
                                    <a class="btn btn-outline-dark btn-lg mr-2" role="button" href="<?= ROOT ?>/dashboard/posts/delete/<?= $row['id'] ?>">Delete</a>
                                    <?php if ($row['status'] != 'published'):?>
                                        <a class="btn btn-outline-primary btn-lg mr-2" role="button" href="<?= ROOT ?>/dashboard/posts/publish/<?= $row['id'] ?>">Publish</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

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