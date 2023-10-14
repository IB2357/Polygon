<?php

function query(string $query, array $data = [])
{
    $dsn = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
    $con = new PDO($dsn, DBUSER, DBPASS);
    
    $stm = $con->prepare($query);
    $stm->execute($data);
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) and !empty($result)) {
        return $result;
    } 
    return false;
}

function redirect($page){
    header('Location: '.$page);
    die;
}

function old_value($key, $default = ''){
    if(!empty($_POST[$key]))
        return $_POST[$key];
    return $default;
}

function authenticate($user){
    $_SESSION['user']=$user;
}

function logged_in(){
    if(!empty($_SESSION['user']))
        return true;
    return false;
}

function slug_creater($str){
    $str = str_replace("'","",$str);
    $str = preg_replace('~[^\\pL0-9_]+~u','-',$str);
    $str = trim($str,'-');
    // $str = iconv("utf-8","us-ascii//TRANSLIT",$str);
    $str = strtolower($str);

    return $str;
}

// escape HTML injections
function esc($str){
    return htmlspecialchars($str ?? '');
}

function get_image($file,$placeholder = 'image_placeholder.svg'){
    $file = $file ?? '';
    if(file_exists($file))
        return ROOT.'/'.$file;
    return ROOT.'/assets/img/'.$placeholder ;

}