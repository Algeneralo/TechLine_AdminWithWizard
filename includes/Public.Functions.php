<?php
/**
 * print variable in readable structure
 * @param $data
 */
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

/**
 * stander response of ajax request
 *
 * @param int $status
 * @param string $message
 * @param array $data
 * @param array $error
 * @return string
 */
function ajaxResponse($status = 200, $message = "", $data = [], $error = [])
{
    $data = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
        'error' => $error
    ];
    return json_encode($data);
}

/**
 *this is the main function that do everything
 */
function __load()
{
    if (!isset($_GET['page'])) {
        include("pages/home.php");
    } else {
        $page = "pages/" . $_GET['page'] . ".php";
        if (file_exists($page)) {
            include($page);
        } else {
            //include('pages/404.php');
            echo "error";
        }
    }

}

function compress_image($src, $dest, $quality)
{
    //$upload_dir = $dest;
    $info = getimagesize($src);
    if ($info['mime'] == 'image/jpeg' or $info['mime'] == 'image/JPEG') {
        $image = imagecreatefromjpeg($src);
    } elseif ($info['mime'] == 'image/gif' or $info['mime'] == 'image/JIF') {
        $image = imagecreatefromgif($src);
    } elseif ($info['mime'] == 'image/png' or $info['mime'] == 'image/PNG') {
        $image = imagecreatefrompng($src);
    } elseif ($info['mime'] == 'image/jpg' or $info['mime'] == 'image/JPG') {
        $image = imagecreatefromjpeg($src);
    } else {
        die('Unknown image file format');
    }
    imagejpeg($image, $dest, $quality);
}

function GoToURL($site)
{
    echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=$site\">\n";
}

function __load_wizard()
{
    //this is for wizard using only
    require_once "wizard/Controller.php";
}

function refresh()
{
    echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0\">";
}

/**
 * this function is for upload an images
 *
 * @param bool $compress : to compress or not the image
 * @param string $folderPath :specify the target folder for upload image
 * @param string $filesName : input file name,default is image
 * @return array :array for images names
 */
function uploadImages($compress = true, $folderPath = "files/media/", $filesName = 'image')
{
    $images = [];
    if (is_array($_FILES)) {
        foreach ($_FILES[$filesName]['name'] as $name => $value) {
            $file_name = explode(".", $_FILES[$filesName]['name'][$name]);
            $ext = end($file_name);

            $allowed_ext = array("jpg", "jpeg", "png", "gif", "GPJ", "JPEG", "PNG", "GIF");
            if (in_array($ext, $allowed_ext)) {
                $new_name = substr(rand() . uniqid(), 0, 16) . '.' . $ext;
                $sourcePath = $_FILES[$filesName]['tmp_name'][$name];
                $targetPath = $folderPath . $new_name;
                $compressPath = $folderPath . 'compress/' . $new_name;

                if (move_uploaded_file($sourcePath, $targetPath)) {
                    if ($compress)
                        compress_image($targetPath, $compressPath, 50);
                    $parameter = [
                        'title' => $_GET['title'] ?? '',
                        'user_id' => $_SESSION['User_ID'],
                        'image' => $new_name,
                        'active' => 1,
                        'date' => date('Y-m-d H:i:s'),
                    ];
                    db::insert('media', $parameter);
                    $images[] = $new_name;
                }
            }
        }
        return $images;
    } else {
        echo 'Error';
    }
    return "Please choose Image";
}