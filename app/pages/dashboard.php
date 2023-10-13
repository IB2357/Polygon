<?php
    if(!logged_in())
        redirect(ROOT.'/login');

    $section = $url[1] ?? 'dashboard';
    $file_name = "../app/pages/dashboard/".$section.".php";

    if(file_exists($file_name)){
        require_once $file_name;
    }
    else{
        require_once "../app/pages/dashboard/404.php";
    }
?>
<?php include_once "dashboard/sidebar.php"; ?>
