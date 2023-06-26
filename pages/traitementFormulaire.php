<?php

require "pdo.php";

$donnees = [];
$nettoyage = [];
$error = [];
$formulaire = "";


$nettoyage = [
    "subject" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "name" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "surname" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "phone" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "mail" => FILTER_VALIDATE_EMAIL,
    "message" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "contact" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
];

$donnees = filter_input_array(INPUT_POST, $nettoyage);

foreach ($donnees as $key => $value) {
    if (empty($value)) {
        $error[$key . "Err"] = "Veuillez renseigner le champ ci-dessus";
    }
}

if (!empty($_POST["mail"]) && !$donnees["mail"]) {
    $error["mailErr"] = "Veuillez renseigner une adresse email valide";
}

if (!empty($donnees["message"] && strlen($donnees["message"]) < 5)) {
    $error["messageErr"] = "Veuillez écrire un message d'une longueur de 5 caractères mininums.";
}

if (empty($error)) {
    date_default_timezone_set("Europe/Paris");
    $donnees["date"] = date("Y-m-d H:i:s");
    $sql = "INSERT INTO contact (date, subject, name, surname, phone, mail, message, contact) VALUES (:date, :subject, :name, :surname, :phone, :mail, :message, :contact)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($donnees);
}

$_SESSION['error'] = $error;
$_SESSION['donnees'] = $donnees;

header("Location: ?page=contact");