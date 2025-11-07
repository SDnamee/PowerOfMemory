<?php

require_once 'config.php'; // Relie le fichier config contenant les infos de connexion

function connectToDbAndGetPdo(): PDO
    
$dsn = 'mysql:host=localhost;dbname=PowerOfMemory;charset=utf8';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
    exit;
}
function updateUserProfile(PDO $pdo, int $userId, string $newEmail, string $newPassword): bool
{
    $sql = "UPDATE users SET email = :email, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $newEmail);
    $stmt->bindValue(':password', $newPassword);
    $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}


    function getScoresByPdo(PDO $pdo, string $pseudo): array
{
    // Requête SQL pour sélectionner les scores où le pseudo contient la valeur saisie
    $sql = "SELECT * FROM score WHERE pseudo LIKE :pseudo";

    // Prépare la requête pour éviter les injections SQL
    $stmt = $pdo->prepare($sql);

    // Associe la valeur du pseudo au paramètre `:pseudo` de la requête
    $stmt->bindValue(':pseudo', "%$pseudo%");

    // Exécute la requête
    $stmt->execute();

    // Retourne tous les résultats sous forme de tableau associatif
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

