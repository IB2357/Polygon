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
    <style>
        .sticky-element {
            position: fixed;
            top: 10px;
            left: 12px;

        }
        .navbar {
            display: none;
            background-color: white;
            /* opacity: .5; */
            border: 1px solid rgba(0,0,0,0.5);
            box-shadow: 0 8px 8px 0 rgba(0,0,0,37);
        }
        /* .glass{
            background: linear-gradient(135deg, rgba(255,255,255,0.3),rgba(255,255,255,.1));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: 0 8px 8px 0 rgba(0,0,0,37);
        } */
    </style>
</head>

<body>
    <button class="btn btn-dark drawer-knob show-nav sticky-element" type="button" data-open="drawer"
        style="background: var(--white);color: rgb(0,0,0);border-width: 2px;border-style: solid;margin-right: -19px;"><i
            class="fas fa-bars"></i></button>

    <nav class="navbar navbar-light fixed-top off-canvas glass" data-right-drawer="0" data-open-drawer="1"
        style="color: rgb(0,0,0);border-right-style: solid;position: sticky;height: 100vh;">
        <div class="container-fluid flex-column">
        <button class="btn btn-dark drawer-knob show-nav" type="button" data-open="drawer"
        style="background: var(--white);color: rgb(0,0,0);border-width: 2px;border-style: solid;margin-right: -19px;"><i
            class="fas fa-bars"></i></button>
            <div class="d-flex justify-content-between brand-line"><a class="navbar-brand" href="<?=ROOT?>/home">
                    <?= BRAND_NAME ?>
                </a><button class="btn btn-dark hide-nav" type="button" data-dismiss="drawer"
                    style="background: var(--white);color: rgb(0,0,0);border-width: 2px;border-style: solid;"><span
                        class="sr-only">Toggle Navigation&nbsp;</span><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg></button></div>
            <div><a href="<?= ROOT ?>/dashboard/profile"
                    style="background: url(&quot;<?= get_image($_SESSION['user']['profile_img'], 'avatar.png') ?>&quot;) center / cover no-repeat, var(--secondary);color: rgba(0,123,255,0);padding: 36px;padding-bottom: 47px;height: 0;width: 0;border-radius: 100px;">Link</a>
            </div>
            <a href="<?= ROOT ?>/dashboard/profile" style="padding-bottom: 0px;">
                <?= esc($_SESSION['user']['full_name']) ?> &nbsp;<span class="badge badge-primary"
                    style="padding-bottom: 2px;">
                    <?= esc($_SESSION['user']['role']) ?>
                </span>
            </a>
            <ul class="navbar-nav flex-column drawer-menu">
                <li class="nav-item"><a class="nav-link <?=($section=='home')?'active':''?>" href="<?= ROOT ?>/dashboard/home">Home</a></li>
                <li class="nav-item"><a class="nav-link <?=($section=='categories')?'active':''?>" href="<?= ROOT ?>/dashboard/categories">All Categories</a></li>
                <?php if(is_admin()):?>
                <li class="nav-item"><a class="nav-link <?=($section=='posts')?'active':''?>" href="<?= ROOT ?>/dashboard/posts">All Posts</a></li>
                <li class="nav-item"><a class="nav-link <?=($section=='users')?'active':''?>" href="<?= ROOT ?>/dashboard/users">All Users</a></li>
                <?php endif;?>
            </ul>
            <ul class="navbar-nav flex-column drawer-menu">
                <li class="nav-item"><a class="nav-link <?=($section=='drafts')?'active':''?>" href="<?= ROOT ?>/dashboard/drafts">My Drafts</a></li>
                <li class="nav-item"><a class="nav-link <?=($section=='publishes')?'active':''?>" href="<?= ROOT ?>/dashboard/publishes">My publishes</a></li>
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
    <script>
        const showButton = document.querySelector(".show-nav");
        const hideButton = document.querySelector(".hide-nav");
        const itemContainer = document.querySelector(".navbar");

        showButton.addEventListener("click", function () {
            itemContainer.style.display = "block";
            showButton.style.display = "none";
        });
        // hideButton.addEventListener("click", function () {
        //     itemContainer.style.display = "none";
        //     itemContainer.style.display = "none";
        // });
    </script>
</body>

</html>