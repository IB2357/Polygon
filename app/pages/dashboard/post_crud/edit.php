<?php
if (!empty($_POST)) {
    // validation
    $errors = [];
    // full name
    if (empty($_POST['title'])) {
        $errors['title'] = "Title is required";
    }

    if (empty($_POST['cat_id'])) {
        $errors['category'] = "Category is required";
    }
    
     // poster_img
     $allowed_imgs = ['image/jpeg', 'image/png', 'image/webp'];
     if (!empty($_FILES['poster_img']['name'])) {
         if (!in_array($_FILES['poster_img']['type'], $allowed_imgs)) {
             $errors['poster_img'] = "Image format is not supported";
         } else {
             $destination = 'uploads/' . time() . basename($_FILES["poster_img"]["name"]);
             move_uploaded_file($_FILES['poster_img']['tmp_name'], $destination);
             resize_image($destination);
         }
     } 

    // save to database
    if (empty($errors)) {
        $new_content = remove_images_from_content($_POST['body']);
        $new_content = remove_root_from_content($new_content);
        $new_content = add_root_to_images($new_content);


        $data = [];
        $data['title'] = $_POST['title'];
        $data['category_id'] = $_POST['cat_id'];
        $data['id'] = $id;

        ///////////////
        $intro_str = "";
        $image_str = "";
        $body_str = "";

        if (!empty($_POST['intro'])) {
            $data['intro'] = $_POST['intro'];
            $intro_str = "intro = :intro, ";
        }
        if (!empty($_POST['body'])) {
            $data['body'] = $new_content;
            $body_str = "body = :body, ";
        }
        
        if (!empty($destination)) {
            $data['poster_img'] = $destination;
            $image_str = "poster_img = :poster_img, ";
        }

        $update_q = "UPDATE post SET title=:title, $image_str $body_str $intro_str category_id = :category_id, `status`='draft', update_date=CURDATE() WHERE id = :id LIMIT 1";

        query($update_q, $data);
        redirect('dashboard/posts');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edit Post
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
            width: 100%;
            height: 350px;
        }

        .contaner {
            width: 100%;
        }

        .avatar {}

        .img-label {
            border: 1px solid #111;
            width: 100%;
        }

        .image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            filter: brightness(0.7);
            transition: filter 0.5s, transform 0.5s;
        }

        .image:hover {
            filter: brightness(0.4);
        }

        .image-text {
            position: absolute;
            color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;

        }

        /* Text visibility on hover */
        .image-container:hover .image-text {
            opacity: 1;
        }
    </style>
</head>

<body>
        <form method="post" enctype="multipart/form-data">
            <div class="form-row my-5">
                <div class="col-md-10 p-4 mx-auto" style="border-style: solid;">
                    <h1>Edit Post #
                        <?= $row[0]['id'] ?>
                    </h1>
                    <div class="avatar" style="margin-top: 18px;">


                        <div class="center my-5 contaner">
                            <label class="img-label">
                                <div class="image-container">
                                    <img src="<?= get_image($row[0]['poster_img'], 'background_placeholder.png') ?>" alt="Image profile"
                                        class="image image-preview-edit" style=" cursor:pointer; ">
                                    <div class="image-text">Change</div>
                                </div>
                                <input onchange="display_image_onchange(this.files[0])" hidden
                                    class="form-control-file form-control mb-5 mx-auto" type="file" name="poster_img">
                            </label>
                            <script>
                                function display_image_onchange(file) {
                                    document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                                }
                            </script>
                            <?php if (!empty($errors['poster_img'])): ?>
                                <div class="text-danger mb-3 mt-1">
                                    <?= $errors['poster_img'] ?>
                                </div>
                            <?php endif; ?>
                        </div>



                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group"><label style="margin-right: 20px;">Title</label>
                                    <input class="form-control" value="<?= old_value('title',$row[0]['title']) ?>" type="text"
                                        name="title">
                                    <?php if (!empty($errors['title'])): ?>
                                        <div class="text-danger mb-3 mt-1">
                                            <?= $errors['title'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="col-sm-12 col-md-6">
                                <div class="form-group"><label>Post Category</label>
                                    <select class="form-control" name="cat_id">
                                        <option value="">-- SELECT --</option>
                                        <?php
                                        $cat_rows = query("SELECT `id`, `category` FROM `category` WHERE active=1");
                                        $used_cat = [];
                                        if (!empty($_POST['cat_id'])) {
                                            $used_cat['id'] = $_POST['cat_id'];
                                            foreach ($cat_rows as $key => $value) {
                                                if ($cat_rows[$key]['id'] == $used_cat['id']) {
                                                    $used_cat['category'] = $value['category'];
                                                    unset($cat_rows[$key]);
                                                }
                                            }
                                        } else {
                                            foreach ($cat_rows as $key => $value) {
                                                if ($cat_rows[$key]['id'] == $row[0]['category_id']) {
                                                    $used_cat = $value;
                                                    unset($cat_rows[$key]);
                                                }
                                            }
                                        }
                                        $used_id = $used_cat['id'];
                                        $used_name = $used_cat['category'];
                                        
                                        echo '<option value="' . "$used_id" . '"selected>' . "$used_name" . '</option>';
                                        foreach ($cat_rows as $cat) {
                                            $id = $cat['id'];
                                            $name = $cat['category'];
                                            echo '<option value="' . "$id" . '">' . "$name" . '</option>';
                                        }

                                        // Different method
                                        
                                        // $cat_rows = query("SELECT `id`, `name` FROM `role`");
                                        
                                        // foreach ($cats as $cat) {
                                        //     $id = $cat['id'];
                                        //     $name = $cat['name'];
                                        //     $old =old_select('cat_id',$id);
                                        //     echo "<option $old value='$id'>$name</option>";
                                        // }
                                        ?>
                                    </select>


                                    <?php if (!empty($errors['category'])): ?>
                                        <div class="text-danger mb-3 mt-1">
                                            <?= $errors['category'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group"><label>Intro</label>
                            <textarea class="form-control" name="intro">
                            <?= old_value('intro',$row[0]['intro']) ?>
                        </textarea>
                        </div>

                        <div class="form-group"><label>Body</label>
                            <textarea id="summernote" class="form-control" name="body">
                            <?= old_value('body',$row[0]['body']) ?>
                        </textarea>
                        </div>
                        <?php if (!empty($errors['body'])): ?>
                            <div class="text-danger mb-3 mt-1">
                                <?= $errors['body'] ?>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="form-row">
                        <div class="col-md-12 content-right">
                            <input class="btn btn-primary form-btn mt-5 " type="submit" value="Save"
                                style="background: rgb(0,0,0);margin-bottom: 0px;">

                            <a href="<?= ROOT ?>/dashboard/posts">
                                <span class="btn btn-primary form-btn mt-5 "
                                    style="background: rgb(0,0,0);margin-bottom: 0px;">
                                    < Back</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
	<link rel="stylesheet" type="text/css" href="<?=ROOT?>/assets/summernote/summernote-lite.min.css">

    <script src="<?= ROOT ?>/assets/js/jquery.min.js"></script>
    <script src="<?= ROOT ?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="<?= ROOT ?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/Profile-Edit-Form-profile.js"></script>

    <script src="<?=ROOT?>/assets/js/jquery.js"></script>
	<script src="<?=ROOT?>/assets/summernote/summernote-lite.min.js"></script>
	<script>
      $('#summernote').summernote({
        placeholder: 'Post content',
        tabsize: 2,
        height: 400
      });
    </script>
</body>

</html>