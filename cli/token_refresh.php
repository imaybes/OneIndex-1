<?php
$config = include_once("./../config/base.php");
if (isset($_GET["secret"]) && $config["password"] == $_GET["secret"]) {
    file_get_contents($_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_ADDR"] . ":" . $_SERVER["SERVER_PORT"] . "/one.php?secret=" . $_GET["secret"] . "&cli=token_refresh");
} else {
    die("No secret OR secret error");
}