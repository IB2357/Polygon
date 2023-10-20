<?php
if (!empty($_POST)) {
    // validation
    $errors = [];
    // category name
    if (empty($_POST['category'])) {
        $errors['category'] = "category name is required";
    } elseif(!preg_match("/^[a-zA-Z0-9 \-\_\&]+$/", $_POST['category']))
    {
      $errors['category'] = "Category can only have letters, numbers, - , _ , & ";
    }

    // slug
    $slug = slug_creater($_POST['category']);
    $slug_row = query("SELECT id FROM category WHERE slug=:slug LIMIT 1", ['slug' => $slug]);
    if($slug_row){
      $slug .= rand(1000,9999);
    }
    // save to database
    if (empty($errors)) {
        $insert_q = "INSERT INTO category (category, slug, active) 
        VALUES (:category,:slug,:active)";
        $data = [];
        $data['category'] = $_POST['category'];
        $data['slug'] = $slug;
        $data['active'] = $_POST['active'];

        query($insert_q, $data);
        redirect('dashboard/categories');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>New Category
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
        <form method="post">
            <div class="form-row profile-row">
                <div class="col-md-8 p-5 mx-auto" style="border-style: solid;">
                    <h1>New Category</h1>
                    <div class="avatar" style="margin-top: 18px;">

                        <div class="form-group">
                            <label style="margin-right: 20px;">Category</label>
                            <input class="form-control" value="<?= old_value('category') ?>" type="text"
                                name="category">
                            <?php if (!empty($errors['category'])): ?>
                                <div class="text-danger mb-3 mt-1">
                                    <?= $errors['category'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-check form-check-inline">
                            <label class="form-check-label mr-2 " for="active">Active </label>
                            <select name="active" id="active">
                            <?php $g = 1; ?>
                                <option value="0" <?=old_select('active',0,'',$g)?> >off</option>
                                <option value="1" <?=old_select('active',1,'',$g)?> >on</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-12 content-right">
                            <input class="btn btn-primary form-btn mt-5 " type="submit" value="Create"
                                style="background: rgb(0,0,0);margin-bottom: 0px;">

                            <a href="<?= ROOT ?>/dashboard/categories">
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