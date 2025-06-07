<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once 'backend/db_connect.php';

// Détection de la section active
$current_section = $_GET['section'] ?? 'home';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Université de Sétif</title>
    <style>
        body { 
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px 0;
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
            background: #34495e;
            border-left: 4px solid #3498db;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background: #ecf0f1;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2 style="padding: 0 20px 20px;">Admin Panel</h2>
        <nav>
            <a href="?section=home" class="<?= $current_section === 'home' ? 'active' : '' ?>">
                <i class="fas fa-home"></i> Accueil
            </a>
            <a href="?section=announcements" class="<?= $current_section === 'announcements' ? 'active' : '' ?>">
                <i class="fas fa-bullhorn"></i> Gestion Annonces
            </a>
            <a href="?section=projects" class="<?= $current_section === 'projects' ? 'active' : '' ?>">
                <i class="fas fa-project-diagram"></i> Projets Fin d'Étude
            </a>
            <a href="?section=students" class="<?= $current_section === 'students' ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Liste Étudiants
            </a>
            <a href="backend/logout.php" style="margin-top: 20px;">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </nav>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <?php
        // Inclusion dynamique en fonction de la section
        switch($current_section) {
            case 'announcements':
                include 'admin/admin_announcements.php';
                break;
            case 'projects':
                include 'admin/admin_projects.php';
                break;
            case 'students':
                include 'admin/admin_students_list.php';
                break;
            default:
                include 'admin/admin_home.php';
        }
        ?>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    
    <script>
        // Confirmation pour les actions sensibles
        document.querySelectorAll('.btn-danger').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (!confirm('Êtes-vous sûr de vouloir effectuer cette action ?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
<script src="../scripts/admin_dashboard.js" defer></script>
</body>
</html>