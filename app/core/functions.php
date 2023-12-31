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

function redirect($page)
{
    header('Location: ' . ROOT . '/' . $page);
    die;
}

function old_value($key, $default = '')
{
    if (!empty($_POST[$key]))
        return $_POST[$key];
    return $default;
}
function old_select($key, $value, $default = '', &$g)
{
    if ($g == 1) {
        if (!empty($_POST[$key]) && $_POST[$key] == $value) {
            $g = 0;
            return " selected ";
        }
        if ($default == $value) {
            $g = 0;
            return " selected ";
        }
    }
    return "";
}

function authenticate($user)
{
    $_SESSION['user'] = $user;
}

function logged_in()
{
    if (!empty($_SESSION['user']))
        return true;
    return false;
}

function is_admin()
{
    if (!empty($_SESSION['user']))
        {
            if($_SESSION['user']['role'] == 'admin'){
                return true;
            }
        }
    return false;
}

function slug_creater($str)
{
    $str = str_replace("'", "", $str);
    $str = preg_replace('~[^\\pL0-9_]+~u', '-', $str);
    $str = trim($str, '-');
    // $str = iconv("utf-8","us-ascii//TRANSLIT",$str);
    $str = strtolower($str);

    return $str;
}

// escape HTML injections
function esc($str)
{
    return htmlspecialchars($str ?? '');
}

function get_image($file, $placeholder = 'image_placeholder.svg')
{
    $file = $file ?? '';
    if (file_exists($file))
        return ROOT . '/' . $file;
    return ROOT . '/assets/img/' . $placeholder;

}

function get_pagination_vars()
{
    $page_number = $_GET['page'] ?? 1;
    $page_number = (empty($page_number) || $page_number < 1) ? 1 : (int) $page_number;
    $current_link = $_GET['url'] ?? 'home';
    $current_link = ROOT . '/' . $current_link;
    $query_string = '';

    foreach ($_GET as $key => $value) {
        if ($key != 'url')
            $query_string .= '&' . $key . '=' . $value;
    }
    if (!strstr($query_string, 'page='))
        $query_string .= '&page=' . $page_number;

    $query_string = trim($query_string, '&');
    $current_link .= '?' . $query_string;
    $prev_page_number = $page_number < 2 ? 1 : $page_number - 1;
    return [
        'current_link' => preg_replace('/page=.*/', 'page=' . ($page_number), $current_link),
        'first_link' => preg_replace('/page=.*/', 'page=1', $current_link),
        'next_link' => preg_replace('/page=.*/', 'page=' . ($page_number + 1), $current_link),
        'prev_link' => preg_replace('/page=.*/', 'page=' . ($prev_page_number), $current_link),
        'page_number' => $page_number,
    ];
}

function resize_image($filename, $max_size = 1000)
{
    if (file_exists($filename)) {
        $type = mime_content_type($filename);
        switch ($type) {
            case 'image/jpeg':
                $src_image = imagecreatefromjpeg($filename);
                break;
            case 'image/png':
                $src_image = imagecreatefrompng($filename);
                break;
            case 'image/webp':
                $src_image = imagecreatefromwebp($filename);
                break;
            default:
                return;
        }
        $src_width = imagesx($src_image);
        $src_height = imagesy($src_image);

        if ($src_width > $src_height) {
            if ($src_width < $max_size)
                $max_size = $src_width;
            $dst_width = $max_size;
            $dst_height = ($src_height / $src_width) * $max_size;
        } else {
            if ($src_height < $max_size)
                $max_size = $src_height;
            $dst_height = $max_size;
            $dst_width = ($src_width / $src_height) * $max_size;
        }
        $dst_height = round($dst_height);
        $dst_width = round($dst_width);

        $dst_image = imagecreatetruecolor($dst_width, $dst_height);
        imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
        imagejpeg($dst_image, $filename, 90);
    }
}

function p_arr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    echo '<br>';
}

function  remove_images_from_content($content, $folder = 'uploads/')
{

	preg_match_all("/<img[^>]+/", $content, $matches);

	if(is_array($matches[0]) && count($matches[0]) > 0)
	{
		foreach ($matches[0] as $img) {

			if(!strstr($img, "data:"))
			{
				continue;
			}

			preg_match('/src="[^"]+/', $img, $match);
			$parts = explode("base64,", $match[0]);

			preg_match('/data-filename="[^"]+/', $img, $file_match);

			$filename = $folder.str_replace('data-filename="', "", $file_match[0]);

			file_put_contents($filename, base64_decode($parts[1]));
			$content = str_replace($match[0], 'src="'.$filename, $content);
			

		}
	}
	return $content;
}


function add_root_to_images($content)
{

	preg_match_all("/<img[^>]+/", $content, $matches);

	if(is_array($matches[0]) && count($matches[0]) > 0)
	{
		foreach ($matches[0] as $img) {

			preg_match('/src="[^"]+/', $img, $match);
			$new_img = str_replace('src="', 'src="'.ROOT."/", $img);
			$content = str_replace($img, $new_img, $content);

		}
	}
	return $content;
}

function remove_root_from_content($content)
{
	
	$content = str_replace(ROOT, "", $content);

	return $content;
}

