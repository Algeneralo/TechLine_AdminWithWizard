<?php session_start();

require_once("../classes/db.class.php");
require_once("../includes/Public.Functions.php");
$images = uploadImages(true, '../files/media/');
foreach ($images as $image) {
    echo '<img src="files/media/' . $image . '" />';
}
//$output = '';
//
//if (is_array($_FILES)) {
//    $title = $_GET['title'];
//    $user = $_SESSION['User_ID'];
//    $path = "../files/media/compress/";
//    foreach ($_FILES['image']['name'] as $name => $value) {
//
//        $file_name = explode(".", $_FILES['image']['name'][$name]);
//        $ext = end($file_name);
//
//        $allowed_ext = array("jpg", "jpeg", "png", "gif", "GPJ", "JPEG", "PNG", "GIF");
//        if (in_array($ext, $allowed_ext)) {
//            $new_name = substr(rand() . uniqid(), 0, 16) . '.' . $ext;
//            $sourcePath = $_FILES['image']['tmp_name'][$name];
//            $targetPath = "../files/media/" . $new_name;
//
//            if (move_uploaded_file($sourcePath, $targetPath)) {
//                compress_image($targetPath, $path . $new_name, 50);
//                $parameter = [
//                    'title' => $title ?? '',
//                    'user_id' => $_SESSION['User_ID'],
//                    'image' => $new_name,
//                    'active' => 1,
//                    'date' => date('Y-m-d H:i:s'),
//                ];
//                db::insert('media', $parameter);
//                $output .= '<img src="files/media/' . $new_name . '" />';
//            }
//        }
//    }
//    echo $output;
//} else {
//    echo 'Error';
//}
?>
