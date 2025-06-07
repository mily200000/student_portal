<?php
// Suppression de la wishlist
if (isset($_GET['remove_from_wishlist'])) {
    $project_id = $_GET['remove_from_wishlist'];
    $pdo->prepare("DELETE FROM student_project_wishlist WHERE student_id = ? AND project_id = ?")
        ->execute([$student_id, $project_id]);
    header("Location: ?section=wishlist");
    exit();
}
?>

<div class="card">
    <h2><i class="fas fa-heart"></i> Ma Wishlist</h2>
    
    <?php
    $wishlist = $pdo->query("
        SELECT p.* FROM projects p
        JOIN student_project_wishlist w ON p.id = w.project_id
        WHERE w.student_id = $student_id
        ORDER BY p.title
    ")->fetchAll();
    
    if (empty($wishlist)): ?>
        <div class="card">
            <p>Vous n'avez aucun projet dans votre wishlist.</p>
            <a href="?section=projects" class="btn btn-primary">
                <i class="fas fa-project-diagram"></i> Parcourir les projets
            </a>
        </div>
    <?php else: ?>
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
                    <?php foreach ($wishlist as $project): ?>
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:12px;"><?= htmlspecialchars($project['title']) ?></td>
                        <td style="padding:12px;"><?= htmlspecialchars(substr($project['description'], 0, 50)) ?>...</td>
                        <td style="padding:12px;">
                            <a href="?section=wishlist&remove_from_wishlist=<?= $project['id'] ?>" 
                               class="btn btn-danger">
                                <i class="fas fa-trash"></i> Retirer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>