<?php
require_once "../classes/db.class.php";
if (isset($_POST['table']) and isset($_POST['id'])) {
    $msg = db::delete($_POST['table'], $_POST['id']);
    echo $msg;
   

}