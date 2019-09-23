
<?php

/**
 * Utilisez un formulaire HTML pour créer une nouvelle entrée 
 * dans la table des utilisateurs.
 *
 */


if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try  {
   
        $connection = new PDO($dsn, $username, $password, $options);

        
        $new_user = array(
            "prenom"    => $_POST['prenom'],
            "nom"       => $_POST['nom'],
            "email"     => $_POST['email'],
            "age"       => $_POST['age'],
            "ville"     => $_POST['ville'],
            "pseudo"     => $_POST['pseudo'],
            "pwd"     => sha1($_POST['pwd'])
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "employes",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
   
   
    }

}

?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['prenom']; ?> a été ajouté avec succès.</blockquote>
    <?php } ?>

    

<h2>Ajouter un employé</h2>

<form method="post">
    <label for="prenom">Prénom</label>
    <input type="text" placeholder="Votre prenom" name="prenom" id="prenom" required="required">
    
    <label for="nom">Nom</label>
    <input type="text" name="nom" placeholder="Votre nom" id="nom" required="required">
    
    <label for="email">Adresse mail</label>
    <input type="text" placeholder="Votre nom" name="email" id="email">
    
    <label for="age">Age</label>
    <input type="text" placeholder="Votre age" name="age" id="age">

    <label for="ville">ville de résidence</label>
    <input type="text" placeholder="Votre ville" name="ville" id="ville">

    <label for="pseudo">Pseudo</label>
    <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" >

    <label for="pwd">Mot de passe</label>
    <input type="password" placeholder="Votre mot de passe" name="pwd" id="pwd">
    <br><br>

    <input type="submit" name="submit" value="Ajouter">
    <br><br>
</form>

<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>
