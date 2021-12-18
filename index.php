<?php
include './vendor/autoload.php';
$fileStore = new \src\FileStore('./file.csv');
foreach ($fileStore as $key => $string){
    print_r($string).PHP_EOL;
}
