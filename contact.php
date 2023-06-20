<?php
    $metaTitle = "Contact";
    $metaDescription = "formulaire de contact";
    require 'header.php';
?>
        <div id="main">
            <div id="corps">
                <div class="formulaire">
                    <form action=" https://httpbin.org/post" method="post">
                        <div id="hautcontact">
                            Me contacter
                        </div>
                        <div id="contactSelection">
                            <label for="subject-select">Que concerne votre demande ?</label>
                            <div class="select">
                                <select name="subject" id="subject-select">
                                    <option value="">--Choisissez une option--</option>
                                    <option value="infographie">Infographie</option>
                                    <option value="installation">Installation artistique</option>
                                    <option value="dev">Développement</option>
                                    <option value="escape">Escape Game</option>
                                    <option value="jeu">Jeu divers</option>
                                </select>
                            </div>
                        </div>
                        <div class="champsTexte">
                            <div>
                                <label for="name" >Nom :</label>
                                <input type="text" id="name" name="user_name">
                            </div>
                            <div>
                                <label for="surname" >Prénom :</label>
                                <input type="text" id="name" name="user_surname">
                            </div>
                            <div>
                                <label for="phone" >Téléphone :</label>
                                <input type="text" id="phone" name="user_phone">
                            </div>
                            <div>
                                <label for="mail">e-mail&nbsp;:</label>
                                <input type="email" id="mail" name="user_mail">
                            </div>
                            <div>
                                <label for="msg">Message :</label>
                                <textarea id="msg" name="user_message"></textarea>
                            </div>
                        </div>
                        <p>Veuillez choisir la meilleure méthode<br>pour vous contacter :</p>
                        <div>
                            <input type="radio" id="contactChoice1" name="contact" value="email">
                            <label for="contactChoice1">Email</label>
                            <input type="radio" id="contactChoice2" name="contact" value="telephone">
                            <label for="contactChoice2">Téléphone</label>
                        </div>
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