<?php

if ($_GET['page'] == 'cv') {
    include 'pages/cv.php';
}
else if ($_GET['page'] == 'hobby') {
    include 'pages/hobby.php';
}
else if ($_GET['page'] == 'contact') {
    include 'pages/contact.php';
}
else  if ($_GET['page'] == '') {
    include 'pages/cv.php';
}
else {
    include 'pages/404.php';
}