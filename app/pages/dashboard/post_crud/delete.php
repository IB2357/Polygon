<?php
if (!empty($_POST)) {
    $data = [];
    $data['id'] = $id;

    $delete_q = "DELETE FROM post WHERE id = :id LIMIT 1";
    query($delete_q, $data);
    if(file_exists($row[0]['poster_img']))
                unlink($row[0]['poster_img']);
    redirect('dashboard/posts');

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Delete Post
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
                    <h1>Delete Post #
                        <?= $row[0]['id'] ?>
                    </h1>

                    <div class="form-group"><label>Title</label>
                        <input readonly class="form-control" value="<?= old_value('title', $row[0]['title']) ?>"
                            type="text" name="title">
                        <?php if (!empty($errors['title'])): ?>
                            <div class="text-danger mb-3 mt-1">
                                <?= $errors['title'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group"><label>Intro</label>
                            <textarea class="form-control" readonly name="intro">
                            <?= old_value('intro',$row[0]['intro']) ?>
                        </textarea>
                        </div>

                    <div class="form-group">
                        <h3 class="text-secondary">Created By: <?=$row[0]['full_name'] ?></h3>
                        <h4 class="text-secondary"><?= date("jS M, Y", strtotime($row[0]['create_date'])) ?></h4> 

                    </div>


                    <div class="form-row">
                        <div class="col-md-12 content-right">
                            <input class="btn btn-primary form-btn mt-5" type="submit" value="Delete"
                                style="background: rgb(0,0,0);margin-bottom: 0px;">
                            <a href="<?= ROOT ?>/dashboard/posts">
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