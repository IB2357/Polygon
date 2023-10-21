<nav class="navbar navbar-light navbar-expand-md py-3"
    style="margin: 18px;margin-left: 18px;border-style: solid;border-bottom-width: 5px;">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="<?= ROOT ?>/home"><span>
                <?= BRAND_NAME ?>
            </span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span
                class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-2">
            <ul class="navbar-nav ms-auto">
                <a class="nav-link active" href="<?= ROOT ?>/about">
                    <li class="nav-item">ABOUT US</li>
                </a>
                <a class="nav-link active" href="<?= ROOT ?>/contact">
                    <li class="nav-item">CONTACT US</li>
                </a>
                <?php if(logged_in()):?>
                <li class="bg-dark p-1 rounded-circle mt-0"><a href="<?=ROOT?>/dashboard" class=""
                    >
                    <img src="<?= get_image($_SESSION['user']['profile_img'], 'avatar.png') ?>" alt="mdo" style="object-fit: cover;" width="52" height="52"
                        class="rounded-circle border-3">
                </a></li>
                <?php endif;?>
                

            </ul>
        </div>
    </div>
</nav>