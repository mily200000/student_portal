<?php

session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'student') {
    header("Location: login.php");
    exit();
}

require_once 'backend/db_connect.php';

// Récupérer les données de l'étudiant
$student_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch();

// Détection de la section active
$section = $_GET['section'] ?? 'home';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Étudiant - Université de Sétif</title>
    
    <style>
        body { 
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background: #3498db;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #2980b9;
            border-left: 4px solid #2c3e50;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background: #f5f5f5;
        }
        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .welcome-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn {
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background: #3498db;
            color: white;
        }
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2 style="padding: 0 20px 20px;">Menu Étudiant</h2>
        <a href="?section=home" class="<?= $section === 'home' ? 'active' : '' ?>">
            <i class="fas fa-home"></i> Accueil
        </a>
        <a href="?section=projects" class="<?= $section === 'projects' ? 'active' : '' ?>">
            <i class="fas fa-project-diagram"></i> Projets disponibles
        </a>
        <a href="?section=wishlist" class="<?= $section === 'wishlist' ? 'active' : '' ?>">
            <i class="fas fa-heart"></i> Ma wishlist
        </a>
        <a href="backend/logout.php" style="margin-top: 20px;">
            <i class="fas fa-sign-out-alt"></i> Déconnexion
        </a>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <?php
        // Inclusion dynamique en fonction de la section
        switch($section) {
            case 'projects':
                include 'student/student_projects.php';
                break;
            case 'wishlist':
                include 'student/student_wishlist.php';
                break;
            default:
                include 'student/student_home.php';
        }
        ?>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    
    <script>
        // Script pour confirmer les actions importantes
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    if (!confirm('Êtes-vous sûr de vouloir effectuer cette action ?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>

</body>
</html>