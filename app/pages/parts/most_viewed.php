<div class="col-md-4 cust_blogteaser" style="padding-bottom: 20px;margin-bottom: 32px;"><a href="<?= ROOT ?>/post/<?= $row['slug'] ?>"><img
            class="img-fluid" style="height: 200px; object-fit: cover" src="<?= get_image($row['poster_img'],'background_placeholder.png') ?>"></a>
    <a href="<?= ROOT ?>/post/<?= $row['slug'] ?>"><h3
        style="text-align: left;margin-top: 20px;font-family: 'Open Sans', sans-serif;font-size: 18px;margin-right: 0;margin-left: 24px;line-height: 34px;letter-spacing: 0px;font-style: normal;font-weight: bold;">
        <?= $row['title'] ?><br></h3></a>
    <p class="text-secondary"
        style="text-align: left;font-size: 14px;font-family: 'Open Sans', sans-serif;line-height: 22px;color: rgb(9,9,10);margin-left: 24px;">
        <?= $row['intro'] ?></p>
    <p class="post-meta">Posted by&nbsp;<a href="#"><?= $row['full_name'] ?> on <?= date("jS M, Y", strtotime($row['publish_date'])) ?></a></p>
</div>