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
    <nav class="navbar navbar-light fixed-top off-canvas" data-right-drawer="0" data-open-drawer="1"
        style="background: rgb(255,255,255);color: rgb(0,0,0);border-right-style: solid;position: sticky;height: 100vh;">
        <div class="container-fluid flex-column"><button class="btn btn-dark drawer-knob" type="button"
                data-open="drawer"
                style="background: var(--white);color: rgb(0,0,0);border-width: 2px;border-style: solid;margin-right: -19px;"><i
                    class="fas fa-bars"></i></button>
            <div class="d-flex justify-content-between brand-line"><a class="navbar-brand" href="#">
                    <?= BRAND_NAME ?>
                </a><button class="btn btn-dark" type="button" data-dismiss="drawer"
                    style="background: var(--white);color: rgb(0,0,0);border-width: 2px;border-style: solid;"><span
                        class="sr-only">Toggle Navigation&nbsp;</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
</svg></button></div>
            <div><a href="<?= ROOT ?>/dashboard/profile"
                    style="background: url(&quot;<?= ROOT ?>/assets/img/PXL_20230421_094918005.jpg&quot;) center / cover no-repeat, var(--secondary);color: rgba(0,123,255,0);padding: 36px;padding-bottom: 47px;height: 0;width: 0;border-radius: 100px;">Link</a>
            </div>
            <a href="<?= ROOT ?>/dashboard/profile" style="padding-bottom: 0px;">
                <?= esc($_SESSION['user']['full_name']) ?> &nbsp;<span class="badge badge-primary"
                    style="padding-bottom: 2px;">
                    <?= esc($_SESSION['user']['role']) ?>
                </span>
            </a>
            <ul class="navbar-nav flex-column drawer-menu">
                <li class="nav-item"><a class="nav-link active" href="<?= ROOT ?>/dashboard/add_user">Add User +</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>/dashboard/posts">All Posts</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>/dashboard/users">All Users</a></li>

            </ul>
            <ul class="navbar-nav flex-column drawer-menu">
                <li class="nav-item"><a class="nav-link active" href="<?= ROOT ?>/dashboard/post_editer">Create
                        Article</a></li>
                <li class="nav-item"><a class="nav-link" href="#">My Drafts</a></li>
                <li class="nav-item"><a class="nav-link" href="#">My publishes</a></li>
            </ul>
            <ul class="navbar-nav flex-column drawer-menu">
                <li class="nav-item"><a class="nav-link" href="<?= ROOT ?>/logout">
                        <i class="bi bi-box-arrow-left"></i>
                        Sign out</a></li>
            </ul>
        </div>
    </nav>
    <script src="<?= ROOT ?>/assets/js/jquery.min.js"></script>
    <script src="<?= ROOT ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/Profile-Edit-Form-profile.js"></script>
</body>

</html>