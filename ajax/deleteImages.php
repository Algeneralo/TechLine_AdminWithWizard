<?php
require_once "../classes/db.class.php";

foreach ($_POST['images'] as $image) {
    db::getConnection()->exec('Delete from media where id=' . $image[0]);
    unlink('../files/media/' . $image[1]);
    unlink('../files/media/compress/' . $image[1]);
}
return 0;