<html>
   
   <head>
    <title> CONNEXION </title>

   </head>
   
   
    <?php
    SESSION_start();
if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try  {
   $connection = new PDO($dsn, $username, $password, $options);
        echo $_POST['pseudo'];
        echo $_POST['pwd'];
   if(isset($_POST['formconnexion'])) {
   $pseudo = $_POST['pseudo'];
   $pwd = sha1($_POST['pwd']);
   if(!empty($login) AND !empty($password)) {
    $requser = $connection->prepare("SELECT * FROM employes WHERE pseudo = ? AND pwd = ?");
    $requser->execute(array($pseudo, $pwd));
    $userexist = $requser->rowCount();
    if($userexist == 1) {
       $userinfo = $requser->fetch();
       header("Location: index.php");
    } else {
       $erreur = "Mauvais login ou mot de passe !";
    } 
    }else {
        $erreur = "Tous les champs doivent être complétés !";
     }

}
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();


}

}


?>

    <body>

        <h2>Connexion</h2>
            <br /><br />
            <form method="POST" action="">
            <label for="pseudo">Login : </label>
            <input type="text"  name="pseudo" placeholder="Votre login" />
            <br /> <br />
            <label for="password">Mot de passe : </label>
            <input type="password"  name="pwd" placeholder="Votre mot de passe" />
            <br /><br />
            <input type="submit" name="formconnexion" value="Se connecter !" />
           <?php 
           if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
         
         </form>

    </body>


</html>