<?php
$limit = 5;
$offset = ($PAGE['page_number'] - 1) * $limit;
$select_posts =
    "SELECT p.*, u.`full_name` ,c.`category`
    FROM `post` p 
    JOIN `user` u
    ON p.`user_id` = u.id
    JOIN `category` c 
    ON p.category_id = c.id
    WHERE
    p.`status` = 'published'
    ORDER BY p.`publish_date`
    DESC
    LIMIT $limit
    OFFSET $offset";
$resent_rows = query($select_posts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        <?= APP_NAME ?>
    </title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/bootstrap-h/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arbutus+Slab">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Animated-Text-Background.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Animated-Typing-With-Blinking.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/cards-d_style.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Gamanet_Pagination_bs5.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Navbar-Right-Links-icons.css">
</head>

<body>
    <?php include_once "parts/nav.php"; ?>
    <?php if ($PAGE['page_number'] < 2): ?>
        <h2
            style="margin-top: 52px;margin-left: 34px;font-family: 'Open Sans', sans-serif;font-size: 22px;font-weight: 800;line-height: 32px;color: rgb(0,0,0);">
            <strong><span style="color: rgb(33, 37, 41);">most viewed</span></strong>
        </h2>
        <div>

            <div class="container">
                <div class="cust_bloglistintro">
                    <p style="margin-left: 34px;color: rgba(255,255,255,0.5);font-size: 14px;"></p>
                </div>

                <div class="row">
                    <?php
                    // // TODO: count the views:   ORDER BY p.`views`
                
                    $most_viewed =
                        "SELECT p.*, u.`full_name` ,c.`category` FROM `post` p JOIN `user` u ON p.`user_id` = u.id JOIN `category` c  ON p.category_id = c.id WHERE p.`status` = 'published' ORDER BY p.publish_date DESC LIMIT 3";
                    $most_viewed_rows = query($most_viewed);
                    if ($most_viewed_rows) {
                        foreach ($most_viewed_rows as $row) {
                            include "parts/most_viewed.php";
                        }
                    } else
                        echo "<p>No Posts Yet</p>";
                    ?>
                </div>
            </div>
        </div>
        <hr
            style="margin-top: 48px;margin-bottom: 0px;background: var(--bs-navbar-active-color);opacity: 1;margin-left: 18px;margin-right: 18px;border: 4px solid #000000;">
        <h2
            style="margin-top: 52px;margin-left: 34px;font-family: 'Open Sans', sans-serif;font-size: 22px;font-weight: 800;line-height: 32px;color: rgb(0,0,0);">
            <strong><span style="color: rgb(33, 37, 41);">Recent</span></strong>
        </h2>
    <?php else: ?>
        <h2
            style="margin-top: 52px;margin-left: 34px;font-family: 'Open Sans', sans-serif;font-size: 22px;font-weight: 800;line-height: 32px;color: rgb(0,0,0);">
            <strong><span style="color: rgb(33, 37, 41);">Older</span></strong>
        </h2>
    <?php endif; ?>

    <?php if (!empty($resent_rows)): ?>
        <?php foreach ($resent_rows as $row): ?>
            <div class="container py-4 py-xl-5">
                <div class="row gy-4 gy-md-0">
                    <div class="col-md-6">
                        <div class="p-xl-5 m-xl-5">
                            <a href="<?= ROOT ?>/post/<?= $row['slug'] ?>"><img class="rounded img-fluid w-100 fit-cover"
                                    style="min-height: 300px;"
                                    src="<?= get_image($row['poster_img'], 'background_placeholder.png') ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-6 d-md-flex align-items-md-center">
                        <div style="max-width: 350px;padding-right: 0px;">
                            <a href="<?= ROOT ?>/post/<?= $row['slug'] ?>">
                                <h2 class="text-uppercase fw-bold">
                                    <?= $row['title'] ?>
                                </h2>
                            </a>

                            <span class=" mt-1 border rounded text-muted">
                                <?= $row['category'] ?>
                            </span>
                            <p class="my-3">
                                <?= $row['intro'] ?>
                            </p>
                            <p class="post-meta">Posted by&nbsp;<a href="#"><a href="#">
                                        <?= $row['full_name'] ?> on
                                        <?= date("jS M, Y", strtotime($row['publish_date'])) ?>
                                    </a></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <hr>
    <div id="pagination" class="d-flex justify-content-center" style="padding-bottom: 0px;">
        <a class="pagination-item <?= ($PAGE['page_number'] == 1) ? 'disabled' : 'active' ?>"
            href="<?= $PAGE['prev_link'] ?>"><img src="<?= ROOT ?>/assets/img/icon_arrow-left.svg"><span>Previos</span>
        </a>
        <a class="pagination-item  <?= ($PAGE['page_number'] == 1) ? 'disabled' : 'active' ?>"
            href="<?= $PAGE['first_link'] ?>">&nbsp;Home&nbsp;
        </a>
        <a class="pagination-item" href="<?= $PAGE['next_link'] ?>"><span>Next</span><img
                src="<?= ROOT ?>/assets/img/icon_arrow-right.svg">
        </a>
    </div>
    <hr
        style="margin-bottom: 0px;background: var(--bs-navbar-active-color);opacity: 1;margin-left: 18px;margin-right: 18px;border: 4px solid #000000;margin-top: 14px;">
    <?php include_once "parts/footer.php"; ?>
    <script src="<?= ROOT ?>/assets/bootstrap-h/js/bootstrap.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Text-Background-animatedTextBackground.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Type-Heading-BS5-Animated-Type-Heading.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Typing-With-Blinking-Animated-Type-Heading.js"></script>
    <script src="<?= ROOT ?>/assets/js/clean-blog.js"></script>
</body>

</html>