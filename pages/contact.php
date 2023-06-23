<?php
$metaTitle = "Contact";
$metaDescription = "formulaire de contact";
require 'header.php';


date_default_timezone_set('Europe/Berlin');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donnees = [];
    $error = [];

    if (empty($_POST["user_name"])) {
        $error["nameErr"] = "Veuillez renseigner votre nom";
    } else {
        $donnees['name'] = filter_input(INPUT_POST, 'user_name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST["user_surname"])) {
        $error["surnameErr"] = "Veuillez renseigner votre prénom";
    } else {
        $donnees['surname'] = filter_input(INPUT_POST, 'user_surname',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST["user_phone"])) {
        $error["phoneErr"] = "Veuillez renseigner votre numéro";
    } else {
        $donnees['phone'] = filter_input(INPUT_POST, 'user_phone',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST["user_mail"])) {
        $error["emailErr"] = "Veuillez renseigner votre email";
    } else {
        $donnees['email'] = filter_input(INPUT_POST, 'user_mail', FILTER_VALIDATE_EMAIL);
        if (empty($donnees['email'])) {
            $error["emailErr"] = "Veuillez renseigner une adresse email valide";
        }
    }
    if (empty($_POST["subject"])) {
        $error["subjectErr"] = "Veuillez choisir un élément";
    } else {
        $donnees['subject'] = filter_input(INPUT_POST, 'subject',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($_POST["user_message"])) {
        $error["user_messageErr"] = "Veuillez renseigner votre message";
    } else {
        $donnees['message'] = filter_input(INPUT_POST, 'user_message',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (strlen($donnees['message'])<5) {
            $error["user_messageErr"] = "Veuillez écrire un message plus long";
        }
    }
    if (empty($_POST["contact"])) {
        $error["contactErr"] = "Veuillez choisir une des options";
    } else {
        $donnees['contact'] = filter_input(INPUT_POST, 'contact',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }


    foreach($donnees as $key => $value) {
        $formulaire .= $key." ".$value."\r\n";
    }

  #  $formulaire = 'name ' . $name . "\r\n" . 'surname ' . $surname . "\r\n" . 'phone ' . $phone . "\r\n" . 'email ' . $email . "\r\n" . 'subject ' . $subject . "\r\n" . 'message ' . $message . "\r\n" . 'contact ' . $contact;

    if (empty($error)) {
        file_put_contents('formulaire/contact_' . date('Y-m-d-H-i-s') . '.txt', $formulaire);
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
                        <select name="subject" id="subject-select" value="<?php echo $donnees['subject']; ?>">
                            <option value="">--Choisissez une option--</option>
                            <option value="infographie" <?php if ($donnees['subject'] == 'infographie') { ?>selected<?php }; ?>>Infographie</option>
                            <option value="installation" <?php if ($donnees['subject'] == 'installation') { ?>selected<?php }; ?>>Installation artistique</option>
                            <option value="dev" <?php if ($donnees['subject'] == 'dev') { ?>selected=<?php }; ?>>Développement</option>
                            <option value="escape" <?php if ($donnees['subject'] == 'escape') { ?>selected<?php }; ?>>Escape Game</option>
                            <option value="jeu" <?php if ($donnees['subject'] == 'jeu') { ?>selected<?php }; ?>>Jeu divers</option>
                        </select>
                    </div>
                </div>
                <div class="error"><?php echo $error["subjectErr"]; ?></div>

                <div class="champsTexte">
                    <div>
                        <label for="name">Nom :</label>

                        <input type="text" id="name" name="user_name" value="<?php echo $donnees['name']; ?>">
                    </div>
                  <div class="error"><?php echo $error["nameErr"]; ?></div>
                    <div>
                        <label for="surname"> Prénom :</label>
                        <input type="text" id="name" name="user_surname" value="<?php echo $donnees['surname']; ?>">
                    </div>
                    <div class="error"><?php echo $error["surnameErr"]; ?></div>
                    <div>
                        <label for="phone">Téléphone :</label>
                        <input type="text" id="phone" name="user_phone" value="<?php echo $donnees['phone']; ?>">
                    </div>
                    <div class="error"><?php echo $error["phoneErr"]; ?></div>
                    <div>
                        <label for="mail">e-mail&nbsp;:</label>
                        <input type="text" id="mail" name="user_mail" value="<?php echo $donnees['email']; ?>">
                    </div>
                    <div class="error"><?php echo $error["emailErr"]; ?></div>
                    <div>
                        <label for="msg">Message :</label>
                        <textarea id="msg" name="user_message"><?php echo $donnees['message']; ?></textarea>
                    </div>
                    <div class="error"><?php echo $error["user_messageErr"]; ?></div>
                </div>
                <p>Veuillez choisir la meilleure méthode<br>pour vous contacter :</p>
                <div>
                    <input type="radio" id="contactChoice1" name="contact" value="email" <?php if ($donnees['contact'] == 'email') { ?>checked<?php }; ?>>
                    <label for="contactChoice1">Email</label>
                    <input type="radio" id="contactChoice2" name="contact" value="telephone" <?php if ($donnees['contact'] == 'telephone') { ?>checked<?php }; ?>>
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
include 'footer.php';
?>


