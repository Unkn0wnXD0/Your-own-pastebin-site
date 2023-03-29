<?php
require "./include/autoload.php";

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: " . getLink("/"));
    exit;
}

$paste = getPaste($_GET['id']);

if(!$paste){
    header("Location: " . getLink("/"));
    exit;
}

$paste['paste_syntax'] == "json" ? header("Content-Type: application/json") : header("Content-Type: text/plain");

echo $paste['paste_content'];

?>