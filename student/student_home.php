<div class="card">
    <div class="welcome-header">
        <h2><i class="fas fa-user-graduate"></i> Bienvenue, <?= htmlspecialchars($student['first_name']) ?> !</h2>
        <span>Dernière connexion: <?= date('d/m/Y') ?></span>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        <div class="card">
            <h3><i class="fas fa-project-diagram"></i> Projets disponibles</h3>
            <?php
            $count = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
            echo "<p style='font-size:24px; margin:10px 0;'>$count projets</p>";
            ?>
            <a href="?section=projects" class="btn btn-primary">Voir les projets</a>
        </div>
        
        <div class="card">
            <h3><i class="fas fa-heart"></i> Ma wishlist</h3>
            <?php
            $count = $pdo->query("SELECT COUNT(*) FROM student_project_wishlist WHERE student_id = $student_id")->fetchColumn();
            echo "<p style='font-size:24px; margin:10px 0;'>$count projets</p>";
            ?>
            <a href="?section=wishlist" class="btn btn-primary">Voir ma sélection</a>
        </div>
    </div>
    
    <div class="card" style="margin-top: 20px;">
        <h3><i class="fas fa-bullhorn"></i> Dernières annonces</h3>
        <?php
        $announcements = $pdo->query("SELECT * FROM announcements ORDER BY datetime DESC LIMIT 3")->fetchAll();
        foreach ($announcements as $announcement):
        ?>
        <div style="padding: 10px 0; border-bottom: 1px solid #eee;">
            <h4><?= htmlspecialchars($announcement['title']) ?></h4>
            <p><?= htmlspecialchars(substr($announcement['content'], 0, 100)) ?>...</p>
            <small><?= date('d/m/Y H:i', strtotime($announcement['datetime'])) ?></small>
        </div>
        <?php endforeach; ?>
    </div>
</div>