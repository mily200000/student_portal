<?php
// Traitement de la suppression
if (isset($_GET['delete_project'])) {
    $id = $_GET['delete_project'];
    $pdo->prepare("DELETE FROM projects WHERE id = ?")->execute([$id]);
    header("Location: ?section=projects");
    exit();
}

// Traitement de l'ajout
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_project'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $stmt = $pdo->prepare("INSERT INTO projects (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $description]);
}
?>

<div class="card">
    <h2><i class="fas fa-project-diagram"></i> Gestion des Projets de Fin d'Étude</h2>
    
    <!-- Formulaire d'ajout -->
    <div class="card" style="margin-bottom: 30px;">
        <h3>Ajouter un Nouveau Projet</h3>
        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px;">Titre du projet :</label>
                <input type="text" name="title" style="width:100%; padding:8px;" required>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px;">Description :</label>
                <textarea name="description" style="width:100%; padding:8px; height:100px;" required></textarea>
            </div>
            
            <button type="submit" name="add_project" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer le projet
            </button>
        </form>
    </div>
    
    <!-- Liste des projets existants -->
    <div class="card">
        <h3>Projets Existants</h3>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $projects = $pdo->query("SELECT * FROM projects ORDER BY title")->fetchAll();
                foreach ($projects as $project):
                ?>
                <tr>
                    <td><?= htmlspecialchars($project['title']) ?></td>
                    <td><?= htmlspecialchars(substr($project['description'], 0, 50)) ?>...</td>
                    <td>
                        <a href="?section=projects&delete_project=<?= $project['id'] ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('Supprimer ce projet ?')">
                            <i class="fas fa-trash"></i> Supprimer
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>