<?php
// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "recensement_db";

$conn = new mysqli($host, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $matricule = htmlspecialchars($_POST["matricule"]);
    $email = htmlspecialchars($_POST["email"]);

    // Requête d'insertion
    $sql = "INSERT INTO etudiants (nom, prenom, matricule, email) VALUES ('$nom', '$prenom', '$matricule', '$email')";

    // Exécution de la requête
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-message'>Formulaire soumis avec succès !</p>";
    } else {
        echo "<p class='error-message'>Erreur lors de la soumission du formulaire : " . $conn->error . "</p>";
    }
}

// Fermeture de la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>

<style>
        /* Votre CSS pour le design du formulaire peut rester inchangé */

        .valid-input {
            border: 1px solid #4CAF50 !important;
        }

        .invalid-input {
            border: 1px solid #F44336 !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var matriculeInput = document.getElementById('matricule');

            matriculeInput.addEventListener('input', function() {
                if (matriculeInput.checkValidity()) {
                    matriculeInput.classList.remove('invalid-input');
                    matriculeInput.classList.add('valid-input');
                } else {
                    matriculeInput.classList.remove('valid-input');
                    matriculeInput.classList.add('invalid-input');
                }
            });
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Recensement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            color: #4caf50;
            margin-bottom: 15px;
        }

        .error-message {
            color: #f44336;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $matricule = htmlspecialchars($_POST["matricule"]);
    $email = htmlspecialchars($_POST["email"]);

    // Faire quelque chose avec les données, par exemple les afficher
    echo "<p>Formulaire soumis avec succès !</p>";
    echo "<p>Nom : $nom</p>";
    echo "<p>Prénom : $prenom</p>";
    echo "<p>Matricule AMCI : $matricule</p>";
    echo "<p>E-mail : $email</p>";
}
?>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<fieldset><legend>Formulaire de Recensement</legend>
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="matricule">Matricule AMCI :</label>
    <input type="text" id="matricule" name="matricule" pattern="[0-9]{8}" title="La matricule doit contenir 8 chiffres" required value="">

    <label for="email">E-mail :</label>
    <input type="email" id="email" name="email" required>

    <input type="submit" value="Soumettre">
    </fieldset>
</form>

<!-- Copyright -->
<footer>
    <p>&copy; 2024 UGESM Tous droits réservés.</p>
</footer>

</body>
</html>
