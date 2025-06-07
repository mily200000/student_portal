<?php
require_once 'backend/db_connect.php'; // Assurez-vous que la connexion DB est chargée

try {
    // Récupérer les annonces générales (sans département spécifique)
    $stmt = $pdo->prepare("SELECT * FROM announcements WHERE display IS NULL OR display = 'general' ORDER BY datetime DESC");
    $stmt->execute();
    $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $announcements = []; // En cas d'erreur, initialiser comme vide
    error_log("Erreur DB : " . $e->getMessage());
}

// Charger le header
require_once 'partials/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail Étudiant - Université de Sétif</title>
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <main class="hero-section">
        <div class="hero-overlay">
            <div class="container">
                <h2>Bienvenue sur le Portail Étudiant</h2>
                <p>Accédez aux annonces, projets de fin d'études et bien plus encore</p>
                <div class="hero-buttons">
                    <a href="login.php" class="btn btn-primary">Espace Étudiant</a>
                    <a href="login.php?role=admin" class="btn btn-secondary">Espace Admin</a>
                </div>
            </div>
        </div>
    </main>

    <section class="announcements-section">
        <div class="container">
            <h2><i class="fas fa-bullhorn"></i> Annonces Générales</h2>
            <div class="announcements-grid">
                <?php if (!empty($announcements)): ?>
                    <?php foreach ($announcements as $announcement): ?>
                        <div class="announcement-card">
                            <div class="announcement-header">
                                <h3><?= htmlspecialchars($announcement['title']) ?></h3>
                                <span class="announcement-date">
                                    <?= date('d M Y', strtotime($announcement['datetime'])) ?>
                                </span>
                            </div>
                            <div class="announcement-content">
                                <p><?= htmlspecialchars($announcement['content']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="announcement-card">
                        <div class="announcement-header">
                            <h3>Aucune annonce disponible</h3>
                        </div>
                        <div class="announcement-content">
                            <p>Il n'y a pas d'annonces à afficher pour le moment.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="departments-section">
        <div class="container">
            <h2><i class="fas fa-graduation-cap"></i> Nos Départements</h2>
            <div class="departments-grid">
                <a href="computer_science.php" class="department-card cs">
                    <i class="fas fa-laptop-code"></i>
                    <h3>Informatique</h3>
                </a>
                <a href="math.php" class="department-card math">
                    <i class="fas fa-square-root-alt"></i>
                    <h3>Mathématiques</h3>
                </a>
                <a href="physics.php" class="department-card physics">
                    <i class="fas fa-atom"></i>
                    <h3>Physique</h3>
                </a>
                <a href="chemistry.php" class="department-card chemistry">
                    <i class="fas fa-flask"></i>
                    <h3>Chimie</h3>
                </a>
            </div>
        </div>
    </section>

    <?php
       require_once 'backend/db_connect.php';

       try {
       // Version 1 : Si vous avez une colonne 'display'
       // $stmt = $pdo->prepare("SELECT * FROM announcements WHERE display IS NULL OR display = 'general' ORDER BY datetime DESC");
    
       // Version 2 : Si vous avez une colonne 'department'
        $stmt = $pdo->prepare("SELECT * FROM announcements WHERE department IS NULL OR department = 'general' OR department = '' ORDER BY datetime DESC");
    
        $stmt->execute();
        $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Debug : afficher les annonces récupérées
        // echo "<pre>"; print_r($announcements); echo "</pre>";
       } catch (PDOException $e) {
            $announcements = [];
            error_log("Erreur DB: " . $e->getMessage());
}

require_once 'partials/footer.php';
?>

<!DOCTYPE html>
<html lang="fr">
<!-- ... (le reste de votre code HTML) ... -->
</body>
</html>