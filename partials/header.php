<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
$is_logged_in = isset($_SESSION['user_id']);
$is_admin = $is_logged_in && ($_SESSION['role'] ?? '') === 'admin';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail Étudiant - Université de Sétif</title>
    <link rel="stylesheet" href="../styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <img src="img/university.png" alt="Logo Université">
                <h1>Portail Étudiant</h1>
            </div>
            <nav class="main-nav">
                <ul>
                    <li>
                        <a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    <li>
                        <a href="computer_science.php" class="<?= ($current_page == 'computer_science.php') ? 'active' : '' ?>">
                            <i class="fas fa-laptop-code"></i> Informatique
                        </a>
                    </li>
                    <li>
                        <a href="math.php" class="<?= ($current_page == 'math.php') ? 'active' : '' ?>">
                            <i class="fas fa-square-root-alt"></i> Mathématiques
                        </a>
                    </li>
                    <li>
                        <a href="physics.php" class="<?= ($current_page == 'physics.php') ? 'active' : '' ?>">
                            <i class="fas fa-atom"></i> Physique
                        </a>
                    </li>
                    <li>
                        <a href="chemistry.php" class="<?= ($current_page == 'chemistry.php') ? 'active' : '' ?>">
                            <i class="fas fa-flask"></i> Chimie
                        </a>
                    </li>
                    <li>
                        <a href="login.php" class="btn-login">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>