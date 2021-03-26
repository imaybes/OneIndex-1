<?php
$config = include_once("./../config/base.php");
if (isset($_GET["secret"]) && $config["password"] == $_GET["secret"]) {
    $result = file_get_contents($_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_ADDR"] . ":" . $_SERVER["SERVER_PORT"] . "/one.php?secret=" . $_GET["secret"] . "&cmd=upload_file&from=" . $_GET["from"] . "&to=" . $_GET["to"]);
    print $result;
} else {
    die("No secret OR secret error");
}