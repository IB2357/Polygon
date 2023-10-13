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
    <div class="container profile profile-view" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button class="close" type="button" aria-label="Close" data-dismiss="alert"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form>
            <div class="form-row profile-row">
                <div class="col-md-4 relative"></div>
                <div class="col-md-8" style="border-style: solid;">
                    <h1>Profile </h1>
                    <div class="avatar" style="margin-top: 18px;">
                        <div class="avatar-bg center"></div>
                    </div><input class="form-control-file form-control" type="file" name="avatar-file">
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label style="margin-right: 20px;">Full name</label><input class="form-control" type="text" name="firstname"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Role</label><select class="form-control">
                                    <optgroup label="This is a group">
                                        <option value="12" selected="">This is item 1</option>
                                        <option value="13">This is item 2</option>
                                        <option value="14">This is item 3</option>
                                    </optgroup>
                                </select></div>
                        </div>
                    </div>
                    <div class="form-group"><label>About</label><textarea class="form-control"></textarea></div>
                    <div class="form-group"><label>Email </label><input class="form-control" type="email" autocomplete="off" required="" name="email"></div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Password </label><input class="form-control" type="password" name="password" autocomplete="off" required=""></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Confirm Password</label><input class="form-control" type="password" name="confirmpass" autocomplete="off" required=""></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit" style="background: rgb(0,0,0);margin-bottom: 7px;">SAVE </button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
  
    <script src="<?=ROOT?>/assets/js/jquery.min.js"></script>
    <script src="<?=ROOT?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=ROOT?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="<?=ROOT?>/assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
    <script src="<?=ROOT?>/assets/js/Profile-Edit-Form-profile.js"></script>
</body>

</html>