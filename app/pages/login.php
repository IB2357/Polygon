<?php
if (!empty($_POST)) {
    // validation
    $errors = [];
    // $select_user = "SELECT * FROM user WHERE email=:email LIMIT 1";
    $select_user = "SELECT u.* , r.name AS `role`
    FROM user u
    JOIN role r 
    ON u.role_id = r.id
    WHERE email=:email
    LIMIT 1";
    $row = query($select_user, ['email' => $_POST['email']]);

    // check password
    if ($row) {
        $data = [];
        if (password_verify($_POST['password'], $row[0]['password'])) {
            if($row[0]['active']!=0){
            authenticate($row[0]);
            p_arr($_SESSION['user']);
            
            redirect('/dashboard/home');
            }
            $errors['active'] = "this account is not active";
        }
    }
    $errors['email'] = "wrong email or password";

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>blog
        <?= APP_NAME ?>
    </title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arbutus+Slab">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Noto+Sans:300,400,500,600,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Animated-Text-Background.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Animated-Typing-With-Blinking.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/cards-d_style.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Dashboard-layout-v11-DashBoard-light-boostrap.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Dashboard-layout-v11-styles.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Dashboard-layout-v11.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Gamanet_Pagination_bs5.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Gamanet_Sidebar_bs5.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Navbar-Right-Links-icons.css">

    <link rel="stylesheet" href="<?= ROOT ?>/assets/bootstrap-h/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">        
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arbutus+Slab">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fonts/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md py-3"
        style="margin: 18px;margin-left: 18px;border-style: solid;border-bottom-width: 5px;">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="home"><span>
                    <?= BRAND_NAME ?>
                </span></a></div>
    </nav>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Log in</h2>
                    <p>Curae hendrerit donec commodo hendrerit egestas tempus, turpis facilisis nostra nunc. Vestibulum
                        dui eget ultrices.</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center" style="border-style: solid;">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"
                                style="background: rgb(0,0,0);"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                    height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z">
                                    </path>
                                </svg></div>
                            <form class="text-center" method="post">
                                <div class="mb-3"><input value="<?= old_value('email') ?>" class="form-control"
                                        type="email" name="email" placeholder="Email"></div>
                                <div class="mb-3"><input value="<?= old_value('password') ?>" class="form-control"
                                        type="password" name="password" placeholder="Password"></div>
                                <?php
                                if (!empty($errors)) {
                                    echo '<div class="form-group alert alert-danger"><ul>';
                                    foreach ($errors as $key => $value) {
                                        echo '</li>**' . $value . '.</li>' . br;
                                    }
                                    echo '</ul></div>';
                                }
                                ?>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit"
                                        style="background: rgb(0,0,0);">Login</button></div>
                                <p class="text-muted">Forgot your password?</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr
        style="margin-bottom: 0px;background: var(--bs-navbar-active-color);opacity: 1;margin-left: 18px;margin-right: 18px;border: 4px solid #000000;margin-top: 14px;">
    <?php include_once "parts/footer.php"; ?>

    <script src="<?= ROOT ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/Dashboard-layout-v11-DashBoard-light-boostrap.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Text-Background-animatedTextBackground.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Type-Heading-BS5-Animated-Type-Heading.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Typing-With-Blinking-Animated-Type-Heading.js"></script>
    <script src="<?= ROOT ?>/assets/js/clean-blog.js"></script>
</body>

</html>