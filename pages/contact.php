<?php
$metaTitle = "Contact";
$metaDescription = "formulaire de contact";
require "header.php";
require "pdo.php";

$donnees = [];
$nettoyage = [];
$error = [];
$formulaire = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    foreach ($donnees as $key => $value) {
        $formulaire .= $key . " " . $value . "\r\n";
    }

    if (empty($error)) {
        /*   date_default_timezone_set("Europe/Paris");
           file_put_contents("formulaire/contact_" . date("Y-m-d-H-i-s") . ".txt", $formulaire);
       }
   */
        $sql = "INSERT INTO contact (subject, name, surname, phone, mail, message, contact) VALUES (:subject, :name, :surname, :phone, :mail, :message, :contact)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($donnees);
    }
}

?>
<div id="main">
    <div id="corps">
        <div class="formulaire">
            <form action="index.php?page=contact" method="post">
                <div id="hautcontact">
                    Me contacter
                </div>
                <div id="contactSelection">
                    <label for="subject-select">Que concerne votre demande ?</label>
                    <div class="select">
                        <select name="subject" id="subject-select" value="<?php echo $donnees["subject"]; ?>">
                            <option value="">--Choisissez une option--</option>
                            <option value="infographie" <?php if ($donnees["subject"] == "infographie") { ?>selected<?php }; ?>>Infographie</option>
                            <option value="installation" <?php if ($donnees["subject"] == "installation") { ?>selected<?php }; ?>>Installation artistique</option>
                            <option value="dev" <?php if ($donnees["subject"] == "dev") { ?>selected=<?php }; ?>>Développement</option>
                            <option value="escape" <?php if ($donnees["subject"] == "escape") { ?>selected<?php }; ?>>Escape Game</option>
                            <option value="jeu" <?php if ($donnees["subject"] == "jeu") { ?>selected<?php }; ?>>Jeu divers</option>
                        </select>
                    </div>
                </div>
                <div class="error"><?php echo $error["subjectErr"]; ?></div>

                <div class="champsTexte">
                    <div>
                        <label for="name">Nom :</label>

                        <input type="text" id="name" name="name" value="<?php echo $donnees["name"]; ?>">
                    </div>
                  <div class="error"><?php echo $error["nameErr"]; ?></div>
                    <div>
                        <label for="surname"> Prénom :</label>
                        <input type="text" id="name" name="surname" value="<?php echo $donnees["surname"]; ?>">
                    </div>
                    <div class="error"><?php echo $error["surnameErr"]; ?></div>
                    <div>
                        <label for="phone">Téléphone :</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $donnees["phone"]; ?>">
                    </div>
                    <div class="error"><?php echo $error["phoneErr"]; ?></div>
                    <div>
                        <label for="mail">e-mail&nbsp;:</label>
                        <input type="text" id="mail" name="mail" value="<?php echo $donnees["mail"]; ?>">
                    </div>
                    <div class="error"><?php echo $error["mailErr"]; ?></div>
                    <div>
                        <label for="msg">Message :</label>
                        <textarea id="msg" name="message"><?php echo $donnees["message"]; ?></textarea>
                    </div>
                    <div class="error"><?php echo $error["messageErr"]; ?></div>
                </div>
                <p>Veuillez choisir la meilleure méthode<br>pour vous contacter :</p>
                <div>
                    <input type="radio" id="contactChoice1" name="contact" value="email" <?php if ($donnees["contact"] == "email") { ?>checked<?php }; ?>>
                    <label for="contactChoice1">Email</label>
                    <input type="radio" id="contactChoice2" name="contact" value="telephone" <?php if ($donnees["contact"] == "telephone") { ?>checked<?php }; ?>>
                    <label for="contactChoice2">Téléphone</label>
                </div>
                <div class="error"><?php echo $error["contactErr"]; ?></div>
                <div class="button">
                    <button type="submit">Envoyer le message</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>


