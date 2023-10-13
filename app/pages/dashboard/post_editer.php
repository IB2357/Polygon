<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>users<?=APP_NAME?></title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Banner-Heading-Image-images.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Profile-Edit-Form.css">
</head>

<body>
    <div class="container">
        <form style="margin: 18px;">
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group"><input class="form-control" type="text"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6"></div>
                <div class="col-md-6" style="padding: 6px;">
                    <div class="btn-group" role="group" style="margin-top: 10px;"><button class="btn btn-dark" type="button" style="margin-right: 10px;border-radius: 6px;">Save</button><button class="btn btn-dark" type="button" style="margin-right: 10px;border-radius: 6px;">Publish</button><button class="btn btn-dark" type="button" style="border-radius: 6px;">Delete</button></div>
                    <div></div><input class="form-control-file" type="file" style="margin-top: 10px;"><select class="form-control" style="margin-top: 10px;">
                        <optgroup label="This is a group">
                            <option value="12" selected="">This is item 1</option>
                            <option value="13">This is item 2</option>
                            <option value="14">This is item 3</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <nav class="navbar navbar-light fixed-top off-canvas" data-right-drawer="0" data-open-drawer="1" style="background: rgb(255,255,255);color: rgb(0,0,0);border-right-style: solid;position: sticky;height: 100vh;">
        <div class="container-fluid flex-column"><button class="btn btn-dark drawer-knob" type="button" data-open="drawer" style="background: var(--white);color: rgb(0,0,0);border-width: 2px;border-style: solid;margin-right: -19px;"><i class="fas fa-bars"></i></button>
            <div class="d-flex justify-content-between brand-line"><a class="navbar-brand" href="#"><?=BRAND_NAME?></a><button class="btn btn-dark" type="button" data-dismiss="drawer" style="background: var(--white);color: rgb(0,0,0);border-width: 2px;border-style: solid;"><span class="sr-only">Toggle Navigation&nbsp;</span><i class="fas fa-times"></i></button></div>
            <div><a href="#" style="background: url(&quot;<?=ROOT?>/assets/img/PXL_20230421_094918005.jpg&quot;) center / cover no-repeat, var(--secondary);color: rgba(0,123,255,0);padding: 36px;padding-bottom: 47px;height: 0;width: 0;border-radius: 100px;">Link</a></div>
            <ul class="navbar-nav flex-column drawer-menu">
                <li class="nav-item"><a class="nav-link active" href="#">Create User</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Posts</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
            </ul>
            <ul class="navbar-nav flex-column drawer-menu">
                <li class="nav-item"><a class="nav-link active" href="#">Create Article</a></li>
                <li class="nav-item"><a class="nav-link" href="#">My Drafts</a></li>
                <li class="nav-item"><a class="nav-link" href="#">My publishes</a></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
            </ul>
            <ul class="navbar-nav flex-column bottom-nav">
                <li class="nav-item"><a class="nav-link active" href="#">First Item</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Second Item</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Third Item</a></li>
            </ul>
        </div>
    </nav>
    <script src="<?=ROOT?>/assets/js/jquery.min.js"></script>
    <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=ROOT?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="<?=ROOT?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
    <script src="<?=ROOT?>/assets/js/Profile-Edit-Form-profile.js"></script>
</body>

</html>