<?php
// Ajout à la wishlist
if (isset($_GET['add_to_wishlist'])) {
    $project_id = $_GET['add_to_wishlist'];
    $pdo->prepare("INSERT INTO student_project_wishlist (student_id, project_id) VALUES (?, ?)")
        ->execute([$student_id, $project_id]);
}
?>

<div class="card">
    <h2><i class="fas fa-project-diagram"></i> Projets Disponibles</h2>
    
    <div class="card">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th style="padding:12px; text-align:left;">Titre</th>
                    <th style="padding:12px; text-align:left;">Description</th>
                    <th style="padding:12px; text-align:left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $projects = $pdo->query("
                    SELECT p.*, 
                    (SELECT COUNT(*) FROM student_project_wishlist w 
                     WHERE w.project_id = p.id AND w.student_id = $student_id) as in_wishlist
                    FROM projects p
                    ORDER BY p.title
                ")->fetchAll();
                
                foreach ($projects as $project):
                ?>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:12px;"><?= htmlspecialchars($project['title']) ?></td>
                    <td style="padding:12px;"><?= htmlspecialchars(substr($project['description'], 0, 50)) ?>...</td>
                    <td style="padding:12px;">
                        <?php if ($project['in_wishlist']): ?>
                            <span style="color:green;">Déjà dans ma wishlist</span>
                        <?php else: ?>
                            <a href="?section=projects&add_to_wishlist=<?= $project['id'] ?>" 
                               class="btn btn-primary">
                                <i class="fas fa-heart"></i> Ajouter
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>