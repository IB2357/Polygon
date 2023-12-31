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
    // email not in use and not for the updated user(id != :id)
    $email_q = "SELECT id FROM user WHERE email=:email && id != :id LIMIT 1";
    $email = query($email_q, ['email' => $_POST['email'], 'id' => $id]);
    if (empty($_POST['email'])) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email not valid";
    } elseif ($email) {
        $errors['email'] = "Email is already in use";
    }
    // password
    if (!empty($_POST['password']) && strlen($_POST['password']) < 8) {
        $errors['password'] = "Password must be 8 characters or more";
    } elseif ($_POST['password'] !== $_POST['confirmpass']) {
        $errors['password'] = "Password and confirming Password do not match ";
    }
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


        $data = [];
        $data['full_name'] = $_POST['full_name'];
        $data['email'] = $_POST['email'];
        // $data['profile_img'] = $_POST['profile_img'];
        // $data['about'] = $_POST['about'];
        $data['role_id'] = $_POST['role'];
        $data['id'] = $id;
        $data['active'] = $_POST['active'];

        // check if password empty
        // if (empty($_POST['password'])) {
        //     $update_q = "UPDATE user SET full_name = :full_name, email = :email, profile_img = :profile_img, about = :about, role_id = :role_id WHERE id = :id LIMIT 1";
        // } else {
        //     $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //     $update_q = "UPDATE user SET full_name = :full_name, email = :email, profile_img = :profile_img, about = :about, password = :password, role_id = :role_id WHERE id = :id LIMIT 1";
        // }

        ///////////////
        $password_str = "";
        $image_str = "";
        $about_str = "";

        if (!empty($_POST['about'])) {
            $data['about'] = $_POST['about'];
            $about_str = "about = :about, ";
        }
        if (!empty($_POST['password'])) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $password_str = "password = :password, ";
        }
        if (!empty($destination)) {
            $data['profile_img'] = $destination;
            $image_str = "profile_img = :profile_img, ";
        }

        $update_q = "UPDATE user SET full_name = :full_name, email = :email, $image_str $about_str $password_str role_id = :role_id, active=:active WHERE id = :id LIMIT 1";

        query($update_q, $data);
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
        <form method="post" enctype="multipart/form-data">
            <div class="form-row profile-row">
                <div class="col-md-8 p-5 mx-auto" style="border-style: solid;">
                    <h1>Editing User
                        <strong>"
                            <?= $row[0]['full_name'] ?>"
                        </strong>
                    </h1>
                    <div class="avatar" style="margin-top: 18px;">

                        <div class="center my-5">
                            <label class="img-label">
                                <div class="image-container">
                                    <img src="<?= get_image($row[0]['profile_img'], 'avatar.png') ?>"
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
                                    <input class="form-control"
                                        value="<?= old_value('full_name', $row[0]['full_name']) ?>" type="text"
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
                                        // old_select :
                                        $used_role = [];
                                        if (!empty($_POST['role'])) {
                                            $used_role['id'] = $_POST['role'];
                                            foreach ($roles as $key => $value) {
                                                if ($roles[$key]['id'] == $used_role['id']) {
                                                    $used_role['name'] = $value['name'];
                                                    unset($roles[$key]);
                                                }
                                            }
                                        } else {
                                            foreach ($roles as $key => $value) {
                                                if ($roles[$key]['id'] == $row[0]['role_id']) {
                                                    $used_role = $value;
                                                    unset($roles[$key]);
                                                }
                                            }

                                        }
                                        $used_id = $used_role['id'];
                                        $used_name = $used_role['name'];
                                        
                                        echo '<option value="' . "$used_id" . '"selected>' . "$used_name" . '</option>';
                                        foreach ($roles as $role) {
                                            $id = $role['id'];
                                            $name = $role['name'];
                                            echo '<option value="' . "$id" . '">' . "$name" . '</option>';
                                        }
                                        
                                        
                                        // Different method 

                                        // $roles = query("SELECT `id`, `name` FROM `role`");
                                        // // old_select :
                                        // $used_role = [];
                                        // foreach ($roles as $key => $value) {
                                        //     if ($roles[$key]['id'] == $row[0]['role_id']) {
                                        //         $used_role = $value;
                                        //     }
                                        // }
                                        // $used_id = $used_role['id'];
                                        // $g = 1;
                                        // foreach ($roles as $role) {
                                        //     $id = $role['id'];
                                        //     $name = $role['name'];
                                        //     $old =old_select('role',$id,$used_id,$g);
                                        //     echo "<option $old value='$id'>$name</option>";
                                        // }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-check form-check-inline">
                                        <label class="form-check-label mr-2 " for="active">Active </label>
                                        <select name="active" id="active">
                                            <?php $g = 1; ?>
                                            <option value="0" <?= old_select('active', 0, '', $g) ?>>off</option>
                                            <option value="1" <?= old_select('active', 1, '', $g) ?>>on</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group"><label>About</label><textarea class="form-control"
                                name="about"><?= old_value('about', $row[0]['about']) ?></textarea></div>

                        <div class="form-group"><label>Email </label>
                            <input class="form-control" type="email" value="<?= old_value('email', $row[0]['email']) ?>"
                                autocomplete="off" name="email">
                            <?php if (!empty($errors['email'])): ?>
                                <div class="text-danger mb-3 mt-1">
                                    <?= $errors['email'] ?>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group"><label>Update Password <small>(leave empty to keep the
                                            old)</small>
                                    </label>
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
                                <input class="btn btn-primary form-btn mt-5" type="submit" value="Save"
                                    style="background: rgb(0,0,0);margin-bottom: 0px;">
                                <a href="<?= ROOT ?>/dashboard/users">
                                    <span class="btn btn-primary form-btn mt-5"
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