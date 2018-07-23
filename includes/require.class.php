<?php
//get all files in classes to require it
$files = scandir('classes', '0');
//remove . and .. from an array
unset($files[0], $files[1]);
//require all files in classes directory
foreach ($files as $file)
    require_once("classes/{$file}");
require_once('includes/Public.Functions.php');
require_once("global/validation/vendor/autoload.php");

?>
