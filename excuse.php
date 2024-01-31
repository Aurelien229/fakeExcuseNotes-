<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fake excuse</title>
</head>
<body>
    <h1>Save your ass...</h1>
    <h2>Libérez-vous en toute légèreté,<br> votre absence sans l'ombre d'un souci!</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nomEnfant">Nom de l'enfant :</label>
        <input type="text" id="nomEnfant" name="nomEnfant" required><br>

        <label>Sexe de l'enfant :</label>
        <input type="radio" id="fille" name="sexeEnfant" value="fille" required>
        <label for="fille">Fille</label>
        <input type="radio" id="garcon" name="sexeEnfant" value="garcon" required>
        <label for="garcon">Garçon</label><br>

        <label for="nomEnseignant">Nom de l'enseignant :</label>
        <input type="text" id="nomEnseignant" name="nomEnseignant" required><br>

        <label for="dateAbsence">Date de l'absence :</label>
        <input type="date" id="dateAbsence" name="dateAbsence" required><br>

        <label>Raison de l'absence :</label><br>
        <input type="radio" id="maladie" name="raisonAbsence" value="maladie" required>
        <label for="maladie">Maladie</label><br>

        <input type="radio" id="animal" name="raisonAbsence" value="animal" required>
        <label for="animal">Animal de compagnie</label><br>

        <input type="radio" id="activiteExtra" name="raisonAbsence" value="activiteExtra" required>
        <label for="activiteExtra">Activité extra-scolaire</label><br>

        <input type="radio" id="autreExcuse" name="raisonAbsence" value="autreExcuse" required>
        <label for="autreExcuse">Excuse aléatoire</label><br>

        <button type="submit">Soumettre</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomEnfant = htmlspecialchars($_POST['nomEnfant']);
    $sexeEnfant = htmlspecialchars($_POST['sexeEnfant']);
    $nomEnseignant = htmlspecialchars($_POST['nomEnseignant']);
    $dateAbsence = htmlspecialchars($_POST['dateAbsence']);
    $raisonAbsence = htmlspecialchars($_POST['raisonAbsence']);

    $messages = [
        'maladie' => [
            "Je crains que mon petit trésor ne puisse pas sortir aujourd'hui, il est malade avec ce qu'ils appellent la 'fièvre licorne'.<br>
             Il semble que son imagination débordante ait pris le dessus, et il est convaincu que des cornes poussent sur sa tête.",
            "Il est en quelque sorte atteint de la 'grippe de l'espace' après ses aventures intergalactiques.<br>
             Vous savez comment les voyages dans l'espace peuvent être épuisants pour les tout-petits.",
            "Mon amour a développé une allergie aux gravités normales de la Terre.<br>
             Donc, selon les conseils du médecin, il doit rester allongé horizontalement pour que son petit corps puisse s'adapter en douceur.",
            "C'est avec un cœur lourd que je dois vous dire que mon enfant souffre d'une 'infection de pixels'.<br>
              Les médecins pensent que c'est peut-être lié à une surexposition aux écrans.<br>
              Il doit prendre du repos loin de toute technologie pour éviter une transformation complète."
        ],
        'animal' => [
            "Notre chat organise une manifestation contre la surconsommation de thon en conserve et a besoin de soutien émotionnel.",
            "Notre chouette prévoit une évasion de sa cage pour rejoidre Poudlard.",
            "mon enfant a attrapé la 'fièvre des pingouins' après un documentaire sur l'Antarctique.<br>
             Le médecin recommande de rester à la maison par temps chaud.",
            "Notre chien veut apprendre à voler, et il est déterminé à l'aider.",
            "Notre poisson rouge l'a invité à un concours de plongeon synchronisé dans son bocal, et il ne veut pas le décevoir."
        ],
        'activiteExtra' => [
            "Il participe à la Champions League de jonglage avec les grenouilles. ",
            "Il est le principal organisateur d'une exposition de sculpture sur nuage.",
            "Suite à la réponse négative de sa candidature spontanée comme roi des Wallons,<br>
             mon enfant fait face à un burnout sévère.",

        ],
        'autreExcuse' => [
            "404, EXCUSE NOT FOUND.",
            "Suite à une grosse crise de flemme, la sortie de sa chambre lui est complètement impossible.",
            "Il se retrouve coincé à la maison suite à une grève spontannée de son cartable."
        ]
    ];

    $messageAleatoireMaladie = $messages['maladie'][array_rand($messages['maladie'])];
    $messageAleatoireAnimal = $messages['animal'][array_rand($messages['animal'])];
    $messageAleatoireActiviteExtra = $messages['activiteExtra'][array_rand($messages['activiteExtra'])];
    $messageAleatoireAutreExcuse = $messages['autreExcuse'][array_rand($messages['autreExcuse'])];

    if ($sexeEnfant == 'fille') {
        $messageEnseignant = "Mr/Mme $nomEnseignant,<br> $nomEnfant ne sera pas présente le $dateAbsence à votre cours.";
    } else {
        $messageEnseignant = "Mr/Mme $nomEnseignant,<br><br> $nomEnfant ne sera pas présent le $dateAbsence à votre cours.";
    }

    switch ($raisonAbsence) {
        case 'maladie':
            $message = $messageAleatoireMaladie;
            break;
        case 'animal':
            $message = $messageAleatoireAnimal;
            break;
        case 'activiteExtra':
            $message = $messageAleatoireActiviteExtra;
            break;
        case 'autreExcuse':
            $message = $messageAleatoireAutreExcuse;
            break;
    }

    echo "<p>Absence confirmée pour $nomEnfant, $sexeEnfant, sous la supervision de $nomEnseignant.</p>";
    echo "<p>Date de l'absence : " . date("l, j F Y", strtotime($dateAbsence)) . "</p>";
    echo "<p>Motif : $raisonAbsence</p>";

    echo "<div class='container'>";
    echo "<p>$messageEnseignant<br> $message<br><br>Cordialement,<br>ma maman.</p>";
    echo "</div>";
}
?>
</body>
</html>