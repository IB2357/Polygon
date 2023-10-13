<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Contact us - <?=APP_NAME?></title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/bootstrap-h/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arbutus+Slab">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="<?=ROOT?>/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Animated-Text-Background.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Animated-Typing-With-Blinking.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/cards-d_style.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Gamanet_Pagination_bs5.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Navbar-Right-Links-icons.css">
</head>

<body>
<?php include_once "parts/nav.php"; ?>

    <header class="masthead" style="background: rgb(255,255,255);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading" style="color: rgb(0,0,0);">
                        <h1>Contact Me</h1><span class="subheading">Have questions? I have answers.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto" style="border-style: solid;">
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                <form id="contactForm" name="sentMessage">
                    <div class="control-group">
                        <div class="form-floating controls mb-3"><input class="form-control" type="text" id="name" required="" placeholder="Name"><label class="form-label" for="name">Name</label><small class="form-text text-danger help-block"></small></div>
                    </div>
                    <div class="control-group">
                        <div class="form-floating controls mb-3"><input class="form-control" type="email" id="email" required="" placeholder="Email Address"><label class="form-label">Email Address</label><small class="form-text text-danger help-block"></small></div>
                    </div>
                    <div class="control-group">
                        <div class="form-floating controls mb-3"><input class="form-control" type="tel" id="phone" required="" placeholder="Phone Number"><label class="form-label">Phone Number</label><small class="form-text text-danger help-block"></small></div>
                    </div>
                    <div class="control-group">
                        <div class="form-floating controls mb-3"><textarea class="form-control" id="message" data-validation-required-message="Please enter a message." required="" placeholder="Message" style="height: 150px;"></textarea><label class="form-label">Message</label><small class="form-text text-danger help-block"></small></div>
                    </div>
                    <div id="success"></div>
                    <div class="mb-3"><button class="btn btn-primary" id="sendMessageButton" type="submit" style="background: rgb(0,0,0);">Send</button></div>
                </form>
            </div>
        </div>
    </div>
    <hr style="margin-bottom: 0px;background: var(--bs-navbar-active-color);opacity: 1;margin-left: 18px;margin-right: 18px;border: 4px solid #000000;margin-top: 40px;">
<?php include_once "parts/footer.php"; ?>

    <script src="<?=ROOT?>/assets/bootstrap-h/js/bootstrap.min.js"></script>
    <script src="<?=ROOT?>/assets/js/Animated-Text-Background-animatedTextBackground.js"></script>
    <script src="<?=ROOT?>/assets/js/Animated-Type-Heading-BS5-Animated-Type-Heading.js"></script>
    <script src="<?=ROOT?>/assets/js/Animated-Typing-With-Blinking-Animated-Type-Heading.js"></script>
    <script src="<?=ROOT?>/assets/js/clean-blog.js"></script>
</body>

</html>