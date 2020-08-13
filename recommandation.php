<?php 

    //me connecte à la base de donnée 
    //crée notre variable $pdo 
    include("db.php");

    //ma requête sql pour récupérer les commentaires
    $sql = "SELECT * 
            FROM recommandations
            order by date_message desc";

    //envoie ma requête SQL au serveur MySQL
    $stmt = $pdo->prepare($sql);


    //demande à MySQL d'exécuter ma requête 
    $stmt->execute();


    //récupère les recommandation depuis le serveur MySQL
    $recommandations = $stmt->fetchAll();

    //pour débugger,
    //var_dump($message);

    //si on a des données dans $_POST, 
    //c'est que le form a été soumis
    if(!empty($_POST)){
        //par défaut, on dit que le formulaire est entièrement valide
        //si on trouve ne serait-ce qu'une seule erreur, on 
        //passera cette variable à false
        $formIsValid = true;

        //on fait un strip_tags sur tous les champs
        //pour virer les balises HTML strip_tags(attaques XSS)
        //on laisse le password tranquille par contre
        $email = strip_tags($_POST['email']);
        $lastname = strip_tags($_POST['lastname']);
        $firstname = strip_tags($_POST['firstname']);
        $enterprise = strip_tags($_POST['enterprise']);
        $message = strip_tags($_POST['message']);

        //tableau qui stocke nos éventuels messages d'erreur
        $errors = [];

        //si le lastname est vide...
        if(empty($lastname) ){
            //on note qu'on a trouvé une erreur ! 
            $formIsValid = false;
            $errors[] = "Veuillez renseigner votre nom de famille !";
        }
        //mb_strlen calcule la longueur d'une chaîne
        elseif(mb_strlen($lastname) <= 1){
            $formIsValid = false;
            $errors[] = "Votre nom de famille est court, très court. Veuillez le rallonger !";
        }
        elseif(mb_strlen($lastname) > 30){
            $formIsValid = false;
            $errors[] = "Votre nom de famille est trop long !";
        }

        //exactement pareil pour le prénom
        //si le firstname est vide...
        if(empty($firstname) ){
            //on note qu'on a trouvé une erreur ! 
            $formIsValid = false;
            $errors[] = "Veuillez renseigner votre prénom !";
        }
        //mb_strlen calcule la longueur d'une chaîne
        elseif(mb_strlen($firstname) <= 1){
            $formIsValid = false;
            $errors[] = "Votre prénom est court, très court. Veuillez le rallonger !";
        }
        elseif(mb_strlen($firstname) > 30){
            $formIsValid = false;
            $errors[] = "Votre prénom est trop long !";
        }

        //validation de l'email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $formIsValid = false;
            $errors[] = "Votre email n'est pas valide !";
        }

//si le formulaire est toujours valide... 
if ($formIsValid == true){
    //on écrit tout d'abord notre requête SQL, dans une variable
    $sql = "INSERT INTO recommandations
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
  <link rel="stylesheet" href="css/stylerecommandation.css">
  <link rel="stylesheet" href="css/menu.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/testcarousel.css">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script type="text/javascript" src="testcarousel.js"></script>
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
                    <li><a href="index.php">Home</a></li>
				            <li><a href="index.php#section_1">About Me</a></li>
				            <li><a href="index.php#section_2">Formation</a></li>
                    <li><a href="index.php#section_3">Projets</a></li>
				            <li><a href="./css/icones/cv.pdf" target="_blank">CV</a></li>
                    <li><a href="index.php#section_5">Contact</a></li>
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
    <div class="recommandation_affichage">
      <div class="recommandation">
        <h1>RECOMMANDATION</h1>

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

          <div class="g-recaptcha" data-sitekey="6LdL59kUAAAAAOhuPv7BDxKMPPkIOxLbBZZhcCiC"></div><br />


          <?php 
          //affiche les éventuelles erreurs de validations
          if (!empty($errors)) {
              foreach ($errors as $error) {
                echo '<div>' . $error . '</div>'    ;
              }
          }   
          ?>

          <button>Envoyer !</button>
        </form>
      </div>

      <div class="carouseul">
        <?php 
              include("testcarousel.php");
        ?>
      </div>
    </div>
  </main>

  <footer>
    <div class="mentions_legales"> © Kévin Charneau 2020 <a href="mentionslegales.php"> Mentions légales</a>
    </div>
  </footer>
</body>
</html>