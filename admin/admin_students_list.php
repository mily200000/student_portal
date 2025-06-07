<div class="card">
    <h2><i class="fas fa-users"></i> Liste des Étudiants</h2>
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Projets Favoris</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $students = $pdo->query("
                SELECT s.*, GROUP_CONCAT(p.title SEPARATOR ', ') as wishlist
                FROM students s
                LEFT JOIN student_project_wishlist w ON s.id = w.student_id
                LEFT JOIN projects p ON w.project_id = p.id
                GROUP BY s.id
                ORDER BY s.last_name, s.first_name
            ")->fetchAll();
            
            foreach ($students as $student):
            ?>
            <tr>
                <td><?= htmlspecialchars($student['last_name']) ?></td>
                <td><?= htmlspecialchars($student['first_name']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= $student['wishlist'] ? htmlspecialchars($student['wishlist']) : 'Aucun' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>