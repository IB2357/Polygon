<?php
    if(!logged_in())
        redirect('login');

    $section = $url[1] ?? 'home';
    $action = $url[2] ?? 'view';
    $id = $url[3] ?? 0;
    $file_name = "../app/pages/dashboard/".$section.".php";

    if(file_exists($file_name)){
        require_once $file_name;
        if(!$action || $action == "view")
            include_once "dashboard/sidebar.php";
    }
    else{
        require_once "../app/pages/dashboard/404.php";
    }
?>