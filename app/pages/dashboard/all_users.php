<?php
$select_users = 
"SELECT u.full_name, u.email, u.profile_img, u.date, r.name AS `role`
FROM user u
JOIN role r 
ON u.role_id = r.id
ORDER BY u.date DESC";
$rows = query($select_users);

?>
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
</head>

<body>
    <main>
        <h1 style="margin: 18px;margin-top: 0px;margin-bottom: 0px;margin-right: 0px;padding-left: 60px;">All Users</h1>
        <hr style="border: 5px solid rgb(0,0,0);background: #000000;margin-right: 18px;margin-left: 18px;">
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <div class="container py-4 py-xl-5">
                    <div class="row" style="border-bottom-style: solid;">
                        <div class="col-md-6 mb-4">
                            <div class="p-xl-5 m-xl-5"><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;"
                                    src="<?= ROOT ?>/assets/img/1528093.jpg"></div>
                        </div>
                        <div class="col-md-6 d-md-flex align-items-md-center mb-4">
                            <div style="max-width: 350px;">
                                <h2 class="text-uppercase font-weight-bold">
                                    <?= esc($row['full_name']) ?>
                                </h2>
                                <p>
                                    <?= $row['email'] ?> <strong class="p-1 border rounded text-primary">
                                        <?= $row['role'] ?>
                                    </strong>
                                </p>
                                <p><small><?= date("jS M, Y",strtotime($row['date'])) ?></small></p>
                                
                                <a class="btn btn-dark btn-lg mr-2" role="button" href="#">Edit</a>
                                <a class="btn btn-outline-dark btn-lg" role="button" href="#">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </main>
    <script src="<?= ROOT ?>/assets/js/jquery.min.js"></script>
    <script src="<?= ROOT ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/Profile-Edit-Form-profile.js"></script>
</body>

</html>