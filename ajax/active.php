<?php
require_once "../classes/db.class.php";

if (isset($_POST['table'])) {
    $active = $_POST['status'] == 0 ? 1 : 0;
    $parameter = ['active' => $active];
    $msg = db::update($_POST['table'], $parameter, $_POST["id"]);
    if ($msg != 0 or !empty($msg)) {
        echo json_encode($active);
    }
}

