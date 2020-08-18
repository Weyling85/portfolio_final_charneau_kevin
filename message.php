<?php 

    //Je me connecte à la base de donnée, je crée notre variable $pdo 
    include("db.php");

    //si on a des données dans $_POST, c'est que le form a été soumis
    if(!empty($_POST)){
        //par défaut, on dit que le formulaire est entièrement valide, si on trouve ne serait-ce qu'une seule erreur, on passera cette variable à false
        $formIsValid = true;

        //on fait un strip_tags sur tous les champs pour virer les balises HTML strip_tags(attaques XSS), on laisse le password tranquille par contre
        $email = strip_tags($_POST['email']);
        $lastname = strip_tags($_POST['lastname']);
        $firstname = strip_tags($_POST['firstname']);
        $enterprise = strip_tags($_POST['enterprise']);
        $message = strip_tags($_POST['message']);

        //Tableau qui stocke nos éventuels messages d'erreurs
        $errors = [];

        //Si le lastname est vide...
        if(empty($lastname) ){
            //On note qu'on a trouvé une erreur
            $formIsValid = false;
            $errors[] = "Veuillez entrer un nom valide";
        }
        //mb_strlen calcule la longueur d'une chaîne
        elseif(mb_strlen($lastname) <= 1){
            $formIsValid = false;
            $errors[] = "Veuillez entrer un nom valide";
        }
        elseif(mb_strlen($lastname) > 30){
            $formIsValid = false;
            $errors[] = "Veuillez entrer un nom valide";
        }

        //Exactement pareil pour le prénom
        //Si le firstname est vide...
        if(empty($firstname) ){
            //On note qu'on a trouvé une erreur
            $formIsValid = false;
            $errors[] = "Veuillez entrer un prénom valide";
        }
        
        //mb_strlen calcule la longueur d'une chaîne
        elseif(mb_strlen($firstname) <= 1){
            $formIsValid = false;
            $errors[] = "Veuillez entrer un prénom valide";
        }
        elseif(mb_strlen($firstname) > 30){
            $formIsValid = false;
            $errors[] = "Veuillez entrer un prénom valide";
        }

        //validation de l'email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $formIsValid = false;
            $errors[] = "Votre email n'est pas valide !";
        }

    //si le formulaire est toujours valide... 
    if ($formIsValid == true){
    //on écrit tout d'abord notre requête SQL, dans une variable
    $sql = "INSERT INTO user_message
            (first_name, last_name, email, enterprise, message, date_message)
            VALUES 
            (:first_name, :last_name, :email, :enterprise, :message, NOW())";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":first_name" => $firstname,
        ":last_name" => $lastname, 
        ":email" => $email,
        ":enterprise" => $enterprise, 
        ":message" => $message,
    ]);

}
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>kcharneau.com</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="css/stylemessage.css">
  <link rel="stylesheet" href="css/menu.css">
</head>

<body>
  <header>
    <nav>
      <div class="menu-wrap">
        <input type="checkbox" class="toggler">
          <div class="hamburger"><div></div></div>
            <div class="menu">
              <div>
                <div>
                  <ul>
                    <li><a href="index.html">Home</a></li>
				            <li><a href="index.html#section_1">About Me</a></li>
				            <li><a href="index.html#section_2">Formation</a></li>
                    <li><a href="index.html#section_3">Projets</a></li>
				            <li><a href="./css/icones/cv.pdf" target="_blank">CV</a></li>
                    <li><a href="index.html#section_5">Contact</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </input>
      </div>
    </nav>
  </header>

  <main>
    <div class="contact">
      <h1>MESSAGE</h1>

      <!-- seuls les formulaires de recherche doivent être en get -->
      <form method="post">
        <div class="nom_prenom">
          <div class="last_name"> 
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname">
          </div>
          <div class="first_name"> 
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname">
          </div>
        </div>
        <div class="email_enterprise">
          <div class="email"> 
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
          </div>
          <div class="enterprise"> 
            <label for="enterprise">Nom de l'entreprise</label>
            <input type="text" name="enterprise" id="enterprise">
          </div>
        </div>
        <div class="message"> 
            <label for="message">Message</label>
            <textarea type="message" name="message" id="message"></textarea>
        </div>

        <div class="form-group">
          <div class="form-check">
            <input class="form" type="checkbox" value="" required>
            <label class="form-check-label" for="invalidCheck3"> J'ai lu et j'accepte les termes et conditions des <a href="./mentionslegales.html" class="mentions_input"> Mentions légales</a>.</label>
          </div>
        </div>

        <div class="g-recaptcha" data-sitekey="6LdL59kUAAAAAOhuPv7BDxKMPPkIOxLbBZZhcCiC"></div>


        <?php 
        //affiche les éventuelles erreurs de validations
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="erreurs">' . $error . '</div>'    ;
            }
        }   
        ?>

        <button class="button">Envoyer !</button>
      </form>
    </div>
  </main>

  <footer>
    <div class="mentions_legales"> © Kévin Charneau 2020 <a href="mentionslegales.html"> Mentions légales</a>
    </div>
  </footer>
</body>
</html>