<?php
if (!empty($_POST)) {
    // validation
    $errors = [];
    // full name
    if (empty($_POST['full_name'])) {
        $errors['full_name'] = "full name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST['full_name'])) {
        $errors['full_name'] = "Enter a real name";
    }
    // email
    $email = query("SELECT id FROM user WHERE email=:email LIMIT 1", ['email' => $_POST['email']]);
    if (empty($_POST['email'])) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email not valid";
    } elseif ($email) {
        $errors['email'] = "Email is already in use";
    }
    // password
    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required";
    } elseif (strlen($_POST['password']) < 8) {
        $errors['password'] = "Password must be 8 characters or more";
    } elseif ($_POST['password'] !== $_POST['confirmpass']) {
        $errors['password'] = "Password and confirming Password do not match ";
    }
    // save to database
    if (empty($errors)) {
        $insert_q = "INSERT INTO user(full_name, email, profile_img, about, password, role_id) 
        VALUES (:full_name,:email,:profile_img,:about,:password,:role_id)";
        $data = [];
        $data['full_name'] = $_POST['full_name'];
        $data['email'] = $_POST['email'];
        $data['profile_img'] = $_POST['profile_img'];
        $data['about'] = $_POST['about'];
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $data['role_id'] = $_POST['role'];

        query($insert_q, $data);
        redirect('users');
    }
}
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
    <div class="container profile profile-view">
        <!-- <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button class="close" type="button"
                        aria-label="Close" data-dismiss="alert"><span aria-hidden="true">×</span></button><span>Profile
                        save with success</span></div>
            </div>
        </div> -->
        <form method="post">
            <div class="form-row profile-row">
                <div class="col-md-8 p-5 mx-auto" style="border-style: solid;">
                    <h1>New User</h1>
                    <div class="avatar" style="margin-top: 18px;">

                        <div class="avatar-bg center"></div>
                    </div><input class="form-control-file form-control mb-5 " type="file" name="profile_img">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label style="margin-right: 20px;">Full name</label>
                                <input class="form-control" value="<?= old_value('full_name') ?>" type="text"
                                    name="full_name">
                                <?php if (!empty($errors['full_name'])): ?>
                                    <div class="text-danger mb-3 mt-1">
                                        <?= $errors['full_name'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>User Role</label>
                                <select class="form-control" name="role">
                                    <?php
                                    $roles = query("SELECT `id`, `name` FROM `role`");
                                    foreach ($roles as $row) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        echo '<option value="' . "$id" . '">' . "$name" . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label>About</label><textarea class="form-control"
                            name="about"><?= old_value('email') ?></textarea></div>

                    <div class="form-group"><label>Email </label>
                        <input class="form-control" type="email" value="<?= old_value('email') ?>" autocomplete="off"
                            name="email">
                        <?php if (!empty($errors['email'])): ?>
                            <div class="text-danger mb-3 mt-1">
                                <?= $errors['email'] ?>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Password </label>
                                <input class="form-control" type="password" value="<?= old_value('password') ?>"
                                    name="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Confirm Password</label>
                                <input class="form-control" value="<?= old_value('confirmpass') ?>" type="password"
                                    name="confirmpass" autocomplete="off">
                            </div>
                        </div>
                        <?php if (!empty($errors['password'])): ?>
                            <div class="text-danger mb-5">
                                <?= $errors['password'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 content-right">
                            <input class="btn btn-primary form-btn mt-5 " type="submit" value="Create"
                                style="background: rgb(0,0,0);margin-bottom: 0px;">

                            <a href="<?= ROOT ?>/dashboard/users">
                                <span class="btn btn-primary form-btn mt-5 "
                                style="background: rgb(0,0,0);margin-bottom: 0px;">
                                < Back</span>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="<?= ROOT ?>/assets/js/jquery.min.js"></script>
    <script src="<?= ROOT ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/Profile-Edit-Form-profile.js"></script>
</body>

</html>