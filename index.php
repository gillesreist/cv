<?php

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_URL);

if ($page == 'cv') {
    include 'pages/cv.php';
}
else if ($page == 'hobby') {
    include 'pages/hobby.php';
}

else if ($page == 'contact') {

    include 'pages/contact.php';
}
else  if ($page== '') {
    include 'pages/cv.php';
}
else {
    include 'pages/404.php';
}
