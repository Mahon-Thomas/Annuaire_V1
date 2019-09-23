<?php

/**
 * Fonction pour interroger les informations en fonction du
 * paramètre: ville
 *
 */

if (isset($_POST['submit'])) {
    try  {
        
        require "../config.php";
        require "../common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * 
                FROM employes WHERE ville = '$_POST[ville]'";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':ville', $ville, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
        <h2>Liste des employés</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Adresse mail</th>
                    <th>Age</th>
                    <th>ville</th>
                    <th>Login</th>
                    <th>Mot de Passe</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["prenom"]); ?></td>
                <td><?php echo escape($row["nom"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["age"]); ?></td>
                <td><?php echo escape($row["ville"]); ?></td>
                <td><?php echo escape($row["pseudo"]); ?> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>Aucun résultat trouvé pour <?php echo escape($_POST['ville']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Liste des employés</h2>

<form method="post">
    <label for="ville">ville</label>
    <input type="text" id="ville" name="ville">
    <input type="submit" name="submit" value="Voir les résultats">
</form>

<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>
