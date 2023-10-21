<h1 style="margin: 18px;margin-top: 5px;margin-bottom: 0px;margin-right: 0px;padding-left: 60px;">Statistics
</h1>

<hr style="border: 5px solid rgb(0,0,0);background: #000000;margin-right: 18px;margin-left: 18px;">

<?php if(is_admin()):?>
<div class="row justify-content-center">
    <div class="m-1 col-md-4 bg-light rounded shadow border text-center">
        <h1><i class="bi bi-person-video3"></i></h1>
        <div>
            Admins
        </div>
        <?php

        $query = "SELECT COUNT(id) AS num FROM user WHERE role_id =1";
        $res = query($query);
        $res = $res[0];
        ?>
        <h1 class="text-dark">
            <?= $res['num'] ?? 0 ?>
        </h1>
    </div>

    <div class="m-1 col-md-4 bg-light rounded shadow border text-center">
        <h1><i class="bi bi-person-circle"></i></h1>
        <div>
            Authors
        </div>
        <?php

        $query = "SELECT COUNT(id) AS num FROM user WHERE role_id =2";
        $res = query($query);
        $res = $res[0];
        ?>
        <h1 class="text-dark" >
            <?= $res['num'] ?? 0 ?>
        </h1>
    </div>

    <div class="m-1 col-md-4 bg-light rounded shadow border text-center">
        <h1><i class="bi bi-tags"></i></h1>
        <div>
            Categories
        </div>
        <?php

        $query = "SELECT COUNT(id) AS num FROM category";
        $res = query($query);
        $res = $res[0];
        ?>
        <h1 class="text-dark">
            <?= $res['num'] ?? 0 ?>
        </h1>
    </div>

    <div class="m-1 col-md-4 bg-light rounded shadow border text-center">
        <h1><i class="bi bi-file-post"></i></h1>
        <div>
            Posts
        </div>
        <?php

        $query = "SELECT COUNT(id) AS num FROM post";
        $res = query($query);
        $res = $res[0];
        ?>
        <h1 class="text-dark">
            <?= $res['num'] ?? 0 ?>
        </h1>
    </div>

</div>
<?php endif;?>

<hr class="my-4" >
<div class="row justify-content-center">
    <div class="m-1 col-md-4 bg-light rounded shadow border text-center">
        <h1><i class="bi bi-file-post"></i></h1>
        <div>
            Publishes
        </div>
        <?php

        $query = "SELECT COUNT(id) AS num FROM post WHERE `status`='published' AND user_id=:id";
        $res = query($query,['id'=>$_SESSION['user']['id']]);
        $res = $res[0];
        ?>
        <h1 class="text-dark">
            <?= $res['num'] ?? 0 ?>
        </h1>
    </div>
    <div class="m-1 col-md-4 bg-light rounded shadow border text-center">
        <h1><i class="bi bi-file-post"></i></h1>
        <div>
            Drafts
        </div>
        <?php

        $query = "SELECT COUNT(id) AS num FROM post WHERE `status`='Drafts' AND user_id=:id";
        $res = query($query,['id'=>$_SESSION['user']['id']]);
        $res = $res[0];
        ?>
        <h1 class="text-dark">
            <?= $res['num'] ?? 0 ?>
        </h1>
    </div>

</div>