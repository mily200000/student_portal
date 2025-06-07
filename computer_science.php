<?php
require_once 'partials/header.php';
require_once 'backend/db_connect.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM announcements WHERE display = ? ORDER BY datetime DESC");
    $stmt->execute(['computer_science']);
    $announcements = $stmt->fetchAll();
} catch (PDOException $e) {
    $announcements = [];
}
?>
    <link rel="stylesheet" href="styles/main.css">

<main>
    <section class="department-hero cs-bg">
        <div class="container">
            <h1><i class="fas fa-laptop-code"></i> Département d'Informatique</h1>
            <p>Formation excellence en génie logiciel, IA et systèmes informatiques</p>
        </div>
    </section>

    <section class="department-announcements">
        <div class="container">
            <h2><i class="fas fa-bullhorn"></i> Annonces du Département</h2>
            <?php if (!empty($announcements)): ?>
                <div class="announcements-grid">
                    <?php foreach ($announcements as $announcement): ?>
                        <div class="announcement-card">
                            <h3><?= htmlspecialchars($announcement['title']) ?></h3>
                            <span class="announcement-date">
                                <?= date('d M Y', strtotime($announcement['datetime'])) ?>
                            </span>
                            <p><?= htmlspecialchars($announcement['content']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-results">Aucune annonce disponible</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once 'partials/footer.php'; ?>