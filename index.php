<?php

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);

$route = [
    "" => "pages/cv.php",
    "cv" => "pages/cv.php",
    "hobby" => "pages/hobby.php",
    "contact" => "pages/contact.php",
];

$render="";

if (!empty($route[$page])) {
    $render += include "$route[$page]";
} else {
    $render += include "pages/404.php";
}

echo "$render";
