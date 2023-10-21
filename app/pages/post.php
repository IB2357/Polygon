<?php
$select_post =
    "SELECT p.*, u.`full_name` ,c.`category`
    FROM `post` p 
    JOIN `user` u
    ON p.`user_id` = u.id
    JOIN `category` c 
    ON p.category_id = c.id
    WHERE
    p.slug=:slug
    LIMIT 1;";
$slug = $url[1] ?? null;
if ($slug) {
    $row = query($select_post, ['slug' => $slug]);
    $row = $row[0];
    $update_q = "UPDATE post SET `views`=(`views`+1) WHERE slug=:slug LIMIT 1";
    query($update_q, ['slug' => $slug]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blog Post -
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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Animated-Text-Background.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Animated-Typing-With-Blinking.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/cards-d_style.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Gamanet_Pagination_bs5.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Navbar-Right-Links-icons.css">
</head>

<body>
    <?php include_once "parts/nav.php"; ?>
    <?php if (!empty($row)): ?>
        <header class="masthead"
            style="background-image: url('<?= get_image($row['poster_img'], 'background_placeholder.png') ?>');margin-right: 18px;margin-left: 18px;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto position-relative">
                        <div class="post-heading">
                            <h1>
                                <?= $row['title'] ?>
                            </h1>
                            <h2 class="subheading">
                                <?= $row['intro'] ?>
                            </h2><span class="meta">Posted by&nbsp;
                                <?= $row['full_name'] ?> on
                                <?= date("jS M, Y", strtotime($row['publish_date'])) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto">
                        <div class="body">
                            <?= $row['body'] ?>
                        </div>
                        <hr>
                        <span class=" m-3 p-1 text-muted border">
                            <?= $row['category'] ?>
                        </span>
                        <span class=" m-3 p-1 text-muted border">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-eyeglasses mr-1" viewBox="0 0 16 16">
                                <path
                                    d="M4 6a2 2 0 1 1 0 4 2 2 0 0 1 0-4zm2.625.547a3 3 0 0 0-5.584.953H.5a.5.5 0 0 0 0 1h.541A3 3 0 0 0 7 8a1 1 0 0 1 2 0 3 3 0 0 0 5.959.5h.541a.5.5 0 0 0 0-1h-.541a3 3 0 0 0-5.584-.953A1.993 1.993 0 0 0 8 6c-.532 0-1.016.208-1.375.547zM14 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
                            </svg>
                            <?= $row['views'] ?>
                        </span>
                    </div>
                </div>
            </div>

        </article>
        <hr
            style="margin-bottom: 0px;background: var(--bs-navbar-active-color);opacity: 1;margin-left: 18px;margin-right: 18px;border: 4px solid #000000;margin-top: 14px;">
        <!-- <h2
            style="margin-top: 52px;margin-left: 34px;font-family: 'Open Sans', sans-serif;font-size: 22px;font-weight: 800;line-height: 32px;color: rgb(0,0,0);margin-bottom: 26px;">
            <strong><span style="color: rgb(33, 37, 41);">Comments</span></strong></h2>
        <div class="container">
            <div class="card" style="border-radius: 3px;border: 2px solid rgb(0,0,0);">
                <div style="margin-bottom: 5vh;">
                    <div class="d-flex"
                        style="padding-left: 22px;padding-top: 20px;padding-right: 30px;padding-bottom: 0px;"><img
                            class="rounded-circle" src="<?= ROOT ?>/assets/img/eren.png" width="72" height="72">
                        <div>
                            <div class="row text-end d-flex">
                                <div class="col-xl-12 d-flex align-items-center" style="padding-left: 23px;">
                                    <h4 style="padding-bottom: 0px;margin-bottom: 4px;">Eren</h4><span
                                        class="font-monospace" style="padding-left: 12px;color: #697077;">04/08/2022</span>
                                </div>
                                <div class="col-xl-11 col-xxl-12 text-break text-start d-flex align-items-xxl-center"
                                    style="padding-left: 24px;">
                                    <p class="text-break text-start">Magna congue sociosqu sit aptent sollicitudin cras,
                                        ante est per. Turpis ipsum fringilla dapibus praesent, conubia potenti. Maecenas
                                        himenaeos fusce dolor, metus egestas sollicitudin. In sodales tempus tellus
                                        maecenas, dapibus aliquam dictumst. Egestas orci himenaeos scelerisque, suscipit
                                        nostra massa ultricies tellus. Class lacinia quisque nisl, habitant aenean feugiat
                                        aliquet habitasse.</p>
                                </div>
                                <div class="col-xl-12 d-flex d-xl-flex justify-content-end align-items-end">
                                    <div><a data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-1"
                                            href="#collapse-1" role="button"><i class="fas fa-reply"></i>&nbsp;Reply</a>
                                        <div id="collapse-1" class="collapse">
                                            <div class="d-flex flex-shrink-1 card-header" style="width: 50vw;">
                                                <div class="col">
                                                    <form action="submit" method="post">
                                                        <div class="d-flex justify-content-start"
                                                            style="padding-bottom: 12px;"><label class="form-label"
                                                                for="name" style="padding-right: 43px;">Name</label><input
                                                                class="border rounded-pill form-control" type="text"
                                                                style="width: 20vw;" name="name" placeholder="Name"></div>
                                                        <div class="d-flex justify-content-xl-start"
                                                            style="padding-bottom: 17px;"><label class="form-label"
                                                                for="email" style="padding-right: 47px;">Email</label><input
                                                                class="border rounded-pill form-control" type="email"
                                                                style="width: 20vw;" inputmode="email" autofocus=""
                                                                name="email" placeholder="Email"></div>
                                                        <div class="d-flex" style="padding-bottom: 17px;"><label
                                                                class="form-label" for="comment"
                                                                style="padding-right: 19px;">Comment</label><textarea
                                                                class="form-control form-control-lg" name="comment" rows="3"
                                                                cols="20" style="width: 20vw;max-width: 400px;"></textarea>
                                                        </div>
                                                        <div class="text-center d-flex"
                                                            style="padding-bottom: 13px;margin-left: 5vw;"><button
                                                                class="btn btn-success" type="button"
                                                                style="margin-right: 22px;">Submit</button><button
                                                                class="btn btn-danger" type="button">Cancel</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex"
                        style="padding-right: 30px;padding-left: 100px;padding-top: 0px;padding-bottom: 18px;"><img
                            class="rounded-circle" src="<?= ROOT ?>/assets/img/levi.png" width="72" height="72">
                        <div>
                            <div class="row text-end d-flex">
                                <div class="col-xl-12 d-flex align-items-center" style="padding-left: 23px;">
                                    <h4 style="padding-bottom: 0px;margin-bottom: 4px;">Levi</h4><span
                                        class="font-monospace" style="padding-left: 12px;color: #697077;">04/08/2022</span>
                                </div>
                                <div class="col-xl-11 col-xxl-12 text-break text-start d-flex align-items-xxl-center"
                                    style="padding-left: 24px;">
                                    <p class="text-break text-start">Magna congue sociosqu sit aptent sollicitudin cras,
                                        ante est per. Turpis ipsum fringilla dapibus praesent, conubia potenti. Maecenas
                                        himenaeos fusce dolor, metus egestas sollicitudin. In sodales tempus tellus
                                        maecenas, dapibus aliquam dictumst. Egestas orci himenaeos scelerisque, suscipit
                                        nostra massa ultricies tellus. Class lacinia quisque nisl, habitant aenean feugiat
                                        aliquet habitasse.</p>
                                </div>
                                <div class="col-xl-12 d-flex d-xl-flex justify-content-end align-items-end">
                                    <div><a data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-2"
                                            href="#collapse-2" role="button"><i class="fas fa-reply"></i>&nbsp;Reply</a>
                                        <div id="collapse-2" class="collapse">
                                            <div class="d-flex flex-shrink-1 card-header" style="width: 50vw;">
                                                <div class="col">
                                                    <form action="submit" method="post">
                                                        <div class="d-flex justify-content-start"
                                                            style="padding-bottom: 12px;"><label class="form-label"
                                                                for="name" style="padding-right: 43px;">Name</label><input
                                                                class="border rounded-pill form-control" type="text"
                                                                style="width: 20vw;" name="name" placeholder="Name"></div>
                                                        <div class="d-flex justify-content-xl-start"
                                                            style="padding-bottom: 17px;"><label class="form-label"
                                                                for="email" style="padding-right: 47px;">Email</label><input
                                                                class="border rounded-pill form-control" type="email"
                                                                style="width: 20vw;" inputmode="email" autofocus=""
                                                                name="email" placeholder="Email"></div>
                                                        <div class="d-flex" style="padding-bottom: 17px;"><label
                                                                class="form-label" for="comment"
                                                                style="padding-right: 19px;">Comment</label><textarea
                                                                class="form-control form-control-lg" name="comment" rows="3"
                                                                cols="20" style="width: 20vw;max-width: 400px;"></textarea>
                                                        </div>
                                                        <div class="text-center d-flex"
                                                            style="padding-bottom: 13px;margin-left: 5vw;"><button
                                                                class="btn btn-success" type="button"
                                                                style="margin-right: 22px;">Submit</button><button
                                                                class="btn btn-danger" type="button">Cancel</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex"
                        style="padding-right: 30px;padding-left: 100px;padding-top: 0px;padding-bottom: 18px;"><img
                            class="rounded-circle" src="<?= ROOT ?>/assets/img/annei.jpg" width="72" height="72">
                        <div>
                            <div class="row text-end d-flex">
                                <div class="col-xl-12 d-flex align-items-center" style="padding-left: 23px;">
                                    <h4 style="padding-bottom: 0px;margin-bottom: 4px;">Aneei</h4><span
                                        class="font-monospace" style="padding-left: 12px;color: #697077;">04/08/2022</span>
                                </div>
                                <div class="col-xl-11 col-xxl-12 text-break text-start d-flex align-items-xxl-center"
                                    style="padding-left: 24px;">
                                    <p class="text-break text-start">Magna congue sociosqu sit aptent sollicitudin cras,
                                        ante est per. Turpis ipsum fringilla dapibus praesent, conubia potenti. Maecenas
                                        himenaeos fusce dolor, metus egestas sollicitudin. In sodales tempus tellus
                                        maecenas, dapibus aliquam dictumst. Egestas orci himenaeos scelerisque, suscipit
                                        nostra massa ultricies tellus. Class lacinia quisque nisl, habitant aenean feugiat
                                        aliquet habitasse.</p>
                                </div>
                                <div class="col-xl-12 d-flex d-xl-flex justify-content-end align-items-end">
                                    <div><a data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-3"
                                            href="#collapse-3" role="button"><i class="fas fa-reply"></i>&nbsp;Reply</a>
                                        <div id="collapse-3" class="collapse">
                                            <div class="d-flex flex-shrink-1 card-header" style="width: 50vw;">
                                                <div class="col">
                                                    <form action="submit" method="post">
                                                        <div class="d-flex justify-content-start"
                                                            style="padding-bottom: 12px;"><label class="form-label"
                                                                for="name" style="padding-right: 43px;">Name</label><input
                                                                class="border rounded-pill form-control" type="text"
                                                                style="width: 20vw;" name="name" placeholder="Name"></div>
                                                        <div class="d-flex justify-content-xl-start"
                                                            style="padding-bottom: 17px;"><label class="form-label"
                                                                for="email" style="padding-right: 47px;">Email</label><input
                                                                class="border rounded-pill form-control" type="email"
                                                                style="width: 20vw;" inputmode="email" autofocus=""
                                                                name="email" placeholder="Email"></div>
                                                        <div class="d-flex" style="padding-bottom: 17px;"><label
                                                                class="form-label" for="comment"
                                                                style="padding-right: 19px;">Comment</label><textarea
                                                                class="form-control form-control-lg" name="comment" rows="3"
                                                                cols="20" style="width: 20vw;max-width: 400px;"></textarea>
                                                        </div>
                                                        <div class="text-center d-flex"
                                                            style="padding-bottom: 13px;margin-left: 5vw;"><button
                                                                class="btn btn-success" type="button"
                                                                style="margin-right: 22px;">Submit</button><button
                                                                class="btn btn-danger" type="button">Cancel</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex"
                        style="padding-left: 22px;padding-right: 30px;padding-bottom: 0px;padding-top: 0px;"><img
                            class="rounded-circle" src="<?= ROOT ?>/assets/img/mikasa.jpg" width="72" height="72">
                        <div>
                            <div class="row text-end d-flex">
                                <div class="col-xl-12 d-flex align-items-center" style="padding-left: 23px;">
                                    <h4 style="padding-bottom: 0px;margin-bottom: 4px;">Mikasa</h4><span
                                        class="font-monospace" style="padding-left: 12px;color: #697077;">04/08/2022</span>
                                </div>
                                <div class="col-xl-11 col-xxl-12 text-break text-start d-flex align-items-xxl-center"
                                    style="padding-left: 24px;">
                                    <p class="text-break text-start">Magna congue sociosqu sit aptent sollicitudin cras,
                                        ante est per. Turpis ipsum fringilla dapibus praesent, conubia potenti. Maecenas
                                        himenaeos fusce dolor, metus egestas sollicitudin. In sodales tempus tellus
                                        maecenas, dapibus aliquam dictumst. Egestas orci himenaeos scelerisque, suscipit
                                        nostra massa ultricies tellus. Class lacinia quisque nisl, habitant aenean feugiat
                                        aliquet habitasse.</p>
                                </div>
                                <div class="col-xl-12 d-flex d-xl-flex justify-content-end align-items-end">
                                    <div><a data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-4"
                                            href="#collapse-4" role="button"><i class="fas fa-reply"></i>&nbsp;Reply</a>
                                        <div id="collapse-4" class="collapse">
                                            <div class="d-flex flex-shrink-1 card-header" style="width: 50vw;">
                                                <div class="col">
                                                    <form action="submit" method="post">
                                                        <div class="d-flex justify-content-start"
                                                            style="padding-bottom: 12px;"><label class="form-label"
                                                                for="name" style="padding-right: 43px;">Name</label><input
                                                                class="border rounded-pill form-control" type="text"
                                                                style="width: 20vw;" name="name" placeholder="Name"></div>
                                                        <div class="d-flex justify-content-xl-start"
                                                            style="padding-bottom: 17px;"><label class="form-label"
                                                                for="email" style="padding-right: 47px;">Email</label><input
                                                                class="border rounded-pill form-control" type="email"
                                                                style="width: 20vw;" inputmode="email" autofocus=""
                                                                name="email" placeholder="Email"></div>
                                                        <div class="d-flex" style="padding-bottom: 17px;"><label
                                                                class="form-label" for="comment"
                                                                style="padding-right: 19px;">Comment</label><textarea
                                                                class="form-control form-control-lg" name="comment" rows="3"
                                                                cols="20" style="width: 20vw;max-width: 400px;"></textarea>
                                                        </div>
                                                        <div class="text-center d-flex"
                                                            style="padding-bottom: 13px;margin-left: 5vw;"><button
                                                                class="btn btn-success" type="button"
                                                                style="margin-right: 22px;">Submit</button><button
                                                                class="btn btn-danger" type="button">Cancel</button></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <hr
            style="margin-bottom: 0px;background: var(--bs-navbar-active-color);opacity: 1;margin-left: 18px;margin-right: 18px;border: 4px solid #000000;margin-top: 14px;"> -->
    <?php else: ?>
        <h1 class="center text-danger mx-5">Article Not Found</h1>
    <?php endif; ?>
    <?php include_once "parts/footer.php"; ?>
    <script src="<?= ROOT ?>/assets/bootstrap-h/js/bootstrap.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Text-Background-animatedTextBackground.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Type-Heading-BS5-Animated-Type-Heading.js"></script>
    <script src="<?= ROOT ?>/assets/js/Animated-Typing-With-Blinking-Animated-Type-Heading.js"></script>
    <script src="<?= ROOT ?>/assets/js/clean-blog.js"></script>
</body>

</html>