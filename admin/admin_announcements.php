<?php
// Traitement de la suppression
if (isset($_GET['delete_announcement'])) {
    $id = $_GET['delete_announcement'];
    $pdo->prepare("DELETE FROM announcements WHERE id = ?")->execute([$id]);
    header("Location: ?section=announcements");
    exit();
}

// Traitement de l'ajout
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_announcement'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $department = $_POST['department'];
    
    $stmt = $pdo->prepare("INSERT INTO announcements (title, content, display, datetime) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$title, $content, $department]);
}
?>

<div class="card">
    <h2><i class="fas fa-bullhorn"></i> Gestion des Annonces</h2>
    
    <!-- Formulaire d'ajout -->
    <div class="card" style="margin-bottom: 30px;">
        <h3>Créer une Nouvelle Annonce</h3>
        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px;">Titre :</label>
                <input type="text" name="title" style="width:100%; padding:8px;" required>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px;">Contenu :</label>
                <textarea name="content" style="width:100%; padding:8px; height:100px;" required></textarea>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px;">Département :</label>
                <select name="department" style="width:100%; padding:8px;">
                    <option value="general">Général</option>
                    <option value="computer_science">Informatique</option>
                    <option value="physics">Physique</option>
                    <option value="chemistry">Chimie</option>
                    <option value="math">Mathématiques</option>
                </select>
            </div>
            
            <button type="submit" name="add_announcement" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Publier l'annonce
            </button>
        </form>
    </div>
    
    <!-- Liste des annonces existantes -->
    <div class="card">
        <h3>Annonces Existantes</h3>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Département</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $announcements = $pdo->query("SELECT * FROM announcements ORDER BY datetime DESC")->fetchAll();
                foreach ($announcements as $announcement):
                ?>
                <tr>
                    <td><?= htmlspecialchars($announcement['title']) ?></td>
                    <td>
                        <?= match($announcement['display']) {
                            'general' => 'Général',
                            'computer_science' => 'Informatique',
                            'physics' => 'Physique',
                            'chemistry' => 'Chimie',
                            'math' => 'Mathématiques'
                        } ?>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($announcement['datetime'])) ?></td>
                    <td>
                        <a href="?section=announcements&delete_announcement=<?= $announcement['id'] ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('Supprimer cette annonce ?')">
                            <i class="fas fa-trash"></i> Supprimer
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>