<?php
$metaTitle = "Contact";
$metaDescription = "formulaire de contact";
require "header.php";

$donnees = [];
$error = [];
if (isset($_SESSION['error']) || isset($_SESSION['donnees'])) {
    $error=$_SESSION['error'];
    $donnees=$_SESSION['donnees'];
    unset($_SESSION['error']);
    unset($_SESSION['donnees']);
}

    ?>
<div id="main">
    <div id="corps">
        <div class="formulaire">
            <form action="index.php?page=formulaire" method="post">
                <div id="hautcontact">
                    Me contacter
                </div>
                <div id="contactSelection">
                    <label for="subject-select">Que concerne votre demande ?</label>
                    <div class="select">
                        <select name="subject" id="subject-select" value="<?= $donnees["subject"]??'' ?>">
                            <option value="">--Choisissez une option--</option>
                            <option value="infographie" <?php if (isset($donnees["subject"]) && $donnees["subject"] == "infographie") { ?>selected<?php } ?>>Infographie</option>
                            <option value="installation" <?php if (isset($donnees["subject"]) && $donnees["subject"] == "installation") { ?>selected<?php } ?>>Installation artistique</option>
                            <option value="dev" <?php if (isset($donnees["subject"]) && $donnees["subject"] == "dev") { ?>selected=<?php } ?>>Développement</option>
                            <option value="escape" <?php if (isset($donnees["subject"]) && $donnees["subject"] == "escape") { ?>selected<?php } ?>>Escape Game</option>
                            <option value="jeu" <?php if (isset($donnees["subject"]) && $donnees["subject"] == "jeu") { ?>selected<?php } ?>>Jeu divers</option>
                        </select>
                    </div>
                </div>
                <div class="error"><?= $error["subjectErr"]??'' ?></div>

                <div class="champsTexte">
                    <div>
                        <label for="name">Nom :</label>

                        <input type="text" id="name" name="name" value="<?= $donnees["name"]??'' ?>">
                    </div>
                  <div class="error"><?= $error["nameErr"]??'' ?></div>
                    <div>
                        <label for="surname"> Prénom :</label>
                        <input type="text" id="name" name="surname" value="<?= $donnees["surname"]??'' ?>">
                    </div>
                    <div class="error"><?php if (isset($error["surnameErr"])) { echo $error["surnameErr"]; } ?></div>
                    <div>
                        <label for="phone">Téléphone :</label>
                        <input type="text" id="phone" name="phone" value="<?= $donnees["phone"]??'' ?>">
                    </div>
                    <div class="error"><?php if (isset($error["phoneErr"])) { echo $error["phoneErr"]; } ?></div>
                    <div>
                        <label for="mail">e-mail&nbsp;:</label>
                        <input type="text" id="mail" name="mail" value="<?= $donnees["mail"]??'' ?>">
                    </div>
                    <div class="error"><?= $error["mailErr"]??'' ?></div>
                    <div>
                        <label for="msg">Message :</label>
                        <textarea id="msg" name="message"><?= $donnees["message"]??'' ?></textarea>
                    </div>
                    <div class="error"><?= $error["messageErr"]??'' ?></div>
                </div>
                <p>Veuillez choisir la meilleure méthode<br>pour vous contacter :</p>
                <div>
                    <input type="radio" id="contactChoice1" name="contact" value="email" <?php if (isset($donnees["contact"]) && $donnees["contact"] == "email") { ?>checked<?php } ?>>
                    <label for="contactChoice1">Email</label>
                    <input type="radio" id="contactChoice2" name="contact" value="telephone" <?php if (isset($donnees["contact"]) && $donnees["contact"] == "telephone") { ?>checked<?php } ?>>
                    <label for="contactChoice2">Téléphone</label>
                </div>
                <div class="error"><?= $error["contactErr"]??'' ?></div>
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