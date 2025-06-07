<div class="card">
    <h2><i class="fas fa-tachometer-alt"></i> Tableau de Bord Admin</h2>
    <p>Bienvenue dans l'interface d'administration du portail étudiant.</p>
    
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 30px;">
        <div class="card">
            <h3><i class="fas fa-users"></i> Étudiants</h3>
            <?php
            $count = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
            echo "<p style='font-size:24px; margin:10px 0;'>$count</p>";
            ?>
            <a href="?section=students" class="btn btn-primary">Voir la liste</a>
        </div>
        
        <div class="card">
            <h3><i class="fas fa-project-diagram"></i> Projets</h3>
            <?php
            $count = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
            echo "<p style='font-size:24px; margin:10px 0;'>$count</p>";
            ?>
            <a href="?section=projects" class="btn btn-primary">Gérer les projets</a>
        </div>
        
        <div class="card">
            <h3><i class="fas fa-bullhorn"></i> Annonces</h3>
            <?php
            $count = $pdo->query("SELECT COUNT(*) FROM announcements")->fetchColumn();
            echo "<p style='font-size:24px; margin:10px 0;'>$count</p>";
            ?>
            <a href="?section=announcements" class="btn btn-primary">Gérer les annonces</a>
        </div>
    </div>
</div>