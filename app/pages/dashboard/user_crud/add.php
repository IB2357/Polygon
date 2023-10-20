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
    // profile_image
    // profile_image
    $allowed_imgs = ['image/jpeg', 'image/png', 'image/webp'];
    if (!empty($_FILES['profile_img']['name'])) {
        if (!in_array($_FILES['profile_img']['type'], $allowed_imgs)) {
            $errors['profile_img'] = "Image format is not supported";
        } else {
            $destination = 'uploads/' . time() . basename($_FILES["profile_img"]["name"]);
            move_uploaded_file($_FILES['profile_img']['tmp_name'], $destination);
            resize_image($destination);
        }
    }
    // save to database
    if (empty($errors)) {
        $insert_q = "INSERT INTO user(full_name, email, about, password, role_id) 
        VALUES (:full_name,:email,:about,:password,:role_id)";
        $data = [];
        $data['full_name'] = $_POST['full_name'];
        $data['email'] = $_POST['email'];
        $data['about'] = $_POST['about'];
        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $data['role_id'] = $_POST['role'];

        if (!empty($destination)) {
            $data['profile_img'] = $destination;
            $insert_q = "INSERT INTO user(full_name, email, profile_img, about, password, role_id) 
        VALUES (:full_name,:email,:profile_img,:about,:password,:role_id)";
        }

        query($insert_q, $data);
        redirect('dashboard/users');
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
    <style>
        .image-container {
            position: relative;
            width: 250px;
            height: 250px;

        }

        .img-label {
            border: 1px solid #111;
        }

        .image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: filter 0.5s, transform 0.5s;
        }

        .image:hover {
            filter: brightness(0.6);
        }

        .image-text {
            position: absolute;
            color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            opacity: 0;
            transition: opacity 0.5s;
        }

        /* Text visibility on hover */
        .image-container:hover .image-text {
            opacity: 1;
        }
    </style>
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
        <form method="post" enctype="multipart/form-data">
            <div class="form-row profile-row">
                <div class="col-md-8 p-5 mx-auto" style="border-style: solid;">
                    <h1>New User</h1>
                    <div class="avatar" style="margin-top: 18px;">
                        <div class="center my-5">
                            <label class="img-label">
                                <div class="image-container">
                                    <img src="<?= get_image('', 'avatar.png') ?>"
                                        alt="Image profile" class="image image-preview-edit"
                                        style="width:250px; hight:250px; object-fit:cover; cursor:pointer; ">
                                    <div class="image-text">Change</div>
                                </div>
                                <input onchange="display_image_onchange(this.files[0])" hidden
                                    class="form-control-file form-control mb-5 mx-auto" type="file" name="profile_img"
                                    style="width:250px; hight:250px; ">
                            </label>
                            <script>
                                function display_image_onchange(file) {
                                    document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                                }
                            </script>
                            <?php if (!empty($errors['profile_img'])): ?>
                                <div class="text-danger mb-3 mt-1">
                                    <?= $errors['profile_img'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

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
                            <input class="form-control" type="email" value="<?= old_value('email') ?>"
                                autocomplete="off" name="email">
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