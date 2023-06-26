<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);

$route = [
    "" => "pages/cv.php",
    "cv" => "pages/cv.php",
    "hobby" => "pages/hobby.php",
    "contact" => "pages/contact.php",
    "formulaire" => "pages/traitementFormulaire.php"
];

$render="";

ob_start();

if (!empty($route[$page])) {
    include $route[$page];
} else {
    include "pages/404.php";
}

$render = ob_get_clean();

echo "$render";
